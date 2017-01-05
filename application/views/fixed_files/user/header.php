<?php

defined('BASEPATH') OR exit('No direct script access allowed');

@$data_atual_system = date('YmdHis');

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

if($page == 'sala'):
?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/master-slider/masterslider/style/masterslider.css">
    <link rel='stylesheet' href="<?php echo base_url();?>/assets/plugins/master-slider/masterslider/skins/default/style.css">

    <?php endif;?>
    <?php
    if($page == 'leiloes'):
    ?>
        <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/noUiSlider/jquery.nouislider.min.css">
        <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/plugins/countdown.js"></script>
    <?php endif;?>

    <?php
    if($page == 'sala'):
    ?>
        <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/plugins/countdown.js"></script>
    <?php endif;?>


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


    <?php

    if($page == 'account' or $page == 'configuracoes' or $page == 'arrematados' or $page == 'pagamentos'):
        ?>    <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/plugins/countdown.js"></script>
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

                    <form method="get" action="<?php echo base_url('leiloes')?>">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por: produto, localidade...">
                    <div class="search-close"><i class="icon-close"></i></div>
               </form>
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
                        <img id="logo-header" src="<?php echo base_url();?>assets/img/logo.png" alt="Logo">
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
                                        <li><a href="<?php echo base_url('leiloes?t=disponiveis');?>">Disponíveis</a></li>
                                        <li><a href="<?php echo base_url('leiloes?t=proximos');?>">Próximos</a></li>

                                        <!-- Inicio - Aparece para quem tem créditos -->
                                        <li><a href="<?php echo base_url('leiloes?t=finalizados');?>">Finalizados</a></li>
                                        <!-- Fim - Aparece para quem tem créditos -->


                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Adicionar</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('adicionar/creditos');?>">Créditos</a></li>
                                       <!-- <li><a href="<?php echo base_url('leiloes/leiloes');?>">Leilões</a></li> -->
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- End Promotion -->
                        <?php
                        $this->db->from('leiloes');
                        $this->db->where('status',1);
                        $this->db->where('inicio_data < ',$data_atual_system);
                        $this->db->limit(4,0);
                        $query = $this->db->get();
                        $count = $query->num_rows();
                        $result = $query->result_array();
if($count > 0):

                        ?>
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
<?php

foreach ($result as $dds){
?>

                                                <div class="col-md-3 col-sm-4 col-xs-4 md-margin-bottom-30">
                                                    <a href="#"><img style="height: 200px;object-fit: cover; object-position: center;" class="product-offers img-responsive" src="<?php echo base_url('pages/exibir?id='.$dds['id']);?>" alt=""></a>
                                                    <b><?php echo $this->Models_model->limitarTexto($dds['title'],30);?></b>
                                                </div>
<?php }?>
                                            </div><!--/end row-->
                                        </div><!--/end container-->
                                    </div><!--/end mega menu content-->
                                </li>
                            </ul><!--/end dropdown-menu-->
                        </li>
                        <!-- End Gifts -->
<?php endif;?>
<?php

if($status == true):

?>
                        <!-- Main Demo -->
                        <li><a href="<?php echo base_url('pages/logout');?>">Sair</a></li>
                        <!-- Main Demo -->

                        <?php endif;?>
                    </ul>
                    <!-- End Nav Menu -->
                </div>
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v5 ===-->

<?php

if(isset($_SESSION['ID']) and $page == 'account' or $page == 'configuracoes' or $page == 'arrematados' or $page == 'pagamentos'):
?>

    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">


                <img class="img-responsive profile-img margin-bottom-20" src="http://127.0.0.1:8080/projects/4porcento/pages/exibir?id=7" style="height: 250px; object-fit: cover; object-position: center;" alt="">
                <a class="btn-u btn-u-sm"  href="#">Alterar imagem</a><br><br>
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item <?php if($page == 'account'): echo 'active'; endif;?>">
                        <a href="<?php echo base_url('minha-conta');?>"><i class="fa fa-bar-chart-o"></i> Resumo</a>
                    </li>
                    <li class="list-group-item <?php if($page == 'configuracoes'): echo 'active'; endif;?>">
                        <a href="<?php echo base_url('configuracoes');?>"><i class="fa fa-cog"></i> Configuraçoes</a>
                    </li>
                    <li class="list-group-item <?php if($page == 'arrematados'): echo 'active'; endif;?>">
                        <a href="<?php echo base_url('meus-arremates');?>"><i class="fa fa-trophy"></i> Leilões arrematados</a>
                    </li>
                    <li class="list-group-item <?php if($page == 'pagamentos'): echo 'active'; endif;?>">
                        <a href="<?php echo base_url('compras');?>"><i class="fa fa-shopping-cart"></i> Compras</a>
                    </li>

                </ul>




                <div class="margin-bottom-50"></div>


            </div>
            <!--End Left Sidebar-->

            <?php
    endif;
    ?>
