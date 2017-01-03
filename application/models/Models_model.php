<?php

class Models_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function cadastro($nome,$sobrenome,$usuario,$email,$senha,$genero,$cpf){


        $this->db->from('user');
        $this->db->where('email',$email);
        $query = $this->db->get();
        $row = $query->num_rows();
        if($row > 0){

            echo 'Email já cadastrado';

        }else{

            $dados['firstname'] = $nome;
            $dados['lastname'] = $sobrenome;
            $dados['email'] = $email;
            $dados['pass'] = hash('whirlpool',md5(sha1($senha)));
            $dados['genre'] = $genero;
            $dados['cpf'] = $cpf;
            $dados['username'] = $usuario;
            $this->db->insert('user',$dados);

            @session_start();
            $_SESSION['Auth01'] = 'logado';
            $_SESSION['NAME'] = $nome.' '.$sobrenome;
            $_SESSION['EMAIL'] = $email;
            $_SESSION['PASS'] = hash('whirlpool',md5(sha1($senha)));
            $_SESSION['ID'] = $this->db->insert_id();
            echo 11;
        }

    }


    public function login($email,$senha){

        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->where('pass',hash('whirlpool',md5(sha1($senha))));
        $query = $this->db->get();
        $row = $query->num_rows();
        $result = $query->result_array();
        if($row > 0){
            @session_start();
            $_SESSION['Auth01'] = 'logado';
            $_SESSION['NAME'] = $result[0]['firstname'].' '.$result[0]['lastname'];
            $_SESSION['EMAIL'] = $result[0]['email'];
            $_SESSION['PASS'] = hash('whirlpool',md5(sha1($senha)));
            $_SESSION['ID'] = $result[0]['id'];
            echo 11;

        }else{
            echo 'Email ou senha incorretos.';


        }

    }
    public function logVer(){


        @session_start();

        if(isset($_SESSION['Auth01']) and isset($_SESSION['NAME']) and isset($_SESSION['EMAIL'])
            and isset($_SESSION['PASS']) and isset($_SESSION['ID'])):

            $this->db->from('user');
            $this->db->where('email',$_SESSION['EMAIL']);
            $this->db->where('pass',$_SESSION['PASS']);
            $query = $this->db->get();
            $row = $query->num_rows();
            if($row > 0):
                return true;

            else:
                return false;

            endif;


        else:

            return false;

        endif;


    }



}

?>
