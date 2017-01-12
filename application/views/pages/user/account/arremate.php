<?php
if ($page == 'arrematados'):
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');
$data_atual_system = date('YmdHis');

?>

<?php

$max = 15;
if (!isset($_GET['pg'])):
    $pgatual = 1;
    $atual = 0;
else:
    if ($_GET['pg'] <= 0):
        $pgatual = 1;
        $min = 0;
    else:
        $pgatual = $_GET['pg'];

    endif;

    $atual = ceil($max * $pgatual - $max);
endif;

$this->db->from('compras');
$this->db->where('id_user ', $_SESSION['ID']);
$this->db->where('type ', 1);
$this->db->order_by('id', 'desc');
$query1 = $this->db->get();
$countt = $query1->num_rows();

    if($countt <= 1):
        $pages = 1;
        else:
            $pages = ceil($max / $countt);

    endif;


$this->db->from('compras');
$this->db->where('id_user ', $_SESSION['ID']);
$this->db->where('type ', 1);
$this->db->order_by('id', 'desc');
$this->db->limit($max, $atual);
$query = $this->db->get();
$count = $query->num_rows();
$result = $query->result_array();
if (!isset($_GET['info'])):
    ?>
    <!-- Profile Content -->
    <div class="col-md-9">


        <div class="col-md-12">
            <!--Table Search v1-->
            <div class="table-search-v1 margin-bottom-20">

                <div class="table-responsive">
                    <h2>Meus arremates</h2>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th class="hidden-sm">Produto</th>
                            <th style="width: 100px;">Status</th>
                            <th>Valor</th>
                            <th>Opções</th>
                            <th>Ações</th>
                            <th>Informações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php


                        if ($count > 0):

                            foreach ($result as $dds) {

                                if ($dds['status'] <> 3):
                                    $ind = $dds['data_solicitation'];
                                    $ano = substr($ind, 0, 4);
                                    $mes = substr($ind, 4, 2);
                                    $dia = substr($ind, 6, 2);
                                    $hora = substr($ind, 8, 2);
                                    $minuto = substr($ind, 10, 2);
                                    $segundo = substr($ind, 12, 2);
                                else:
                                    $ind = $dds['data_payment'];
                                    $ano = substr($ind, 0, 4);
                                    $mes = substr($ind, 4, 2);
                                    $dia = substr($ind, 6, 2);
                                    $hora = substr($ind, 8, 2);
                                    $minuto = substr($ind, 10, 2);
                                    $segundo = substr($ind, 12, 2);
                                endif;
                                ?>


                                <tr>
                                    <td><b><?php echo $dds['id_obj_compra']; ?></b></td>
                                    <td class="td-width">
                                        <?php echo $dds['title']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($dds['status'] <> 1 and $dds['status'] <> 2 and $dds['status'] <> 3 and $dds['status'] <> 4 and $dds['status'] <> 5 and $dds['status'] <> 6 and $dds['status'] <> 7):
                                            ?>
                                            <button class="btn-u btn-u-yellow btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Status indísponivel
                                            </button>

                                        <?php endif; ?>
                                        <?php
                                        if ($dds['status'] == 1 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-blue btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Aguardando pagamento
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 2 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-blue btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Em análise
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 3 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-green btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Paga
                                            </button>

                                        <?php endif; ?>
                                        <?php
                                        if ($dds['status'] == 4 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-green btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Disponível
                                            </button>

                                        <?php endif; ?>
                                        <?php
                                        if ($dds['status'] == 5 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-yellow btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Em disputa
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 6 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-red btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Devolvida
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 7 and $dds['type'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-red btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Cancelada
                                            </button>

                                        <?php endif; ?>


                                        <?php
                                        if ($dds['status'] == 3 and $dds['type'] == 1):
                                            ?>
                                            <button class="btn-u btn-u-green btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Pago
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span><b>R$ <?php echo $dds['value_show']; ?></b></span>

                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        if ($dds['submit'] == 3):
                                            echo '<a href="javascript:func();" class=" btn btn-warning">Entregue</a>';
                                        endif;
                                        if ($dds['status'] == 1 and $dds['submit'] <> 3):
                                            echo '<a href="'.$dds['url_payment'].'" target="_blank" class=" btn btn-success">Realizar pagamento</a>';
                                        endif;
                                        if ($dds['status'] == 2 and $dds['submit'] <> 3):
                                            echo '<span class=" btn btn-info">Em análise</span>';
                                        endif;

                                        if ($dds['status'] == 5 and $dds['submit'] <> 3):
                                            echo '<span class=" btn btn-danger">Aguardando disputa</span>';
                                        endif;

                                        if ($dds['status'] == 6 or $dds['status'] == 7 and $dds['submit'] <> 3):
                                            echo '<span class=" btn btn-danger">Cancelado/devolvido</span>';
                                        endif;
                                        if ($dds['submit'] <> 3  and $dds['submit'] == 3 and $dds['type'] == 1 and $dds['status'] == 3 or $dds['submit'] <> 3  and $dds['submit'] == 3 and $dds['type'] == 1 and $dds['status'] == 4 ):
                                            echo '<span class=" btn btn-success">Pedido entregue</span>';
                                        endif;

                                        if ($dds['submit'] <> 3  and $dds['submit'] == 2 and $dds['type'] == 1 and $dds['status'] == 3 or $dds['submit'] <> 3  and $dds['submit'] == 2 and $dds['type'] == 1 and $dds['status'] == 4):
                                            echo '<a href="'.base_url('retirada?item='.$dds['id_obj_compra']).'" class=" btn btn-info">Retirar comprovante</a>';
                                        endif;

                                        if ($dds['submit'] <> 3  and $dds['submit'] == 1 and $dds['type'] == 2 and $dds['status'] == 3 or $dds['submit'] <> 3  and $dds['submit'] == 1 and $dds['type'] == 2 and $dds['status'] == 4):
                                            echo '<span class=" btn btn-success">Crédito adicionado</span>';
                                        endif;
                                        if ($dds['submit'] <> 3  and $dds['submit'] == 1 and $dds['type'] == 1 and $dds['status'] == 3  or $dds['submit'] <> 3  and $dds['submit'] == 1 and $dds['type'] == 1 and $dds['status'] == 4):


                if ($dds['submit'] <> 3  and $dds['submit'] == 1 and $dds['type'] == 1 and $dds['status'] == 3 or $dds['submit'] <> 3  and  $dds['submit'] == 1 and $dds['type'] == 1 and $dds['status'] == 4):

                    $this->db->from('objetos_correios');
                    $this->db->where('item_id', $dds['id_obj_compra']);
                    $query_track = $this->db->get();
                    $rows_track = $query_track->num_rows();
                    if ($rows_track > 0):
                        $result_track = $query_track->result_array();
                        if (empty($result_track[0]['code'])):
                            echo '<a href="javasrcipt:func();"  class=" btn btn-info">Aguardando envio</a>';
                        else:
                            if($dds['status'] == 3 or $dds['status'] == 4):
                                echo '<a href="' . $result_track[0]['code'] . '" target="_blank" class=" btn btn-warning">Rastrear pedido</a>';
                            else:
                                echo '<a href="javasrcipt:func();" class=" btn btn-info">Aguardando envio</a>';

                            endif;

                        endif;
                    else:

                        echo '<a href="javasrcipt:func();"  class=" btn btn-info">Aguardando envio</a>';
                    endif;


                endif;







                if ($dds['submit'] == 2):

                    if ($dds['status'] == 3 or $dds['status'] == 4):

                        echo '<a href="'.base_url('retirada?item='.$dds['id_obj_compra']).'" target="_blank" class=" btn btn-success">Cupom Emitido</a>';

                    else:
                        echo '<a href="javasrcipt:func();" class=" btn btn-info">Aguardando</a>';

                    endif;

                endif;


                                        endif;




                                        ?>


                                    </td>
                                    <td>
                                        <?php
                                        if ($dds['status'] == 1 or $dds['status'] == 2):
                                            ?>
                                            <span class="btn">


                                <?php

                                if ($dds['type'] == 1):
                                    $this->db->from('arremates');
                                    $this->db->where('id_arremate', $dds['id_obj_compra']);
                                    $this->db->where('id_user', $_SESSION['ID']);
                                    $query = $this->db->get();
                                    $count = $query->num_rows();
                                    $result = $query->result_array();
                                    if ($count > 0):
                                        $arremateid = '&&id3=' . $result[0]['id'];

                                    else:

                                        $arremateid = '&&id3=0';

                                    endif;

                                else:
                                    $arremateid = '&&id3=0';

                                endif;
                                ?>

                                                <a href="<?php echo base_url('pages/cpd?id=' . $dds['id_obj_compra'] . '&&id2=' . $dds['id'] . '' . $arremateid . '&&tp=' . $dds['type']); ?>"
                                                   class="btn btn-danger">Cancelar</a>

                            </span>

                                        <?php else:
                                            echo '-- --';
                                        endif;
                                        ?>


                                    </td>

                                    <td>
                                        <a href="<?php echo base_url('meus-arremates?info=' . $dds['id_obj_compra']); ?>"><span
                                                class="fa fa-eye"></span> Sobre o arremate</a>
                                    </td>
                                </tr>

                                <!--End Table Search v1-->
                            <?php }

                        else:
                            ?>

                            <tr>
                                <td>-- --</td>
                                <td>-- --</td>
                                <td>-- --</td>
                                <td>-- --</td>
                                <td>-- --</td>
                                <td>-- --</td>
                                <td>-- --</td>
                            </tr>


                            <?php

                        endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
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
                <li><a href=<?php echo base_url('meus-arremates'); ?>?pg=<?php echo $before; ?>>Anterior</a>
                </li>

                <li>
                    <a href="<?php echo base_url('meus-arremates'); ?>?pg=<?php echo $next; ?>">Próximo</a>
                </li>
            </ul>
        </div>
        <!-- End Profile Content -->
    </div>

<?php else:

    ?>

    <div class="col-md-9">


    <div class="col-md-12">

    <?php

    if (!empty($_GET['info'])):

        $this->db->from('arremates');
        $this->db->where('id_arremate', $_GET['info']);
        $this->db->where('id_user', $_SESSION['ID']);
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count <= 0):
            redirect(base_url('meus-arremates'), 'refresh');
        else:
            $this->db->from('compras');
            $this->db->where('id_obj_compra', $_GET['info']);
            $this->db->where('id_user', $_SESSION['ID']);
            $query41 = $this->db->get();
            $rows1 = $query41->num_rows();
            $result41 = $query41->result_array();

            if ($rows1 == 0 or $rows1 > 0 and $result41[0]['type'] == 2):
                redirect(base_url('meus-arremates'), 'refresh');

            endif;

            $result12 = $query->result_array();
            $ind = $result12[0]['data_arremate'];
            $ano = substr($ind, 0, 4);
            $mes = substr($ind, 4, 2);
            $dia = substr($ind, 6, 2);
            $hora = substr($ind, 8, 2);
            $minuto = substr($ind, 10, 2);
            $segundo = substr($ind, 12, 2);
            ?>
            <div class="content">

            <div class="row margin-bottom-60">
            <div class="col-sm-8">
                <div class="headline"><h2><?php echo $this->Models_model->limitarTexto($result12[0]['title_arremate'],100); ?></h2></div>
                <p>
                   <b>Valor do arremate </b> - R$ <?php echo number_format($result12[0]['valor_arremate'],2,'.',','); ?>
                    <br> <br>
                    <b>Descrição: </b><br>
                    <?php
                    if(empty($result12[0]['description_arremate'])):
                        echo 'Descição indisponível.';
                        else:
                    echo $result12[0]['description_arremate'];

                            endif;?></p>
            </div>
            <?php
            $this->db->from('user');
            $this->db->where('id', $result12[0]['id_user']);
            $query4 = $this->db->get();
            $rows = $query4->num_rows();
            if ($rows == 0):
                redirect(base_url('meus-arremates'), 'refresh');

            endif;
            $result4 = $query4->result_array();





            ?>

            <div class="col-sm-4">
            <div class="headline"><h2>Detalhes do arremate</h2></div>
            <ul class="list-unstyled project-details">
            <li><strong>Cliente:</strong> <?php echo $result4[0]['firstname']; ?></li>
            <li><strong>Data:</strong> <?php
                echo $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo;
                ?></li>
            <li><strong>Meus
                    lances:</strong> <?php echo number_format($result12[0]['meus_lances']);
                if ($result12[0]['meus_lances'] == 1): echo ' lance'; endif;
                if ($result12[0]['meus_lances'] > 1): echo ' lances'; endif; ?></li>
            <li><strong>Lances
                    Totais:</strong> <?php echo number_format($result12[0]['lances_totais']);
                if ($result12[0]['lances_totais'] == 1): echo ' lance'; endif;
                if ($result12[0]['lances_totais'] > 1): echo ' lances'; endif; ?> </li>
            <li><strong>Duração do
                    leilão:</strong> <?php echo $result12[0]['duracao_segundos'] / 60; ?>
                min
            </li>
            <?php
            if ($result41[0]['submit'] <> 3):

                ?>
                <li><strong>Status:</strong>
                    <?php
                    if ($result41[0]['status'] == 1):
                        ?>
                        <b class="text-info">
                            <small><a href="<?php echo $result41[0]['url_payment'];?>" target="_blank">Aguardando pagamento</a>
                            </small>
                        </b>


                    <?php endif; ?>

                    <?php
                    if ($result41[0]['status'] == 2):
                        ?>
                        <b class="text-info"> Em análise</b>


                    <?php endif; ?>

                    <?php
                    if ($result41[0]['status'] == 3):
                        ?>
                        <b class="text-success"> Pago</b>


                    <?php endif; ?>
                    <?php
                    if ($result41[0]['status'] == 4):
                        ?>
                        <b class="text-success"> Disponível</b>


                    <?php endif; ?>
                    <?php
                    if ($result41[0]['status'] == 5):
                        ?>
                        <b class="text-warning"> Em disputa</b>

                    <?php endif; ?>

                    <?php
                    if ($result41[0]['status'] == 6):
                        ?>
                        <b class="text-danger"> Devolvida</b>


                    <?php endif; ?>

                    <?php
                    if ($result41[0]['status'] == 7):
                        ?>
                        <b class="text-danger"> Cancelada </b>


                    <?php endif; ?>

                </li>

            <?php endif; ?>

                <?php
                if($result41[0]['status'] == 1 or $result41[0]['status'] == 2 or $result41[0]['status'] == 3 or $result41[0]['status'] == 4):

                ?>
            <li><strong>Tipo de envio: </strong>
                <?php


                if ($result41[0]['submit'] == 1):
                    echo '<b class="text-info">Entrega por envio</b>';
                endif;


                if ($result41[0]['submit'] == 2):
                    echo '<b class="text-info">Retirada em loja</b>';

                endif;


                ?>
            </li>
            <li><strong>Envio status:</strong>

                <?php

                if ($result41[0]['submit'] == 1):

                    $this->db->from('objetos_correios');
                    $this->db->where('item_id', $_GET['info']);
                    $query_track = $this->db->get();
                    $rows_track = $query_track->num_rows();
                    if ($rows_track > 0):
                        $result_track = $query_track->result_array();
                        if (empty($result_track[0]['code'])):
                            echo '<a href="javasrcipt:func();"  class=" btn btn-info">Aguardando envio</a>';
                        else:
                            if($result41[0]['status'] == 3 or $result41[0]['status'] == 4):
                            echo '<a href="' . $result_track[0]['code'] . '" target="_blank" class=" btn btn-warning">Rastrear pedido</a>';
else:
    echo '<a href="javasrcipt:func();" class=" btn btn-info">Aguardando envio</a>';

                            endif;

                        endif;
                    else:

                        echo '<a href="javasrcipt:func();"  class=" btn btn-info">Aguardando envio</a>';
                    endif;


                endif;

                if ($result41[0]['submit'] == 2):

                    if ($result41[0]['status'] == 3 or $result41[0]['status'] == 4):

                        echo '<a href="'.base_url('retirada?item='.$_GET['info']).'" target="_blank" class=" btn btn-success">Cupom Emitido</a>';

                    else:
                        echo '<a href="javasrcipt:func();" class=" btn btn-info">Aguardando</a>';

                    endif;

                endif;

                ?></li>




                        <?php
endif;

            if ($result41[0]['status'] == 1):

                endif;

                ?>
                </ul>
                </div>
                </div>


                </div>


                <?php
            endif;
        else:
            redirect(base_url('meus-arremates'), 'refresh');
        endif;
        ?>
        </div>
        </div>
    <?php endif;
    ?>
    </div>
    </div>
    </div>
    <?php


    $this->load->view('fixed_files/user/footer');

endif;
?>
