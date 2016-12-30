<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    function __construct(){

        parent::__construct();
        $this->load->helper('url');

    }


    public function index()
    {
        $this->load->library('funcoes');
        $log = $this->funcoes->logVer();


        $this->load->helper('form');
        $this->load->helper('html');
        $dados['reportData'] = '';
        $dados['errorLog'] = '';
        $dados['formerror'] = '';
        $this->load->view('home',$dados);


    }

}
