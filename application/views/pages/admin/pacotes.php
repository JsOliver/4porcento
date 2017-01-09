<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');

if ($page == 'pacotes'):
    $data_atual_system = date('YmdHis');
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pacotes</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php if (!isset($_GET['edit'])): ?>
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" <?php if (!isset($_GET['t'])): echo "class=\"active\""; endif; ?> ><a
                                href="<?php echo base_url('adm/pacotes'); ?>">Todos pacotes</a></li>

                        <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] == 'novo'): echo "class=\"active\""; endif; ?>>
                            <a href="<?php echo base_url('adm/pacotes?t=novo'); ?>">Adicionar pacote</a></li>
                    </ul>
                    <br>


                    <?php

                    if (!isset($_GET['t']) or isset($_GET['t']) and $_GET['t'] <> 'novo'):

                        ?>
                        <!-- Inicio todos os leiloes -->
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <?php if (!isset($_GET['t'])): ?>
                                    <div class="panel-heading">
                                        Todos pacotes cadastrados
                                    </div>

                                    <?php
                                else:

                                    ?>

                                    <div class="panel-heading">
                                        Todos leiloes <?php echo $_GET['t']; ?>
                                    </div>

                                <?php endif; ?>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="dataTables-example_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">

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
                                                       id="dataTables-example" role="grid"
                                                       aria-describedby="dataTables-example_info" style="width: 100%;">

                                                    <thead>
                                                    <tr role="row">

                                                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                            style="width: 77px;">ID
                                                        </th>

                                                        <th class="" tabindex="0" aria-controls="dataTables-example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending"
                                                            style="width: 96px;">Titulo
                                                        </th>


                                                        <th class="" tabindex="0" aria-controls="dataTables-example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending"
                                                            style="width: 86px;">Valor
                                                        </th>

                                                        <th class="" tabindex="0" aria-controls="dataTables-example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending"
                                                            style="width: 64px;">Data da ultima alteração
                                                        </th>


                                                        <th class="" tabindex="0" aria-controls="dataTables-example"
                                                            rowspan="1" colspan="1"
                                                            aria-label="CSS grade: activate to sort column ascending"
                                                            style="width: 44px;">Ações
                                                        </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    $max = 15;
                                                    $this->db->from('pacotes');
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

                                                    $this->db->from('pacotes');

                                                    $this->db->order_by('id', 'desc');
                                                    $this->db->limit($max, $atual);
                                                    $get = $this->db->get();
                                                    $num = $get->num_rows();
                                                    $fetch = $get->result_array();

                                                    foreach ($fetch as $dds) {
                                                        $ind = $dds['data'];
                                                        $ano = substr($ind, 0, 4);
                                                        $mes = substr($ind, 4, 2);
                                                        $dia = substr($ind, 6, 2);
                                                        $hora = substr($ind, 8, 2);
                                                        $minuto = substr($ind, 10, 2);
                                                        $segundo = substr($ind, 12, 2);
                                                        ?>
                                                        <tr class="gradeA odd" role="row">
                                                            <td class="sorting_1"><?php echo $dds['id']; ?></td>
                                                            <td><?php echo $dds['title']; ?></td>
                                                            <td><?php echo $dds['valor']; ?></td>

                                                            <td>

                                                                <?php
                                                                echo $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo;
                                                                ?>
                                                            </td>

                                                            <td class="center">


                                                                <a href="<?php echo base_url('adm/pacotes?edit=' . $dds['id']); ?>"
                                                                   class="btn btn-info">Editar</a>

                                                                <a href="<?php echo base_url('pages/deleteptc?id=' . $dds['id']); ?>"
                                                                   class="text-danger btn btn">Excluir</a></td>
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
                                                            <a href="<?php echo base_url('adm/pacotes?'); ?>pg=<?php echo $before; ?>">Anterior</a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo base_url('adm/pacotes?'); ?>pg=<?php echo $next; ?>">Próximo</a>
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
                        <!-- Fim todos os leiloes -->
                    <?php endif; ?>

                    <?php if (isset($_GET['t']) and $_GET['t'] == 'novo'): ?>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Novo pacote
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form role="form" method="post" enctype="multipart/form-data"
                                                      action="<?php echo base_url('pages/addPacote'); ?>">
                                                    <div class="form-group">
                                                        <label>Nome do pacote</label>
                                                        <input required name="title" class="form-control">
                                                        <p class="help-block">Exemplo: Pacote de inicio de ano.</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Valor</label>
                                                        <input required id="valor2" name="valor_pacote"
                                                               class="form-control" placeholder="Preço do pacote.">
                                                    </div>

                                                    <button type="submit" class="btn btn-default">Adicionar pacote
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                        <!-- /.row (nested) -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>


                    <?php endif; ?>

                </div>
            <?php else:


                $this->db->from('pacotes');
                $this->db->where('id', $_GET['edit']);
                $query = $this->db->get();
                $count = $query->num_rows();
                $result = $query->result_array();
                if ($count > 0):

                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Editar pacote <?php echo $_GET['edit']; ?>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="post" enctype="multipart/form-data"
                                                  action="<?php echo base_url('pages/updPacote'); ?>">

                                                <input type="hidden" value="<?php echo $result[0]['id'] ?>"
                                                       name="pacote">
                                                <div class="form-group">
                                                    <label>Nome do pacote</label>
                                                    <input required name="title" class="form-control"
                                                           value="<?php echo $result[0]['title']; ?>">
                                                    <p class="help-block">Exemplo: Pacote de inicio de ano.</p>
                                                </div>

                                                <div class="form-group">
                                                    <label>Valor</label>
                                                    <input required id="valor2"
                                                           value="<?php echo $result[0]['valor']; ?>"
                                                           name="valor_pacote" class="form-control"
                                                           placeholder="Preço do pacote.">
                                                </div>

                                                <button type="submit" class="btn btn-default">Salvar pacote</button>
                                            </form>
                                        </div>

                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>


                    <?php
                else:
                    redirect(base_url('adm/pacotes'), 'refresh');

                endif;


            endif; ?>

        </div>
    </div>


    <?php
    $this->load->view('fixed_files/admin/footer');

endif;

?>
