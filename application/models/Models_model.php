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
            $_SESSION['TYPE'] = 0;
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
            $_SESSION['TYPE'] = $result[0]['type'];

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


    public function delete($table,$col,$where){

        if(empty($table) or empty($col) or empty($where)):
        return 0;
        else:
        $this->db->where($col,$where);
        $this->db->delete($table);

            return 1;
            endif;
    }


    public function newleilao($titulo,$breve_descricao,$file,$valor,$descricao,$inicio,$estado,$cidade,$cep,$rua,$bairro){


        if(empty($titulo) or empty($breve_descricao) or empty($file) or empty($valor) or empty($descricao) or empty($inicio)){

            return 'A campos obrigatorios vazios.';

        }else
        {
            $max_size = 5;
            $data['title'] = $titulo;
            $data['breve_descricao'] = $breve_descricao;
            $data['valor_leilao'] = $valor;
            $data['descricao_completa'] = $descricao;
            $data['inicio_data'] = $inicio;
            $data['estado'] = $estado;
            $data['duracao_hora'] = 3600;
            $data['status'] = 1;
            $data['cidade'] = $cidade;
            $data['cep'] = $cep;
            $data['rua'] = $rua;
            $data['bairro'] = $bairro;

            if (!empty($file['name'])):
                $filex = $file['tmp_name'];
                $size = $file['size'];
                $type = $file['type'];
                $name = $file['name'];

                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $data['ext'] = str_replace('.','',$extension);
                if (strstr('jpg,gif,png', $extension)):


                    if ($size > $max_size * 1000000):

                        return 'Tamanho maximo de ' . $max_size. 'MB, excedido.';

                    else:

                        $data['image'] = file_get_contents(addslashes($filex));

                        $this->db->insert('leiloes',$data);

                        if ($this->db->insert_id() > 0) {
                            return 1;
                        } else {
                            return 'Erro a salvar a imagem, tente mais tarde.';
                        }

                    endif;


                else:

                    return 'Somente as extensões jpg,gif,png são permitidas.';

                endif;


            else:


                return 'Por favor selecione o arquivo.';


            endif;


        }



        }




}

?>
