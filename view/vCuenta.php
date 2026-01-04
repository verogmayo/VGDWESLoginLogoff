<!-- <div class="header"> -->
        <div class="tituloCentralCuenta">
            <h3>CUENTA</h3>
        </div>
        <form class="botonesCuenta">
            <div id="botonVolverCuentadiv">
                <button id="botonVolverCuenta" class="botonAzul" type="submit" name="volver">Volver</button>
            </div>
            <button id="botonCuenta" class="botonCuenta" type="submit" name="cuenta"><?php echo $_SESSION['inicialVGDAW']; ?></button>
            <button id="botonSessionIPrivado" class="botonSession" type="submit" name="cerrar">Cerrar Sessión</button>
        </form>
    <!-- </div>   -->
</header>
<main class="mainCuenta">
    <div class="cabeceraPerfil">
            <h1>Información personal</h1>
            
        </div>
    <div class="paginaCuentaContainer">
    <aside class="menuLateral">
        <nav>
            <ul>
                <li>
                    <a href="#" class="menuCuenta activo">
                        <span class="material-icons">person</span>
                        Información personal
                    </a>
                </li>
                <li>
                    <a href="#" class="menuCuenta">
                        <span class="material-icons">security</span>
                        Seguridad
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <section class="contenidoPerfil">
       

        <div class="tablaDatos">
            <div class="filaDato">
                <div class="etiqueta">FOTO</div>
                <div class="valor">Una foto ayuda a personalizar tu cuenta</div>
                <div class="accion">
                    <div class="inicialGrande"><?php echo $_SESSION['inicialVGDAW']; ?></div>
                </div>
            </div>

            <div class="filaDato">
                <div class="etiqueta">NOMBRE</div>
                <div class="valor"><?php echo $_SESSION['usuarioVGDAWAppLoginLogoff']->getDescUsuario(); ?></div>
                <div class="accion"><span>&rsaquo;</span></div>
            </div>

            <div class="filaDato">
                <div class="etiqueta">USUARIO</div>
                <div class="valor"><?php echo $_SESSION['usuarioVGDAWAppLoginLogoff']->getCodUsuario(); ?></div>
                <div class="accion"><span>&rsaquo;</span></div>
            </div>

            <div class="filaDato">
                <div class="etiqueta">PERFIL</div>
                <div class="valor"><?php echo $_SESSION['usuarioVGDAWAppLoginLogoff']->getPerfil(); ?></div>
                <div class="accion"><span>&rsaquo;</span></div>
            </div>
        </div>
    </section>
    </div>
     
</main>