<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia Sesión en DevWebCamp</p>

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
    <div class="formulario__campo">
        <label for="password" class="formulario__label">Password</label>
        <input 
        type="password"
        class="formulario__input"
        placeholder="Tu password de registro"
        id="password"
        name="password"
        />
    </div>
    <input type="submit" value="Iniciar Sesión" class="formulario__submit" />
    </form>
    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿No tienes cuenta? Crea una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password? Restablece tu password</a>
    </div>

</main>