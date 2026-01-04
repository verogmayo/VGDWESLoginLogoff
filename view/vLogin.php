</header>
<main class="mainForm">
    <section class="formulario">
        <div class="imagen"><img src="webroot/images/logo.png" alt="logo" />
            <p class="pInicioSession"> Inicia Sesión en Login Logoff</p>
        </div>
        <form class="form" action="indexLoginLogoff.php" method="post">
            <div class="contenedorInput">
                <a style='color:red'></a><br>
                <input name="usuario" id="usuario" type="text" placeholder=" " value=''>
                <label for="usuario">Usuario:</label>
            </div>
            <div class="contenedorInput">
                <a style='color:red'></a><br>
                <input name="password" id="password" type="password" placeholder=" " value=''>
                <label for="password">Contraseña: </label>
            </div>
            <div class="divBotones">
                <button id="botonSessionLogin" class="botonSession" type="submit" name="enviar">Enviar</button>
                <div class="botonVolverLogin">
                    <button id="botonVolverLogin" class="botonAzul" type="submit" name="volver">Volver</button>
                </div>
                <button id="botonCrearCuenta" class="botonAzul" type="submit" name="crearCuenta">Crear Cuenta</button>
            </div>
        </form>
    </section>
</main>