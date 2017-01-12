<?php
if ($page == 'compra'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');

    ?>

    <br>
    <br>
    <br>

    <div class="container">
        <script>
            function compra(compra) {

                $("#respck" + compra + "").html('<a href="#" class="btn btn-success text-white" style="color: white;"><b><img src="<?php echo base_url('assets/img/load.gif');?>" style="width:20px;"></b></a>');
                $.post("<?php echo base_url('comprarPack');?>", {compra: compra}, function (res) {
                    if (res) {

                        if (res == 0) {

                            $("#respck" + compra + "").html('<a class="btn btn-danger text-white" style="color: white;"><b>Erro ao comprar pacote.</b></a>');

                        }

                        if (res == 2) {

                            $("#respck" + compra + "").html('<a  class="btn btn-warning text-white" style="color: white;"><b>Aguardando confirmação de pagamento.</b></a>');

                        }
                        else{


                            $("#respck" + compra + "").html('<a href="'+res+'" target="_blank"  class="btn btn-info text-white" style="color: white;"><b>Prosseguir para o pagamento.</b></a>');
                        }

                    } else {

                        $("#respck" + compra + "").html('<a class="btn btn-danger text-white" style="color: white;"><b>Erro ao comprar pacote.</b></a>');

                    }
                });
            }
        </script>
        <div class="row margin-bottom-60">
            <?php
            $max = 6;
            if (!isset($_GET['pg'])) {
                $page_atual = 1;

            } else {

                if ($_GET['pg'] <= 0):

                    $page_atual = 1;

                else:
                    $page_atual = $_GET['pg'];
                endif;

            }

            $this->db->from('pacotes');
            $this->db->order_by('id', 'desc');
            $querypg = $this->db->get();
            $countpg = $querypg->num_rows();
            $pages = ceil($countpg / $max);

            if ($countpg > 0):


                if (!isset($_GET['pg'])) {

                    $min = 0;

                } else {

                    $min = ceil($max * $page_atual - $max);

                }

                $this->db->from('pacotes');
                $this->db->order_by('id', 'desc');
                $this->db->limit($max, $min);
                $query = $this->db->get();
                $count = $query->num_rows();
                $result = $query->result_array();
                foreach ($result as $dds) {

                    $stripr1 = str_replace('.', '', $dds['valor']);
                    $reais = str_replace(',', '', $stripr1);
                    ?>


                    <div class="col-md-4 product-service">
                        <div class="product-service-heading">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="product-service-in">
                            <h3>R$ <?php echo number_format($dds['valor'], 2, '.', ','); ?> </h3>
                            <p><b><?php echo $this->Models_model->limitarTexto($dds['title'],30); ?></b></p>
                            <span id="respck<?php echo $dds['id']; ?>">
                        <a class="btn btn-success text-white" style="cursor:pointer;color: white;"
                           onclick="compra('<?php echo $dds['id']; ?>')">Comprar por <b>R$ <?php echo number_format($dds['valor'], 2, '.', ','); ?> </b></a>
                          </span>
                        </div>
                        <br>
                    </div>

                    <?php
                }
            else:
                echo '<br><br><br><br><br>';

                echo '<br><h1 style="text-align: center;">Nenhum pacote encontrado.</h1>';
                echo '<br><br><br><br><br><br>';
            endif;
            ?>
        </div>

        <?php


        if ($page_atual <= 0):
            $next = 1;
            $before = 1;
        else:
            if ($pages <= 1):

                $next = 1;
                $before = 1;

            else:

                if ($pages > 1):

                    if ($page_atual == $pages):

                        $next = $page_atual;

                    else:
                        $next = $page_atual + 1;


                    endif;
                endif;
                if ($page_atual > 1):
                    $before = $page_atual - 1;

                else:
                    $before = 1;
                endif;
            endif;
        endif;

        if ($countpg > 0):
            ?>
            <div class="text-center">
                <ul class="pagination pagination-v2">
                    <li><a href="<?php echo base_url('adicionar/creditos'); ?>?pg=<?php echo $before; ?>">Anterior</a>
                    </li>

                    <li><a href="<?php echo base_url('adicionar/creditos'); ?>?pg=<?php echo $next; ?>">Próximo</a></li>
                </ul>
            </div>

        <?php endif; ?>
    </div>
    <?php

    $this->load->view('fixed_files/user/footer');

endif;

?>
