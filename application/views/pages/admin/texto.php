<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');

if ($page == 'textos'):
    $data_atual_system = date('YmdHis');
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Textos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

<?php
$this->db->from('textos');
$this->db->order_by('id','desc');
$this->db->limit(1,0);
$query = $this->db->get();
$row = $query->num_rows();
$result = $query->result_array();
if($row > 0):

    $t1_log = $result[0]['t1_log'];
    $d1_log = $result[0]['d1_log'];
    $t2_log = $result[0]['t2_log'];
    $d2_log = $result[0]['d2_log'];
    $t3_log = $result[0]['t3_log'];
    $d3_log = $result[0]['d3_log'];
    $t1_cad = $result[0]['t1_cad'];
    $d1_cad = $result[0]['d1_cad'];
    $t1_about = $result[0]['t1_about'];
    $d1_about = $result[0]['d1_about'];
    $cite_about = $result[0]['cite_about'];
    $d2_about = $result[0]['d2_about'];
    $video = $result[0]['video'];
else:
    $t1_log = '';
    $d1_log = '';
    $t2_log = '';
    $d2_log = '';
    $t3_log = '';
    $d3_log = '';
    $t1_cad = '';
    $d1_cad = '';
    $t1_about = '';
    $d1_about = '';
    $cite_about = '';
    $d2_about = '';
    $video = '';
endif;
?>
        <div class="row">

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs in" role="tablist">
                    <li role="presentation" <?php if (!isset($_GET['t'])): echo 'class="active"'; endif; ?> >
                        <a href="<?php echo base_url('adm/textos'); ?>">Cadastro</a></li>
                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] ==
                        'login'
                    ): echo 'class="active"'; endif; ?>>
                        <a href="<?php echo base_url('adm/textos?t=login'); ?>">Login</a></li>

                    <li role="presentation" <?php if (isset($_GET['t']) and $_GET['t'] ==
                        'sobre'
                    ): echo 'class="active"'; endif; ?>>
                        <a href="<?php echo base_url('adm/textos?t=sobre'); ?>">Sobre</a></li>
                </ul>
                <br>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Editar texto da pagina <?php if(!isset($_GET['t'])): echo 'cadastro'; else: echo $_GET['t']; endif; ?>
                        </div>

                        <?php if(!isset($_GET['t'])):?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="get" enctype="multipart/form-data"
                                          action="<?php echo base_url('pages/EditText');?>">
                                        <div class="form-group">
                                            <input type="hidden" name="type" value="1">
                                            <label>Titulo</label>
                                            <input required="" value="<?php echo $t1_cad; ?>" name="title" class="form-control">
                                            <p class="help-block">Exemplo: Bem vindo ao 4 porcento.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <textarea name="explicativo"><?php echo $d1_cad; ?>
                                            </textarea>
                                        </div>


                                        <button type="submit" class="btn btn-default">Editar textos
                                        </button>
                                    </form>
                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <?php endif;?>

                        <?php if(isset($_GET['t']) and $_GET['t'] == 'login'):?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method="post" enctype="multipart/form-data"
                                              action="<?php echo base_url('pages/EditText');?>">


                                            <input type="hidden" name="type" value="2">
                                            <div class="form-group">
                                                <label>Titulo</label>
                                                <input required="" value="<?php echo $t1_log; ?>" name="title" class="form-control">
                                                <p class="help-block">Exemplo: Bem vindo ao 4 porcento.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Descrição</label><br>
                                                <textarea name="explicativo"><?php echo $d1_log; ?>
                                            </textarea>


                                            <div class="form-group">
                                                <label>Titulo 2</label>
                                                <input value="<?php echo $t2_log; ?>" required="" name="title1" class="form-control">
                                                <p class="help-block">Exemplo: Junte-se, somos <cite>x</cite> membros..</p>
                                            </div>
                                                <div class="form-group">
                                                    <label>Descrição 2</label><br>
                                                    <textarea name="explicativo1"><?php echo $d2_log; ?>
                                            </textarea>

                                                    <div class="form-group">
                                                        <label>Titulo 3</label>
                                                        <input required="" value="<?php echo $t3_log; ?>" name="title2" class="form-control">
                                                        <p class="help-block">Exemplo: Junte-se, somos <cite>x</cite> membros..</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Descrição 3</label><br>
                                                        <textarea name="explicativo2"><?php echo $d3_log; ?>
                                            </textarea>

                                            </div>


                                            <button type="submit" class="btn btn-default">Editar textos
                                            </button>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.row (nested) -->
                            </div>
                        <?php endif;?>


                        <?php if(isset($_GET['t']) and $_GET['t'] == 'sobre'):

                            ?>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method="post" enctype="multipart/form-data"
                                              action="<?php echo base_url('pages/EditText');?>">

                                            <input type="hidden" name="type" value="3">

                                            <div class="form-group">
                                                <label>Descrição 1</label><br>
                                                <textarea name="explicativo"><?php echo $d1_about; ?>
                                            </textarea>

                                            <div class="form-group">
                                                <label>Citação 1</label>
                                                <input value="<?php echo $cite_about; ?>" required="" name="cite" class="form-control">
                                            </div>

                                                <div class="form-group">
                                                    <label>Descrição 2</label><br>
                                                    <textarea name="explicativo1"><?php echo $d2_about; ?>
                                            </textarea>

                                                    <div class="form-group">
                                                        <label>Video URL</label>
                                                        <input value="<?php echo $video; ?>" name="video" class="form-control">
                                                    </div>



                                            <button type="submit" class="btn btn-default">Editar textos
                                            </button>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.row (nested) -->
                            </div>
                        <?php endif;?>
                    </div>
                    <!-- /.panel -->
                </div>


            </div>
        </div>
    </div>

    <?php
    $this->load->view('fixed_files/admin/footer');

endif; ?>
