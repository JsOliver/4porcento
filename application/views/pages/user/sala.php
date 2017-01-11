<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if ($page == 'sala'):
    $this->load->view('fixed_files/user/header');


    $this->db->from('lances');
    $this->db->where('id_leilao', $_GET['p']);
    $query = $this->db->get();
    $rowss = $query->num_rows();

    $this->db->from('leiloes');
    $this->db->where('id', $_GET['p']);
    $query = $this->db->get();
    $result = $query->result_array();


    ?>


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
                            <small> R$ <?php echo  number_format($desconto,2,'.',','); ?></small>

                        </li>
                        <li class="line-through"> R$ <?php echo $result[0]['valor_leilao']; ?></li>

                    </ul><!--/end shop product prices-->


                    <h3 class="shop-product-title">Tempo restante</h3>
                    <div class="margin-bottom-40">
                        <span id="segundosRest" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #98acff;">Aguardando</span>

                        <span id="buttonLancep">
                        <span id="buttonLance">
            <button type="button" class="btn-u btn-u-sea-shop btn-u-lg" >Carregando...</button>
        </span>
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


        var leilao = '<?php echo $_GET['p'];?>';
        var tempo = new Number();
        // Tempo em segundos
        tempo = <?php echo $result[0]['duracao_lance'];?>;

        function startCountdown(){

            if(tempo == <?php echo ceil($result[0]['duracao_lance'] - 2);?> ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res1) {

                    if(res1){
                        tempo = res1;

                    }

                });
            }
            if(tempo == <?php echo ceil($result[0]['duracao_lance'] - 5);?> ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res1) {

                    if(res1){
                        tempo = res1;

                    }

                });
            }

            if(tempo == <?php echo ceil($result[0]['duracao_lance'] - 10);?> ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res2) {

                    if(res2){
                        tempo = res2;
                    }

                });
            }
            if(tempo == <?php echo ceil($result[0]['duracao_lance'] / 2 - 1);?> ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res3) {

                    if(res3){
                        tempo = res3;
                    }

                });
            }
            if(tempo == 10 ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res3) {

                    if(res3){
                        tempo = res3;
                    }

                });
            }
            if(tempo == 5 ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res1) {

                    if(res1){
                        tempo = res1;

                    }

                });
            }
            if(tempo == 3 ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res1) {

                    if(res1){
                        tempo = res1;

                    }

                });
            }


            if(tempo == 1 ){
                $.post("<?php echo base_url('pages/checkTimeSin')?>",{leilao:leilao},function (res1) {

                    if(res1){
                        tempo = res1;

                    }

                });
            }


            // Se o tempo não for zerado
            if((tempo - 1) >= 0){

                // Pega a parte inteira dos minutos
                var min = parseInt(tempo/60);
                // Calcula os segundos restantes
                var seg = tempo%60;

                // Formata o número menor que dez, ex: 08, 07, ...
                if(min < 10){
                    min = "0"+min;
                    min = min.substr(0, 2);
                }

                // Cria a variável para formatar no estilo hora/cronômetro
                horaImprimivel = seg+ ' segundos';
                //JQuery pra setar o valor
                $("#segundosRest").html(horaImprimivel);

                // Define que a função será executada novamente em 1000ms = 1 segundo
                setTimeout('startCountdown()',1000);

                // diminui o tempo
                tempo--;

                // Quando o contador chegar a zero faz esta ação
            } else {

                $("#script0").remove();
                $("#script1").remove();
                $("#script2").remove();
                $("#script3").remove();
$("#segundosRest").html('Finalizado');


$("#buttonLancep").html('<button type="button" class="btn-u btn-u-sea-shop btn-u-lg"  style="background: #4752cb;">Aguarde...</button>');
                $.post("<?php echo base_url('pages/winner');?>",{leilao:leilao,valor:<?php echo $desconto; ?>},function (res) {

                    if(res){
                    if(res == 1){
                        $("#buttonLancep").html('<button type="button" class="btn-u btn-u-sea-shop btn-u-lg"  style="background: #cb0000;">Finalizado</button>');
                       window.location.href="<?php echo base_url('meus-arremates');?>";
                    }
                    }
                });

            }

        }

        </script>

    <script id="script0">


        <?php

        if($rowss >= $result[0]['minimo_users']):

            echo '
    startCountdown();
   var so = 1;
    
    ';else:
            echo '    
              var so = 0;
';

        endif;
        ?>

        $.post("<?php echo base_url('pages/atualizalance');?>",{leilao:leilao},function (res) {

            if(res == 3 && so == 0){
                startCountdown();
                so++;
            }
        });
        function inicio() {

            var inicio = 0;
            var leilao = '<?php echo $_GET['p'];?>';

            $.post("<?php echo base_url('pages/atualizalance');?>",{leilao:leilao},function (res) {

                if(res) {
                    if (res == 1 && inicio == 0) {


                        inicio++;
                    }
                    if (res == 2 && inicio == 1) {

                        inicio++;
                    }
                    if (res == 3) {

                        if(so == 0){
                            startCountdown();

                        }

                        $.post("<?php echo base_url('pages/permissionButton');?>", {leilao:<?php echo $_GET['p'];?>}, function (res1) {

                            if (res1) {
                                $("#buttonLance").html(res1);
                            }
                            tempo = <?php echo $result[0]['duracao_lance'];?>;
                            inicio = 1;

                        });
                    }
                }});}
        setInterval("inicio();", 1000);

        $(function () {

            inicio();
        });

        function button() {
            $.post("<?php echo base_url('pages/permissionButton');?>", {leilao:<?php echo $_GET['p'];?>}, function (res1) {

                if (res1) {
                    $("#buttonLance").html(res1);
                }


            });
        }

        setInterval("button();", 1000);

        $(function () {

            button();
        });

    </script>

    <script id="script1">
        $.post("<?php echo base_url('pages/permissionButton');?>", {leilao:<?php echo $_GET['p'];?>}, function (res1) {

            if (res1) {
                $("#buttonLance").html(res1);

            }

        });
    </script>
    <script id="script2">

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
    <script id="script3">
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

