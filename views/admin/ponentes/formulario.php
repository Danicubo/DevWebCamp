<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input 
        type="text" 
        name="nombre"
        id="nombre"
        class="formulario__input"
        placeholder="Nombre Ponente"
        value="<?php echo $ponente->nombre ?? '';  ?>"
        />
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellidos</label>
        <input 
        type="text" 
        name="apellido"
        id="apellido"
        class="formulario__input"
        placeholder="Apellido Ponente"
        value="<?php echo $ponente->apellido ?? '';  ?>"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input 
        type="text" 
        name="ciudad"
        id="ciudad"
        class="formulario__input"
        placeholder="Ciudad Ponente"
        value="<?php echo $ponente->ciudad ?? '';  ?>"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="pais">Pais Ponente</label>
        <input 
        type="text" 
        name="pais"
        id="pais"
        class="formulario__input"
        placeholder="Pais Ponente"
        value="<?php echo $ponente->pais ?? '';  ?>"
        />
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input 
        type="file" 
        name="imagen"
        id="imagen"
        class="formulario__input formulario__input--file"
        />
    </div>
    <?php if(isset($ponente->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Actual</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/image/speakers/' . $ponente->imagen;?>.webp" type="image/webp"> 
                <source srcset="<?php echo $_ENV['HOST'] . '/image/speakers/' . $ponente->imagen;?>.png" type="image/png"> 
                <img src="<?php echo $_ENV['HOST'] . '/image/speakers/' . $ponente->imagen;?>.png" alt="Imagen Ponente">
            </picture>
        </div>
    <?php } ?>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Áreas de Experiencia</label>
        <input 
        type="text" 
        id="tags_input"
        class="formulario__input"
        placeholder="Ej: NodeJS, VueJS, PHP, CSS, Laravel, UX/UI"
        />
        <div id="tags" class="formulario__listado">
           
        </div>
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
            type="text" 
            name="redes[facebook]"
            class="formulario__input--sociales"
            placeholder="Facebook"
            value="<?php echo $redes->facebook ?? '';  ?>"
            />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-square-twitter"></i>
            </div>
            <input 
            type="text" 
            name="redes[twitter]"
            class="formulario__input--sociales"
            placeholder="Twitter"
            value="<?php echo $redes->twitter ?? '';  ?>"
            />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
            type="text" 
            name="redes[youtube]"
            class="formulario__input--sociales"
            placeholder="YouTube"
            value="<?php echo $redes->youtube ?? '';  ?>"
            />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
            type="text" 
            name="redes[instagram]"
            class="formulario__input--sociales"
            placeholder="Instagram"
            value="<?php echo $redes->instagram ?? '';  ?>"
            />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
            type="text" 
            name="redes[tiktok]"
            class="formulario__input--sociales"
            placeholder="TikTok"
            value="<?php echo $redes->tiktok ?? '';  ?>"
            />
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
            type="text" 
            name="redes[github]"
            class="formulario__input--sociales"
            placeholder="Github"
            value="<?php echo $redes->github ?? '';  ?>"
            />
        </div>
    </div>
</fieldset>    