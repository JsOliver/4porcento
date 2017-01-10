<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if ($page == 'sala'):
    $this->load->view('fixed_files/user/header');


    $this->db->from('leiloes');
    $this->db->where('id', $_GET['p']);
    $query = $this->db->get();
    $result = $query->result_array();


    ?>

        <script>

            function comecoVer() {
                var tempo = 0;

                $.post("<?php echo base_url('pages/checkLeilao');?>", {leilao:<?php echo $_GET['p'];?>}, function (res) {

                    if (res == 1) {
                        $.post("<?php echo base_url('pages/permissionButton');?>", {leilao:<?php echo $_GET['p'];?>}, function (res1) {

                            if (res1) {
                                $("#buttonLance").html(res1);

                            }

                        });

                        $.post("<?php echo base_url('pages/segsRestante');?>", {leilao:<?php echo $_GET['p'];?>}, function (res2) {

                            if (res2) {
                                tempo = res2;
                                $("#segundosRest").text(res2 + ' Segundos');

                            }

                        });

                    }

                });
            }
            setInterval("comecoVer()", 1000);

            $(function () {

                comecoVer();
            });
        </script>

    <script>
        $.post("<?php echo base_url('pages/permissionButton');?>", {leilao:<?php echo $_GET['p'];?>}, function (res1) {

            if (res1) {
                $("#buttonLance").html(res1);

            }

        });
        </script>

    <!--=== Shop Product ===-->
    <div class="shop-product" xmlns="http://www.w3.org/1999/html">
    <!-- Breadcrumbs v5 -->
    <div class="container">
        <ul class="breadcrumb-v5">
            <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?php echo base_url('leiloes?t=disponiveis'); ?>">Leilões</a></li>
            <li class="active"><?php echo strip_tags($result[0]['title']); ?></li>
        </ul>
    </div>
    <!-- End Breadcrumbs v5 -->

    <div class="container">
    <div class="row">
    <div class="col-md-4 md-margin-bottom-50">
        <div class="ms-showcase2-template">
            <!-- Master Slider -->
            <div class="master-slider ms-skin-default" id="masterslider">
                <style>
                    .ms-nav-next {
                        display: none;
                    }

                    .ms-nav-prev {
                        display: none;
                    }
                </style>

                <div class="ms-slide">
                    <img class="ms-brd" src="<?php echo base_url('pages/exibir?id=' . $_GET['p']); ?>"
                         data-src="<?php echo base_url('pages/exibir?id=' . $_GET['p']); ?>"
                         alt="lorem ipsum dolor sit">
                </div>
                <br>
                <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                    <li class="wishlist-in">
                        <i class="fa fa-eye"></i>
                        <a href="#">Ultimos Lances</a>

                    </li>

                </ul>
                <p class="wishlist-category"><i class="fa fa-hand-o-up"></i> <strong>JonyCash</strong> clicou</p>
                <p class="wishlist-category"><i class="fa fa-hand-o-up"></i> <strong>Marciaryb</strong> clicou</p>
                <p class="wishlist-category"><i class="fa fa-hand-o-up"></i> <strong>Marcelogonzaga</strong> clicou
            </div>
            <!-- End Master Slider -->

        </div>
    </div>

    <div class="col-md-4">
        <div class="shop-product-heading">
            <h2><?php echo strip_tags($result[0]['title']); ?></h2>

        </div><!--/end shop product social-->


        <p><?php echo $result[0]['descricao_completa']; ?></p><br>

        <ul class="list-inline shop-product-prices margin-bottom-30">

            <li class="shop-red">
                <small> R$ <?php echo $desconto; ?></small>

            </li>
            <li class="line-through"> R$ <?php echo $result[0]['valor_leilao']; ?></li>

        </ul><!--/end shop product prices-->


        <h3 class="shop-product-title">Tempo restante</h3>
        <div class="margin-bottom-40">
            <span id="segundosRest" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #98acff;">Em breve</span>

            <span id="buttonLance">
            <button type="button" class="btn-u btn-u-sea-shop btn-u-lg" >Carregando...</button>
        </span>
        </div><!--/end product quantity-->


        </p>
    </div>

    <style>
        body {
            overflow-x: hidden;
        }

        .chat {
            list-style: none;
            margin: 0;
            padding: 0;

        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body {
            margin-left: 60px;
        }

        .chat li.right .chat-body {
            margin-right: 60px;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon {
            margin-right: 5px;
        }

        .panel-body {
            overflow-y: scroll;
            height: 400px;
        }

        .panel-body ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        .panel-body ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .panel-body ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

        textarea {
            resize: none;
        }
    </style>
    <div class="col-md-3">
    <div class="container">
    <div class="row">
    <div class="col-md-4">
    <div class="panel ">


    <div class="panel-collapse collapse in" id="collapseOne">
    <div class="panel-body">
        <ul class="chat" id="chat_ast">
            <li class="left clearfix" id="newmessage">

            </li>
        </ul>
    </div>
    <div class="panel-footer">
    <div class="input-group">
    <textarea id="txtArea" cols="50" rows="3" class="form-control input-sm"
              placeholder="Digite sua mensagem aqui..."></textarea>



    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div><!--/end row-->
    </div>

    </div>
    <!--=== End Shop Product ===-->
    <script>

        function atualizar1() {


            $.post('<?php echo base_url('pages/chat');?>', {leilao: '<?php echo $_GET['p'];?>'}, function (resp) {


                if(resp !== 0){
                    $('#chat_ast').html(resp);
                }


            });

        }

        setInterval("atualizar1()", 20000);

        $(function () {

            atualizar1();
        });


        $.post('<?php echo base_url('pages/chat');?>', {leilao: '<?php echo $_GET['p'];?>'}, function (resp) {

            if(resp !== 0) {

                $('#chat_ast').html(resp);

            }
        });

        function atualizar() {


            $.post('<?php echo base_url('pages/checkverMessage');?>', {leilao: '<?php echo $_GET['p'];?>'}, function (resp) {
                if (resp == 1) {

                    $.post('<?php echo base_url('pages/chat');?>', {leilao: '<?php echo $_GET['p'];?>'}, function (res) {

                        if(res !== 0) {

                            $('#chat_ast').html(res);

                        }
                    });

                }
                else {


                }

            });


        }

        setInterval("atualizar()", 2000);

        $(function () {

            atualizar();
        });
    </script>
    <script>
        $("#txtArea").on("keypress", function (e) {
            var key = e.keyCode;

            // If the user has pressed enter
            if (key == 13) {

                var mensagem = document.getElementById("txtArea").value = document.getElementById("txtArea").value + "\n";


                $.post("<?php echo base_url('pages/chat');?>", {
                    mensagem: mensagem,
                    send: '<?php echo $_SESSION['ID'];?>',
                    leilao: '<?php echo $_GET['p'];?>'
                }, function (res) {

                });

                $("#txtArea").val('');

                $.post('<?php echo base_url('pages/chat');?>', {leilao: '<?php echo $_GET['p'];?>'}, function (resp) {
                    $('#chat_ast').html(resp);

                });
                return false;
            }
            else {
                return true;
            }
        });
    </script>

    <?php
    $this->load->view('fixed_files/user/footer');

endif;

?>

