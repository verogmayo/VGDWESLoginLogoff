</header>
<main class="mainForm">
    <section class="formularioRegistro">
        <div class="imagen"><img src="webroot/images/logoV2.png" alt="logo" />
            <p class="pInicioSession"> Inicia Sesión en Login Logoff</p>
        </div>
        <form class="form" action="indexLoginLogoff.php" method="post">
            <div class="contenedorInput">
                <a style='color:red'><?php echo $aErrores['codUsuario'] ?></a><br>
                <input name="codUsuario" id="codUsuario" type="text" placeholder=" " value=''>
                <label for="codUsuario">Usuario:</label>
            </div>
            <div class="contenedorInput">
                <a style='color:red'><?php echo $aErrores['descUsuario'] ?></a><br>
                <input name="descUsuario" id="descUsuario" type="text" placeholder=" " value=''>
                <label for="descUsuario">Nombre Completo:</label>
            </div>

            <div class="contenedorInput">
                <a style='color:red'><?php echo $aErrores['password'] ?></a><br>
                <input name="password" id="password" type="password" placeholder=" " value=''>
                <label for="password">Contraseña: </label>
            </div>
            <div class="divBotones">
                <button id="botonSessionLogin" class="botonSession" type="submit" name="enviar">Enviar</button>
                <div class="botonVolverLogin">
                    <button id="botonVolverLogin" class="botonAzul" type="submit" name="volver">Volver</button>
                </div>

            </div>
        </form>
    </section>
</main>