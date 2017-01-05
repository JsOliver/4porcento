<?php
if ($page == 'arrematados'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');
    $data_atual_system = date('YmdHis');

    ?>
    <!-- Profile Content -->
    <div class="col-md-9">


        <div class="col-md-12">
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

            $pages = ceil($max / $countt);

            $this->db->from('compras');
            $this->db->where('id_user ', $_SESSION['ID']);
            $this->db->where('type ', 1);
            $this->db->order_by('id', 'desc');
            $this->db->limit($max, $atual);
            $query = $this->db->get();
            $count = $query->num_rows();
            $result = $query->result_array();

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
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Status
                                                indísponivel
                                            </button>

                                        <?php endif; ?>
                                        <?php
                                        if ($dds['status'] == 1):
                                            ?>
                                            <button class="btn-u btn-u-blue btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Aguardando
                                                pagamento
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 2):
                                            ?>
                                            <button class="btn-u btn-u-blue btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Em análise
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 3):
                                            ?>
                                            <button class="btn-u btn-u-green btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Paga
                                            </button>

                                        <?php endif; ?>
                                        <?php
                                        if ($dds['status'] == 4):
                                            ?>
                                            <button class="btn-u btn-u-green btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Disponível
                                            </button>

                                        <?php endif; ?>
                                        <?php
                                        if ($dds['status'] == 5):
                                            ?>
                                            <button class="btn-u btn-u-yellow btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Em disputa
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 6):
                                            ?>
                                            <button class="btn-u btn-u-red btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Devolvida
                                            </button>

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['status'] == 7):
                                            ?>
                                            <button class="btn-u btn-u-red btn-block btn-u-xs"><i
                                                    class="fa fa-sort-amount-desc margin-right-5"></i> Cancelada
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span><b>R$ <?php echo $dds['value_show']; ?></b></span>

                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        if ($dds['status'] == 1):
                                            echo '<a href="#" target="_blank" class=" btn btn-success">Realizar pagamento</a>';
                                        endif;
                                        if ($dds['status'] == 5):
                                            echo '<span class=" btn btn-danger">Aguardando disputa</span>';
                                        endif;

                                        if ($dds['status'] == 6 or $dds['status'] == 7):
                                            echo '<span class=" btn btn-danger">Cancelado/devolvido</span>';
                                        endif;
                                        if ($dds['submit'] == 1 and $dds['type'] == 1 and $dds['status'] == 3 or $dds['status'] == 4):
                                            echo '<a href="#" target="_blank" class=" btn btn-warning">Rastrear pedido</a>';
                                        endif;

                                        if ($dds['submit'] == 3 and $dds['type'] == 1 and $dds['status'] == 3 or $dds['status'] == 4):
                                            echo '<span class=" btn btn-success">Pedido entregue</span>';
                                        endif;

                                        if ($dds['submit'] == 2 and $dds['type'] == 1 and $dds['status'] == 3 or $dds['status'] == 4):
                                            echo '<a href="#" class=" btn btn-info">Retirar comprovante</a>';
                                        endif;

                                        if ($dds['submit'] == 1 and $dds['type'] == 2 and $dds['status'] == 3 or $dds['status'] == 4):
                                            echo '<span class=" btn btn-success">Crédito adicionado</span>';
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
                                        <a href="<?php echo base_url('meus-arremates?info=' . $dds['id']); ?>"><span
                                                class="fa fa-eye"></span> Sobre o arremate</a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--End Table Search v1-->
                <?php } endif; ?>

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
        endif;?>
        <div class="text-center">
            <ul class="pagination pagination-v2">
                <li><a href=<?php echo base_url('meus-arremates');?>?pg=<?php echo $before;?>>Anterior</a>
                </li>

                <li>
                    <a href="<?php echo base_url('meus-arremates'); ?>?pg=<?php echo $next;?>">Próximo</a>
                </li>
            </ul>
        </div>
        <!-- End Profile Content -->
    </div>
    </div>
    </div>
    </div>
    <?php

    $this->load->view('fixed_files/user/footer');

endif;
?>
