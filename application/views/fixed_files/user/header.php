<?php

defined('BASEPATH') OR exit('No direct script access allowed');


?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>4Porcento </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,800&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/shop.style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/headers/header-v5.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/footers/footer-v4.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/revolution-slider/rs-plugin/css/settings.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/custom.css">


    <?php
    if($page == 'login'):
    ?>
        <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/css-rtl/pages/log-reg-v3-rtl.css">

    <?php endif;?>

    <?php

    if($page == 'register'):
    ?>

        <!-- CSS Page Styles -->
        <link rel="stylesheet" href="assets/css/pages/log-reg-v3.css">

        <!-- Style Switcher -->
        <link rel="stylesheet" href="assets/css/plugins/style-switcher.css">

        <!-- CSS Theme -->
        <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">

        <!-- CSS Customization -->
        <link rel="stylesheet" href="assets/css/custom.css">


    <?php endif;?>

    <?php if($page == 'home'):?>
    <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/plugins/countdown.js"></script>
    <?php endif;?>

    <?php if($page == 'register'):?>
        <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/plugins/jquery.mask.js"></script>

<?php endif;?>
</head>

<body class="header-fixed">

<div class="wrapper">
    <!--=== Header v5 ===-->
    <div class="header-v5 header-static">
        <!-- Topbar v3 -->
        <div class="topbar-v3">
            <div class="search-open">
                <div class="container">
                    <input type="text" class="form-control" placeholder="Pesquisar">
                    <div class="search-close"><i class="icon-close"></i></div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline right-topbar pull-right">

                            <?php
                            if($status == true):
                            ?>
                            <!-- Inicio - Aparece somente se estiver logado -->
                            <li><a href="<?php echo base_url('minha-conta');?>">Minha conta</a></li>
                            <li><a href="<?php echo base_url('minha-conta');?>">Arrematados <!-- Inicio - Quantidade de arremates -->(0) <!-- Inicio - Quantidade de arremates --></a></li>
                            <!-- Fim - Aparece somente se estiver logado -->
                            <?php endif; ?>


                            <?php
                            if($status == false):
                            ?>
                                <!-- Inicio - Aparece somente se não estiver logado -->

                                <li><a href="<?php echo base_url('login');?>">Entrar</a> | <a href="<?php echo base_url('cadastro');?>">Cadastrar</a></li>
                                <!-- Fim - Aparece somente se não estiver logado -->

                            <?php endif;?>
                            <li><i class="search fa fa-search search-button"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--/container-->
        </div>
        <!-- End Topbar v3 -->

        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('home');?>">
                        <img id="logo-header" src="assets/img/logo.png" alt="Logo">
                    </a>
                </div>


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <!-- Nav Menu -->
                    <ul class="nav navbar-nav">
                        <!-- Pages -->
                        <li class="dropdown active">
                            <a href="<?php echo base_url('home');?>" >
                                Inicio
                            </a>

                        </li>
                        <!-- End Pages -->

                        <!-- Promotion -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                Leilões
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Salas</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('leiloes/disponiveis');?>">Disponíveis</a></li>
                                        <li><a href="<?php echo base_url('leiloes/finalizados');?>">Finalizados</a></li>

                                        <!-- Inicio - Aparece para quem tem créditos -->
                                        <li><a href="<?php echo base_url('leiloes/gratuitos');?>">Gratuitos</a></li>
                                        <!-- Fim - Aparece para quem tem créditos -->


                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Adicionar</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('adicionar/creditos');?>">Créditos</a></li>
                                        <li><a href="<?php echo base_url('leiloes/leiloes');?>">Leilões</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- End Promotion -->

                        <!-- Gifts -->
                        <li class="dropdown mega-menu-fullwidth">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                Ultimos leilões
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="container">
                                            <div class="row">

                                                <div class="col-md-3 col-sm-4 col-xs-4 md-margin-bottom-30">
                                                    <a href="#"><img class="product-offers img-responsive" src="assets/img/blog/01.jpg" alt=""></a>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-xs-4 sm-margin-bottom-30">
                                                    <a href="#"><img class="product-offers img-responsive" src="assets/img/blog/02.jpg" alt=""></a>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-xs-4">
                                                    <a href="#"><img class="product-offers img-responsive" src="assets/img/blog/03.jpg" alt=""></a>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-xs-4">
                                                    <a href="#"><img class="product-offers img-responsive" src="assets/img/blog/03.jpg" alt=""></a>
                                                </div>
                                            </div><!--/end row-->
                                        </div><!--/end container-->
                                    </div><!--/end mega menu content-->
                                </li>
                            </ul><!--/end dropdown-menu-->
                        </li>
                        <!-- End Gifts -->


                        <!-- Main Demo -->
                        <li><a href="../index.html">Sair</a></li>
                        <!-- Main Demo -->
                    </ul>
                    <!-- End Nav Menu -->
                </div>
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v5 ===-->

