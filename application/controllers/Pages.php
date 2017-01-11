<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Models_model');


    }


    public function admin()
    {
        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'home';
            $this->load->view('pages/admin/home', $dados);
        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');
        endif;

    }

    public function index()
    {
        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == false):
            $dado['user'] = 0;
            $dado['interact_type'] = 1;
        else:
            $dado['user'] = $_SESSION['ID'];
            $dado['interact_type'] = 1;
        endif;
        $this->db->insert('interact_report', $dado);
        $dados['status'] = $log;
        $dados['page'] = 'home';
        $this->load->view('pages/user/home', $dados);

    }

    public function sala()
    {
        @$data_atual_system = date('YmdHis');

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):

            $this->db->from('leiloes');
            $this->db->where('id', $_GET['p']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();

                $data_inicio = $result[0]['inicio_data'];
                if ($data_inicio < $data_atual_system):


                    if (strlen(str_replace(',', '', $result[0]['valor_leilao']) / 100) > 4):

                        $explode = @explode('.', substr(str_replace(',', '', $result[0]['valor_leilao']) / 100, 0, -2) * 4);

                        if (@strlen($explode[0]) == 1 and @strlen($explode[1]) == 1):
                            $valor_in = number_format(substr(str_replace(',', '', $result[0]['valor_leilao']) / 100, 0, -2) * 4 . '0', 2, '.', ',');
                        else:
                            $valor_in = number_format(substr(str_replace(',', '', $result[0]['valor_leilao']) / 100, 0, -2) * 4, 2, '.', ',');

                        endif;

                    else:
                        $explode = @explode('.', str_replace(',', '', $result[0]['valor_leilao']) / 100);


                        if (@strlen($explode[1]) == 1 and @strlen(@$explode[0]) >= 2):
                            $valor_in = number_format(str_replace(',', '', $result[0]['valor_leilao']) / 100 * 4 . 0, 2, '.', ',');
                        else:
                            $valor_in = number_format(str_replace(',', '', $result[0]['valor_leilao']) / 100 * 4, 2, '.', ',');
                        endif;
                    endif;
                    $this->db->from('creditos');
                    $this->db->where('usuario', $_SESSION['ID']);
                    $query_credit = $this->db->get();
                    $row_credit = $query_credit->num_rows();
                    if ($row_credit > 0):
                        $my_credit = number_format($query_credit->result_array()[0]['credito'], 2, '.', '');
                    else:
                        $my_credit = '0.00';
                    endif;
                    $this->db->from('vangancy');
                    $this->db->where('id_leilao', $_GET['p']);
                    $query_count = $this->db->get();
                    if ($query_count->num_rows() < $result[0]['minimo_users']):

                        if ($query_count->num_rows() > 0):
                            $vagas = false;

                        else:
                            $vagas = true;

                        endif;

                    else:

                        $vagas = false;
                    endif;

                    if ($my_credit >= $valor_in):

                        if ($vagas == true):
                            $dos['credito'] = $my_credit - $valor_in;
                            $this->db->where('usuario', $_SESSION['ID']);
                            $this->db->update('creditos', $dos);
                            $ddos['id_leilao'] = $_GET['p'];
                            $ddos['id_user'] = $_SESSION['ID'];
                            $this->db->insert('vangancy', $ddos);
                        endif;

                        $dado['user'] = $_SESSION['ID'];
                        $dado['interact_type'] = 2;
                        $this->db->insert('interact_report', $dado);

                        $dados['status'] = $log;
                        $dados['page'] = 'sala';
                        $dados['desconto'] = $valor_in;
                        $this->load->view('pages/user/sala', $dados);


                    else:
                        redirect(base_url('adicionar/creditos'), 'refresh');
                    endif;

                else:
                    redirect(base_url('home'), 'refresh');
                endif;

            else:
                redirect(base_url('home'), 'refresh');

            endif;

        else:
            redirect(base_url('login'), 'refresh');
        endif;


    }

    public function account()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):
            $this->db->from('compras');
            $this->db->where('id_user', $_SESSION['ID']);
            $this->db->where('status', 1);
            $this->db->or_where('status', 2);
            $this->db->or_where('status', 5);
            $query = $this->db->get();

            $dadas['status'] = $log;
            $dadas['page'] = 'account';
            $this->load->view('pages/user/account/account', $dadas);
            if ($query->num_rows() > 0):
                $result = $query->result_array();
                foreach ($result as $dds) {
                    $check = $this->Models_model->check_payment($dds['reference_code']);

                    if ($check !== 0):

                        $dados['status'] = @$check->transactions->transaction->status;
                        $dados['transaction_code'] = @$check->transactions->transaction->code;
                        $dados['data_payment'] = @$check->transactions->transaction->date;
                        if ($dds['type'] == 2 and $dds['submit'] < 3 and $dds['submit'] >= 1 and $check->transactions->transaction->status == 3 or $check->transactions->transaction->status == 4):
                            $dados['submit'] = 3;
                            $this->db->from('pacotes');
                            $this->db->where('id', $dds['id_obj_compra']);
                            $query = $this->db->get();
                            if ($query->num_rows() > 0):
                                $this->Models_model->addcredito($dds['id_obj_compra']);
                            endif;
                        endif;
                        $this->db->where('reference_code', @$check->transactions->transaction->reference);
                        $this->db->update('compras', $dados);
                    endif;
                }
            endif;
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function arremate()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):
            $dados['status'] = $log;
            $dados['page'] = 'arrematados';
            $this->load->view('pages/user/account/arremate', $dados);
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function configuracoes()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):
            $dados['status'] = $log;
            $dados['page'] = 'configuracoes';
            $this->load->view('pages/user/account/configuracoes', $dados);
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }


    public function configure()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'configure';
        $this->load->view('pages/user/sala', $dados);

    }

    public function pagamento()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):
            $dadas['status'] = $log;
            $dadas['page'] = 'pagamentos';
            $this->load->view('pages/user/account/compras', $dadas);
            $this->db->from('compras');
            $this->db->where('id_user', $_SESSION['ID']);
            $this->db->where('status', 1);
            $this->db->or_where('status', 2);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            if ($query->num_rows() > 0):
                $result = $query->result_array();
                foreach ($result as $dds) {
                    $check = $this->Models_model->check_payment($dds['reference_code']);

                    if ($check !== 0):

                        $dados['status'] = @$check->transactions->transaction->status;
                        $dados['transaction_code'] = @$check->transactions->transaction->code;
                        $dados['data_payment'] = @$check->transactions->transaction->date;
                        if ($dds['type'] == 2 and $dds['submit'] < 3 and $dds['submit'] >= 1 and $check->transactions->transaction->status == 3 or $check->transactions->transaction->status == 4):
                            $dados['submit'] = 3;
                            $this->db->from('pacotes');
                            $this->db->where('id', $dds['id_obj_compra']);
                            $query = $this->db->get();
                            if ($query->num_rows() > 0):
                                $this->Models_model->addcredito($dds['id_obj_compra']);
                            endif;
                        endif;
                        $this->db->where('reference_code', @$check->transactions->transaction->reference);
                        $this->db->update('compras', $dados);
                    endif;
                }
            endif;
        else:
            redirect(base_url('home'), 'refresh');

        endif;

    }

    public function login()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'login';


        if ($log == true):
            redirect(base_url('home'), 'refresh');
        else:
            $this->load->view('pages/user/acess/login', $dados);

        endif;


    }

    public function register()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'register';

        if ($log == true):

            redirect(base_url('home'), 'refresh');
        else:
            $this->load->view('pages/user/acess/register', $dados);
        endif;


    }

    public function leiloes()
    {


        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'leiloes';
        $this->load->view('pages/user/leiloes', $dados);

    }

    public function compra()
    {


        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):
            $this->db->from('compras');
            $this->db->where('id_user', $_SESSION['ID']);
            $this->db->where('status', 1);
            $this->db->or_where('status', 2);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            if ($query->num_rows() > 0):
                $result = $query->result_array();
                foreach ($result as $dds) {
                    $check = $this->Models_model->check_payment($dds['reference_code']);

                    if ($check !== 0):

                        $dados['status'] = @$check->transactions->transaction->status;
                        $dados['transaction_code'] = @$check->transactions->transaction->code;
                        $dados['data_payment'] = @$check->transactions->transaction->date;
                        if ($dds['type'] == 2 and $dds['submit'] < 3 and $dds['submit'] >= 1 and $check->transactions->transaction->status == 3 or $check->transactions->transaction->status == 4):
                            $dados['submit'] = 3;
                            $this->db->from('pacotes');
                            $this->db->where('id', $dds['id_obj_compra']);
                            $query = $this->db->get();
                            if ($query->num_rows() > 0):
                                $this->Models_model->addcredito($dds['id_obj_compra']);
                            endif;
                        endif;
                        $this->db->where('reference_code', @$check->transactions->transaction->reference);
                        $this->db->update('compras', $dados);
                    endif;
                }
            endif;

            $dadas['status'] = $log;
            $dadas['page'] = 'compra';
            $this->load->view('pages/user/compra', $dadas);

        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function cadastro()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if ($log == false):

            echo $this->Models_model->cadastro($_POST['nome'], $_POST['sobrenome'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['genero'], $_POST['cpf']);

        endif;

    }

    public function logar()
    {
        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if ($log == false):
            echo $this->Models_model->login($_POST['email'], $_POST['pass']);

        endif;
    }

    public function logout()
    {

        @session_destroy();
        redirect(base_url('home'), 'refresh');

    }


    public function deleteus()
    {


        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):

            if ($this->Models_model->delete('user', 'id', $_GET['id']) == 1) {
                redirect(base_url('adm/clientes'), 'refresh');

            } else {
                redirect(base_url('admin'), 'refresh');

            }
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function deletelei()
    {


        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->delete('leiloes', 'id', $_GET['id']) == 1) {
                redirect(base_url('adm/leiloes'), 'refresh');

            } else {
                redirect(base_url('admin'), 'refresh');

            }

        else:
            redirect(base_url('home'), 'refresh');

        endif;

    }

    public function cpd()
    {


        if (isset($_SESSION['ID'])):

            if ($_GET['tp'] == 1):

                $dado['status'] = 7;
                $this->db->where('id', $_GET['id2']);
                $this->db->where('id_user', $_SESSION['ID']);
                $this->db->update('compras', $dado);

                $dado1['status_payment'] = 7;
                $this->db->where('id', $_GET['id']);
                $this->db->where('id_user', $_SESSION['ID']);
                $this->db->update('arremates', $dado1);
                if ($this->Models_model->cupon($_SESSION['ID'], $_GET['id'], $_GET['id3']) == 1) {

                    redirect(base_url('meus-arremates'), 'refresh');

                } else {
                    redirect(base_url('minha-conta'), 'refresh');


                }

            else:
                if ($this->Models_model->deleteus('compras', 'id', $_GET['id2'], $_SESSION['ID']) == 1) {

                    if ($_GET['tp'] == 2):
                        redirect(base_url('compras'), 'refresh');

                    else:
                        redirect(base_url('meus-arremates'), 'refresh');

                    endif;

                } else {
                    redirect(base_url('home'), 'refresh');

                }
            endif;
            redirect(base_url('home'), 'refresh');

        endif;


    }

    public function deleteptc()
    {


        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->delete('pacotes', 'id', $_GET['id']) == 1) {
                redirect(base_url('adm/pacotes'), 'refresh');

            } else {
                redirect(base_url('admin'), 'refresh');

            }

        else:
            redirect(base_url('home'), 'refresh');

        endif;

    }

    public function deletecrs()
    {

        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->delete('carrosel', 'id', $_GET['id']) == 1) {
                redirect(base_url('adm/carrosel'), 'refresh');

            } else {
                redirect(base_url('admin'), 'refresh');

            }

        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }


    public function clients()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if ($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'users';
            $this->load->view('pages/admin/users', $dados);

        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');
        endif;

    }

    public function leilao()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if ($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'leilao';
            $this->load->view('pages/admin/leiloes', $dados);

        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');
        endif;

    }

    public function carrosel()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if ($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'carrosel';
            $this->load->view('pages/admin/carrosel', $dados);

        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');
        endif;

    }

    public function pacotes()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if ($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'pacotes';
            $this->load->view('pages/admin/pacotes', $dados);

        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');
        endif;

    }

    public function addLeilao()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->newleilao($_POST['maxlance'],$_POST['title'], $_POST['minuser'], $_POST['maxuser'], $_POST['breve_descricao'], $_FILES['image'], $_POST['valor_leilao'], $_POST['descricao_completa'], $_POST['inicio_data'], $_POST['estado'], $_POST['cidade'], $_POST['cep'], $_POST['rua'], $_POST['bairro']) == 1):
                redirect(base_url('adm/leiloes'), 'refresh');

            else:
                redirect(base_url('admin'), 'refresh');

            endif;
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function addCarrosel()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->addCarrosel($_POST['title'], $_POST['breve_descricao'], $_FILES['image'], $_POST['linktext'], $_POST['link']) == 1):
                redirect(base_url('adm/carrosel'), 'refresh');

            else:
                redirect(base_url('admin'), 'refresh');

            endif;
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function editCarrosel()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->editCarrosel($_POST['carrosel'], $_POST['title'], $_POST['breve_descricao'], $_FILES['image'], $_POST['linktext'], $_POST['link']) == 1):
                redirect(base_url('adm/carrosel'), 'refresh');

            else:
                redirect(base_url('admin'), 'refresh');

            endif;
        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function addPacote()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):

            if ($this->Models_model->newpacote($_POST['title'], $_POST['valor_pacote']) == 1):
                redirect(base_url('adm/pacotes'), 'refresh');

            else:
                redirect(base_url('admin'), 'refresh');

            endif;
        else:
            redirect(base_url('home'), 'refresh');


        endif;
    }

    public function exibir()
    {

        $this->db->from('leiloes');
        $this->db->where('id', addslashes($_GET['id']));
        $query = $this->db->get();
        $fetch = $query->result_array();
        header("content-type: " . $fetch[0]['ext'] . "");
        echo $fetch[0]['image'];

    }

    public function exibirUs()
    {

        $this->db->from('user');
        $this->db->where('id', addslashes($_GET['id']));
        $query = $this->db->get();
        $fetch = $query->result_array();
        header("content-type: " . 'jpg' . "");
        echo $fetch[0]['image'];

    }

    public function exibirCr()
    {

        $this->db->from('carrosel');
        $this->db->where('id', addslashes($_GET['id']));
        $query = $this->db->get();
        $fetch = $query->result_array();
        header("content-type: " . 'jpg' . "");
        echo $fetch[0]['image'];

    }


    public function image()
    {
        $allowed = 'jpge,jpg,png,gif';
        $upload = $this->Models_model->uploadUs('pp', 'default', 'image_profile', $_FILES['fileUpload'], $allowed, 3);
        echo $upload;

    }

    public function updLeilao()
    {

        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->updleilao($_POST['maxlance'],$_POST['leilao'], $_POST['minuser'], $_POST['maxuser'], $_POST['title'], $_POST['breve_descricao'], $_FILES['image'], $_POST['valor_leilao'], $_POST['descricao_completa'], $_POST['inicio_data'], $_POST['estado'], $_POST['cidade'], $_POST['cep'], $_POST['rua'], $_POST['bairro']) == 1):
                redirect(base_url('adm/leiloes'), 'refresh');

            else:
                redirect(base_url('admin'), 'refresh');

            endif;
        else:
            redirect(base_url('home'), 'refresh');

        endif;

    }

    public function updPacote()
    {

        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->updpacote($_POST['pacote'], $_POST['title'], $_POST['valor_pacote']) == 1):
                redirect(base_url('adm/pacotes'), 'refresh');

            else:
                redirect(base_url('admin'), 'refresh');

            endif;
        else:
            redirect(base_url('home'), 'refresh');


        endif;

    }

    public function alterPass()
    {

        if (isset($_SESSION['ID'])):
            if ($this->Models_model->updpass($_POST['newpass'], $_POST['newpassag'], $_POST['oldpass'], $_POST['email']) == 1):
                echo 'Senha alterada com sucesso.';

            else:
                echo 'Erro ao alterar senha tente mais tarde.';

            endif;
        else:
            redirect(base_url('home'), 'refresh');


        endif;
    }

    public function alterdatesUs()
    {

        if (isset($_SESSION['ID'])):
            if ($this->Models_model->alterdata($_POST['type'], $_POST['valor'], 'user') == 1):
                echo 1;

            else:
                echo 0;

            endif;
        else:
            redirect(base_url('home'), 'refresh');


        endif;
    }

    public function updateServer()
    {
        echo $this->Models_model->reloadToken($_SESSION['ID']);


    }

    public function comprarPack()
    {

        if (isset($_SESSION['ID'])):

            echo $this->Models_model->comprarPack($_POST['compra']);

        endif;

    }

    public function checkverMessage()
    {
        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao']) and !isset($_POST['send'])):

                $this->db->from('chat');
                $this->db->where('id_leilao', $_POST['leilao']);
                $this->db->where('status', 0);
                $this->db->order_by('id', 'desc');
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            endif;
        endif;
    }

    public function chat()
    {

        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao']) and !isset($_POST['send'])):

                $this->db->from('chat');
                $this->db->where('id_leilao', $_POST['leilao']);
                $this->db->order_by('id', 'desc');
                $query = $this->db->get();


                if ($query->num_rows() > 0):

                    foreach ($query->result_array() as $dds) {

                        $this->db->from('user');
                        $this->db->where('id', $dds['id_user']);
                        $query1 = $this->db->get();
                        $result1 = $query1->result_array();

                        ?>


                        <li class="left clearfix">
                <span class=" pull-left">
                            <img src="<?php echo base_url('pages/exibirUs?id=' . $dds['id_user']); ?>"
                                 style="opacity:1;width: 50px; height: 50px;object-fit: cover; object-position: center;"
                                 alt="User Avatar" class="img-circle"/>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <?php if ($dds['id_user'] == $_SESSION['ID']): ?>
                                        <strong
                                            class="primary-font"><?php echo $this->Models_model->limitarTexto(strip_tags($result1[0]['firstname']), 50); ?></strong>
                                    <?php else: ?>
                                        <span
                                            class="primary-font"><?php echo $this->Models_model->limitarTexto(strip_tags($result1[0]['firstname']), 50); ?></span>

                                    <?php endif; ?>
                                    <?php if (!empty($dds['data'])): ?>
                                        <small class="pull-right text-muted">
                                            <span
                                                class="glyphicon glyphicon-time"></span><?php echo $this->Models_model->SecsDataConvert($this->Models_model->segundosDif($dds['data'])); ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                                <p>
                                    <?php echo $dds['mensagem']; ?>
                                </p>
                            </div>
                        </li>


                        <?php

                        $dta['status'] = 1;
                        $this->db->where('id', $dds['id']);
                        $this->db->where('status', 0);
                        $this->db->update('chat', $dta);
                    }


                else:

                    echo 'Nenhuma mensagem.';

                endif;
            endif;

            if (isset($_POST['leilao']) and isset($_POST['send'])):

                echo $this->Models_model->messageChat($_POST['leilao'], $_SESSION['ID'], $_POST['mensagem']);

            endif;
        endif;
    }

    public function checkLeilao()
    {
        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    $min = $result[0]['minimo_users'];
                    $max = $result[0]['maximo_users'];
                    $data_inicio = $result[0]['inicio_data'];
                    $this->db->from('vangancy');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query1 = $this->db->get();
                    $vagas = $query1->num_rows();

                    if ($vagas >= $min and $vagas <= $max) {

                        echo 1;

                    } else {
                        echo 0;
                    }


                } else {

                    echo 0;
                }

            else:
                echo 0;

            endif;
        endif;
    }

    public function permissionButton()
    {
        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):
                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                if ($row_prod > 0):
                    $result_prod = $query_prod->result_array();
                    $this->db->from('vangancy');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query_vagancy = $this->db->get();
                    $row_vagancy = $query_vagancy->num_rows();
                    if ($row_vagancy >= $result_prod[0]['minimo_users'] and $row_vagancy <= $result_prod[0]['maximo_users']):

                        ?>
                        <script>
                            function lance() {
                                tempo = <?php echo $result_prod[0]['duracao_lance'];?>;

                                $("#btn-lanc").html('<a style="cursor: pointer;" class="btn-u btn-u-sea-shop btn-u-lg" >Aguarde...</a>');
                                $.post("<?php echo base_url('pages/lance');?>", {leilao:<?php echo $_POST['leilao'];?>}, function (res) {
                                    if (res == 1) {
                                        $("#btn-lanc").html('<a style="cursor: pointer;" class="btn-u btn-u-sea-shop btn-u-lg" >Na frente</a>');
                                        atualiza = 0;

                                    } else {
                                        $("#btn-lanc").html('<a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a>');
                                    }

                                });
                            }
                            var atualiza = 0;
                            function vezlance() {
                                $.post("<?php echo base_url('pages/atualizalance');?>", {leilao:<?php echo $_POST['leilao'];?>}, function (res) {
                                    if (res == 1 && atualiza == 0) {
                                        $("#btn-lanc").html('<a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a>');
                                        atualiza++;
                                    }
                                });
                            }
                            setInterval("vezlance()", 1000);

                            $(function () {

                                vezlance();
                            });


                        </script>

                        <?php

                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $this->db->limit(1, 0);
                        $query_user = $this->db->get();
                        $row_user = $query_user->num_rows();
                        if ($row_user > 0):
                            if ($query_user->result_array()[0]['id_user'] == $_SESSION['ID']):
                                echo '<a style="cursor: pointer;" class="btn-u btn-u-sea-shop btn-u-lg" >Na frente</a>';

                            else:
                                echo '<span id="btn-lanc"><a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a></span>';
                            endif;


                    else:
                        if ($row_vagancy <= $result_prod[0]['maximo_users'] and $row_vagancy >= $result_prod[0]['minimo_users']):
                        echo '<span id="btn-lanc"><a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a></span>';
                            endif;
                        if ($row_vagancy > $result_prod[0]['maximo_users']):
                            echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #cb0000;" >Sala Cheia</button>';

                        endif;

                        if ($row_vagancy < $result_prod[0]['minimo_users']):
                            echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #cbb64a;" >Aguarde</button>';
                        endif;
                    endif;


                else:
                    echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #cbb64a;" >Aguarde</button>';




                endif;


            endif;
        endif;
        endif;


    }

    public function checktime()
    {


        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                if ($row_prod > 0):
                    $result_prod = $query_prod->result_array();

                    $this->db->from('lances');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query_lances = $this->db->get();
                    $row_lances = $query_lances->num_rows();
                    if ($row_lances > 0):

                        echo $result_prod[0]['duracao_lance'];

                    else:
                        echo 0;
                    endif;
                endif;
            endif;
        endif;
    }


    public function checkTimeSin()
    {
        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                $row_result= $query_prod->result_array();
                if ($row_prod > 0):
                    $this->db->from('lances');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query_lances = $this->db->get();
                    $row_lances = $query_lances->num_rows();
                    if ($row_lances > 0):
                        $result = $query_lances->result_array();

                        echo $row_result[0]['duracao_lance'] - $this->Models_model->segundosDif($result[0]['data']);

                    else:

                        echo 0;

                    endif;

                else: echo 0;
                endif;


            endif;
        endif;
    }

    public function lance()
    {
        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                $result_prd = $query_prod->result_array();
                if ($row_prod > 0):

                    $this->db->from('vangancy');
                    $this->db->where('id_user', $_SESSION['ID']);
                    $query_vagancy = $this->db->get();
                    $row_vagancy = $query_vagancy->num_rows();
                    if ($row_vagancy > 0):
                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $this->db->limit(1, 0);
                        $query_lance = $this->db->get();
                        $row_lance = $query_lance->num_rows();

                        if($row_lance > 0){

                            $user = $query_lance->result_array()[0]['id_user'];

                            if($user <> $_SESSION['ID']):

                                $dado['id_user'] = $_SESSION['ID'];
                                $dado['id_leilao'] = $_POST['leilao'];
                                $dado['data'] = date('YmdHis');
                                $this->db->insert('lances', $dado);
                                echo 1;
                                endif;

                        }else{

                            $dado['id_user'] = $_SESSION['ID'];
                            $dado['id_leilao'] = $_POST['leilao'];
                            $dado['data'] = date('YmdHis');
                            $this->db->insert('lances', $dado);
                            echo 1;

                        }

                    else:
                        echo 0;
                    endif;


                endif;
            endif;
        endif;
    }

    public function atualizalance()
    {

        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao'])):


                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query = $this->db->get();
                $row = $query->num_rows();
                $result = $query->result_array();



                $this->db->from('vangancy');
                $this->db->where('id_leilao', $_POST['leilao']);
                $queryv = $this->db->get();
                $rowv = $queryv->num_rows();



                if($row > 0 and $rowv >= $result[0]['minimo_users']):

                $this->db->from('lances');
                $this->db->where('id_leilao', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                if ($row_prod > 0):



                    $result_prod = $query_prod->result_array();

                    $this->db->from('lances');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $this->db->order_by('id', 'desc');
                    $query_user = $this->db->get();
                    $row_user = $query_user->num_rows();

                    if ($row_user > 0):


                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $this->db->limit(1,0);
                        $query_user1 = $this->db->get();
                        $row_user1 = $query_user1->num_rows();

                        if ($query_user1->result_array()[0]['id_user'] == $_SESSION['ID']):
                        if($result_prod[0]['read'] == 0){
                            $ddos['read'] = 1;
                            $this->db->where('id_leilao',$_POST['leilao']);
                            $this->db->update('lances',$ddos);
                            echo 3;

                        }else{

                            echo 0;
                        }

                        else:

                            if($result_prod[0]['read'] == 0){

                            $ddos['read'] = 1;
                                $this->db->where('id_leilao',$_POST['leilao']);
                                $this->db->update('lances',$ddos);
                                echo 2;

                            }else{

                                echo 0;
                            }
                            endif;


                    else:
                        echo 1;

                    endif;



                else:

                    echo 0;

                endif;

            endif;
            else:
                echo 1;
        endif;
        else:
            echo 0;
        endif;
    }

}
