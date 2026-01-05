<div class="tituloCentralCuenta">
    <h3></h3>
</div>
<form class="botonesCuenta">
    <div id="botonVolverCuentadiv">
        <button id="botonVolverCuenta" class="botonAzul" type="submit" name="volver">Volver</button>
    </div>
    <button id="botonCuenta" class="botonCuenta" type="submit" name="cuenta"><?php echo $_SESSION['inicialVGDAW']; ?></button>
    <button id="botonSessionIPrivado" class="botonSession" type="submit" name="cerrar">Cerrar Sessión</button>
</form>

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
                        <a href="#" class="menuCuenta  activo">
                            <span class="iconoMenu li1"><i class="fa-regular fa-address-book"></i></span>
                            Información personal
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menuCuenta ">
                            <span class="iconoMenu li2"><i class="fa-solid fa-shield-halved"></i></span>
                            Seguridad
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <section class="contenidoPerfil">

            <form method="post">
                <div class="tablaDatosGrid">
                    <div class="filaDato">
                        <div class="etiqueta">FOTO</div>
                        <div class="valor">Añade una foto de perfil para personalizar tu cuenta</div>
                        <div class="icono">
                            <div class="inicialGrande"><?php echo $_SESSION['inicialVGDAW']; ?></div>
                        </div>
                    </div>

                    <div class="filaDato">
                        <div class="etiqueta">NOMBRE</div>
                        <div class="valor"><?php echo $_SESSION['usuarioVGDAWAppLoginLogoff']->getDescUsuario(); ?></div>
                        <div class="icono"><span>&rsaquo;</span></div>
                    </div>

                    <div class="filaDato">
                        <div class="etiqueta">USUARIO</div>
                        <div class="valor"><?php echo $_SESSION['usuarioVGDAWAppLoginLogoff']->getCodUsuario(); ?></div>
                        <div class="icono"><span>&rsaquo;</span></div>
                    </div>
                    <div class="filaDato filaDesplegable">
                        <div class="etiqueta">CONTRASEÑA</div>
                        <div class="valor">
                            <input type="password" name="passwordCuenta" id="passwordCuenta" value="********" disabled>
                            <div class="desplegable">
                                <button type="submit" name="cambiarPassword" class="botonCambiarPswd">Cambiar contraseña</button>
                            </div>
                        </div>
                        <div class="icono"><span class="flecha">&rsaquo;</span></div>
                    </div>

                    <div class="filaDato">
                        <div class="etiqueta">PERFIL</div>
                        <div class="valor"><?php echo $_SESSION['usuarioVGDAWAppLoginLogoff']->getPerfil(); ?></div>
                        <div class="icono"><span>&rsaquo;</span></div>
                    </div>
                </div>
            </form>

        </section>
    </div>

</main>