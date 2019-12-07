<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">

            <a class='home' href='tarefasAsignadas.php'>
                <h3 id='cabecera_navBar'>XestorGal</h3>

                <?php
                $ruta = '../imgUsuarios/'.$_SESSION['login'];
                $login = $_SESSION['login'];
                $loginImg = 'img_'.$_SESSION['login'];
                echo "<img id='imgUsuario' src='$ruta' alt='$loginImg' width='200' />";
                ?>
            </a>
            <strong>XTR</strong>

        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="conta.php">
                    <i class="fas fa-home"></i> A miña conta
                </a>
            </li>
            <li>

                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i> Tarefas
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="tarefasAsignadas.php">Tarefas Asignadas</a>
                    </li>
                    <li>
                        <a href="tarefasCreadas.php">Tarefas Creadas</a>
                    </li>
                    <li>
                        <a href="tarefasFinalizadas.php">Tarefas Finalizadas</a>
                    </li>
                    <li>
                        <a href="formularioCrearTarefa.php">Crear Tarefas</a>
                    </li>
                </ul>

                <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-users"></i> Equipo
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu2">
                    <li>
                        <a href="paxinaEquipo.php">Equipo</a>
                    </li>
                    <li>
                        <a href="formularioCrearEquipo.php">Crear Equipo</a>
                    </li>
                </ul>
            </li>
            <!--   <li>
                <a href="#">
                    <i class="fas fa-image"></i> Portfolio
                </a>
            </li>-->
            <li>
                <a href="../php/paxinaContacto.php">
                    <i class="fas fa-envelope"></i> Contacto
                </a>
            </li>
            <li>
                <a href="../php/pecharSesion.php">
                    <i class="fas fa-window-close"></i> Pechar Sesión
                </a>
            </li>
        </ul>

        <!--
        <ul class="list-unstyled CTAs">
            <li>
                <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
            </li>
            <li>
                <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
            </li>
        </ul>
        -->
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light nav-color">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>

                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="tarefasCreadas.php">Tarefas Creadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tarefasAsignadas.php">Tarefas Asignadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="formularioCrearTarefa.php">Crear Tarefa</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- </div></div> -->