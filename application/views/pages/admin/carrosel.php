<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');


if ($page == 'carrosel'):
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slides</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <?php if (!isset($_GET['edit']) and !isset($_GET['t'])): ?>
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" <?php if (!isset($_GET['t'])): echo "class=\"active\""; endif; ?> ><a
                            href="<?php echo base_url('adm/carrosel'); ?>">Todos slides</a></li>
                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] == 'novo'): echo "class=\"active\""; endif; ?>>
                        <a href="<?php echo base_url('adm/carrosel?t=novo'); ?>">Novo slide</a></li>
                </ul>
                <br>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Todos slides cadastrados
                        </div>

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

                                                <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 96px;">Titulo
                                                </th>


                                                <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 86px;">Imagem
                                                </th>

                                                <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending"
                                                    style="width: 64px;">Data da ultima alteração
                                                </th>


                                                <th class="" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending"
                                                    style="width: 44px;">Ações
                                                </th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $max = 15;
                                            $this->db->from('carrosel');
                                            $this->db->order_by('id', 'desc');
                                            $pagination_query = $this->db->get();
                                            $row_query = $pagination_query->num_rows();

                                            if (!isset($_GET['pg'])) {
                                                $atual = 0;
                                                $pages = 1;
                                                $pgatual = 1;
                                            } else {
                                                $atual = ceil($max * $_GET['pg'] - $max);
                                                if ($_GET['pg'] <= 1) {
                                                    $pages = 1;
                                                    $pgatual = 1;

                                                } else {

                                                    $pages = ceil($max / $_GET['pg']);
                                                    $pgatual = $_GET['pg'];

                                                }
                                            }

                                            $this->db->from('carrosel');
                                            $this->db->limit($max, $atual);
                                            $this->db->order_by('id', 'desc');
                                            $query = $this->db->get();
                                            $row = $query->num_rows();
                                            $result = $query->result_array();
                                            if ($row > 0):
                                                foreach ($result as $dds) {

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
                                                        <td><?php echo $this->Models_model->limitarTexto($dds['titulo'], 60); ?></td>
                                                        <td><img
                                                                src="<?php echo base_url('pages/exibirCr?id=' . $dds['id']); ?>"
                                                                style="width: 80px; object-fit: cover; object-position: center;">
                                                        </td>

                                                        <td>
                                                            <?php echo $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo; ?>
                                                        </td>

                                                        <td class="center">


                                                            <a href="<?php echo base_url('adm/carrosel?edit=' . $dds['id']); ?>"
                                                               class="btn btn-info">Editar</a>

                                                            <a href="<?php echo base_url('pages/deletecrs?id=' . $dds['id']); ?>"
                                                               class="text-danger btn btn">Excluir</a></td>
                                                    </tr>

                                                <?php }

                                            else: ?>

                                                <tr>
                                                    <td>-- --</td>
                                                    <td>-- --</td>
                                                    <td>-- --</td>
                                                    <td>-- --</td>
                                                    <td>-- --</td>
                                                </tr>
                                            <?php endif; ?>


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
                                        <div class="text-center">
                                            <ul class="pagination pagination-v2">
                                                <li>
                                                    <a href="<?php echo base_url('adm/carrosel?'); ?>pg=<?php echo $before; ?>">Anterior</a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo base_url('adm/carrosel?'); ?>pg=<?php echo $next; ?>">Próximo</a>
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


            </div>
        </div>
        <?php
        endif;
        if (!isset($_GET['edit']) and isset($_GET['t']) and $_GET['t'] == 'novo'): ?>

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Novo slide
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" method="post" enctype="multipart/form-data"
                                      action="<?php echo base_url('pages/addCarrosel'); ?>">
                                    <div class="form-group">
                                        <label>Titulo do slide</label>
                                        <input required="" name="title" class="form-control">
                                        <p class="help-block">Exemplo: Fone de ouvido Pulse.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Breve descrição</label>
                                        <input required="" name="breve_descricao" class="form-control"
                                               placeholder="Uma breve descrição do slide.">
                                    </div>

                                    <div class="form-group">
                                        <label>Imagem do leilão</label>
                                        <input required="" name="image" type="file">
                                    </div>
                                    <div class="form-group">
                                        <label>Titulo do link</label>
                                        <input name="linktext" class="form-control">
                                        <p class="help-block">Exemplo: Ver mais</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Link</label>
                                        <input name="link" class="form-control">
                                        <p class="help-block">Exemplo: https://www.google.com.br/</p>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-default">Adicionar</button>
                                    <a href="<?php echo base_url('adm/carrosel'); ?>"
                                       class="btn btn-default">Cancelar</a>


                                </form>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>


            </div>
            <?php
        endif;
        ?>


    </div>


    <?php
    if (isset($_GET['edit'])):
        $this->db->from('carrosel');
        $this->db->where('id', $_GET['edit']);
        $veredit = $this->db->get();
        $row_query_edit = $veredit->num_rows();
        $result = $veredit->result_array();
        if ($row_query_edit == 0):

            redirect(base_url('adm/carrosel'), 'refresh');

        endif;
        ?>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar slide <b><?php echo $_GET['edit'];?></b>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" enctype="multipart/form-data"
                                  action="<?php echo base_url('pages/editCarrosel');?>">

                                <input type="hidden" name="carrosel" value="<?php echo $result[0]['id']; ?>">
                                <div class="form-group">
                                    <label>Titulo do slide</label>
                                    <input required="" name="title" class="form-control" value="<?php echo $result[0]['titulo'];?>">
                                    <p class="help-block">Exemplo: Fone de ouvido Pulse.</p>
                                </div>
                                <div class="form-group">
                                    <label>Breve descrição</label>
                                    <input required="" name="breve_descricao" class="form-control"
                                           placeholder="Uma breve descrição do slide." value="<?php echo str_replace('<br>','.',$result[0]['texto']);?>">
                                </div>

                                <div class="form-group">
                                    <label>Imagem do leilão</label><br>
<label>
                                    <img src="<?php echo base_url('pages/exibirCr?id='.$result[0]['id']);?>" style="width: 122px; height: 100px; object-fit: cover; object-position: center;">
                                    <input required="" name="image" type="file"></label>
                                </div>
                                <div class="form-group">
                                    <label>Titulo do link</label>
                                    <input name="linktext" class="form-control" value="<?php echo $result[0]['link_texto_1'];?>">
                                    <p class="help-block">Exemplo: Ver mais</p>
                                </div>

                                <div class="form-group">
                                    <label>Link</label>
                                    <input name="link" class="form-control" value="<?php echo $result[0]['link_1'];?>">
                                    <p class="help-block">Exemplo: https://www.google.com.br/</p>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-default">Alterar</button>
                                <a href="<?php echo base_url('adm/carrosel');?>" class="btn btn-default">Cancelar</a>


                            </form>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>


        </div>

    <?php endif; ?>
    </div>
    <?php

    $this->load->view('fixed_files/admin/footer');

endif; ?>