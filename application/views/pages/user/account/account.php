<?php

if ($page == 'account'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');
    $data_atual_system = date('YmdHis');
    ?>

    <!-- Profile Content -->
    <div class="col-md-9">


        <div class="col-md-12">

            <?php
            if (isset($_SESSION['ID'])):
                $this->db->from('user');
                $this->db->where('id', $_SESSION['ID']);
                $query = $this->db->get();
                $result = $query->result_array();
            endif;
            ?>
            <h2><?php echo $result[0]['firstname'] . ' ' . $result[0]['lastname']; ?></h2>

            <?php

            $this->db->from('creditos');
            $this->db->where('usuario',$_SESSION['ID']);
            $queryCre = $this->db->get();
            $countCre = $queryCre->num_rows();
            $resultCre = $queryCre->result_array();
            if($countCre > 0):

                $credito = '<span  class="text-info">'.number_format($resultCre[0]['credito'],2,'.',',').'</span>';

            else:
                $credito = '<span class="text-danger">0.00</span>';

            endif;


            $this->db->from('cupon_loja');
            $this->db->where('id_user',$_SESSION['ID']);
            $queryCreUs = $this->db->get();
            $countCreUs = $queryCreUs->num_rows();
            $resultCreUs = $queryCreUs->result_array();
            if($countCreUs > 0):

                $saldo = number_format($resultCreUs[0]['valor'],2,'.',',');

            else:
                $saldo = '0.00';

            endif;

            ?>
            <span><strong>Meus créditos: </strong> R$ <?php echo $credito;?></span>&nbsp;&nbsp;
            <span><strong>Saldo de compra: </strong>R$ <?php echo $saldo;?></span>
            <hr>


        </div>

        <?php

        $this->db->from('compras');
        $this->db->where('id_user ', $_SESSION['ID']);
        $this->db->order_by('id', 'desc');
        $this->db->limit(5, 0);
        $query = $this->db->get();
        $count = $query->num_rows();
        $result = $query->result_array();

        if ($count > 0):


                ?>
                <!--Table Search v1-->
                <div class="table-search-v1 margin-bottom-20">

                    <div class="table-responsive">
                        <h2>Ultimas compras</h2>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th class="hidden-sm">Produto</th>
                                <th style="width: 100px;">Status</th>
                                <th>Valor</th>
                                <th>Opções</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
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
                                    if ($dds['status'] == 1):
                                        ?>
                                        <button class="btn-u btn-u-blue btn-block btn-u-xs"><i
                                                class="fa fa-sort-amount-desc margin-right-5"></i> Aguardando pagamento
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
                                        echo '<a href="'.$dds['url_payment'].'" target="_blank" class=" btn btn-success">Realizar pagamento</a>';
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
                                        $arremateid = '&&id3='.$result[0]['id'];

                                    else:

                                        $arremateid = '&&id3=0';

                                    endif;

                                else:
                                    $arremateid = '&&id3=0';

                                endif;
                                ?>

                                            <a href="<?php echo base_url('pages/cpd?id=' . $dds['id_obj_compra'] . '&&id2=' . $dds['id'] . ''.$arremateid.'&&tp=' . $dds['type']); ?>"
                                               class="btn btn-danger">Cancelar</a>

                            </span>

                                    <?php else:
                                        echo '-- --';
                                    endif;
                                    ?>


                                </td>
                            </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--End Table Search v1-->
            <?php endif; ?>
        <div class="table-search-v2">
            <div class="">
                <h2>Ultimos leilões</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Sobre</th>
                        <th>Status</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $this->db->from('leiloes');
                    $this->db->where('status != ', 0);
                    $this->db->where('status != ', 2555);
                    $this->db->order_by('id', 'desc');
                    $this->db->limit(5, 0);
                    $query = $this->db->get();
                    $count = $query->num_rows();

                    if ($count > 0):
                        $result = $query->result_array();
                        foreach ($result as $dds) {
                            $ind = $dds['inicio_data'];
                            $ano = substr($ind, 0, 4);
                            $mes = substr($ind, 4, 2);
                            $dia = substr($ind, 6, 2);
                            $hora = substr($ind, 8, 2);
                            $minuto = substr($ind, 10, 2);
                            $segundo = substr($ind, 12, 2);
                            ?>
                            <tr>
                                <td>
                                    <img class="rounded-x"
                                         src="<?php echo base_url('pages/exibir?id=' . $dds['id']); ?>"
                                         style="width: 80px; height:80px;object-fit: cover; object-position: center;"
                                         alt="">
                                </td>
                                <td class="td-width">
                                    <h3><a href="<?php

                                        if ($dds['status'] == 1 and $data_atual_system >= $dds['inicio_data']):
                                            echo base_url('sala?p=' . $dds['id']);
                                        else:
                                            echo 'javascript:func();';
                                        endif;
                                        ?>"><?php echo $this->Models_model->limitarTexto(strip_tags($dds['title']), 40); ?></a>
                                    </h3>
                                    <p><?php echo $this->Models_model->limitarTexto(strip_tags($dds['descricao_completa']), 150); ?></p>
                                    <?php

                                    if ($dds['status'] == 1 and $data_atual_system < $dds['inicio_data']):

                                        echo ' <small class="hex"><b>Começa:</b> ' . $dia . '/' . $mes . '/' . $ano . ' as ' . $hora . ':' . $minuto . ':' . $segundo . '</small>';
                                    endif;

                                    if ($dds['status'] == 1 and $data_atual_system >= $dds['inicio_data']):

                                        echo ' <small class="hex"><b>0</b> pessoas online / <b>0</b> lugares disponiveis</small>';

                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php

                                    if ($dds['status'] == 1 and $data_atual_system >= $dds['inicio_data']):


                                        echo '<span class="label label-success">Disponivel</span>';

                                    endif;

                                    if ($dds['status'] == 1 and $data_atual_system < $dds['inicio_data']):


                                        echo '<span class="label label-info">Em breve</span>';

                                    endif;
                                    ?>

                                </td>
                                <td>R$
                                    <b><?php

                                        if (strlen(str_replace(',', '', $dds['valor_leilao']) / 100) > 4):

                                            $explode = @explode('.', substr(str_replace(',', '', $dds['valor_leilao']) / 100, 0, -2) * 4);

                                            if (@strlen($explode[0]) == 1 and @strlen($explode[1]) == 1):
                                                echo number_format(substr(str_replace(',', '', $dds['valor_leilao']) / 100, 0, -2) * 4 . '0',2,'.',',');
                                            else:
                                                echo number_format(substr(str_replace(',', '', $dds['valor_leilao']) / 100, 0, -2) * 4,2,'.',',');

                                            endif;

                                        else:
                                            $explode = @explode('.', str_replace(',', '', $dds['valor_leilao']) / 100);


                                            if (@strlen($explode[1]) == 1 and @strlen(@$explode[0]) >= 2):
                                                echo number_format(str_replace(',', '', $dds['valor_leilao']) / 100 * 4 . 0,2,'.',',');
                                            else:
                                                // echo str_replace(',','',$dds['valor_leilao']) / 100 * 4;
                                                echo number_format(str_replace(',', '', $dds['valor_leilao']) / 100 * 4,2,'.',',');
                                            endif;
                                        endif;
                                        ?></b>
                                </td>
                            </tr>

                        <?php }
                    else: ?>

                        <tr>
                            <td> -- --</td>
                            <td> -- --</td>
                            <td> -- --</td>
                            <td> -- --</td>


                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- End Profile Content -->
    </div>
    </div>

    <?php
    $this->load->view('fixed_files/user/footer');


endif; ?>