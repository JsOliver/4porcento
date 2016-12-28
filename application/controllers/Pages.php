<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    function __construct(){

        parent::__construct();
        $this->load->helper('url');

    }


    public function index()
    {
        $this->load->library('functions');
        $log = $this->functions->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'home';
        $this->load->view('home',$dados);

    }

    public function sala(){

        $this->load->library('functions');
        $log = $this->functions->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'sala';
        $this->load->view('sala',$dados);

    }

    public function configure(){

        $this->load->library('functions');
        $log = $this->functions->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'configure';
        $this->load->view('sala',$dados);

    }
    public function login(){

        $this->load->library('functions');
        $log = $this->functions->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'login';
        $this->load->view('home',$dados);

    }
    public function register(){

        $this->load->library('functions');
        $log = $this->functions->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'register';
        $this->load->view('home',$dados);

    }

}
