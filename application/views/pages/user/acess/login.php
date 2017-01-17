<?php


defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');


if($page == 'login'):

    ?>

    <script>
function login(){
        //Masking

            // Validation for login form
            $("#sky-form1").validate({
                // Rules for form validation
                rules:
                {
                    email:
                    {
                        required: true,
                        email: true
                    },
                    password:
                    {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    }
                },

                // Messages for form validation
                messages:
                {
                    email:
                    {
                        required: 'Informe o email',
                        email: 'Email inválido'
                    },
                    password:
                    {
                        required: 'informe sua senha'
                    }
                },

                // Do not change code below
                errorPlacement: function(error, element)
                {
                    error.insertAfter(element.parent());
                }, submitHandler: function(error, element) {

                    var email = document.getElementById('email').value;

                    var pass = document.getElementById('pass').value;

                    $.post("logar",{log:true,email:email,pass:pass},function (res) {

                        if (res == 11)
                        {
                            window.location.reload();
                        }else{

                            $("#resposta").html(res);
                        }

                    });
                }
            });
            return false;


        }

    </script>

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

                <?php

                $this->db->from('textos');
                $this->db->order_by('id','desc');
                $this->db->limit(1,0);
                $query = $this->db->get();
                $row = $query->num_rows();
                $result = $query->result_array();


                $t1_log = $result[0]['t1_log'];
                $d1_log = $result[0]['d1_log'];
                $t2_log = $result[0]['t2_log'];
                $d2_log = $result[0]['d2_log'];
                $t3_log = $result[0]['t3_log'];
                $d3_log = $result[0]['d3_log'];


                ?>

                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title"></h2>

                    <div class="info-block-v2">
                        <i class="icon icon-layers"></i>
                        <div class="info-block-in">
                            <h3><?php echo strip_tags($t1_log);?></h3>
                            <p><?php echo $d1_log;?></p>
                        </div>
                    </div>
                    <div class="info-block-v2">
                        <i class="fa fa-trophy"></i>
                        <div class="info-block-in">
                            <h3><?php echo strip_tags($t2_log);?></h3>
                            <p><?php echo $d2_log;?></p>
                        </div>
                    </div>
                    <div class="info-block-v2">
                        <i class="icon icon-paper-plane"></i>
                        <div class="info-block-in">
                            <h3><?php echo strip_tags($t3_log);?></h3>
                            <p><?php echo $d3_log;?></p>
                        </div>
                    </div>
                </div>


                <div class="col-md-5">

                    <?php if(!isset($_GET['recover'])):?>
                    <form id="sky-form1" class="log-reg-block sky-form" >
                        <h2>Entrar na minha conta</h2>

                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="email" type="email" placeholder="Email" name="email" class="form-control">
                                </div>
                            </label>
                        </section>
                        <section>
                            <label class="input login-input no-border-top">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="pass" type="password" placeholder="Senha" name="password" class="form-control">
                                </div>
                            </label>
                        </section>
                        <div class="row margin-bottom-5">
                            <div class="col-xs-6">
                                <br>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="<?php echo base_url('login?recover');?>">Esqueceu sua senha?</a>
                            </div>
                        </div>
<b id="resposta"></b>


                        <!-- Modal -->
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" onclick="login();">Entrar</button>
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
                                                </div> -->


                    </form>
<?php else: ?>

                        <script>

                            function recover() {


                                var email = document.getElementById('recovermail').value;



                                $("#recovercampo").html("Aguarde...");

                                $.post("<?php base_url('pages/recovery'); ?>",{email:email},function(res) {

                                    if(res){
                                        if(res == 11){
                                            $("#recovercampo").html("Nova senha enviada por email com sucesso.");

                                        }else
                                        {
                                            $("#recovercampo").html("<span>Erro ao recuperar senha.</span>");

                                        }
                                    }else
                                    {
                                        $("#recovercampo").html("<span>Erro ao recuperar senha.</span>");

                                    }

                                });


                            }

                        </script>
                        <form  class="log-reg-block sky-form" action="javascript:func();">
                            <h2>Recuperar</h2>

                            <section>
                                <label class="input login-input">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="recovermail" type="email" placeholder="Email" name="email" class="form-control">
                                    </div>
                                </label>
                            </section>
                            <b id="recovercampo"></b>
                            <!-- Modal -->
                            <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" onclick="recover();">Recuperar</button>

                        </form>
    <?php endif;?>
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