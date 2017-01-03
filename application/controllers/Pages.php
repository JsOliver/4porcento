<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    function __construct(){

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Models_model');


    }


    public function index()
    {
        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'home';
        $this->load->view('pages/user/home',$dados);

    }

    public function sala(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if($log == true):
            $dados['status'] = $log;
            $dados['page'] = 'sala';
            $this->load->view('pages/user/sala',$dados);
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

}
