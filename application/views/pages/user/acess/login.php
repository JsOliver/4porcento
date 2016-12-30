<?php


defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');


if($page == 'login'):

    ?>
    <div class="modal fade" id="recuperar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">Entrar</span>
            <h1>Entrar no <span class="shop-green">4</span> porcento</h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="<?php echo base_url('home');?>">Inicio</a></li>
                <li class="active">Entrar</li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->


    <!--=== Login ===-->
    <div class="log-reg-v3 content-md">
        <div class="container">
            <div class="row">


                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title"></h2>
                    <p>Suspendisse et tincidunt ipsum, et dignissim urna. Vestibulum nisl tortor, gravida at magna et, suscipit vehicula massa.</p><br>
                    <div class="info-block-v2">
                        <i class="icon icon-layers"></i>
                        <div class="info-block-in">
                            <h3>Pellentesque vulputate</h3>
                            <p>Vestibulum non ex volutpat, sodales diam sit amet, semper nunc. Integer sed nibh commodo, tincidunt nisi.</p>
                        </div>
                    </div>
                    <div class="info-block-v2">
                        <i class="icon icon-settings"></i>
                        <div class="info-block-in">
                            <h3>Curabitur tincidunt</h3>
                            <p>Vestibulum non ex volutpat, sodales diam sit amet, semper nunc. Integer sed nibh commodo, tincidunt nisi.</p>
                        </div>
                    </div>
                    <div class="info-block-v2">
                        <i class="icon icon-paper-plane"></i>
                        <div class="info-block-in">
                            <h3>Aenean condimentum</h3>
                            <p>Vestibulum non ex volutpat, sodales diam sit amet, semper nunc. Integer sed nibh commodo, tincidunt nisi.</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <form id="sky-form1" class="log-reg-block sky-form">
                        <h2>Entrar na minha conta</h2>

                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="email" placeholder="Email" name="email" class="form-control">
                                </div>
                            </label>
                        </section>
                        <section>
                            <label class="input login-input no-border-top">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="Senha" name="password" class="form-control">
                                </div>
                            </label>
                        </section>
                        <div class="row margin-bottom-5">
                            <div class="col-xs-6">
                                <br>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a  data-toggle="modal" data-target="#recuperar">Esqueceu sua senha?</a>
                            </div>
                        </div>



                        <!-- Modal -->
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Log in</button>
                        <!--
                                                <div class="border-wings">
                                                    <span>or</span>
                                                </div>

                                                <div class="row columns-space-removes">
                                                    <div class="col-lg-6 margin-bottom-10">
                                                        <button type="button" class="btn-u btn-u-md btn-u-fb btn-block"><i class="fa fa-facebook"></i> Facebook Log In</button>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn-u btn-u-md btn-u-tw btn-block"><i class="fa fa-twitter"></i> Twitter Log In</button>
                                                    </div>
                                                </div>

                                                -->
                    </form>

                    <div class="margin-bottom-20"></div>
                    <p class="text-center">Não tem uma conta?  <a href="<?php echo base_url('cadastro');?>">Cadastre-se aqui</a>.</p>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Login ===-->



<?php

    $this->load->view('fixed_files/user/footer');


endif;?>