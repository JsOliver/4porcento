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
                    <li class="<?php if(!isset($_GET['code'])): echo 'active'; endif;?> "><a data-toggle="tab" href="#profile" aria-expanded="true">Editar Perfil</a></li>
                    <li class=""><a data-toggle="tab" href="#passwordTab" aria-expanded="false">Mudar Senha</a></li>
                    <?php if ($_SESSION['TYPE'] == 53 or $_SESSION['TYPE'] == 54): ?>
                        <li class="<?php if(isset($_GET['code'])): echo 'active'; endif;?>"><a data-toggle="tab" href="#fornecedor" aria-expanded="false">Consultar arremates</a></li>
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

                    <div id="profile" class="profile-edit tab-pane fade <?php if(!isset($_GET['code'])): echo 'active in';endif;?>">
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
                                    else: echo strip_tags($result[0]['telefone']); endif; ?>
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

                                <dt><strong>Endereço </strong></dt>
                                <dd>
                                    <span id="endereco">
                                    <?php if (empty($result[0]['endereco'])): echo 'Indisponível';
                                    else: echo strip_tags($result[0]['endereco']); endif; ?>
                                            </span>
                                    <span>
												<span style="cursor: pointer;" onclick="alterendereco()"
                                                      class="pull-right">
													&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>
                                                    </span>
                                                    <b class="pull-right" id="enderecoresp"></b>


                                </dd>
                                <hr>


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


                    <?php if ($_SESSION['TYPE'] == 53 or $_SESSION['TYPE'] == 54): ?>



                        <div id="fornecedor" class="profile-edit tab-pane fade <?php if(isset($_GET['code'])): echo 'active in';endif;?>">
                        <?php if(!isset($_GET['code'])):?>
                            <p> <div  class="search-block-v2 ">

                                <form action="<?php echo base_url('configuracoes');?>" method="get">
                                    <div class="col-md-6 col-md-offset-3">
                                        <h2>Buscar por codigo</h2>
                                        <div class="input-group">
                                            <input type="text" name="code" class="form-control" placeholder="Informe o codigo de pagamento.">
                                            <span class="input-group-btn">
							<button class="btn-u" type="button"><i class="fa fa-search"></i></button>
						</span>
                                        </div>
                                    </div>

                                    </form>

                            </div></p>
                            <br>
                            <?php

                        else:

                            $this->db->from('compras');
                            $this->db->where('reference_code',$_GET['code']);
                            $this->db->where('submit !=',3);
                            $query = $this->db->get();
                            $countCp = $query->num_rows();
                            $resultCp = $query->result_array();

if($countCp > 0):
    $idObj = $resultCp[0]['id_obj_compra'];
                            ?>

                            <div class="col-xs-12">
                            <div class="content">
                                <!--Invoice Header-->
                                <div class="row invoice-header">
                                    <div class="col-xs-6">
                                        <img src="<?php echo base_url('assets/img/logo-3.png');?>" style="width: 70px;"  alt="">
                                        <!-- You also can use a title instead of image
                                        <h2 class="pull-left">Product Invoice</h2>-->
                                    </div><br><br>
                                    <div class="col-xs-6 invoice-numb">
                                        #<?php echo $idObj; ?> / <?php echo $resultCp[0]['data_solicitation'];?>
                                        <span><?php echo $resultCp[0]['title'];?></span>
                                    </div>
                                </div>
                                <!--End Invoice Header-->

                                <!--Invoice Detials-->
                                <div class="row invoice-info">
                                    <div class="col-xs-6">
                                        <div class="tag-box tag-box-v3">
                                            <h2>Informação do cliente:</h2>
                                            <?php
                                            $this->db->from('user');
                                            $this->db->where('id',$resultCp[0]['id_user']);
                                            $queryUs = $this->db->get();
                                            $countUs = $queryUs->num_rows();
                                            $resultUs = $queryUs->result_array();
                                            if($countUs > 0):
                                                ?>
                                                <ul class="list-unstyled">
                                                    <li><strong>Nome:</strong> <?php echo $resultUs[0]['firstname'];?></li>
                                                    <li><strong>Sobrenome:</strong> <?php echo $resultUs[0]['lastname'];?></li>
                                                    <li><strong>Email:</strong> <?php echo $resultUs[0]['email'];?></li>
                                                    <li><strong>Sexo:</strong> <?php
                                                        if($resultUs[0]['genre'] == 1): echo 'Masculino'; endif;
                                                        if($resultUs[0]['genre'] == 2): echo 'Feminino'; endif;
                                                        if($resultUs[0]['genre'] == 3): echo 'Outro'; endif;
                                                        ?></li>
                                                </ul>

                                                <?php
                                            else:
                                                ?>

                                                <ul class="list-unstyled">
                                                    <li><strong>Nome:</strong> -- --</li>
                                                    <li><strong>Sobrenome:</strong> -- --</li>
                                                    <li><strong>Email:</strong> -- --</li>
                                                    <li><strong>Sexo:</strong> -- --</li>
                                                </ul>

                                                <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="tag-box tag-box-v3">
                                            <h2>Detalhes do pagamento:</h2>
                                            <ul class="list-unstyled">
                                                <li><strong>Meio de pagamento:</strong> 4 Porcento</li>
                                                <li><strong>Data do pagamento:</strong> <?php echo $resultCp[0]['data_solicitation'];?></li>
                                                <li><strong>CPF do cliente:</strong> <?php  if(empty($resultUs[0]['cpf'])): echo 'Indisponível'; else: echo $resultUs[0]['cpf']; endif;?></li>
                                                <li><strong>Codigo do pagamento:</strong> <?php echo $resultCp[0]['reference_code'];?></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--End Invoice Detials-->

                                <!--Invoice Table-->
                                <div class="panel panel-default margin-bottom-40">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Detalhes da compra</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p><?php echo strip_tags($resultCp[0]['description']);?></p>
                                    </div>
                                    <table class="table table-striped invoice-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th class="hidden-sm">Descrição</th>
                                            <th>Quantidade</th>
                                            <th>Valor pago</th>
                                            <th>Valor do produto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo $idObj;?></td>
                                            <td><?php echo $resultCp[0]['title'];?></td>
                                            <td class="hidden-sm"><?php echo strip_tags($this->Models_model->limitarTexto($resultCp[0]['description'],40));?></td>
                                            <td>1</td>
                                            <td><b>R$ <?php echo $resultCp[0]['value_show'];?></b></td>
                                            <td>R$
                                                <?php
                                                $this->db->from('leiloes');
                                                $this->db->where('id',$idObj);
                                                $queryLe = $this->db->get();
                                                $resultLe = $queryLe->result_array();
                                                echo $resultLe[0]['valor_leilao'];
                                                ?>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--End Invoice Table-->

                                <?php
                                $this->db->from('administracao');
                                $this->db->order_by('id','desc');
                                $this->db->limit(1,0);
                                $query = $this->db->get();
                                $result = $query->result_array();
                                ?>
                                <!--Invoice Footer-->
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="tag-box tag-box-v3 no-margin-bottom">
                                            <address class="no-margin-bottom">
                                                <?php echo $result[0]['numero'];?>, <?php echo $result[0]['rua'];?> <br>
                                                <?php echo $result[0]['estado'];?> <br>
                                                Telefone: <?php echo $result[0]['phone'];?> <br>
                                                Email: <a href="mailto:<?php echo $result[0]['email'];?>"><?php echo $result[0]['email'];?></a>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <ul class="list-unstyled invoice-total-info">
                                            <li><strong>Sub - Total produto:</strong> R$ <?php  echo $resultLe[0]['valor_leilao'];?></li>
                                            <li><strong>Desconto:</strong> 96%</li>
                                            <li><strong>Valor total:</strong> R$ <?php echo $resultCp[0]['value_show'];?></li>
                                        </ul>
                                        <button class="btn-u sm-margin-bottom-10" onclick="javascript:window.print();"><i
                                                class="fa fa-print"></i> Imprimir
                                        </button>
                                        <a href="<?php echo base_url('pages/entregue?i='.$idObj);?>" class="btn-u">Entregue</a>
                                    </div>
                                </div>
                                <!--End Invoice Footer-->
                            </div>
</div>
                            <?php

else:
    echo 'Objeto não encontrado ou já entregue.';

endif;

                        endif;
                        ?>


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
