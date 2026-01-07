        <div class="tituloCentral">
                <p>INICIO PRIVADO</p>

        </div>
        <form class="botonesDetalles" action="">
            <button id="botonCuenta" class="botonCuenta" type="submit" name="cuenta"><?php echo $_SESSION['inicialVGDAW']; ?></button>
            <button id="botonSessionIPrivado" class="botonSession" type="submit" name="cerrar">Cerrar Sessión</button>
        </form>
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