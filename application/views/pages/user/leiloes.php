<?php
if($page == 'leiloes'):
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');


    if(!isset($_GET['t'])):
        $tipo = 'todos';
        $tipoCog = 0;
        else:

        if(isset($_GET['t']) and $_GET['t'] == 'disponiveis' or $_GET['t'] == 'finalizados' or $_GET['t'] == 'proximos' or $_GET['t'] == 'todos'):
            $tipo = $_GET['t'];
            if( $_GET['t'] == 'disponiveis'):
                $tipoCog = 1;

            endif;
            if( $_GET['t'] == 'proximos'):
                $tipoCog = 2;

            endif;

            if( $_GET['t'] == 'finalizados'):
                $tipoCog = 3;

            endif;
            if( $_GET['t'] == 'todos'):
                $tipoCog = 0;

            endif;



        else:
            redirect('home', 'refresh');

        endif;
            endif;
?>



    <!--=== Content Part ===-->
    <div class="content container">
        <div class="row">


            <div class="col-md-12">
                <div class="row margin-bottom-5">
                    <div class="col-sm-4 result-category">
                        <h2><small>Leiloes <?php echo $tipo;?></small></h2>
                        <small class="shop-bg-red badge-results">0 Resultados</small>
                    </div>
                    <div class="col-sm-8">
                        <ul class="list-inline clear-both">

                            <li class="sort-list-btn">
                                <h3>Ordenar por :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                                      <?php  if(!isset($_GET['order'])):
                                          echo 'Ultimos adicionados';

                                      else:

                                         if($_GET['order'] == 0):
                                             echo 'Ultimos adicionados';
                                             endif;

                                         if($_GET['order'] == 1):
                                             echo 'Mais proximos';
                                             endif;

                                         if($_GET['order'] == 2):
                                             echo 'Menores preços';
                                             endif;

                                         if($_GET['order'] == 3):
                                             echo 'Maiores preços';
                                             endif;

                                      endif; ?><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&<?php
                                            if(isset($_GET['limit'])):

                                        echo 'limit='.$_GET['limit'].'&&';
                                            endif;
                                            ?>order=0">Ultimos adicionados</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&<?php
                                            if(isset($_GET['limit'])):

                                                echo 'limit='.$_GET['limit'].'&&';
                                            endif;
                                            ?>order=1">Mais proximos</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&<?php
                                            if(isset($_GET['limit'])):

                                                echo 'limit='.$_GET['limit'].'&&';
                                            endif;
                                            ?>order=2">Menores preços</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&<?php
                                            if(isset($_GET['limit'])):

                                                echo 'limit='.$_GET['limit'].'&&';
                                            endif;
                                            ?>order=3">Maiores preços</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sort-list-btn">
                                <h3>Mostrar :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <?php

                                        if(!isset($_GET['limit'])):
                                        echo 'Tudo';
                                        else:
                                            echo $_GET['limit'];

                                        endif;
                                        ?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="leiloes?t=<?php echo $tipo;?><?php

                                            if(isset($_GET['order'])):
                                                echo '&&order='.$_GET['order'];
                                            endif;

                                            ?>">Tudo</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&limit=20<?php

                                            if(isset($_GET['order'])):
                                                echo '&&order='.$_GET['order'];
                                            endif;

                                            ?>">20</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&limit=10<?php

                                            if(isset($_GET['order'])):
                                                echo '&&order='.$_GET['order'];
                                            endif;

                                            ?>">10</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&limit=5<?php

                                            if(isset($_GET['order'])):
                                                echo '&&order='.$_GET['order'];
                                            endif;

                                            ?>">5</a></li>
                                        <li><a href="leiloes?t=<?php echo $tipo;?>&&limit=3<?php

                                            if(isset($_GET['order'])):
                                                echo '&&order='.$_GET['order'];
                                            endif;

                                            ?>">3</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!--/end result category-->

                <div class="filter-results">
                    <div class="row illustration-v2 margin-bottom-30">

                        <?php
                        if($tipoCog == 0):

                        ?>
                        <div class="col-md-4">
                            <div class="product-img product-img-brd">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/blog/16.jpg" alt=""></a>
                                <div class="shop-rgba-dark-green rgba-banner">New</div>
                            </div>
                            <div class="product-description product-description-brd margin-bottom-30">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="shop-ui-inner.html">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Men</span>
                                        <span class="gender">Suits - Blazers</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="title-price">$60.00</span>
                                        <span class="title-price line-through">$95.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endif;?>

                        <?php
                        if($tipoCog == 1):

                            for($i=0;$i<1;$i++):
                        ?>
                        <div class="col-md-4">
                            <div class="product-img product-img-brd">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/blog/16.jpg" alt=""></a>
                            </div>
                            <div class="product-description product-description-brd margin-bottom-30">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="<?php echo base_url('sala?p='.$i.'');?>">Nome do leilão</a></h4>
                                        <span class="gender text-uppercase">Cidade</span>
                                        <span class="gender">Adicionado por: ---------</span>
                                    </div>
                                    <div class="product-price">
                                        <!--Inicio - Preço atual -->
                                        <span class="title-price">R$ 5.00</span>
                                        <!--Fim - Preço atual -->

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        endfor;
                        endif;?>

                        <?php
                        if($tipoCog == 2):

                        for($w=0;$w<1;$w++):
                        ?>
                        <div class="col-md-4">
                            <div class="product-img product-img-brd">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/blog/16.jpg" alt=""></a>
                                <a class="product-review"  href="<?php echo base_url('sala?p='.$w.'');?>"><b>Começa em:</b> <span id="start<?php echo $w;?>"></span></a>
                            </div>
                            <div class="product-description product-description-brd margin-bottom-30">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="<?php echo base_url('sala?p='.$w.'');?>">Nome do leilão</a></h4>
                                        <span class="gender text-uppercase">Valor inicial: <b>R$ 5.00</b></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <script type="text/javascript">
                                $("#start<?php echo $w; ?>")
                                    .countdown("2017/01/05 10:02:19", function(event) {
                                        $(this).text(
                                            event.strftime('%D dias %H:%M:%S')
                                        );
                                    });
                            </script>

                        <?php

                        endfor;
                       endif;?>

                        <?php
                        if($tipoCog == 3):
                            for($n=0;$n<1;$n++):
                        ?>
                        <div class="col-md-4">
                            <div class="product-img product-img-brd">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/blog/16.jpg" alt=""></a>
                            </div>
                            <div class="product-description product-description-brd margin-bottom-30">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="<?php echo base_url('sala?p='.$n.'');?>">Nome do leilão</a></h4>
                                        <span class="gender">Vencedor: <b>Jonhcash</b></span>
                                    </div>
                                    <div class="product-price">
                                        <span class="title-price" ><small>R$ 255.00</small></span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        endfor;
                        endif;?>

                    </div>


                </div><!--/end filter resilts-->

                <div class="text-center">
                    <ul class="pagination pagination-v2">
                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div><!--/end pagination-->
            </div>
        </div><!--/end row-->
    </div><!--/end container-->
    <!--=== End Content Part ===-->

<?php

    $this->load->view('fixed_files/user/footer');

else:

    redirect('home', 'refresh');

    endif;

    ?>
