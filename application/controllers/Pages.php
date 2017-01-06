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
                $dado['user'] = $_SESSION['ID'];
                $dado['interact_type'] = 2;
                $this->db->insert('interact_report', $dado);

                $dados['status'] = $log;
                $dados['page'] = 'sala';
                $this->load->view('pages/user/sala', $dados);
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
        if($log == true):
        $dados['status'] = $log;
        $dados['page'] = 'account';
        $this->load->view('pages/user/account/account', $dados);
else:
    redirect(base_url('home'), 'refresh');

        endif;
    }
    public function arremate()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if($log == true):
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
        if($log == true):
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
        $dados['status'] = $log;
        $dados['page'] = 'pagamentos';
        $this->load->view('pages/user/account/compras', $dados);

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
        $dados['status'] = $log;
        $dados['page'] = 'compra';
        $this->load->view('pages/user/compra', $dados);

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
                if($this->Models_model->cupon($_SESSION['ID'], $_GET['id'],$_GET['id3']) == 1){

                    redirect(base_url('meus-arremates'), 'refresh');

                }else{
                    redirect(base_url('minha-conta'), 'refresh');


                }

            else:
                if ($this->Models_model->deleteus('compras', 'id', $_GET['id2'], $_SESSION['ID']) == 1) {

                    redirect(base_url('meus-arremates'), 'refresh');

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
        header("content-type: " . 'jpg'. "");
        echo $fetch[0]['image'];

    }

    public function image(){
        $allowed = 'jpge,jpg,png,gif';
        $upload = $this->Models_model->uploadUs('pp','default','image_profile',$_FILES['fileUpload'],$allowed,3);
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

    public function alterPass(){

        if (isset($_SESSION['ID'])):
            if ($this->Models_model->updpass($_POST['newpass'], $_POST['newpassag'],$_POST['oldpass'],$_POST['email']) == 1):
                echo 'Senha alterada com sucesso.';

            else:
                echo 'Erro ao alterar senha tente mais tarde.';

            endif;
        else:
            redirect(base_url('home'), 'refresh');


        endif;
    }

    public function alterdatesUs(){

        if (isset($_SESSION['ID'])):
            if ($this->Models_model->alterdata($_POST['type'], $_POST['valor'],'user') == 1):
                echo 1;

            else:
                echo 0;

            endif;
        else:
            redirect(base_url('home'), 'refresh');


        endif;
    }

    public function updateServer(){
       echo $this->Models_model->reloadToken($_SESSION['ID']);


    }
}
