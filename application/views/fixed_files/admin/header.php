<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>/assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>/assets/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>/assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>/assets/admin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>/assets/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <?php if($page == 'leilao'):?>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


    <script>

        tinymce.init({
            selector: 'textarea',
            height: 200,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table',
            content_css: '//www.tinymce.com/css/codepen.min.css'
        });
    </script>

    <?php endif;?>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>/assets/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Jquery easing -->
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.mask.js"></script>

    <script>
        jQuery(document).ready(function() {

            jQuery('#cep').mask('00.000-000');
            jQuery('#dateinicio').mask('00/00/0000 00:00:00');
            jQuery('#valor').mask("#,##0.00", {reverse: true});
            jQuery('#valor2').mask("###0.00", {reverse: true});
            jQuery('#numero').mask("###000", {reverse: true});
            jQuery('#numero1').mask("###000", {reverse: true});

        });
    </script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('admin');?>">4% Administração</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <li >
                <a href="<?php echo base_url('pages/logout');?>">
                    <i class="fa fa-sign-out"></i>
                </a>


            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="<?php echo base_url('admin');?>"><i class="fa fa-dashboard fa-fw"></i> Resumo</a>
                    </li>

                     <li>
                        <a href="<?php echo base_url('adm/clientes');?>"><i class="fa fa-users fa-fw"></i> Clientes</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('adm/leiloes');?>"><i class="fa fa-tasks fa-fw"></i> Leilões</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('adm/pacotes');?>"><i class="fa fa-money fa-fw"></i> Pacotes</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('adm/carrosel');?>"><i class="fa fa-slideshare fa-fw"></i> Slides</a>
                    </li>




                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

