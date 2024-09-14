(function (){
    const ponentesInput = document.querySelector('#ponente');

    if(ponentesInput) {
        let ponentes = [];
        let ponentesFiltrado = [];
        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="ponente_id"]');

        obtenerPonentes();

        ponentesInput.addEventListener('input', buscarPonentes);

        if(ponenteHidden.value){
            (async() => {
                const ponente = await obtenerPonente(ponenteHidden.value);
                const { nombre, apellido} = ponente
                const ponenteDOM = document.createElement('LI');
                ponenteDOM.classList.add('listado-ponentes__ponente', 'listado-ponentes__ponente--seleccionado');
                ponenteDOM.textContent = `${nombre} ${apellido}`;
                listadoPonentes.appendChild(ponenteDOM);
                
            })()
        }

        async function obtenerPonentes() {
            const url = `/api/ponentes`;
            try {
                const respuesta = await fetch(url);
                const resultado = await respuesta.json();

                formatearPonentes(resultado);
                   
            } catch (error) {   
                console.log(error)
            }
        }

        async function obtenerPonente(id) {
            const url = `/api/ponente?id=${id}`;
            try {
                const respuesta = await fetch(url);
                const resultado = await respuesta.json();
                return resultado;
                   
            } catch (error) {   
                console.log(error)
            }
        }

        function formatearPonentes(arraPonentes = []) {
            ponentes = arraPonentes.map( ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })

        }
        function buscarPonentes(e) {
            const busqueda = e.target.value;

            if(busqueda.length > 3){
                const expresion = new RegExp(busqueda, "i");
                ponentesFiltrado = ponentes.filter(ponente =>{
                    if(ponente.nombre.toLowerCase().search(expresion) != -1){
                        return ponente;
                    }
                });      
            } else {
                ponentesFiltrado = [];
            }
            mostrarPonentes();
        }
        function mostrarPonentes(){
            
            while(listadoPonentes.firstChild){
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if(ponentesFiltrado.length > 0) {
                ponentesFiltrado.forEach(ponente => {
                    const ponenteHtml = document.createElement('LI');
                    ponenteHtml.classList.add('listado-ponentes__ponente');
                    ponenteHtml.textContent = ponente.nombre;
                    ponenteHtml.dataset.ponenteId = ponente.id;
                    ponenteHtml.onclick = seleccionarPonente;
    
                    //Añadir al DOM
                    listadoPonentes.appendChild(ponenteHtml);
                })
            } else {
                const noResultado = document.createElement('P');
                noResultado.classList.add('listado-ponentes__no-resultado');
                noResultado.textContent = 'No hay resultados para tu búsqueda';
                listadoPonentes.appendChild(noResultado);
            }

            
        }
        function seleccionarPonente(e) {
            const ponente = e.target;
            //Remover clase previa
            const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
            
            if(ponentePrevio) {
                
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
            }
            ponente.classList.add('listado-ponentes__ponente--seleccionado');
            ponenteHidden.value = ponente.dataset.ponenteId;
        }
    }
})();