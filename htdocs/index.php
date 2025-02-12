<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['sessao'])) {
    if ($_SESSION['sessao'] === "ativa") {
        if (isset($_GET['url'])) {
            $url = __DIR__ . "/Page/" . $_GET['url'] . ".php";
            if (!file_exists($url)) {
                $url = __DIR__ . "/Page/404.html";
            }
        } else {
            $url = __DIR__ . "/Page/Dashboard.php";
        }
?>

        <!DOCTYPE html>
        <html lang="pt-br">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Bem vindo</title>

            <!-- Bootstrap personalizado para botoes -->
            <link href="app/css/button.css" rel='stylesheet' type='text/css' />

            <!-- Custom fonts for this template-->
            <link href="App/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="App/css/sb-admin-2.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        </head>

        <body id="page-top">
            <div class="col ">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-laugh-wink"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3">Robson Moura <sup>sistemas</sup></div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="?url=Dashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Menu
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-laptop"></i>
                            <span>Cadastro</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="?url=Pessoa"><i class="fa fa-angle-right"></i> Pessoa</a>
                                <a class="collapse-item" href="?url=Despesa"><i class="fa fa-angle-right"></i> Despesas</a>
                                <a class="collapse-item" href="?url=Receita"><i class="fa fa-angle-right"></i> Receita</a>
                                <a class="collapse-item" href="?url=Categoria"><i class="fa fa-angle-right"></i> Categoria</a>
                                <a class="collapse-item" href="?url=Conta"><i class="fa fa-angle-right"></i> Contas</a>
                                <a class="collapse-item" href="?url=Usuario"><i class="fa fa-angle-right"></i> Usuário</a>
                            </div>
                        </div>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="model/logoff.php">
                            <i class="bi bi-file-lock2"></i>
                            <span>Logoff</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="model/logoff.php">
                            <i class="bi bi-indent"></i>
                            <span>Sair</span>
                        </a>
                    </li>

                </ul>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">
                        <div class="tela-cadastrar d-none">
                            <small class="tela-cadastrar-carregando"></small>
                        </div>

                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <div id="alerta" class="alertas d-none">
                                <small class="alertas-mensagens"></small>
                            </div>

                            <?php if (isset($url) && !empty($url)) {
                                @include_once($url);
                            }
                            ?>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Desenvolvido por Robson Moura</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>


            <!-- Bootstrap core JavaScript-->
            <script src="App/vendor/jquery/jquery.min.js"></script>
            <script src="App/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="App/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="App/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="App/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script> -->

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


            <!-- Bootstrap CSS -->
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <!-- Bootstrap JS Bundle (inclui Popper) -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


        </body>

<?php } else {
        header("location: model/logoff.php");
    }
} else {
    header("location: model/logoff.php");
} ?>

        </html>