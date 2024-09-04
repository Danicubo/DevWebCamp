<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Restablece tu cuenta en DevWebCamp</p>

    <form action="/login" class="formulario">
    <div class="formulario__campo">
        <label for="email" class="formulario__label">Email</label>
        <input 
        type="email"
        class="formulario__input"
        placeholder="Tu email de registro"
        id="email"
        name="email"
        />
    </div>
    <input type="submit" value="Iniciar Sesión" class="formulario__submit" />
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/registro" class="acciones__enlace">¿No tienes cuenta? Crea una</a>
    </div>

</main>