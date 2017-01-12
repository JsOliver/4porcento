<?php
if ($page == 'invice'):
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');
$data_atual_system = date('YmdHis');

    $this->db->from('compras');
    $this->db->where('id_obj_compra',$_GET['item']);
    $query = $this->db->get();
    $countCp = $query->num_rows();
    $resultCp = $query->result_array();
?>

<div class="container content">
    <!--Invoice Header-->
    <div class="row invoice-header">
        <div class="col-xs-6">
            <img src="<?php echo base_url('assets/img/logo-3.png');?>" style="width: 70px;"  alt="">
            <!-- You also can use a title instead of image
            <h2 class="pull-left">Product Invoice</h2>-->
        </div><br><br>
        <div class="col-xs-6 invoice-numb">
            #<?php echo $_GET['item']; ?> / <?php echo $resultCp[0]['data_solicitation'];?>
            <span><?php echo $resultCp[0]['title'];?></span>
        </div>
    </div>
    <!--End Invoice Header-->

    <!--Invoice Detials-->
    <div class="row invoice-info">
        <div class="col-xs-6">
            <div class="tag-box tag-box-v3">
                <h2>Informação do cliente:</h2>
                <?php
                $this->db->from('user');
                $this->db->where('id',$resultCp[0]['id_user']);
                $queryUs = $this->db->get();
                $countUs = $queryUs->num_rows();
                $resultUs = $queryUs->result_array();
                if($countUs > 0):
                ?>
                    <ul class="list-unstyled">
                        <li><strong>Nome:</strong> <?php echo $resultUs[0]['firstname'];?></li>
                        <li><strong>Sobrenome:</strong> <?php echo $resultUs[0]['lastname'];?></li>
                        <li><strong>Email:</strong> <?php echo $resultUs[0]['email'];?></li>
                        <li><strong>Sexo:</strong> <?php
                            if($resultUs[0]['genre'] == 1): echo 'Masculino'; endif;
                            if($resultUs[0]['genre'] == 2): echo 'Feminino'; endif;
                            if($resultUs[0]['genre'] == 3): echo 'Outro'; endif;
                            ?></li>
                    </ul>

                    <?php
                else:
?>

                    <ul class="list-unstyled">
                        <li><strong>Nome:</strong> -- --</li>
                        <li><strong>Sobrenome:</strong> -- --</li>
                        <li><strong>Email:</strong> -- --</li>
                        <li><strong>Sexo:</strong> -- --</li>
                    </ul>

                    <?php
                    endif;
                    ?>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="tag-box tag-box-v3">
                <h2>Detalhes do pagamento:</h2>
                <ul class="list-unstyled">
                    <li><strong>Meio de pagamento:</strong> 4 Porcento</li>
                    <li><strong>Data do pagamento:</strong> <?php echo $resultCp[0]['data_solicitation'];?></li>
                    <li><strong>CPF do cliente:</strong> <?php  if(empty($resultUs[0]['cpf'])): echo 'Indisponível'; else: echo $resultUs[0]['cpf']; endif;?></li>
                    <li><strong>Codigo do pagamento:</strong> <?php echo $resultCp[0]['reference_code'];?></li>

                </ul>
            </div>
        </div>
    </div>
    <!--End Invoice Detials-->

    <!--Invoice Table-->
    <div class="panel panel-default margin-bottom-40">
        <div class="panel-heading">
            <h3 class="panel-title">Detalhes da compra</h3>
        </div>
        <div class="panel-body">
            <p><?php echo strip_tags($resultCp[0]['description']);?></p>
        </div>
        <table class="table table-striped invoice-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th class="hidden-sm">Descrição</th>
                <th>Quantidade</th>
                <th>Valor pago</th>
                <th>Valor do produto</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $_GET['item'];?></td>
                <td><?php echo $resultCp[0]['title'];?></td>
                <td class="hidden-sm"><?php echo strip_tags($this->Models_model->limitarTexto($resultCp[0]['description'],40));?></td>
                <td>1</td>
                <td><b>R$ <?php echo $resultCp[0]['value_show'];?></b></td>
                <td>R$
                <?php
                $this->db->from('leiloes');
                $this->db->where('id',$_GET['item']);
                $queryLe = $this->db->get();
                $resultLe = $queryLe->result_array();
                echo $resultLe[0]['valor_leilao'];
                ?>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <!--End Invoice Table-->

    <?php
    $this->db->from('administracao');
    $this->db->order_by('id','desc');
    $this->db->limit(1,0);
    $query = $this->db->get();
    $result = $query->result_array();
    ?>
    <!--Invoice Footer-->
    <div class="row">
        <div class="col-xs-6">
            <div class="tag-box tag-box-v3 no-margin-bottom">
                <address class="no-margin-bottom">
                    <?php echo $result[0]['numero'];?>, <?php echo $result[0]['rua'];?> <br>
                    <?php echo $result[0]['estado'];?> <br>
                    Telefone: <?php echo $result[0]['phone'];?> <br>
                    Email: <a href="mailto:<?php echo $result[0]['email'];?>"><?php echo $result[0]['email'];?></a>
                </address>
            </div>
        </div>
        <div class="col-xs-6 text-right">
            <ul class="list-unstyled invoice-total-info">
                <li><strong>Sub - Total produto:</strong> R$ <?php  echo $resultLe[0]['valor_leilao'];?></li>
                <li><strong>Desconto:</strong> 96%</li>
                <li><strong>Valor total:</strong> R$ <?php echo $resultCp[0]['value_show'];?></li>
            </ul>
            <button class="btn-u sm-margin-bottom-10" onclick="javascript:window.print();"><i
                    class="fa fa-print"></i> Imprimir
            </button>
            <a href="<?php echo base_url('retirada?item='.$_GET['item']);?>" download class="btn-u">Salvar</a>
        </div>
    </div>
    <!--End Invoice Footer-->
</div>


<?php
    $this->load->view('fixed_files/user/footer');

    endif;

    ?>