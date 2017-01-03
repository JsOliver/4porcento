<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');


if($page == 'users'):
    ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Todos usuarios cadastrados
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="dataTables-example_length">
                                </div></div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">




                                </div></div></div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">

                                    <thead>
                                    <tr role="row">

                                        <th  tabindex="0" aria-controls="dataTables-example" rowspan="1"  style="width: 77px;">ID</th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 96px;">Nome</th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 86px;">Sobrenome</th>
                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 86px;">Username</th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 64px;">CPF</th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 44px;">E-mail</th>
                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 44px;">Gênero</th>
                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 44px;">Arrematados</th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 44px;">Saldo</th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 44px;">Ações</th>

                                    </tr>
                                    </thead>
                                    <tbody>

<?php
$max = 20;
if(isset($_GET['pg'])):
    $beg = $max * $_GET['pg'] - $max;

else:

    $beg = 0;

endif;

$this->db->from('user');
$this->db->order_by('id','desc');
$getNl = $this->db->get();
$numNl = $getNl->num_rows();

$this->db->from('user');
$this->db->order_by('id','desc');
$this->db->limit($max,$beg);
$get = $this->db->get();
$num = $get->num_rows();
$fetch = $get->result_array();

foreach($fetch as $dds){

?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1"><?php echo $dds['id'];?></td>
                                        <td><?php echo $dds['firstname'];?></td>
                                        <td><?php echo $dds['lastname'];?></td>
                                        <td class="center"><b><?php echo $dds['username'];?></b></td>
                                        <td class="center"><?php echo $dds['cpf'];?></td>
                                        <td class="center">

                                            <?php echo $dds['email'];?>
                                        </td>
                                        <td class="center">   <?php


                                            if($dds['genre'] == 0):
                                                echo 'Não informado';
                                            endif;
                                            if($dds['genre'] == 1):
                                                echo 'Masculino';
                                            endif;
                                            if($dds['genre'] == 2):
                                                echo 'Feminino';
                                            endif;
                                            if($dds['genre'] == 3):
                                                echo 'Outro';
                                            endif;


                                            ?></td>
                                        <td class="center">
<?php
$this->db->from('arremates');
$this->db->where('id_user',$dds['id']);
$coount = $this->db->get();
$rowValue = $coount->num_rows();
echo number_format($rowValue);
?>
                                        </td>
                                        <td >
                                        <?php

                                        $this->db->from('creditos');
                                        $this->db->where('usuario',$dds['id']);
                                       $coount = $this->db->get();
                                        $rowValue = $coount->num_rows();
                                        $fetchValue = $coount->result_array();
                                        if($rowValue == 0):

                                            echo '0,00';
                                            else:
                                                $valuef1 = str_replace('.','',$fetchValue['credito']);
                                                $valuef2 = str_replace(',','',$valuef1);
                                                echo number_format($valuef2,2,'.',',');
                                        ?>

                                                <?php endif;?>
                                        </td>

                                        <td class="center"><a href="<?php echo base_url('pages/deleteus?id='.$dds['id']);?>" class="text-danger">Excluir</a></td>                                    </tr>

<?php }?>

                                    <tr class="gradeA even" role="row">
                                  </tbody>
                                </table></div></div><div class="row">



                            <div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination">

                                        <li class="paginate_button previous" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Anterior</a></li>
                                   <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Proximo</a></li></ul></div></div></div></div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
<?php

    $this->load->view('fixed_files/admin/footer');


endif;?>

    <?php

$this->load->view('fixed_files/admin/footer');


?>