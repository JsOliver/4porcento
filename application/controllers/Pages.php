<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    function __construct(){

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Models_model');


    }


    public function admin(){
        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if($log == true and $_SESSION['TYPE'] == 54):
        $dados['status'] = $log;
        $dados['page'] = 'home';
        $this->load->view('pages/admin/home',$dados);
        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');
        endif;

    }

    public function index()
    {
        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if($log == false):
            $dado['user'] = 0;
            $dado['interact_type'] = 1;
            else:
                $dado['user'] = $_SESSION['ID'];
                $dado['interact_type'] = 1;
                endif;
        $this->db->insert('interact_report',$dado);
        $dados['status'] = $log;
        $dados['page'] = 'home';
        $this->load->view('pages/user/home',$dados);

    }

    public function sala(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if($log == true):

            $this->db->from('leiloes');
            $this->db->where('id',$_GET['p']);
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):
                $dado['user'] = $_SESSION['ID'];
                $dado['interact_type'] = 2;
                $this->db->insert('interact_report',$dado);

                $dados['status'] = $log;
                $dados['page'] = 'sala';
                $this->load->view('pages/user/sala',$dados);
                else:
                    redirect(base_url('home'), 'refresh');
            endif;

            else:
                redirect(base_url('login'), 'refresh');
                endif;


    }

    public function configure(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'configure';
        $this->load->view('pages/user/sala',$dados);

    }
    public function login(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;

        if($log == true):
            redirect(base_url('home'), 'refresh');
            else:
                $dados['page'] = 'login';
                $this->load->view('pages/user/acess/login',$dados);

                endif;


    }
    public function register(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        if($log == true):

            redirect(base_url('home'), 'refresh');
            else:
                $dados['page'] = 'register';
                $this->load->view('pages/user/acess/register',$dados);
                endif;


    }
    public function leiloes(){


        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'leiloes';
        $this->load->view('pages/user/leiloes',$dados);

    }

    public function compra(){


        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'compra';
        $this->load->view('pages/user/compra',$dados);

    }
    public function cadastro(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

       if($log == false):

          echo $this->Models_model->cadastro($_POST['nome'],$_POST['sobrenome'],$_POST['username'],$_POST['email'],$_POST['password'],$_POST['genero'],$_POST['cpf']);

            endif;

    }

    public function logar(){
        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if($log == false):

            echo $this->Models_model->login($_POST['email'],$_POST['pass']);

        endif;
    }

    public function logout(){

        @session_destroy();
        redirect(base_url('home'), 'refresh');

    }



    public function deleteus()
    {



        if($this->Models_model->delete('user','id',$_GET['id']) == 1){
            redirect(base_url('adm/clientes'), 'refresh');

        }else{
            redirect(base_url('admin'), 'refresh');

        }

    }

    public function deletelei()
    {



        if($this->Models_model->delete('leiloes','id',$_GET['id']) == 1){
            redirect(base_url('adm/leiloes'), 'refresh');

        }else{
            redirect(base_url('admin'), 'refresh');

        }

    }

    public function clients(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'users';
            $this->load->view('pages/admin/users',$dados);

        else:
                @session_destroy();
                redirect(base_url('login'), 'refresh');
                endif;

    }

    public function leilao(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();

        if($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'leilao';
            $this->load->view('pages/admin/leiloes',$dados);

        else:
                @session_destroy();
                redirect(base_url('login'), 'refresh');
                endif;

    }

    public function addLeilao(){

      if($this->Models_model->newleilao($_POST['title'],$_POST['breve_descricao'],$_FILES['image'],$_POST['valor_leilao'],$_POST['descricao_completa'],$_POST['inicio_data'],$_POST['estado'],$_POST['cidade'],$_POST['cep'],$_POST['rua'],$_POST['bairro']) == 1):
           redirect(base_url('adm/leiloes'), 'refresh');

           else:
               redirect(base_url('admin'), 'refresh');

               endif;

    }

    public function exibir(){

        $this->db->from('leiloes');
        $this->db->where('id',addslashes($_GET['id']));
        $query =  $this->db->get();
        $fetch = $query->result_array();
        header("content-type: ".$fetch[0]['ext']."");
        echo $fetch[0]['image'];

    }

}
