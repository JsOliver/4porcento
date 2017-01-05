<?php

class Models_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
    }


    public function cadastro($nome, $sobrenome, $usuario, $email, $senha, $genero, $cpf)
    {


        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $row = $query->num_rows();
        if ($row > 0) {

            echo 'Email já cadastrado';

        } else {

            $dados['firstname'] = $nome;
            $dados['lastname'] = $sobrenome;
            $dados['email'] = $email;
            $dados['pass'] = hash('whirlpool', md5(sha1($senha)));
            $dados['genre'] = $genero;
            $dados['cpf'] = $cpf;
            $dados['username'] = $usuario;
            $this->db->insert('user', $dados);

            @session_start();
            $_SESSION['Auth01'] = 'logado';
            $_SESSION['NAME'] = $nome . ' ' . $sobrenome;
            $_SESSION['EMAIL'] = $email;
            $_SESSION['PASS'] = hash('whirlpool', md5(sha1($senha)));
            $_SESSION['TYPE'] = 0;
            $_SESSION['ID'] = $this->db->insert_id();
            echo 11;
        }

    }


    public function login($email, $senha)
    {

        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('pass', hash('whirlpool', md5(sha1($senha))));
        $query = $this->db->get();
        $row = $query->num_rows();
        $result = $query->result_array();
        if ($row > 0) {
            @session_start();
            $_SESSION['Auth01'] = 'logado';
            $_SESSION['NAME'] = $result[0]['firstname'] . ' ' . $result[0]['lastname'];
            $_SESSION['EMAIL'] = $result[0]['email'];
            $_SESSION['PASS'] = hash('whirlpool', md5(sha1($senha)));
            $_SESSION['ID'] = $result[0]['id'];
            $_SESSION['TYPE'] = $result[0]['type'];

            echo 11;

        } else {
            echo 'Email ou senha incorretos.';


        }

    }

    public function logVer()
    {


        @session_start();

        if (isset($_SESSION['Auth01']) and isset($_SESSION['NAME']) and isset($_SESSION['EMAIL'])
            and isset($_SESSION['PASS']) and isset($_SESSION['ID'])
        ):

            $this->db->from('user');
            $this->db->where('email', $_SESSION['EMAIL']);
            $this->db->where('pass', $_SESSION['PASS']);
            $query = $this->db->get();
            $row = $query->num_rows();
            if ($row > 0):
                return true;

            else:
                return false;

            endif;


        else:

            return false;

        endif;


    }


    public function deleteus($table, $col, $where, $user)
    {

        if (empty($table) or empty($col) or empty($where)):
            return 0;
        else:
            $this->db->where($col, $where);
            $this->db->where('id_user', $user);
            $this->db->delete($table);

            return 1;
        endif;
    }

    public function delete($table, $col, $where)
    {

        if (empty($table) or empty($col) or empty($where)):
            return 0;
        else:
            $this->db->where($col, $where);
            $this->db->delete($table);

            return 1;
        endif;
    }


    public function newleilao($titulo, $minuser, $maxuser, $breve_descricao, $file, $valor, $descricao, $inicio, $estado, $cidade, $cep, $rua, $bairro)
    {


        if (empty($titulo) or empty($breve_descricao) or empty($file) or empty($valor) or empty($descricao) or empty($inicio)) {

            return 'A campos obrigatorios vazios.';

        } else {
            $max_size = 5;
            $data_inicio_explode = explode('/', $inicio);
            $ano_explode = explode(' ', $data_inicio_explode[2]);
            $horario_explode = explode(':', $ano_explode[1]);
            $mes = $data_inicio_explode[1];
            $dia = $data_inicio_explode[0];
            $ano = $ano_explode[0];
            $hora = $horario_explode[0];
            $minuto = $horario_explode[1];
            $segundo = $horario_explode[2];
            $data_inicio_system = $ano . $mes . $dia . $hora . $minuto . $segundo;
            $valor1r = str_replace('.', '', $valor);
            $valor2r = str_replace(',', '', $valor1r);
            $data['title'] = $titulo;
            $data['breve_descricao'] = $breve_descricao;
            $data['minimo_users'] = $minuser;
            $data['maximo_users'] = $maxuser;
            $data['valor_leilao'] = $valor;
            $data['valor_replace'] = $valor2r;
            $data['descricao_completa'] = $descricao;
            $data['inicio_data'] = $data_inicio_system;
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
                $data['ext'] = str_replace('.', '', $extension);
                $data['image'] = file_get_contents(addslashes($filex));

                if (strstr('jpg,gif,png', $extension)):


                    if ($size > $max_size * 1000000):

                        return 'Tamanho maximo de ' . $max_size . 'MB, excedido.';

                    else:


                        $this->db->insert('leiloes', $data);

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


    public function updleilao($leilao, $minuser, $maxuser, $titulo, $breve_descricao, $file, $valor, $descricao, $inicio, $estado, $cidade, $cep, $rua, $bairro)
    {


        if (empty($titulo) or empty($breve_descricao) or empty($file) or empty($valor) or empty($descricao) or empty($inicio) or empty($leilao)) {

            return 'A campos obrigatorios vazios.';

        } else {
            $max_size = 5;
            $data_inicio_explode = explode('/', $inicio);
            $ano_explode = explode(' ', $data_inicio_explode[2]);
            $horario_explode = explode(':', $ano_explode[1]);
            $mes = $data_inicio_explode[1];
            $dia = $data_inicio_explode[0];
            $ano = $ano_explode[0];
            $hora = $horario_explode[0];
            $minuto = $horario_explode[1];
            $segundo = $horario_explode[2];
            $data_inicio_system = $ano . $mes . $dia . $hora . $minuto . $segundo;

            $valor1r = str_replace('.', '', $valor);
            $valor2r = str_replace(',', '', $valor1r);
            $data['title'] = $titulo;
            $data['breve_descricao'] = $breve_descricao;
            $data['valor_leilao'] = $valor;
            $data['valor_replace'] = $valor2r;
            $data['minimo_users'] = $minuser;
            $data['maximo_users'] = $maxuser;
            $data['descricao_completa'] = $descricao;
            $data['inicio_data'] = $data_inicio_system;
            $data['estado'] = $estado;
            $data['duracao_hora'] = 3600;
            $data['status'] = 1;
            $data['cidade'] = $cidade;
            $data['cep'] = $cep;
            $data['rua'] = $rua;
            $data['bairro'] = $bairro;

            if (empty($file['name'])):

                $this->db->where('id', $leilao);
                $this->db->update('leiloes', $data);

                return 1;

            else:

                if (!empty($file['name'])):
                    $filex = $file['tmp_name'];
                    $size = $file['size'];
                    $type = $file['type'];
                    $name = $file['name'];

                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    $extension = strtolower($extension);
                    $data['ext'] = str_replace('.', '', $extension);

                    if (strstr('jpge,jpg,png,gif', $extension)):


                        if ($size > $max_size * 1000000):

                            return 'Tamanho maximo de ' . $max_size . 'MB, excedido.';

                        else:

                            $data['image'] = file_get_contents(addslashes($filex));

                            $this->db->where('id', $leilao);
                            $this->db->update('leiloes', $data);

                            return 1;


                        endif;


                    else:

                        return 'Somente as extensões jpg,gif,png são permitidas.';

                    endif;


                else:


                    return 'Por favor selecione o arquivo.';


                endif;


            endif;

        }


    }

    public function newpacote($title, $valor)
    {

        if (empty($title) or empty($valor)) {
            return 0;
        } else {

            $data['title'] = $title;
            $data['valor'] = $valor;
            $data['data'] = date('YmdHis');

            $this->db->insert('pacotes', $data);
            if ($this->db->insert_id() > 0) {
                return 1;
            } else {
                return 0;

            }
        }

    }

    public function updpacote($pacote, $title, $valor)
    {

        if (empty($title) or empty($valor)) {
            return 0;
        } else {

            $data['title'] = $title;
            $data['valor'] = $valor;
            $data['data'] = date('YmdHis');
            $this->db->where('id', $pacote);
            $this->db->update('pacotes', $data);
            return 1;

        }

    }


    public function cupon($user, $leilao, $arremate)
    {

        if (empty($user) or empty($leilao) or empty($arremate)) {

            return 0;

        } else {


            $this->db->from('arremates');
            $this->db->where('id',$arremate);
            $this->db->where('id_user',$_SESSION['ID']);
            $query = $this->db->get();
            $count = $query->num_rows();
            $result = $query->result_array();

            if($count > 0){

                $valor = $result[0]['valor_arremate'];
                $this->db->from('cupon_loja');
                $this->db->where('id_user', $_SESSION['ID']);
                $query = $this->db->get();
                $count = $query->num_rows();
                $result = $query->result_array();
                if ($count > 0):

                    $valoracs = $result[0]['valor'];
                    $valor_show = $result[0]['valor_show'];
                    $dado['valor'] = str_replace(',', '', $valoracs) + str_replace(',', '', $valor);
                    $dado['valor_show'] = number_format(str_replace(',', '', $valor_show) + str_replace(',', '', $valor), 2, '.', ',');
                    $this->db->where('id_user',$_SESSION['ID']);
                    $this->db->update('cupon_loja',$dado);
                else:

                    $dado['id_user'] = $_SESSION['ID'];
                    $dado['valor'] = str_replace(',', '', $valor);
                    $dado['valor_show'] = number_format(str_replace(',', '', $valor), 2, '.', ',');
                    $this->db->insert('cupon_loja',$dado);

                endif;
                return 1;

            }else{
                return 0;
            }



        }


    }


    public function limitarTexto($texto, $limite)
    {
        $contador = strlen($texto);
        if ($contador >= $limite) {
            $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
            return $texto;
        } else {
            return $texto;
        }
    }

}

?>
