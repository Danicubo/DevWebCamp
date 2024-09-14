(function(){

    const categoria = document.querySelector('[name="categoria_id"]');
    const horas = document.querySelector('#horas');
    const inputHiddenDia = document.querySelector('[name="dia_id"]');
    const inputHiddenHora = document.querySelector('[name="hora_id"]');
    const dias = document.querySelectorAll('[name="dia"]');

    if(horas){

        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
        
        const busqueda = {
            categoria_id: +categoria.value || '',
            dia: +inputHiddenDia.value || '',
        }

        if(!Object.values(busqueda).includes('')) {
            async function iniciarApp() {
                await buscarEventos();
                const id = inputHiddenHora.value;
                //Resaltar hora actual
                const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
                horaSeleccionada.classList.remove('horas__hora--deshabilitado');
                horaSeleccionada.classList.add('horas__hora--seleccionada');

                horaSeleccionada.onclick = seleccionarHora;
            }  
            iniciarApp();  
        }
        

        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;

            inputHiddenHora.value = ''
            inputHiddenDia.value = ''
            //Deshabilitar hora
            const horaPrevia =  document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada')
            }
            if(Object.values(busqueda).includes('')){
                return;
            }

            buscarEventos();
        }
        async function buscarEventos() {    
            const { dia, categoria_id } = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;
            try {
                const resultado = await fetch(url);
                const eventos = await resultado.json();
                 
                obtenerHorasDisponibles(eventos);      
            } catch (error) {
                 
            console.log(error)
            }
            
        };

        function obtenerHorasDisponibles(eventos) {

            // Reiniciar las horas
            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitado'));
            // comprobar eventos ya tomados, y quitar la clase de deshabilitado

            const horasTomadas = eventos.map( evento => evento.hora_id);

           
            const listadoHorasArray = Array.from(listadoHoras);

            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitado'));
            
            const resultado = listadoHorasArray.filter( li => !horasTomadas.includes(li.dataset.horaId));
            resultado.forEach( li => li.classList.remove('horas__hora--deshabilitado'));

            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitado)');
            horasDisponibles.forEach( hora => hora.addEventListener('click', seleccionarHora));
 
        }
        function seleccionarHora(e) {

            //Deshabilitar hora
            const horaPrevia =  document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada')
            }

            //Agregar clase de seleccionado
            e.target.classList.add('horas__hora--seleccionada');
            inputHiddenHora.value = e.target.dataset.horaId;


            //LLenar el campo oculto de día
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }
    }
    

})();