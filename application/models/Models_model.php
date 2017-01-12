<?php

class Models_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
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
            $dados['type'] = 1;
            $this->db->insert('user', $dados);

            @session_start();
            $_SESSION['Auth01'] = 'logado';
            $_SESSION['NAME'] = $nome . ' ' . $sobrenome;
            $_SESSION['EMAIL'] = $email;
            $_SESSION['PASS'] = hash('whirlpool', md5(sha1($senha)));
            $_SESSION['TYPE'] = 1;
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


    public function newleilao($lancetime,$titulo, $minuser, $maxuser, $breve_descricao, $file, $valor, $descricao, $inicio, $estado, $cidade, $cep, $rua, $bairro)
    {


        if (empty($titulo) or empty($lancetime) or empty($breve_descricao) or empty($file) or empty($valor) or empty($descricao) or empty($inicio)) {

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
            $data['duracao_lance'] = $lancetime;
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
            $data['keywords'] = $rua.','.$bairro.','.$cidade.','.$estado;

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


    public function updleilao($lancetime,$leilao, $minuser, $maxuser, $titulo, $breve_descricao, $file, $valor, $descricao, $inicio, $estado, $cidade, $cep, $rua, $bairro)
    {


        if (empty($titulo) or empty($lancetime) or empty($breve_descricao) or empty($file) or empty($valor) or empty($descricao) or empty($inicio) or empty($leilao)) {

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
            $data['duracao_lance'] = $lancetime;
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
            $data['keywords'] = $rua.','.$bairro.','.$cidade.','.$estado;


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

    public function addCarrosel($title, $descricao, $file, $linktext, $link)
    {

        if (empty($title) or empty($descricao) or empty($file)) {
            return 0;
        } else {

            $data['titulo'] = $title;
            $data['texto'] = $descricao;
            $data['link_texto_1'] = $linktext;
            $data['link_1'] = $link;
            $data['data'] = date('YmdHis');
            if (!empty($file['name'])):
                $filex = $file['tmp_name'];
                $size = $file['size'];
                $type = $file['type'];
                $name = $file['name'];

                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $extension = strtolower($extension);

                $data['image'] = file_get_contents(addslashes($filex));

                if (strstr('jpg,gif,png', $extension)):


                    if ($size > 5 * 1000000):

                        return 'Tamanho maximo de ' . 5 . 'MB, excedido.';

                    else:


                        $this->db->insert('carrosel', $data);

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

    public function editCarrosel($carrosel, $title, $descricao, $file, $linktext, $link)
    {

        if (empty($title) or empty($descricao) or empty($file)) {
            return 0;
        } else {

            $data['titulo'] = $title;
            $data['texto'] = $descricao;
            $data['link_texto_1'] = $linktext;
            $data['link_1'] = $link;
            $data['data'] = date('YmdHis');
            if (empty($file['name'])):

                $this->db->where('id', $carrosel);
                $this->db->update('carrosel', $data);

                return 1;

            else:

                if (!empty($file['name'])):
                    $filex = $file['tmp_name'];
                    $size = $file['size'];
                    $type = $file['type'];
                    $name = $file['name'];

                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    $extension = strtolower($extension);


                    if (strstr('jpge,jpg,png,gif', $extension)):


                        if ($size > 5 * 1000000):

                            return 'Tamanho maximo de ' . 5 . 'MB, excedido.';

                        else:

                            $data['image'] = file_get_contents(addslashes($filex));

                            $this->db->where('id', $carrosel);
                            $this->db->update('carrosel', $data);

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

    public function check_payment($reference){

        $this->db->from('pagseguro');
        $this->db->order_by('id','desc');
        $this->db->limit(1,0);
        $query = $this->db->get();
        $result = $query->result_array();
        $token = $result[0]['token'];
        $email = $result[0]['email'];

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email=' . $email . '&token='. $token . '&reference=' . $reference . '';


        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $transactionCurl = curl_exec($curl);
        curl_close($curl);

        $xmlresult = simplexml_load_string($transactionCurl);
        if(!isset($xmlresult->transactions->transaction->status)):

            return 0;
            else:
                return simplexml_load_string($transactionCurl);

        endif;

    }


    public function payment($id,$quantidade,$descricao,$preco,$reference){

        //Inicio configuração do pagseguro.
        $this->db->from('pagseguro');
        $this->db->order_by('id','desc');
        $this->db->limit(1,0);
        $query = $this->db->get();
        $result = $query->result_array();

        $data['token'] = $result[0]['token'];
        $data['email'] = $result[0]['email'];

        //Fim configuração do pagseguro.



        $data['currency'] = 'BRL';
        $data['itemId1'] = $id;
        $data['itemQuantity1'] = $quantidade;
        $data['itemDescription1'] = ''.$descricao.'';
        $data['itemAmount1'] = "".$preco."";
        $data['reference'] = $reference;

        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

        $data = http_build_query($data);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml= curl_exec($curl);

        curl_close($curl);

        return simplexml_load_string($xml);
    }

public function addcredit($user){

    $this->db->from('compras');
    $this->db->where('id_user', $user);
    $this->db->where('status', 1);
    $this->db->or_where('status', 2);
    $this->db->or_where('status', 5);
    $query = $this->db->get();
    if ($query->num_rows() > 0):
        $result = $query->result_array();
        foreach ($result as $dds) {
            $check = $this->check_payment($dds['reference_code']);

            if ($check !== 0):

                $dados['status'] = @$check->transactions->transaction->status;
                $dados['transaction_code'] = @$check->transactions->transaction->code;
                $dados['data_payment'] = @$check->transactions->transaction->date;
                if ($dds['type'] == 2 and $dds['submit'] < 3  and $check->transactions->transaction->status == 3 or $check->transactions->transaction->status == 4):


                    $dados['submit'] = 3;
                    $this->db->from('pacotes');
                    $this->db->where('id', $dds['id_obj_compra']);
                    $query = $this->db->get();
                    if ($query->num_rows() > 0):
                        $this->addcredito($dds['id_obj_compra']);
                    endif;
                endif;


                $this->db->where('reference_code', @$check->transactions->transaction->reference);
                $this->db->update('compras', $dados);

            endif;
        }
        return $query->num_rows();
    else:
        return 0;
    endif;

}
    public function comprarPack($compra)
    {
        $this->db->from('pacotes');
        $this->db->where('id',$compra);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->from('compras');
            $this->db->where('type',2);
            $this->db->where('id_obj_compra',$compra);
            $this->db->where('id_user',$_SESSION['ID']);
            $queryPct = $this->db->get();

            if($queryPct->num_rows() > 0){

                return 2;

            }else {

                $result = $query->result_array();
                $reference = 'PKE-T2' . date('Y') . rand();
                $payment = $this->payment('2' . $compra, 1, strip_tags($result[0]['title']), number_format($result[0]['valor'], 2, '.', ''), $reference);


                $dados['id_user'] = $_SESSION['ID'];
                $dados['type'] = 2;
                $dados['id_obj_compra'] = $compra;
                $dados['title'] = strip_tags($result[0]['title']);
                $dados['description'] = strip_tags($result[0]['title']);
                $dados['value_show'] = number_format($result[0]['valor'], 2, '.', ',');
                $dados['value_pagseguro'] = number_format($result[0]['valor'], 2, '.', '');
                $dados['pre_approval'] = $payment->code;
                $dados['reference_code'] = $reference;
                $dados['url_payment'] = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $payment->code;
                $dados['status'] = 1;
                $dados['data_solicitation'] = date('d/m/Y H:i:s');
                $dados['submit'] = 1;

                $this->db->insert('compras',$dados);

                if ($this->db->insert_id() > 0):
                    return 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $payment->code;

                else:
                    return 0;

                endif;


            }

        }else{
            return 0;
        }

    }

    public function updpass($new, $newag, $old, $email)
    {

        if (empty($new) or empty($newag) or empty($old) or empty($email)) {
            return 0;
        } else {

            if ($new == $newag and $_SESSION['EMAIL'] == $email):
                $data['pass'] = hash('whirlpool', md5(sha1($new)));
                $this->db->where('id', $_SESSION['ID']);
                $this->db->where('pass', hash('whirlpool', md5(sha1($old))));
                if ($this->db->update('user', $data)):
                    $_SESSION['PASS'] = hash('whirlpool', md5(sha1($_POST['newpass'])));
                    return 1;

                else:
                    return 0;

                endif;


            else:
                return 0;
            endif;

        }

    }


    public function cupon($user, $leilao, $arremate)
    {

        if (empty($user) or empty($leilao) or empty($arremate)) {

            return 0;

        } else {


            $this->db->from('arremates');
            $this->db->where('id_arremate', $arremate);
            $query = $this->db->get();
            $count = $query->num_rows();
            $result = $query->result_array();

            if ($count > 0) {

                $valor = $result[0]['valor_arremate'];
                $this->db->from('cupon_loja');
                $this->db->where('id_user',$user);
                $query = $this->db->get();
                $count = $query->num_rows();
                $result = $query->result_array();
                if ($count > 0):

                    $valoracs = $result[0]['valor'];
                    $valor_show = $result[0]['valor_show'];
                    $dado['valor'] = str_replace(',', '', $valoracs) + str_replace(',', '', $valor);
                    $dado['valor_show'] = number_format(str_replace(',', '', $valor_show) + str_replace(',', '', $valor), 2, '.', ',');
                    $this->db->where('id_user', $user);
                    $this->db->update('cupon_loja', $dado);
                else:

                    $dado['id_user'] = $user;
                    $dado['valor'] = str_replace(',', '', $valor);
                    $dado['valor_show'] = number_format(str_replace(',', '', $valor), 2, '.', ',');
                    $this->db->insert('cupon_loja', $dado);

                endif;
                return 1;

            } else {
                return 0;
            }


        }


    }



    public function addcredito($pacote)
    {

        if (empty($pacote)) {

            return 0;

        } else {


            $this->db->from('pacotes');
            $this->db->where('id', $pacote);
            $query = $this->db->get();
            $count = $query->num_rows();
            $result = $query->result_array();

            if ($count > 0) {

                $valor = $result[0]['valor'];
                $this->db->from('creditos');
                $this->db->where('usuario', $_SESSION['ID']);
                $query = $this->db->get();
                $count = $query->num_rows();
                $result = $query->result_array();
                if ($count > 0):

                    $valoracs = $result[0]['credito'];
                    $dado['credito'] = str_replace(',', '', $valoracs) + str_replace(',', '', $valor);

                    $this->db->where('usuario', $_SESSION['ID']);
                    $this->db->update('creditos', $dado);
                else:

                    $dado['usuario'] = $_SESSION['ID'];
                    $dado['credito'] = str_replace(',', '', $valor);
                    $this->db->insert('creditos', $dado);

                endif;
                return 1;

            } else {
                return 0;
            }


        }


    }



    public function alterdata($type, $valor, $db)
    {
        if (empty($valor)) {

            return 0;
        } else {
            if ($type == 0):

                $dado['firstname'] = $valor;
                $this->db->where('id', $_SESSION['ID']);
                if ($this->db->update($db, $dado)):
                    return 1;
                else:
                    return 0;
                endif;
            endif;

            if ($type == 1):

                $dado['lastname'] = $valor;
                $this->db->where('id', $_SESSION['ID']);
                if ($this->db->update($db, $dado)):
                    return 1;
                else:
                    return 0;
                endif;
            endif;

            if ($type == 2):

                $dado['telefone'] = $valor;
                $this->db->where('id', $_SESSION['ID']);
                if ($this->db->update($db, $dado)):
                    return 1;
                else:
                    return 0;
                endif;
            endif;

            if ($type == 3):

                $dado['endereco'] = $valor;
                $this->db->where('id', $_SESSION['ID']);
                if ($this->db->update($db, $dado)):
                    return 1;
                else:
                    return 0;
                endif;
            endif;

        }


    }

    public function reloadToken($user)
    {

        $dado['token'] = 'PKE-' . $user . rand();
        $this->db->where('id_user', $user);
        if ($this->db->update('cupon_loja', $dado)) {

            return 'PKE-' . $user . rand();

        } else {

            return 0;
        }

    }


    public function uploadUs($nameimage, $dataname, $tablename, $file, $allowed, $max_size)
    {

        if (!empty($file['name'])):
            $filex = $file['tmp_name'];
            $size = $file['size'];
            $type = $file['type'];
            $name = $file['name'];

            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if (strstr($allowed, $extension)):


                if ($size > $max_size * 1000000):

                    return 'Tamanho maximo de ' . $max_size . 'MB, excedido.';

                else:

                    $date['image'] = file_get_contents(addslashes($filex));
                    $this->db->where('id', $_SESSION['ID']);
                    if ($this->db->update('user', $date)) {
                        return $_SESSION['ID'];
                    } else {
                        return 'Erro a salvar a imagem, tente mais tarde.';
                    }

                endif;


            else:

                return 'Somente as extensões ' . $allowed . ' são permitidas.';

            endif;


        else:


            return 'Por favor selecione o arquivo.';


        endif;


    }

public function messageChat($leilao, $user, $mesage)
{

    if(empty($leilao) or empty($user) or empty($mesage)){

        return 0;

    }else{

        $dados['data'] = date('YmdHis');
        $dados['id_user'] = $user;
        $dados['id_leilao'] = $leilao;
        $dados['mensagem'] = $mesage;
        $this->db->insert('chat',$dados);

            return 1;

    }


}

public function segundosDif($data){

    $ind = $data;
    $anoat = substr($ind, 0, 4);
    $mesat = substr($ind, 4, 2);
    $diaat = substr($ind, 6, 2);
    $horaat = substr($ind, 8, 2);
    $minutoat = substr($ind, 10, 2);
    $segundoat = substr($ind, 12, 2);
    $data_hora_inicial = mktime($horaat, $minutoat, $segundoat, $mesat, $diaat, $anoat);
    $data_hora_final = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
    return  $data_hora_final -  $data_hora_inicial;

}
public function SecsDataConvert($secs){

    if($secs <= 1):
        return $secs.' Seg';
        endif;

    if($secs < 60 and $secs > 2):
        return $secs.' Segs';
        endif;

    if($secs > 60 and $secs < 120):
        return ceil($secs / 60) - 1 .' Min';
        endif;

    if($secs > 60 and $secs > 120 and $secs < 3600):
        return ceil($secs / 60) - 1 .' Mins';
        endif;

    if($secs > 3600 and $secs < 7200):
        return ceil($secs / 60 / 60) - 1 .' Hr';
        endif;

    if($secs > 3600 and $secs > 7200):
        return ceil($secs / 60 / 60) - 1 .' Hrs';
        endif;

}



public function winner($leilao,$winner,$valor){

    if(empty($leilao) and empty($winner) and empty($valor)){
        return 0;
    }else{
        $reference = 'PKE-T1' . date('Y') . rand();

        $this->db->from('user');
        $this->db->where('id',$winner);
        $this->db->where('type',1);
        $this->db->or_where('type',54);
        $query_us = $this->db->get();
        $row_user = $query_us->num_rows();

        $this->db->from('leiloes');
        $this->db->where('id',$leilao);
        $this->db->where('status',1);
        $query_lei = $this->db->get();
        $row_lei = $query_lei->num_rows();
        $result_lei = $query_lei->result_array();

        if($row_lei > 0 and $row_user > 0){

            $dados_up['winner'] = $winner;
            $dados_up['status'] = 2555;
            $this->db->where('id',$leilao);
            $this->db->update('leiloes',$dados_up);


            $this->db->from('lances');
            $this->db->where('id_leilao',$leilao);
            $this->db->where('id_user',$winner);
            $query_mlnc = $this->db->get();
            $row_mlnc = $query_mlnc->num_rows();

            $this->db->from('lances');
            $this->db->where('id_leilao',$leilao);
            $query_lnc = $this->db->get();
            $row_lnc = $query_lnc->num_rows();
            $duracao = $this->segundosDif($result_lei[0]['comeco_data']);

           $payment =  $this->payment('1.'.$leilao,1,strip_tags($result_lei[0]['title']),number_format($valor, 2, '.', ''),$reference);



            $dados_arr['id_user'] = $winner;
            $dados_arr['title_arremate'] = $result_lei[0]['title'];
            $dados_arr['description_arremate'] = $result_lei[0]['descricao_completa'];
            $dados_arr['id_arremate'] = $leilao;
            $dados_arr['valor_arremate'] = $valor;
            $dados_arr['meus_lances'] = $row_mlnc;
            $dados_arr['lances_totais'] = $row_lnc;
            $dados_arr['duracao_segundos'] = $duracao;
            $dados_arr['pre_approval'] = $payment -> code;
            $dados_arr['reference_code'] = $reference;
            $dados_arr['url_payment'] = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $payment->code;
            $dados_arr['data_arremate'] = date('YmdHis');

            $this->db->from('arremates');
            $this->db->where('id_arremate',$leilao);
            $query_arsr = $this->db->get();
            if($query_arsr->num_rows() == 0):
                $this->db->insert('arremates',$dados_arr);

                $dados_cpm['type'] = 1;
                $dados_cpm['id_user'] = $winner;
                $dados_cpm['title'] = $result_lei[0]['title'];
                $dados_cpm['description'] = strip_tags($result_lei[0]['descricao_completa']);
                $dados_cpm['id_obj_compra'] = $leilao;
                $dados_cpm['value_show'] = number_format($valor, 2, '.', ',');
                $dados_cpm['value_pagseguro'] = $valor;
                $dados_cpm['pre_approval'] = $payment -> code;
                $dados_cpm['reference_code'] = $reference;
                $dados_cpm['status'] = 3;
                $dados_cpm['submit'] = 1;
                $dados_cpm['url_payment'] = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $payment->code;
                $dados_cpm['data_solicitation'] = date('d/m/Y H:i:s');
                $this->db->insert('compras',$dados_cpm);
                $arrematePsn = $this->db->insert_id();
                if($arrematePsn > 0):

                    $this->db->from('vangancy');
                    $this->db->where('id_user !=',$winner);
                    $this->db->where('id_leilao',$leilao);
                    $queryVnc = $this->db->get();
                    foreach ($queryVnc->result_array() as $dds){
                        $this->cupon($dds['id_user'],$leilao,$leilao);
                    }

                    $dd_ntf['id_user'] = $_SESSION['ID'];
                    $dd_ntf['title'] = utf8_decode('Leilão arrematado');
                    $dd_ntf['image'] = $result_lei[0]['image'];
                    $dd_ntf['text'] = utf8_decode('Parabéns <b>'.$_SESSION['NAME'].'</b>, você arrematou o leilão numero <b>'.$leilao.'</b>. Estamos aguardando a confirmação do pagamento para a liberação do produto.');
                    $dd_ntf['link'] = base_url('meus-arremates');
                    $this->db->insert('notificacao',$dd_ntf);
                    $ddp['id_user'] = $_SESSION['ID'];
                    $this->db->insert('notificacao_read',$ddp);

                    return $winner;

                else:

                    return 0;

                endif;



                else:
                return 0;
                    endif;

        }else{

            return 0;

        }


    }


}

public function convertPrize($valor,$porcento){
    if (strlen(str_replace(',', '', $valor) / 100) > 4):

        $explode = @explode('.', substr(str_replace(',', '', $valor) / 100, 0, -2) * $porcento);

        if (@strlen($explode[0]) == 1 and @strlen($explode[1]) == 1):
            $valor_in = number_format(substr(str_replace(',', '', $valor) / 100, 0, -2) * $porcento . '0', 2, '.', ',');
        else:
            $valor_in = number_format(substr(str_replace(',', '', $valor) / 100, 0, -2) * $porcento, 2, '.', ',');

        endif;

    else:
        $explode = @explode('.', str_replace(',', '', $valor) / 100);


        if (@strlen($explode[1]) == 1 and @strlen(@$explode[0]) >= 2):
            $valor_in = number_format(str_replace(',', '', $valor) / 100 * $porcento . 0, 2, '.', ',');
        else:
            $valor_in = number_format(str_replace(',', '', $valor) / 100 * $porcento, 2, '.', ',');
        endif;
    endif;

    return $valor_in;
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


    public function compraAPI($token, $code,$valor)
    {

        if (empty($token) or empty($code)) {

            return 0;

        }

        else {

            if($token == 'pk221a'):


                $valor = number_format($valor,2,'.',',');
                $this->db->from('cupon_loja');
                $this->db->where('token', $code);
                $query = $this->db->get();
                $count = $query->num_rows();
                $result = $query->result_array();
                if ($count > 0):

                    $valoracs = $result[0]['valor'];
                    $valor_show = number_format($result[0]['valor_show'],2,'.',',');
                    $dado['valor'] = str_replace(',', '', $valoracs) - str_replace(',', '', $valor);
                    $dado['valor_show'] = $valor_show - $valor;
                    $this->db->where('id_user', $_SESSION['ID']);
                    if($this->db->update('cupon_loja', $dado)){
                        return 3;

                    }else{
                        return 2;

                    }


                else:

                   return 1;

                endif;


else:
    return 0;
    endif;

        }


    }
    public function API($token,$code,$method,$valor){

        if($token == 'pk221a'):
        $token = strip_tags($token);
        $code = strip_tags($code);
        $method = strip_tags($method);

    $this->db->from('cupon_loja');
    $this->db->where('token',$code);
    $query = $this->db->get();
    if($query->num_rows() > 0):

        $result = $query->result_array();
        if($method == 1):

            $this->db->from('user');
            $this->db->where('id',$result[0]['id_user']);
            $query = $this->db->get();
            $resultu = $query->result_array();
                if($query->num_rows() > 0):

            $dado['userid'] = $result[0]['id_user'];
            $dado['email'] = $resultu[0]['email'];
            $dado['cpf'] = $resultu[0]['cpf'];
            $dado['saldo'] = $result[0]['valor_show'];
                return $dado;

            else:
            return 0;
            endif;

        endif;
        if($method == 2):
            if($this->compraAPI($token,$code,$valor) == 3):
return 1;
                else:
return 0;
                endif;
            endif;
        if($method <> 1 or $method <> 2 ):




            endif;
else:
    return 0;


    endif;
        else:

            return 0;
    endif;
}
}

?>
