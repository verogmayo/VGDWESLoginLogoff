<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véro Grué - DWESLoginLogoffTema5</title>
        <!--Fuente de google font-->
        <!--Para descargar iconos. https://v2.boxicons.com/usage  (import the css)-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="webroot/css/styles.css">
        <!--https://cdnjs.com/libraries/font-awesome --> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="proyecto">
                <p class="letras">
                    <span>L</span><span>O</span><span>G</span><span>I</span><span>N</span>
                    <span>&nbsp;</span>
                    <span>L</span><span>O</span><span>G</span><span>O</span><span>F</span><span>F</span>
                </p>
            </div>
            <div class="tituloCentral">
                <p class="letras">
                    <span>I</span><span>N</span><span>I</span><span>C</span><span>I</span><span>O</span>
                    <span>&nbsp;</span>
                    <span>P</span><span>Ú</span><span>B</span><span>L</span><span>I</span><span>C</span><span>O</span>
                </p>
            </div>
            <nav>
                <form method="post">
                    <!-- Botones de idiomas -->
                    <!-- Si no se ha iniciado cession o si se hace clic en el boton de español, el icono de la bandera de españa se hace mas grande-->
                    <button class="idioma <?php echo (!isset($_COOKIE['idioma']) || $_COOKIE['idioma'] == 'es') ? 'seleccionado' : ''; ?>" 
                            type="submit" name="idioma" id="es" value="es"> <img src="webroot/images/banderaEs.png" width="20" alt="es"/> </button>
                     <!-- Si se hace clic en el icono de la bandera de GB, el icono se hace mas grande-->
                    <button class="idioma <?php echo (isset($_COOKIE['idioma']) && $_COOKIE['idioma'] == 'en') ? 'seleccionado' : ''; ?>"  
                            type="submit" name="idioma" id="en" value="en"> <img src="webroot/images/banderaGb.png" width="20" alt="en" /> </button>	
                    <!-- Si se hace clic en el icono de la bandera de Francia, el icono se hace mas grande-->
                     <button class="idioma <?php echo (isset($_COOKIE['idioma']) && $_COOKIE['idioma'] == 'fr') ? 'seleccionado' : ''; ?>"  
                            type="submit" name="idioma" id="fr" value="fr"> <img src="webroot/images/banderaFr.png" width="20" alt="fr" /> </button>    
                    <!-- Botón de login -->
                    <button class="botonSession" type="submit" name="login" id="login">login</button>
                </form>
            </nav>
        </header>
        <main>
            <section>

                <div class="titulo">
                    <h2>BIENVENIDO A INICIO PÚBLICO</h2>
                </div>

            </section>
        </main>
        <footer >
            <div class="footer">
                <div class="pais">
                    <p>España</p>
                    <div class="social-media">
                        <a href="https://github.com/verogmayo/VGDWESLoginLogoffTema5"><i class='bx bxl-github' ></i></a>
                    </div>
                </div>
                <div class="footerInfo">
                    <div class="info">
                        <p >
                            2025-26 IES LOS SAUCES. &#169;Todos los derechos reservados.</p> 
                            <address><a href="https://veroniquegru.ieslossauces.es/" target="_blank">Véronique Grué.</a> 
                                Fecha de Actualización :
                            <time datetime="2025-12-15"></time> 15-12-2025 </address>
                    </div>
                    <div class="google">
                        <a href="https://www.google.com/"><i class="fa-brands fa-google" style="color: #1a73e8;"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
