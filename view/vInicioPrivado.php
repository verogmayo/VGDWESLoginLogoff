
    <!-- <div class="header"> -->
        <div class="tituloCentral">
            <p class="letras">
                <span>I</span><span>N</span><span>I</span><span>C</span><span>I</span><span>O</span>
                <span>&nbsp;</span>
                <span>P</span><span>R</span><span>I</span><span>V</span><span>A</span><span>D</span><span>O</span>
            </p>

        </div>
        <form action="">
            <button id="botonSessionIPrivado" class="botonSession" type="submit" name="cerrar">Cerrar Sessión</button>
        </form>

    <!-- </div> -->
</header>
<main>
    <section>
        <div class="titulo2">
             <?php
            // Obtener el objeto de la sesión 
            $oUsuarioActual = $_SESSION['usuarioVGDAWAppLoginLogoff'];

            //Sacar  los datos usando los métodos de tu clase Usuario
            $nombreUsuario = $oUsuarioActual->getDescUsuario();
            $numConexiones = $oUsuarioActual->getNumAccesos();
            $fechaAnterior = $oUsuarioActual->getFechaHoraUltimaConexionAnterior();

            echo "<h2>BIENVENIDO/A " . $nombreUsuario . "</h2>";

            if ($numConexiones <= 1) {
                echo "¡Esta es tu primera conexión!<br>";
            } else {
                // Si fechaAnterior ya es un objeto DateTime no hace falta hacer el "new DateTime", se puede usar:
                if ($fechaAnterior instanceof DateTime) {
                    $oFormatoFecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

                    $fecha = $oFormatoFecha->format($fechaAnterior);
                    $hora = $fechaAnterior->format('H:i');

                    echo "Esta es la vez número " . $numConexiones . " que se conecta.<br>";
                    echo "Usted se conectó por última vez el <br>";
                    echo $fecha . " a las " . $hora;
                }
            }
            ?>
        </div>
           

        
        <div class="botones">
            <form>
                <button class="botonCentral" type="submit" name="detalles" id="detalles">Detalles</button>

            </form>
        </div>
    </section>
</main>