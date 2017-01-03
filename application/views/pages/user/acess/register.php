<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');

if($page == 'register'):
    ?>

    <script>



        </script>
    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">Cadastrar</span>
            <h1>Cadastrar no <span class="shop-green">4</span> porcento</h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="<?php echo base_url('home');?>">Inicio</a></li>
                <li class="active">Cadastrar</li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <?php

    $this->db->from('user');
    $queryu = $this->db->get();
    $users = $queryu->num_rows();
    ?>
    <!--=== Registre ===-->
    <div class="log-reg-v3 content-md margin-bottom-30">
        <div class="container">
            <div class="row">
                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title">Bem vindo ao 4 porcento</h2>
                    <p><cite>Aqui sera um texto explicativo.</cite></p><br>
                    <div class="row margin-bottom-50">
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>0</span>
                                <small>Leilões</small>
                            </div>
                        </div>
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>0</span>
                                <small>Finalizados</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="site-statistics">
                                <span><?php echo number_format($users);?></span>
                                <small>Usuarios</small>
                            </div>
                        </div>
                    </div>
                    <div class="members-number">
                        <h3>Junte-se, somos  <span class="shop-green"><cite>0</cite></span> membros. </h3>
                        <img class="img-responsive" src="assets/img/map.png" alt="">
                    </div>
                </div>

                <div class="col-md-5">
                    <form id="sky-form4" class="log-reg-block sky-form">
                        <h2>Criar uma nova conta</h2>

                        <div class="login-input reg-input">
                            <div class="row">
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input id="firstname" type="text" name="firstname" placeholder="Nome" class="form-control">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input id="lastname" type="text" name="lastname" placeholder="Sobrenome" class="form-control">
                                        </label>
                                    </section>
                                </div>
                            </div>
                            <label class="select margin-bottom-15">
                                <select id="sexo" name="gender" class="form-control">
                                    <option value="0" selected disabled>Sexo</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Feminino</option>
                                    <option value="3">Outro</option>
                                </select>
                            </label>
                            <div class="row margin-bottom-10" style="display: none;">
                                <div class="col-xs-6">
                                    <label class="select">
                                        <select  name="month" id="syn_list" class="form-control">
                                            <option disabled="" selected="" value="0">Mês</option>
                                            <option value="1">Janeiro</option>
                                            <option value="2">Fevereiro</option>
                                            <option value="3">Março</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Maio</option>
                                            <option value="6">Junho</option>
                                            <option value="7">Julho</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Setembro</option>
                                            <option value="10">Outubro</option>
                                            <option value="11">Novembro</option>
                                            <option>Dezembro</option>
                                        </select>
                                    </label>
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        $('#day').mask('00');
                                        $('#year').mask('0000');
                                        $('#cpf').mask('000.000.000-00');
                                    });
                                </script>
                                <div class="col-xs-3">
                                    <input type="text" id="day" name="day" placeholder="Dia" class="form-control">
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" id="year" name="year" placeholder="Ano" class="form-control">
                                </div>
                            </div>


                            <section>
                                <label class="input">
                                    <input id="username" type="text" name="username" placeholder="Username" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input id="email" type="email" name="email" placeholder="E-mail" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input id="cpf" type="text" name="cpf" placeholder="CPF" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input  type="password" name="password" placeholder="Senha" id="password" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Confirmar senha" class="form-control">
                                </label>
                            </section>
                            <b id="resposta"></b>
                        </div>

                       <!-- <label class="checkbox margin-bottom-10">
                            <input type="checkbox" name="checkbox"/>
                            <i></i>
                            Subscribe to our newsletter to get the latest offers
                        </label> -->
                        <label class="checkbox margin-bottom-20">
                            <input type="checkbox" name="checkbox"/>
                            <i></i>
                            Eu aceito os <a href="#">termos &amp; condições</a>
                        </label>
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" onclick="register();">Criar conta</button>
                    </form>

                    <div class="margin-bottom-20"></div>
                    <p class="text-center">Já tem uma conta? <a href="<?php echo base_url('login');?>">Logar</a></p>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Registre ===-->


<?php

    $this->load->view('fixed_files/user/footer');

endif;?>