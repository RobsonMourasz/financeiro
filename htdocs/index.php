<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['sessao'])) {
    if ($_SESSION['sessao'] === "ativa") {
        if (isset($_GET['url'])) {
            $url = __DIR__ . "/page/" . $_GET['url'] . ".php";
            if (!file_exists($url)) {
                $url = __DIR__ . "/page/404.html";
            }
        } else {
            $url = __DIR__ . "/page/Dashboard.php";
        }
?>

        <!DOCTYPE HTML>
        <html>

        <head>
            <title>Bem vindo</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <script type="application/x-javascript">
                addEventListener("load", function() {
                    setTimeout(hideURLbar, 0);
                }, false);

                function hideURLbar() {
                    window.scrollTo(0, 1);
                }
            </script>

            <!-- Bootstrap Core CSS -->
            <link href="app/css/bootstrap.css" rel='stylesheet' type='text/css' />

            <!-- Bootstrap personalizado para botoes -->
            <link href="app/css/button.css" rel='stylesheet' type='text/css' />

            <!-- Custom CSS -->
            <link href="app/css/style.css" rel='stylesheet' type='text/css' />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

            <!-- font-awesome icons CSS -->
            <link href="app/css/font-awesome.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- //font-awesome icons CSS-->

            <!-- side nav css file -->
            <link href='app/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
            <!-- //side nav css file -->

            <!-- js-->
            <script src="app/js/jquery-1.11.1.min.js"></script>
            <script src="app/js/modernizr.custom.js"></script>

            <!--webfonts-->
            <link href="app/fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
            <!--//webfonts-->

            <!-- chart -->
            <script src="app/js/Chart.js"></script>
            <!-- //chart -->

            <!-- Metis Menu -->
            <script src="app/js/metisMenu.min.js"></script>
            <script src="app/js/custom.js"></script>
            <link href="app/css/custom.css" rel="stylesheet">
            <!--//Metis Menu -->
            <style>
                #chartdiv {
                    width: 100%;
                    height: 295px;
                }
            </style>
            <!--pie-chart --><!-- index page sales reviews visitors pie chart -->
            <script src="app/js/pie-chart.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#demo-pie-1').pieChart({
                        barColor: '#2dde98',
                        trackColor: '#eee',
                        lineCap: 'round',
                        lineWidth: 8,
                        onStep: function(from, to, percent) {
                            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                        }
                    });

                    $('#demo-pie-2').pieChart({
                        barColor: '#8e43e7',
                        trackColor: '#eee',
                        lineCap: 'butt',
                        lineWidth: 8,
                        onStep: function(from, to, percent) {
                            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                        }
                    });

                    $('#demo-pie-3').pieChart({
                        barColor: '#ffc168',
                        trackColor: '#eee',
                        lineCap: 'square',
                        lineWidth: 8,
                        onStep: function(from, to, percent) {
                            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                        }
                    });


                });
            </script>
            <!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

            <!-- requried-jsfiles-for owl -->
            <link href="app/css/owl.carousel.css" rel="stylesheet">
            <script src="app/js/owl.carousel.js"></script>
            <script>
                $(document).ready(function() {
                    $("#owl-demo").owlCarousel({
                        items: 3,
                        lazyLoad: true,
                        autoPlay: true,
                        pagination: true,
                        nav: true,
                    });
                });
            </script>
            <!-- //requried-jsfiles-for owl -->
        </head>

        <body class="cbp-spmenu-push">
            <div class="main-content">
                <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                    <!--left-fixed -navigation-->
                    <aside class="sidebar-left">
                        <nav class="navbar navbar-inverse">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <h1><a class="navbar-brand" href="index.php"><span class="fa fa-area-chart"></span> Robson<span class="dashboard_text">Sistema financeiro</span></a></h1>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="sidebar-menu">
                                    <li class="header">Menu Navegação</li>
                                    <li class="treeview">
                                        <a href="?url=Dashboard">
                                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-laptop"></i>
                                            <span>Cadastro</span>
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="?url=Pessoa"><i class="fa fa-angle-right"></i> Pessoa</a></li>
                                            <li><a href="?url=Despesa"><i class="fa fa-angle-right"></i> Despesas</a></li>
                                            <li><a href="?url=Receita"><i class="fa fa-angle-right"></i> Receita</a></li>
                                            <li><a href="?url=Categoria"><i class="fa fa-angle-right"></i> Categoria</a></li>
                                            <li><a href="?url=Conta"><i class="fa fa-angle-right"></i> Contas</a></li>
                                            <li><a href="?url=Usuario"><i class="fa fa-angle-right"></i> Usuário</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="model/logoff.php">
                                            <i class="bi bi-file-lock2"></i> <span>Logoff</span>
                                        </a>
                                    </li>
                                    <li class="treeview">
                                        <a href="model/logoff.php">
                                            <i class="bi bi-indent"></i> <span>Sair</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>
                    </aside>
                </div>
                <!--left-fixed -navigation-->

                <!-- header-starts -->
                <div class="sticky-header header-section ">
                    <div class="header-left">
                        <!--toggle button start-->
                        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                        <!--toggle button end-->

                        <div class="clearfix"> </div>
                    </div>
                    <div class="header-right">

                        <div class="profile_details">
                            <ul>
                                <li class="dropdown profile_details_drop">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <div class="profile_img">
                                            <div class="user-name">
                                                <p><?php echo $_SESSION['usuario'] ?></p>
                                                <span><?php echo $_SESSION['nivel'] ?></span>
                                            </div>
                                            <i class="fa fa-angle-down lnr"></i>
                                            <i class="fa fa-angle-up lnr"></i>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu drp-mnu">
                                        <li><a href="model/logoff.php"><i class="fa fa-sign-out"></i> Sair</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <!-- //header-ends -->
                <div class="tela-cadastrar d-none">
                    <small class="tela-cadastrar-carregando"></small>
                </div>
                <!-- main content start-->
                <div id="page-wrapper">
                    <?php include_once($url) ?>
                </div> <!-- main content start-->


                <!--footer-->
                <div class="footer">
                    <p>&copy; Desenvolvido por Robson Moura</p>
                </div>
                <!--//footer-->
            </div>

            <!-- Bootstrap Core JavaScript -->
            <script src="../app/js/bootstrap.js"> </script>
            <!-- //Bootstrap Core JavaScript -->


            <!-- Classie --><!-- for toggle left push menu script -->
            <script src="app/js/classie.js"></script>
            <script>
                var menuLeft = document.getElementById('cbp-spmenu-s1'),
                    showLeftPush = document.getElementById('showLeftPush'),
                    body = document.body;

                showLeftPush.onclick = function() {
                    classie.toggle(this, 'active');
                    classie.toggle(body, 'cbp-spmenu-push-toright');
                    classie.toggle(menuLeft, 'cbp-spmenu-open');
                    disableOther('showLeftPush');
                };


                function disableOther(button) {
                    if (button !== 'showLeftPush') {
                        classie.toggle(showLeftPush, 'disabled');
                    }
                }
            </script>
            <!-- //Classie --><!-- //for toggle left push menu script -->
            <!--scrolling js-->
            <script src="app/js/jquery.nicescroll.js"></script>
            <script src="app/js/scripts.js"></script>
            <!--//scrolling js-->

            <!-- side nav js -->
            <script src='app/js/SidebarNav.min.js' type='text/javascript'></script>
            <script>
                $('.sidebar-menu').SidebarNav()
            </script>
            <!-- //side nav js -->

            <!-- Bootstrap Core JavaScript -->
            <script src="app/js/bootstrap.js"> </script>
            <!-- //Bootstrap Core JavaScript -->

            <!-- for amcharts js -->
            <script src="app/js/amcharts.js"></script>
            <script src="app/js/serial.js"></script>
            <script src="app/js/export.min.js"></script>
            <link rel="stylesheet" href="../app/css/export.css" type="text/css" media="all" />
            <script src="../app/js/light.js"></script>
            <!-- for amcharts js -->
            <script src="../app/js/index1.js"></script>
        </body>


<?php } else {
        header("location: model/logoff.php");
    }
} else {
    header("location: model/logoff.php");
} ?>

        </html>