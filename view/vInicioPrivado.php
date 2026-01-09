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
            

            echo "<h2>BIENVENIDO/A " . $avInicioPrivado['descUsuario'] . "</h2>";

            if ($avInicioPrivado['numConexiones'] <= 1) {
                echo "¡Esta es tu primera conexión!<br>";
            } else {
                // Si fechaAnterior ya es un objeto DateTime no hace falta hacer el "new DateTime", se puede usar:
                if ($avInicioPrivado['fechaAnterior'] instanceof DateTime) {
                    // Formatear la fecha y hora según la configuración regional española
                    //IntlDateFormatter::FULL - muestra la fecha completa (día de la semana, día, mes y año)
                    //IntlDateFormatter::LONG - mostraría la fecha (día, mes y año)
                    //IntlDateFormatter::MEDIUM - mostraría la fecha abreviada (ejemplo:12 ene 2025)
                    //IntlDateFormatter::NONE - no muestra la hora
                    $oFormatoFecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

                    $fecha = $oFormatoFecha->format($avInicioPrivado['fechaAnterior']);
                    $hora = $avInicioPrivado['fechaAnterior']->format('H:i');
                    echo "Esta es la vez número " . $avInicioPrivado['numConexiones'] . " que se conecta.<br>";
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