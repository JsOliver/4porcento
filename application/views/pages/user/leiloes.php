<?php
if ($page == 'leiloes'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');
    $data_atual_system = date('YmdHis');


    if (!isset($_GET['t']) and !isset($_GET['search'])):
        redirect(base_url('leiloes?t=disponiveis'), 'refresh');

    else:

        if (!isset($_GET['t']) and isset($_GET['search'])):

            $tipoCog = 4;
            $tipo = '<b>' . $_GET['search'] . '</b>';


        else:

            if (isset($_GET['t']) and $_GET['t'] == 'disponiveis' or $_GET['t'] == 'finalizados' or $_GET['t'] == 'proximos' or $_GET['t'] == 'todos'):
                $tipo = $_GET['t'];
                if ($_GET['t'] == 'disponiveis'):
                    $tipoCog = 1;

                endif;
                if ($_GET['t'] == 'proximos'):
                    $tipoCog = 2;

                endif;

                if ($_GET['t'] == 'finalizados'):
                    $tipoCog = 3;

                endif;
                if ($_GET['t'] == 'todos'):
                    $tipoCog = 0;

                endif;


            else:


                redirect(base_url('home'), 'refresh');


            endif;
        endif;
    endif;
    ?>


    <!--=== Content Part ===-->
    <div class="content container">
        <div class="row">

            <?php
            $this->db->from('leiloes');
            if (isset($_GET['t'])):


                if ($tipoCog == 1):
                    $this->db->where('inicio_data < ', $data_atual_system);

                    $this->db->where('status', 1);
                endif;

                if ($tipoCog == 2):
                    $this->db->where('inicio_data > ', $data_atual_system);
                    $this->db->where('status', 1);
                endif;

                if ($tipoCog == 3):
                    $this->db->where('status', 0);
                    $this->db->or_where('status', 2555);
                endif;

            endif;
            if (!isset($_GET['t']) and isset($_GET['search'])):
                if ($tipoCog == 4):
                    $this->db->like('title', $_GET['search']);
                    $this->db->or_like('cidade', $_GET['search']);
                    $this->db->or_like('estado', $_GET['search']);
                    $this->db->or_like('rua', $_GET['search']);
                    $this->db->or_like('cep', $_GET['search']);
                    $this->db->or_like('breve_descricao', $_GET['search']);
                    $this->db->or_like('descricao_completa', $_GET['search']);
                    $this->db->or_like('keywords', $_GET['search']);


                endif;
            endif;
            $querynl = $this->db->get();
            $countnl = $querynl->num_rows();

            ?>
            <div class="col-md-12">
                <div class="row margin-bottom-5">
                    <div class="col-sm-4 result-category">
                        <h2>
                            <small>Leiloes <?php echo $this->Models_model->limitarTexto($tipo, 30); ?></small>
                        </h2>
                        <small class="shop-bg-red badge-results"><?php echo number_format($countnl); ?> Resultados
                        </small>
                    </div>
                    <div class="col-sm-8">
                        <ul class="list-inline clear-both">

                            <li class="sort-list-btn">
                                <h3>Ordenar por :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">

                                        <?php
                                        if (isset($_GET['search'])):
                                            $action = 'search';
                                        else:
                                            $action = 't';
                                        endif;

                                        if (!isset($_GET['order'])):
                                            echo 'Ultimos adicionados';

                                        else:

                                            if ($_GET['order'] == 0):
                                                echo 'Ultimos adicionados';
                                            endif;

                                            if ($_GET['order'] == 1):
                                                echo 'Mais proximos';
                                            endif;

                                            if ($_GET['order'] == 2):
                                                echo 'Menores preços';
                                            endif;

                                            if ($_GET['order'] == 3):
                                                echo 'Maiores preços';
                                            endif;

                                        endif; ?><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&<?php
                                            if (isset($_GET['limit'])):

                                                echo 'limit=' . $_GET['limit'] . '&&';
                                            endif;
                                            ?>order=0">Ultimos adicionados</a></li>
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&<?php
                                            if (isset($_GET['limit'])):

                                                echo 'limit=' . $_GET['limit'] . '&&';
                                            endif;
                                            ?>order=1">Mais proximos</a></li>
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&<?php
                                            if (isset($_GET['limit'])):

                                                echo 'limit=' . $_GET['limit'] . '&&';
                                            endif;
                                            ?>order=2">Menores preços</a></li>
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&<?php
                                            if (isset($_GET['limit'])):

                                                echo 'limit=' . $_GET['limit'] . '&&';
                                            endif;
                                            ?>order=3">Maiores preços</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sort-list-btn">
                                <h3>Mostrar :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                        <?php

                                        if (isset($_GET['search'])):
                                            $action = 'search';
                                        else:
                                            $action = 't';
                                        endif;
                                        if (!isset($_GET['limit'])):
                                            echo '20';
                                        else:
                                            echo strip_tags($_GET['limit']);

                                        endif;
                                        ?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">

                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&limit=20<?php

                                            if (isset($_GET['order'])):
                                                echo '&&order=' . $_GET['order'];
                                            endif;

                                            ?>">20</a></li>
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&limit=10<?php

                                            if (isset($_GET['order'])):
                                                echo '&&order=' . $_GET['order'];
                                            endif;

                                            ?>">10</a></li>
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&limit=5<?php

                                            if (isset($_GET['order'])):
                                                echo '&&order=' . $_GET['order'];
                                            endif;

                                            ?>">5</a></li>
                                        <li>
                                            <a href="leiloes?<?php echo $action; ?>=<?php echo strip_tags($tipo); ?>&&limit=3<?php

                                            if (isset($_GET['order'])):
                                                echo '&&order=' . $_GET['order'];
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
                        if (!isset($_GET['limit'])):
                            $max = 15;

                        else:
                            if ($_GET['limit'] < 3 or $_GET['limit'] > 20):
                                $max = 15;

                            else:
                                $max = $_GET['limit'];
                            endif;

                        endif;

                        if (!isset($_GET['pg'])):
                            $atual = 0;
                            $pgatual = 1;

                        else:
                            $atual = ceil($max * $_GET['pg'] - $max);
                            $pgatual = $_GET['pg'];
                        endif;


                        $pages = ceil($countnl / $max);


                        $this->db->from('leiloes');
                        if (isset($_GET['t'])):


                            if ($tipoCog == 1):
                                $this->db->where('inicio_data < ', $data_atual_system);

                                $this->db->where('status', 1);
                            endif;

                            if ($tipoCog == 2):
                                $this->db->where('inicio_data > ', $data_atual_system);
                                $this->db->where('status', 1);
                            endif;

                            if ($tipoCog == 3):
                                $this->db->where('status', 0);
                                $this->db->or_where('status', 2555);
                            endif;

                        endif;
                        if (!isset($_GET['t']) and isset($_GET['search'])):
                            if ($tipoCog == 4):
                                $this->db->like('title', $_GET['search']);
                                $this->db->or_like('cidade', $_GET['search']);
                                $this->db->or_like('estado', $_GET['search']);
                                $this->db->or_like('rua', $_GET['search']);
                                $this->db->or_like('cep', $_GET['search']);
                                $this->db->or_like('breve_descricao', $_GET['search']);
                                $this->db->or_like('descricao_completa', $_GET['search']);
                                $this->db->or_like('keywords', $_GET['search']);


                            endif;
                        endif;
                        $this->db->limit($max, $atual);

                        if (!isset($_GET['order'])):
                            $this->db->order_by('id', 'desc');

                        else:
                            if ($_GET['order'] == 0):
                                $this->db->order_by('id', 'desc');
                            endif;
                            if ($_GET['order'] == 1):
                                $this->db->order_by('id', 'desc');
                            endif;

                            if ($_GET['order'] == 2):
                                $this->db->order_by('valor_replace', 'ASC');
                            endif;
                            if ($_GET['order'] == 3):
                                $this->db->order_by('valor_replace', 'DESC');
                            endif;


                        endif;

                        $querynl = $this->db->get();
                        $countnl = $querynl->num_rows();
                        $result = $querynl->result_array();

                        foreach ($result as $dds) {
                            $ind = $dds['inicio_data'];
                            $ano = substr($ind, 0, 4);
                            $mes = substr($ind, 4, 2);
                            $dia = substr($ind, 6, 2);
                            $hora = substr($ind, 8, 2);
                            $minuto = substr($ind, 10, 2);
                            $segundo = substr($ind, 12, 2);
                            ?>
                            <div class="col-md-4">
                                <div class="product-img product-img-brd">

                                    <a href="<?php


                                    if ($dds['inicio_data'] <= $data_atual_system and $dds['status'] == 1):

                                    echo base_url('sala?p=' . $dds['id'] . ''); ?>"><?php


                                        else:
                                            echo 'javascript:func();">';

                                        endif;

                                        ?><img class="full-width img-responsive"
                                               src="<?php echo base_url('pages/exibir?id=' . $dds['id']); ?>" alt=""
                                               style="height: 350px;object-fit: cover; object-position: center;"></a>
                                    <a class="product-review" href="<?php


                                    if ($dds['inicio_data'] <= $data_atual_system and $dds['status'] == 1):

                                    echo base_url('sala?p=' . $dds['id'] . ''); ?>"><?php


                                        else:
                                            echo 'javascript:func();">';

                                        endif;

                                        ?>


                                        <?php
                                        if ($dds['inicio_data'] > $data_atual_system and $dds['status'] == 1):
                                            echo '<b>Começa:</b> ' . $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo . '';
                                        endif;

                                        if ($dds['inicio_data'] <= $data_atual_system and $dds['status'] == 1):
                                            echo '<b>0 pessoas online</b>';
                                        endif;

                                        if ($dds['status'] == 0):
                                            echo '<b>Finalizado</b>';
                                        endif;

                                        if ($dds['status'] == 2555):
                                            echo '<b>Finalizado</b>';
                                        endif;
                                        ?>


                                    </a>
                                </div>
                                <div class="product-description product-description-brd margin-bottom-30">
                                    <div class="overflow-h margin-bottom-5">
                                        <div class="pull-left">
                                            <h4 class="title-price"><a href="<?php

                                                if ($dds['inicio_data'] <= $data_atual_system and $dds['status'] == 1):

                                                echo base_url('sala?p=' . $dds['id'] . ''); ?>"><?php echo $dds['title'];


                                                    else:
                                                        echo 'javascript:func();">' . $dds['title'];

                                                    endif;

                                                    ?>


                                                </a></h4>
                                            <?php

                                            if ($dds['status'] == 1):
                                                echo '<span class="gender">Vencedor: <b>Jonhcash</b></span>';
                                            endif;
                                            if ($dds['status'] == 0):
                                                echo '<span class="gender">Leilão finalizado sem nenhum vencedor.</span>';
                                            endif;
                                            if ($dds['status'] == 2555):

                                                $this->db->from('user');
                                                $this->db->where('id', $dds['winner']);
                                                $query1 = $this->db->get();
                                                $count = $query1->num_rows();
                                                $result = $query1->result_array();
                                                if ($count > 0):

                                                    echo '<span class="gender">Vencedor: <b class="text-info">' . $result[0]['username'] . '</b></span>';


                                                else:
                                                    echo '<span class="gender">Vencedor: <b class="text-danger">Indisponível</b></span>';

                                                endif;
                                            endif;

                                            ?>

                                        </div>
                                        <div class="product-price">
                                            <?php

                                            if ($dds['status'] <> 2555):
                                                ?>
                                                <span class="title-price"><small>R$ <?php echo $this->Models_model->convertPrize($dds['valor_leilao'],4); ?> </small></span>
                                                <span class="title-price line-through">R$ <?php echo number_format($dds['valor_leilao'],2,'.',',');?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>


                    </div>


                </div><!--/end filter resilts-->

                <?php

                $requisicao = explode('?', $_SERVER['REQUEST_URI']);
                $url_atual = $requisicao[1];


                if ($pgatual <= 0):
                    $next = 1;
                    $before = 1;
                else:
                    if ($pages <= 1):

                        $next = 1;
                        $before = 1;

                    else:

                        if ($pages > 1):

                            if ($pgatual == $pages):

                                $next = $pgatual;

                            else:
                                $next = $pgatual + 1;


                            endif;
                        endif;
                        if ($pgatual > 1):
                            $before = $pgatual - 1;

                        else:
                            $before = 1;
                        endif;
                    endif;
                endif;


                ?>
                <div class="text-center">
                    <ul class="pagination pagination-v2">
                        <li><a href="<?php echo base_url('leiloes?' . $url_atual); ?>&&pg=<?php echo $before; ?>">Anterior</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('leiloes?' . $url_atual); ?>&&pg=<?php echo $next; ?>">Próximo</a>
                        </li>
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
