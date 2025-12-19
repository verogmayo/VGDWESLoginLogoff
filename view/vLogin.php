</header>
<main class="mainForm">
            <section class="formulario">
                <div class="imagen"><img src="webroot/images/logo.png" alt="logo"/>
                    <p class="pInicioSession"> Inicia Sessión en Login Logof Tema5</p>
                </div>
                <form class="form" action="" method="post">
                    <div class="contenedorInput">
                        <a style='color:red'></a><br>
                        <input  name="usuario" id="usuario" type="text" placeholder=" " value=''>
                        <label for="usuario">Usuario:</label>
                    </div>
                    <div class="contenedorInput">
                        <a style='color:red'></a><br>
                        <input name="passwd" id="passwd" type="password" placeholder=" " value=''>
                        <label for="passwd" >Contraseña: </label>
                    </div>
                    <div class="divBotones">
                         <button id="botonSessionLogin" class="botonSession" type="submit" name="enviar">Enviar</button>
                        <div  class="botonVolverLogin">
                          <button id="botonVolverLogin" class="botonAzul" type="submit" name="volver">Volver</button>
                        </div>
                       
                    </div>
                </form>         
            </section>
        </main>