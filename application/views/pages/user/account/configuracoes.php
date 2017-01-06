<?php
if ($page == 'configuracoes'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');
    $data_atual_system = date('YmdHis');


    $this->db->from('user');
    $this->db->where('id', $_SESSION['ID']);
    $get = $this->db->get();
    $count = $get->num_rows();
    if ($count <= 0):
        redirect(base_url('pages/logout'), 'refresh');
    else:
        $result = $get->result_array();
    endif;
    ?>

    <div class="col-md-9">
        <div class="profile-body margin-bottom-20">
            <div class="tab-v1">
                <ul class="nav nav-justified nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#profile" aria-expanded="true">Editar Perfil</a></li>
                    <li class=""><a data-toggle="tab" href="#passwordTab" aria-expanded="false">Mudar Senha</a></li>
                    <?php if ($_SESSION['TYPE'] == 53): ?>
                        <li class=""><a data-toggle="tab" href="#fornecedor" aria-expanded="false">Informações do
                                Fornecedor</a></li>
                    <?php endif; ?>
                    </li>
                </ul>
                <div class="tab-content">

                    <script>
                        $(document).ready(function () {
                            var SPMaskBehavior = function (val) {
                                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                                },
                                spOptions = {
                                    onKeyPress: function (val, e, field, options) {
                                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                                    }
                                };

                            $('#telalter').mask(SPMaskBehavior, spOptions);

                        });
                    </script>
                    <script>

                        function newftn(valor, id) {
                            if (id == 0) {

                                var idcomun = 'firstname';
                                var idcomunresp = 'firstnameresp';
                            }

                            if (id == 1) {

                                var idcomun = 'lastname';
                                var idcomunresp = 'lastnameresp';
                            }
                            if (id == 2) {

                                var idcomun = 'telefone';
                                var idcomunresp = 'telefoneresp';
                            }
                            if (id == 3) {

                                var idcomun = 'endereco';
                                var idcomunresp = 'enderecoresp';
                            }

                            $("#" + idcomun + "").text(valor);
                            $.post("<?php echo base_url('pages/alterdatesUs');?>", {
                                type: id,
                                valor: valor
                            }, function (res) {
                                if (res) {
                                    if (res == 1) {
                                        $("#" + idcomunresp + "").html('<span class="text-success">Dados alterados com sucesso.</span>');
                                    } else {

                                        $("#" + idcomunresp + "").html('<span class="text-danger">Erro ao salvar os dados.</span>');

                                    }
                                } else {
                                    $("#" + idcomunresp + "").html('<span class="text-danger">Ocorreu um erro, tente mais tarde.</span>');
                                }
                            });
                        }

                        function altername() {
                            $("#firstname").html('<input type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,0);return false;}" />')
                        }

                        function alterlastname() {
                            $("#lastname").html('<input type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,1);return false;}" />')
                        }

                        function altertelefone() {
                            $("#telefone").html('<input id="telalter" type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,2);return false;}" />')
                        }

                        function alterendereco() {
                            $("#endereco").html('<input type="text"  onkeypress="if (event.keyCode==13){ newftn(this.value,3);return false;}" />')
                        }

                        function alterenderecoce() {
                            $("#cidade").html('<input placeholder="Cidade" type="text"  onkeypress="alert(this.value);" />')
                        }

                        function reloadPull() {

                            $.post("<?php echo base_url('pages/updateServer');?>",{id:0},function (res) {
if(res){
    $("#idCupon").text(res);

}

                            });
                        }
                    </script>

                    <div id="profile" class="profile-edit tab-pane fade active in">
                        <h2 class="heading-md">Alterar seu nome sua senha e informações de contato.</h2>
                        <br>
                        <dl class="dl-horizontal">
                            <dt><strong>Nome </strong></dt>
                            <dd><span id="firstname">
                                <?php if (empty($result[0]['firstname'])): echo 'Indisponível';
                                else: echo strip_tags($result[0]['firstname']); endif; ?>
                                </span>
                                <span>
&nbsp;&nbsp;&nbsp;&nbsp;
												<span style="cursor: pointer;" onclick="altername()" class="pull-right"
                                                      href="javascript:func();">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
												</span>
                                      <b class="pull-right" id="firstnameresp"></b>&nbsp;&nbsp;&nbsp;&nbsp;
											</span>
                            </dd>
                            <hr>
                            <dt><strong>Sobrenome</strong></dt>
                            <dd>
                                <span id="lastname">
                                <?php if (empty($result[0]['lastname'])): echo 'Indisponível';
                                else: echo strip_tags($result[0]['lastname']); endif; ?>
                                </span>
                                <span>
												<span style="cursor: pointer;" onclick="alterlastname()"
                                                      class="pull-right">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
												</span>
                                          <b class="pull-right" id="lastnameresp"></b>&nbsp;&nbsp;&nbsp;&nbsp;

											</span>
                            </dd>

                            <hr>
                            <?php
                            $this->db->from('cupon_loja');
                            $this->db->where('id_user', $_SESSION['ID']);
                            $get2 = $this->db->get();
                            $count2 = $get2->num_rows();
                            if ($count2 > 0):
                                $result2 = $get2->result_array();

                                if ($result2[0]['valor'] > '0.00'):

                                    ?>
                                    <dt><strong>Meu cupon</strong></dt>
                                    <dd id="cupon">

                                        <span id="idCupon">

                                        <?php
                                        echo $result2[0]['token'];
                                        ?>

                                        </span>

                                        <span>
												<span onclick="reloadPull()" style="cursor: pointer;" class="pull-right text-success">
													<i class="fa fa-refresh"></i>
												</span>
											</span>
                                    </dd>
                                    <hr>
                                    <?php


                                endif;
                            endif;
                            ?>


                            <dt><strong>Telefone </strong></dt>
                            <dd>
                                    <span id="telefone">

                                    <?php if (empty($result[0]['telefone'])): echo '<b class="text-warning">Indisponível</b>';
                                    else: echo $result[0]['telefone']; endif; ?>
                                        </span>
                                <span>
												<span style="cursor: pointer;" onclick="altertelefone()"
                                                      class="pull-right" href="#">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
												</span>
                                                                              <b class="pull-right"
                                                                                 id="telefoneresp"></b>

											</span>
                            </dd>
                            <hr>
                            <?php
                            if (!empty($result[0]['endereco'])):
                                ?>
                                <dt><strong>Endereço </strong></dt>
                                <dd>
                                    <span id="endereco">
                                    <?php if (empty($result[0]['endereco'])): echo 'Indisponível';
                                    else: echo $result[0]['endereco']; endif; ?>
                                            </span>
                                    <span>
												<span style="cursor: pointer;" onclick="alterendereco()"
                                                      class="pull-right">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
                                                    </span>
                                                    <b class="pull-right" id="enderecoresp"></b>


                                </dd>
                                <hr>



                            <?php endif; ?>
                        </dl>

                    </div>

                    <div id="passwordTab" class="profile-edit tab-pane fade">
                        <h2 class="heading-md">Altere sua senha.</h2>
                        <br>

                        <script>
                            function alterpass() {
                                $("#resp").html('Carregando...');

                                var email = document.getElementById('email').value;
                                var atual = document.getElementById('password_atual').value;
                                var nova = document.getElementById('password_new').value;
                                var cnova = document.getElementById('password_new_confirm').value;

                                if (nova == cnova) {

                                    $.post("<?php echo base_url('pages/alterPass');?>", {
                                        newpass: nova,
                                        newpassag: cnova,
                                        oldpass: atual,
                                        email: email
                                    }, function (res) {
                                        if (res) {
                                            $("#resp").html(res);

                                        } else {
                                            $("#resp").html('Ocorreu um erro, tente mais tarde.');
                                        }

                                    });
                                } else {
                                    $("#resp").html('Senhas não coicidem');

                                }


                                return false;
                            }
                        </script>

                        <dl class="dl-horizontal">

                            <dt>Meu email</dt>
                            <dd>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input id="email" type="email" placeholder="Meu E-mail" name="email">
                                    </label>
                                </section>
                            </dd>
                            <dt>Senha atual</dt>
                            <dd>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" id="password_atual" name="password_atual"
                                               placeholder="Senha atual">
                                    </label>
                                </section>
                            </dd>

                            <dt>Nova senha</dt>
                            <dd>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" id="password_new" name="password_new"
                                               placeholder="Nova senha">
                                    </label>
                                </section>
                            </dd>
                            <dt>Repita a nova senha</dt>
                            <dd>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input id="password_new_confirm" type="password" name="password_new_confirm"
                                               placeholder="Confirmar nova senha">
                                    </label>
                                </section>
                            </dd>
                            <span id="resp"></span>
                        </dl>

                        <button type="button" class="btn-u btn-u-default">Cancelar</button>
                        <button class="btn-u" onclick="alterpass();">Salvar alterações</button>

                    </div>


                    <?php if ($_SESSION['TYPE'] == 53): ?>

                        <div id="fornecedor" class="profile-edit tab-pane fade">
                            <h2 class="heading-md">Manage your Payment Settings</h2>
                            <p>Below are the payment options for your account.</p>
                            <br>
                            <form class="sky-form" id="sky-form" action="#" novalidate="novalidate">
                                <!--Checkout-Form-->
                                <section>
                                    <div class="inline-group">
                                        <label class="radio"><input type="radio" checked="" name="radio-inline"><i
                                                class="rounded-x"></i>Visa</label>
                                        <label class="radio"><input type="radio" name="radio-inline"><i
                                                class="rounded-x"></i>MasterCard</label>
                                        <label class="radio"><input type="radio" name="radio-inline"><i
                                                class="rounded-x"></i>PayPal</label>
                                    </div>
                                </section>

                                <section>
                                    <label class="input">
                                        <input type="text" name="name" placeholder="Name on card">
                                    </label>
                                </section>

                                <div class="row">
                                    <section class="col col-10">
                                        <label class="input">
                                            <input type="text" name="card" id="card" placeholder="Card number">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="input">
                                            <input type="text" name="cvv" id="cvv" placeholder="CVV2">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <label class="label col col-4">Expiration date</label>
                                    <section class="col col-5">
                                        <label class="select">
                                            <select name="month">
                                                <option disabled="" selected="" value="0">Month</option>
                                                <option value="1">January</option>
                                                <option value="1">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="input">
                                            <input type="text" placeholder="Year" id="year" name="year">
                                        </label>
                                    </section>
                                </div>
                                <button type="button" class="btn-u btn-u-default">Cancel</button>
                                <button class="btn-u" type="submit">Save Changes</button>
                                <!--End Checkout-Form-->
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <?php

    $this->load->view('fixed_files/user/footer');


endif; ?>
