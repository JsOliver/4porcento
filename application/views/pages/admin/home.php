<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/admin/header');


if ($page == 'home'):
    ?>


    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Resumo</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php


        $this->db->from('user');
        $queryu = $this->db->get();
        $usersCount = $queryu->num_rows();


        $this->db->from('leiloes');
        $this->db->where('status', 1);
        $queryld = $this->db->get();
        $leiloesDpCount = $queryld->num_rows();


        $this->db->from('leiloes');
        $this->db->where('status', 0);
        $queryli = $this->db->get();
        $leiloesIdCount = $queryli->num_rows();
        ?>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo number_format($usersCount); ?></div>
                                <div>Usuarios</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('adm/usuarios'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver mais</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo number_format($leiloesDpCount); ?></div>
                                <div>Leilões disponiveis</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('adm/leiloes?t=disponiveis'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver mais</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo number_format($leiloesIdCount); ?></div>
                                <div>Leiloes finalizados</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('adm/leiloes?t=finalizados'); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Ver mais</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo number_format($usersCount); ?></div>
                                <div>Compras no site!</div>
                            </div>
                        </div>
                    </div>
                    <a disabled="disabled">
                        <div class="panel-footer">
                            <span class="pull-left">Compras de créditos</span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php

        $this->db->from('interact_report');
        $this->db->order_by('id', 'desc');
        $this->db->limit(10, 0);
        $get = $this->db->get();
        $interactCount = $get->num_rows();
        $fetchInteract = $get->result_array();
        if ($interactCount > 0):
            ?>
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Ultimas interações
                        </div>

                        <div class="panel-body">
                            <div class="list-group">

                                <?php


                                foreach ($fetchInteract as $dds) {


                                    ?>
                                    <a href="#" class="list-group-item">
                                        <?php
                                        if ($dds['interact_type'] == 1):
                                            ?>
                                            <i class="fa fa-user fa-fw"></i> Nova visita no site

                                        <?php endif; ?>

                                        <?php
                                        if ($dds['interact_type'] == 2):
                                            ?>
                                            <i class="fa fa-tasks fa-fw"></i> Entrou em um leilão
                                        <?php endif; ?>
                                        <?php
                                        if ($dds['user'] == 0):
                                        ?>
                                        <span class="pull-right text-muted small"><em>não cadastrado</em>
                                            <?php
                                            else:
                                            ?>

                                            <span class="pull-right text-muted small"
                                                  onclick="window.location.href='<?php echo base_url('adm/user?q=' . $dds['user']); ?>'"
                                                  style="cursor: pointer;"><em>por usuario <?php echo $dds['user']; ?></em>


                                                <?php
                                                endif;
                                                ?>

                                    </span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.col-lg-4 -->
            </div>


        <?php endif; ?>
    </div>
    <!-- /#page-wrapper -->


    <?php
    $this->load->view('fixed_files/admin/footer');

endif;

?>
