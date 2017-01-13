<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');


if ($page == 'leilao'):
$data_atual_system = date('YmdHis');

?><!-- Latest compiled and minified CSS -->


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leiloes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <?php if (!isset($_GET['edit']) and !isset($_GET['arrematado'])): ?>
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" <?php if (!isset($_GET['t'])): echo "class=\"active\""; endif; ?> ><a
                            href="<?php echo base_url('adm/leiloes'); ?>">Todos leilões</a></li>
                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] == 'arrematados'): echo "class=\"active\""; endif; ?>>
                        <a href="<?php echo base_url('adm/leiloes?t=arrematados'); ?>">Leilões arrematados</a></li>
                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] == 'finalizados'): echo "class=\"active\""; endif; ?>>
                        <a href="<?php echo base_url('adm/leiloes?t=finalizados'); ?>">Leilões finalizados</a></li>
                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] == 'disponiveis'): echo "class=\"active\""; endif; ?>>
                        <a href="<?php echo base_url('adm/leiloes?t=disponiveis'); ?>">Leilões disponiveis</a></li>

                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] == 'novo'): echo "class=\"active\""; endif; ?>>
                        <a href="<?php echo base_url('adm/leiloes?t=novo'); ?>">Adicionar leilão</a></li>
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
                                    Todos leiloes cadastrados
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
                                                        style="width: 86px;">Inicio
                                                    </th>

                                                    <th class="" tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending"
                                                        style="width: 64px;">Duração
                                                    </th>

                                                    <th class="" tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending"
                                                        style="width: 44px;">Preço
                                                    </th>
                                                    <th class="" tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending"
                                                        style="width: 44px;">Breve descrição
                                                    </th>
                                                    <th class="" tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending"
                                                        style="width: 44px;">Endereço
                                                    </th>

                                                    <th class="" tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending"
                                                        style="width: 44px;">Status
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
                                                $this->db->from('leiloes');
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


                                                $this->db->from('leiloes');
                                                if (isset($_GET['t']) and $_GET['t'] == 'arrematados'):
                                                    $this->db->where('status', 2555);
                                                endif;
                                                if (isset($_GET['t']) and $_GET['t'] == 'finalizados'):
                                                    $this->db->where('status', 0);
                                                endif;
                                                if (isset($_GET['t']) and $_GET['t'] == 'disponiveis'):
                                                    $this->db->where('status', 1);
                                                endif;
                                                //$this->db->where('done', 0);

                                                $this->db->order_by('id', 'desc');
                                                $this->db->limit($max, $atual);
                                                $get = $this->db->get();
                                                $num = $get->num_rows();
                                                $fetch = $get->result_array();

                                                foreach ($fetch as $dds) {
                                                    $ind = $dds['inicio_data'];
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
                                                        <td><?php echo $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo; ?></td>
                                                        <td class="center"><b>1</b></td>
                                                        <td class="center"><?php echo $dds['valor_leilao']; ?></td>

                                                        <td class="center">   <?php
                                                            echo $dds['breve_descricao'];
                                                            ?></td>
                                                        <td class="center">
                                                            <?php
                                                            if (!empty($dds['rua']) and !empty($dds['bairro']) and !empty($dds['cidade']) and !empty($dds['estado'])):
                                                                echo $dds['rua'] . ' <b>/</b> ' . $dds['bairro'] . ' <b>/</b> ' . $dds['cidade'] . ' <b>/</b> ' . $dds['estado'];

                                                            else:
                                                                echo '<b class="text-danger">Endereço indisponível.</b>';

                                                            endif;
                                                            ?>
                                                        </td>
                                                        <td>

                                                            <?php

                                                            $this->db->from('compras');
                                                            $this->db->where('id_obj_compra',$dds['id']);
                                                            $query = $this->db->get();
                                                            $result = $query->result_array();
                                                            if($query->num_rows() > 0):
                                                                if($result[0]['submit'] == 3):
                                                                    echo '<b class="text-info">Entregue</b>';

                                                                    endif;

                                                                if ($dds['status'] == 0 and $result[0]['submit'] <> 3):
                                                                    echo '<b class="text-danger">Finalizado</b>';
                                                                endif;
                                                                if ($dds['status'] == 1 and $data_atual_system > $ind and $result[0]['submit'] <> 3):
                                                                    echo '<b class="text-success">Disponivel</b>';
                                                                endif;
                                                                if ($dds['status'] == 2555 and $result[0]['submit'] <> 3):
                                                                    echo '<a><b class="text-warning">Arrematado</b></a>';
                                                                endif;

                                                                if ($dds['status'] == 1 and $data_atual_system < $ind and $result[0]['submit'] <> 3):
                                                                    echo '<a><b class="text-info">Aguardando</b></a>';
                                                                endif;

                                                                else:
                                                                    if ($dds['status'] == 0):
                                                                        echo '<b class="text-danger">Finalizado</b>';
                                                                    endif;
                                                                    if ($dds['status'] == 1 and $data_atual_system > $ind):
                                                                        echo '<b class="text-success">Disponivel</b>';
                                                                    endif;
                                                                    if ($dds['status'] == 2555):
                                                                        echo '<a><b class="text-warning">Arrematado</b></a>';
                                                                    endif;

                                                                    if ($dds['status'] == 1 and $data_atual_system < $ind):
                                                                        echo '<a><b class="text-info">Aguardando</b></a>';
                                                                    endif;


                                                                    endif;


                                                            ?>
                                                        </td>

                                                        <td class="center">
                                                            <?php
                                                            if ($dds['status'] == 2555 and $dds['winner'] > 0):
                                                                ?>
                                                                <a href="<?php echo base_url('adm/leiloes?arrematado=' . $dds['id']); ?>"
                                                                   class="btn btn-warning">Detalhes</a>

                                                            <?php else: ?>

                                                                <a href="<?php echo base_url('adm/leiloes?edit=' . $dds['id']); ?>"
                                                                   class="btn btn-info">Editar</a>
                                                            <?php endif; ?>
                                                            <a href="<?php echo base_url('pages/deletelei?id=' . $dds['id']); ?>"
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
                                                        <a href="<?php echo base_url('adm/leiloes?'); ?>pg=<?php echo $before; ?>">Anterior</a>
                                                    </li>

                                                    <li>
                                                        <a href="<?php echo base_url('adm/leiloes?'); ?>pg=<?php echo $next; ?>">Próximo</a>
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
                                    Novo leilão
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="post" enctype="multipart/form-data"
                                                  action="<?php echo base_url('pages/addLeilao'); ?>">
                                                <div class="form-group">
                                                    <label>Nome do leilão</label>
                                                    <input required name="title" class="form-control">
                                                    <p class="help-block">Exemplo: Fone de ouvido Pulse.</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Breve descrição</label>
                                                    <input required name="breve_descricao" class="form-control"
                                                           placeholder="Uma breve descrição do leilão.">
                                                </div>

                                                <div class="form-group">
                                                    <label>Imagem do leilão</label>
                                                    <input required name="image" type="file">
                                                </div>
                                                <div class="form-group">
                                                    <label>Valor</label>
                                                    <input required id="valor" name="valor_leilao" class="form-control"
                                                           placeholder="Preço do produto.">
                                                    <div class="form-group">
                                                        <label>Minimo usuarios</label>
                                                        <input required id="numero" name="minuser" class="form-control"
                                                               placeholder="Minimo de usuarios">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Maximo usuarios</label>
                                                        <input required id="numero1" name="maxuser" class="form-control"
                                                               placeholder="Maximo de usuarios">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tempo de lance</label>
                                                        <input required type="number" name="maxlance"
                                                               class="form-control"
                                                               placeholder="Tempo de lance">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Inicio</label>
                                                        <input required id="dateinicio" name="inicio_data"
                                                               class="form-control"
                                                               placeholder="Data inical do leilão.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Descrição completa</label>
                                                        <textarea name="descricao_completa" class="form-control"
                                                                  rows="3"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <input name="estado" class="form-control"
                                                               placeholder="Estado aonde se encontra o produto.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <input name="cidade" class="form-control"
                                                               placeholder="Cidade aonde se encontra o produto.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>CEP</label>
                                                        <input id="cep" name="cep" class="form-control"
                                                               placeholder="CEP aonde se encontra o produto.">
                                                        <div class="form-group">
                                                            <label>Rua</label>
                                                            <input name="rua" class="form-control"
                                                                   placeholder="Rua aonde se encontra o produto.">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Bairro</label>
                                                            <input name="bairro" class="form-control"
                                                                   placeholder="Bairro aonde se encontra o produto.">
                                                        </div>
                                                        <button type="submit" class="btn btn-default">Enviar
                                                            formulario
                                                        </button>
                                                        <button type="reset" class="btn btn-default">Limpar formulario
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

        <?php elseif (isset($_GET['edit']) and !isset($_GET['arrematado'])):

            $this->db->from('leiloes');
            $this->db->where('id', $_GET['edit']);
            $query = $this->db->get();
            $count = $query->num_rows();
            $result = $query->result_array();

            if ($count == 0):

                redirect(base_url('adm/leiloes'), 'refresh');

            else:

                $ind = $result[0]['inicio_data'];
                $ano = substr($ind, 0, 4);
                $mes = substr($ind, 4, 2);
                $dia = substr($ind, 6, 2);
                $hora = substr($ind, 8, 2);
                $minuto = substr($ind, 10, 2);
                $segundo = substr($ind, 12, 2);
                ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Editar leilão numero <b><?php echo $_GET['edit']; ?></b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method="post" enctype="multipart/form-data"
                                              action="<?php echo base_url('pages/updLeilao'); ?>">


                                            <input type="hidden" name="leilao" value="<?php echo $_GET['edit']; ?>">
                                            <div class="form-group">
                                                <label>Nome do leilão</label>
                                                <input required name="title" class="form-control"
                                                       value="<?php echo $result[0]['title']; ?>">
                                                <p class="help-block">Exemplo: Fone de ouvido Pulse.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Breve descrição</label>
                                                <input required name="breve_descricao" class="form-control"
                                                       placeholder="Uma breve descrição do leilão."
                                                       value="<?php echo $result[0]['breve_descricao']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Imagem do leilão</label><br>
                                                <img src="<?php echo base_url('pages/exibir?id=' . $_GET['edit']); ?>"
                                                     style="width: 120px;"><br>
                                                <input name="image" type="file">
                                            </div>
                                            <div class="form-group">
                                                <label>Valor</label>
                                                <input required id="valor" name="valor_leilao" class="form-control"
                                                       placeholder="Preço do produto."
                                                       value="<?php echo $result[0]['valor_leilao']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Minimo usuarios</label>
                                                <input required value="<?php echo $result[0]['minimo_users']; ?>"
                                                       id="numero" name="minuser" class="form-control"
                                                       placeholder="Minimo de usuarios">
                                            </div>
                                            <div class="form-group">
                                                <label>Maximo usuarios</label>
                                                <input required id="numero1"
                                                       value="<?php echo $result[0]['maximo_users']; ?>" name="maxuser"
                                                       class="form-control" placeholder="Maximo de usuarios">
                                            </div>

                                            <div class="form-group">
                                                <label>Tempo de lance</label>
                                                <input required value="<?php echo $result[0]['duracao_lance']; ?>"
                                                       type="number" name="maxlance" class="form-control"
                                                       placeholder="Tempo de lance">
                                            </div>
                                            <div class="form-group">
                                                <label>Inicio</label>
                                                <input required id="dateinicio" name="inicio_data" class="form-control"
                                                       placeholder="Data inical do leilão."
                                                       value="<?php echo $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Descrição completa</label>
                                                <textarea name="descricao_completa" class="form-control"
                                                          rows="3"><?php echo $result[0]['descricao_completa']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <input name="estado" class="form-control"
                                                       placeholder="Estado aonde se encontra o produto."
                                                       value="<?php echo $result[0]['estado']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input name="cidade" class="form-control"
                                                       placeholder="Cidade aonde se encontra o produto."
                                                       value="<?php echo $result[0]['cidade']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>CEP</label>
                                                <input id="cep" name="cep" class="form-control"
                                                       placeholder="CEP aonde se encontra o produto."
                                                       value="<?php echo $result[0]['cep']; ?>">
                                                <div class="form-group">
                                                    <label>Rua</label>
                                                    <input name="rua" class="form-control"
                                                           placeholder="Rua aonde se encontra o produto."
                                                           value="<?php echo $result[0]['rua']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Bairro</label>
                                                    <input name="bairro" class="form-control"
                                                           placeholder="Bairro aonde se encontra o produto."
                                                           value="<?php echo $result[0]['bairro']; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-default">Atualizar leilao</button>
                                                <button type="reset" class="btn btn-default">Limpar formulario</button>
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

            endif;
        else:

            ?>

            <?php

            $this->db->from('leiloes');
            $this->db->where('id',$_GET['arrematado']);
            $query = $this->db->get();
            $rowArremate = $query->num_rows();
            $result = $query->result_array();
            if($rowArremate == 0):
                redirect(base_url('leiloes'), 'refresh');
            endif;
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Leilão arrematado por usuario <b><?php echo $result[0]['winner']; ?></b>
                        </div>
                        <?php
                        $this->db->from('compras');
                        $this->db->where('id_obj_compra',$_GET['arrematado']);
                        $this->db->where('type',1);
                        $query_cp = $this->db->get();
                        $rowCp = $query_cp->num_rows();
                        $resultCp = $query_cp->result_array();
                        if($rowCp == 0):
                            redirect(base_url('leiloes'), 'refresh');
                        endif;


                        $this->db->from('user');
                        $this->db->where('id',$result[0]['winner']);
                        $query_us = $this->db->get();
                        $rowUs = $query_us->num_rows();
                        $resultUs = $query_us->result_array();
                        if($rowUs == 0):
                            redirect(base_url('leiloes'), 'refresh');
                        endif;

                        ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="dataTables-example_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table width="100%"
                                               class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                               id="dataTables-example" role="grid"
                                               aria-describedby="dataTables-example_info" style="width: 100%;">
                                            <thead>
                                            <tr role="row">
                                                <th tabindex="0" aria-controls="dataTables-example"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 77px;">Item arrematado
                                                </th>
                                                <th tabindex="0" aria-controls="dataTables-example"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 77px;">Vencedor
                                                </th>
                                                <th tabindex="0" aria-controls="dataTables-example"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 77px;">Valor com desconto
                                                </th>

                                                <th tabindex="0" aria-controls="dataTables-example"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 77px;"> Status do pagamento
                                                </th>

                                                <th tabindex="0" aria-controls="dataTables-example"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 77px;"> Data do arremate
                                                </th>
                                                <?php
                                                if($resultCp[0]['submit'] == 1 and  $resultCp[0]['status'] == 3 or $resultCp[0]['status'] == 4):
                                                ?>
                                                    <th tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending"
                                                        style="width: 77px;"> Url de rastreio
                                                    </th>



                                                <?php endif;?>

                                                <?php
                                                if($resultCp[0]['submit'] == 3):
                                                ?>
                                              <th tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending"
                                                        style="width: 77px;"> Status do recebimento
                                                    </th>
<?php endif;?>



                                                    <th tabindex="0" aria-controls="dataTables-example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending"
                                                        style="width: 77px;"> Resolvido
                                                    </th>

                                            </tr>
                                            </thead>
                                            <tbody>


                                            <tr class="gradeA even" role="row">
                                                <td class="sorting_1"><b><?php echo $_GET['arrematado'];?></b></td>
                                                <td><small><b><a href="<?php echo base_url('adm/clientes?q='.$result[0]['winner']);?>" target="_blank"><?php echo $resultUs[0]['firstname'].' '.$resultUs[0]['lastname'];?></a></b></small></td>
                                                <td>R$ <?php echo $resultCp[0]['value_show'];?></td>
                                                <td class="center">

                                                    <?php

                                                    if($resultCp[0]['status'] == 1 or $resultCp[0]['status'] == 2):
                                                    echo '<b class="text-info">Aguardando pagamento</b>';
                                                    endif;

                                                    if($resultCp[0]['status'] == 3 or $resultCp[0]['status'] == 4):
                                                    echo '<b class="text-success">Pagamento aprovado</b>';
                                                    endif;

                                                    if($resultCp[0]['status'] == 5):
                                                    echo '<b class="text-warning">Em disputa</b>';
                                                    endif;

                                                    if($resultCp[0]['status'] == 6):
                                                    echo '<b class="text-danger">Devolvida</b>';
                                                    endif;

                                                    if($resultCp[0]['status'] == 7):
                                                    echo '<b class="text-danger">Cancelada</b>';
                                                    endif;


                                                    ?>
                                                </td>

                                                <td>
                                                    <?php


                                                    echo $resultCp[0]['data_solicitation'];
                                                    ?>


                                                </td>
                                                <?php
                                                if($resultCp[0]['submit'] <> 2 and $resultCp[0]['status'] == 3 or $resultCp[0]['status'] == 4):
                                                ?>

                                                    <script>

                                                        function rastreio(tp) {

                                                            if(tp == 1){
                                                                $("#rastreio").html('<input type="text" onkeypress="if (event.keyCode==13){ track(this.value);return false;}" />');

                                                            }
                                                            if(tp == 2){
                                                                $("#rastreio").html('<input type="text" onkeypress="if (event.keyCode==13){ trackup(this.value);return false;}" />');

                                                            }

                                                        }
                                                        
                                                        function track(url) {

                                                            $("#rastreio").html('<a href="'+url+'" target="_blank">Rastrear objeto</a>');
                                                            $.post("<?php echo base_url('pages/trackNew');?>",{url:url,arr:<?php echo $_GET['arrematado'];?>},function (res) {});
                                                        }
                                                        function trackup(url) {

                                                            $("#rastreio").html('<a href="'+url+'" target="_blank">Rastrear objeto</a>');
                                                            $.post("<?php echo base_url('pages/trackNewup');?>",{url:url,arr:<?php echo $_GET['arrematado'];?>},function (res) {});
                                                        }
                                                    </script>
                                                <td class="center" id="rastreio">

                                                    <?php
                                                    if($resultCp[0]['submit'] == 3):
                                                        echo '<b>Pacote entregue</b>';
                                                        endif;

                                                    if($resultCp[0]['submit'] <> 3):

                                                        $this->db->from('objetos_correios');
                                                        $this->db->where('item_id',$_GET['arrematado']);
                                                        $query_qr = $this->db->get();
                                                        $rowQr = $query_qr->num_rows();
                                                        $resultQr = $query_qr->result_array();
                                                    if($rowQr > 0):

                                                        if(empty($resultQr[0]['code'])):
                                                            echo '<b class="text-warning" onclick="rastreio(2);">Objeto não postado</b>';
                                                            else:
                                                                if($resultCp[0]['submit'] == 1):
                                                                    echo '<a href="'.$resultQr[0]['code'].'" target="_blank" style="font-weight: bold;" class="text-success">Rastrear objeto</a><br><a onclick="rastreio(2);">Alterar URL</a>';
                                                                    else:
                                                                        echo '<a style="font-weight: bold;" class="text-success">Aguardando busca</a>';
                                                                        endif;


                                                        endif;

                                                else:

                                        echo '<b class="text-warning" onclick="rastreio(1);">Objeto não postado</b>';
                                                        endif;



                                                    endif;
                                                    ?>

                                                </td>
                                                <?php  endif;?>


                                                 <td class="center">
                                                 <a href="<?php echo base_url('pages/done?id='.$_GET['arrematado']);?>" class="btn btn-success">Resolvido</a>
                                                 </td>


                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

        <?php endif;
        ?>
    </div>


</div>


<?php

$this->load->view('fixed_files/admin/footer');


endif; ?>

