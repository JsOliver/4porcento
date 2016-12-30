<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');

if($page == 'register'):
    ?>

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
                                <span>0</span>
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
                                            <input type="text" name="firstname" placeholder="Nome" class="form-control">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" name="lastname" placeholder="Sobrenome" class="form-control">
                                        </label>
                                    </section>
                                </div>
                            </div>
                            <label class="select margin-bottom-15">
                                <select name="gender" class="form-control">
                                    <option value="0" selected disabled>Sexo</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Feminino</option>
                                    <option value="3">Outro</option>
                                </select>
                            </label>
                            <div class="row margin-bottom-10">
                                <div class="col-xs-6">
                                    <label class="select">
                                        <select name="month" class="form-control">
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
                                    <input type="text" name="username" placeholder="Username" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="email" name="email" placeholder="Email address" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="password" name="passwordConfirm" placeholder="Confirm password" class="form-control">
                                </label>
                            </section>
                        </div>

                        <label class="checkbox margin-bottom-10">
                            <input type="checkbox" name="checkbox"/>
                            <i></i>
                            Subscribe to our newsletter to get the latest offers
                        </label>
                        <label class="checkbox margin-bottom-20">
                            <input type="checkbox" name="checkbox"/>
                            <i></i>
                            I have read agreed with the <a href="#">terms &amp; conditions</a>
                        </label>
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Create Account</button>
                    </form>

                    <div class="margin-bottom-20"></div>
                    <p class="text-center">Already you have an account? <a href="shop-ui-login.html">Sign In</a></p>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Registre ===-->


<?php

    $this->load->view('fixed_files/user/footer');

endif;?>