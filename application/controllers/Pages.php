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

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):

            $this->db->from('leiloes');
            $this->db->where('id', $_GET['p']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array();
                $valor_in = number_format($result[0]['valor_leilao'], 2, '.', '');
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
                if($query_count->num_rows() < $result[0]['minimo_users']):

                    if($query_count->num_rows() > 0):
                        $vagas = false;

                    else:
                            $vagas = true;

                    endif;

                    else:

                        $vagas = false;
                        endif;

                if ($my_credit >= $valor_in):

                    if($vagas == true):
                    $dos['credito'] = $my_credit - $valor_in;
                    $this->db->where('usuario', $_SESSION['ID']);
                    $this->db->update('creditos', $dos);
                        $ddos['id_leilao'] = $_GET['p'];
                        $ddos['id_user'] = $_SESSION['ID'];
                    $this->db->insert('vangancy',$ddos);
                    endif;

                    $dado['user'] = $_SESSION['ID'];
                    $dado['interact_type'] = 2;
                    $this->db->insert('interact_report', $dado);

                    $dados['status'] = $log;
                    $dados['page'] = 'sala';
                    $this->load->view('pages/user/sala', $dados);

                else:
                    redirect(base_url('adicionar/creditos'), 'refresh');
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

        if ($log == true):
            redirect(base_url('home'), 'refresh');
        else:
            $dados['page'] = 'login';
            $this->load->view('pages/user/acess/login', $dados);

        endif;


    }

    public function register()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        if ($log == true):

            redirect(base_url('home'), 'refresh');
        else:
            $dados['page'] = 'register';
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
            if ($this->Models_model->newleilao($_POST['title'], $_POST['minuser'], $_POST['maxuser'], $_POST['breve_descricao'], $_FILES['image'], $_POST['valor_leilao'], $_POST['descricao_completa'], $_POST['inicio_data'], $_POST['estado'], $_POST['cidade'], $_POST['cep'], $_POST['rua'], $_POST['bairro']) == 1):
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
            if ($this->Models_model->updleilao($_POST['leilao'], $_POST['minuser'], $_POST['maxuser'], $_POST['title'], $_POST['breve_descricao'], $_FILES['image'], $_POST['valor_leilao'], $_POST['descricao_completa'], $_POST['inicio_data'], $_POST['estado'], $_POST['cidade'], $_POST['cep'], $_POST['rua'], $_POST['bairro']) == 1):
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


}
