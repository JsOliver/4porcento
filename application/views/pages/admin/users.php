<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');


if ($page == 'users'):
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
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%"
                                       class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                       id="dataTables-example" role="grid" aria-describedby="dataTables-example_info"
                                       style="width: 100%;">

                                    <thead>
                                    <tr role="row">

                                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            style="width: 77px;">ID
                                        </th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            style="width: 96px;">Nome
                                        </th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                            style="width: 86px;">Sobrenome
                                        </th>
                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                            style="width: 86px;">Username
                                        </th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending"
                                            style="width: 64px;">CPF
                                        </th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 44px;">E-mail
                                        </th>
                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 44px;">Gênero
                                        </th>
                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 44px;">Arrematados
                                        </th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 44px;">Saldo
                                        </th>

                                        <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="width: 44px;">Ações
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $max = 25;
                                    $this->db->from('user');
                                    $this->db->order_by('id', 'desc');
                                    $pagination_query = $this->db->get();
                                    $row_query = $pagination_query->num_rows();
                                    $pages = ceil($row_query / $max);

                                    if (!isset($_GET['pg'])) {
                                        $atual = 0;
                                        $pgatual = 1;
                                    } else {
                                        $atual = ceil($max * $_GET['pg'] - $max);
                                        if ($_GET['pg'] <= 1) {
                                            $pgatual = 1;

                                        } else {

                                            $pgatual = $_GET['pg'];

                                        }
                                    }

                                    $this->db->from('user');
                                    if(isset($_GET['q']) and !empty($_GET['q'])):
                                        $this->db->where('id', $_GET['q']);
                                    endif;
                                    $this->db->where('type !=', 54);

                                    $this->db->order_by('id', 'desc');
                                    $this->db->limit($max, $atual);
                                    $get = $this->db->get();
                                    $num = $get->num_rows();
                                    $fetch = $get->result_array();

                                    foreach ($fetch as $dds) {

                                        ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?php echo $dds['id']; ?></td>
                                            <td><?php echo $dds['firstname']; ?></td>
                                            <td><?php echo $dds['lastname']; ?></td>
                                            <td class="center"><b><?php echo $dds['username']; ?></b></td>
                                            <td class="center"><?php echo $dds['cpf']; ?></td>
                                            <td class="center">

                                                <?php echo $dds['email']; ?>
                                            </td>
                                            <td class="center">   <?php


                                                if ($dds['genre'] == 0):
                                                    echo 'Não informado';
                                                endif;
                                                if ($dds['genre'] == 1):
                                                    echo 'Masculino';
                                                endif;
                                                if ($dds['genre'] == 2):
                                                    echo 'Feminino';
                                                endif;
                                                if ($dds['genre'] == 3):
                                                    echo 'Outro';
                                                endif;


                                                ?></td>
                                            <td class="center">
                                                <?php
                                                $this->db->from('arremates');
                                                $this->db->where('id_user', $dds['id']);
                                                $coount = $this->db->get();
                                                $rowValue = $coount->num_rows();
                                                echo number_format($rowValue);
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                $this->db->from('creditos');
                                                $this->db->where('usuario', $dds['id']);
                                                $coount = $this->db->get();
                                                $rowValue = $coount->num_rows();
                                                $fetchValue = $coount->result_array();
                                                if ($rowValue == 0):

                                                    echo '0,00';
                                                else:

                                                    echo number_format($fetchValue[0]['credito'], 2, '.', ',');

                                                    ?>

                                                <?php endif; ?>
                                            </td>

                                            <td class="center"><a
                                                    href="<?php echo base_url('pages/deleteus?id=' . $dds['id']); ?>"
                                                    class="text-danger">Excluir</a><br>
                                            <?php 
                                            if($dds['type'] == 1):
                                                echo '<a href="'.base_url('pages/lbcnd?id='.$dds['id']).'">Liberar consulta</a>';
                                                else:
                                                    echo '<a href="'.base_url('pages/bbcnd?id='.$dds['id']).'">Bloquear consulta</a>';

                                            endif;
                                            ?>
                                            </td>
                                        </tr>

                                    <?php } ?>

                                    <tr class="gradeA even" role="row">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-sm-6">
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
                                <div class="">
                                    <ul class="pagination pagination-v2">
                                        <li>
                                            <a href="<?php echo base_url('adm/clientes?'); ?>pg=<?php echo $before; ?>">Anterior</a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url('adm/clientes?'); ?>pg=<?php echo $next; ?>">Próximo</a>
                                        </li>
                                    </ul>
                                </div><!--/end pagination-->
                            </div>
                        </div>
                    </div>
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


endif; ?>

<?php

$this->load->view('fixed_files/admin/footer');


?>