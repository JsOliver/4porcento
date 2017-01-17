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

    public function recovery(){

        $newpass =  rand().date('Y');

        $dataup['pass'] = hash('whirlpool',md5(sha1($newpass)));
        $this->db->where('email', $_POST['email']);
        if($this->db->update('user',$dataup)):
            //Inicia o processo de configuração para o envio do email
            $config['protocol'] = 'mail'; // define o protocolo utilizado
            $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
            $config['validate'] = TRUE; // define se haverá validação dos endereços de email
            $config['mailtype'] = 'html';
            $this->load->library('email');


            // Define remetente e destinatário
            $this->email->from('4porcento@4porcento.com.br','Recuperação de senha'); // Remetente
            $this->email->to($_POST['email']); // Destinatário

            $this->email->subject('4porcento - Recuperação de senha.');
            $this->email->message('Sua nova senha e:
        '.$newpass.'');

            if($this->email->send()):

                echo '11';
            else:

                echo '0';

            endif;
            else:

                echo '0';
                endif;


    }

    public function EditText(){


        @$data_atual_system = date('YmdHis');

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true and $_SESSION['TYPE'] == 54):

            if(isset($_POST['type']) and $_POST['type'] == 3 and isset($_POST['explicativo']) and isset($_POST['cite']) and isset($_POST['explicativo1']) and isset($_POST['video']) and !empty($_POST['explicativo']) and !empty($_POST['cite']) and !empty($_POST['explicativo1'])):

                $this->db->from('textos');
                $query = $this->db->get();
                $dados['d1_about'] = $_POST['explicativo'];
                $dados['cite_about'] = $_POST['cite'];
                $dados['d2_about'] = $_POST['explicativo1'];
                $dados['video'] = $_POST['video'];
                if($query->num_rows() == 0):
                    $this->db->insert('textos',$dados);

                else:
                    $this->db->update('textos',$dados);

                endif;

            endif;

            if(isset($_POST['type']) and $_POST['type'] == 2 and isset($_POST['title']) and isset($_POST['explicativo']) and isset($_POST['title1']) and isset($_POST['explicativo1']) and isset($_POST['title2']) and isset($_POST['explicativo2']) and !empty($_POST['explicativo']) and !empty($_POST['title1']) and !empty($_POST['explicativo1']) and !empty($_POST['title']) and !empty($_POST['title2']) and !empty($_POST['explicativo2'])):

                $this->db->from('textos');
                $query = $this->db->get();
                $dados['t1_log'] = $_POST['title'];
                $dados['d1_log'] = $_POST['explicativo'];
                $dados['t2_log'] = $_POST['title1'];
                $dados['d2_log'] = $_POST['explicativo1'];
                $dados['t3_log'] = $_POST['title2'];
                $dados['d3_log'] = $_POST['explicativo2'];
                if($query->num_rows() == 0):
                    $this->db->insert('textos',$dados);

                else:
                    $this->db->update('textos',$dados);

                endif;

            endif;


            if(isset($_GET['type']) and $_GET['type'] == 1 and isset($_GET['title']) and isset($_GET['explicativo']) and !empty($_GET['title']) and !empty($_GET['explicativo'])):
                $dados['t1_cad'] = $_GET['title'];
                $dados['d1_cad'] = $_GET['explicativo'];
                $this->db->from('textos');
                $query = $this->db->get();

                if($query->num_rows() == 0):
                    $this->db->insert('textos',$dados);

                else:
                    $this->db->update('textos',$dados);

                endif;

            endif;

            redirect(base_url('adm/textos'), 'refresh');

        endif;


    }

    public function entregue(){

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if (isset($_GET['i']) and !empty($_GET['i']) and $log == true and $_SESSION['TYPE'] == 54 or $log == true and $_SESSION['TYPE'] == 53):

            $dado['submit'] = 3;
            $this->db->where('submit !=',3);
            $this->db->update('compras',$dado);
            redirect(base_url('configuracoes'), 'refresh');


        endif;
    }

    public function texto(){

        @$data_atual_system = date('YmdHis');

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true and $_SESSION['TYPE'] == 54):
            $dados['status'] = $log;
            $dados['page'] = 'textos';
            $this->load->view('pages/admin/texto', $dados);
        endif;
    }

    public function about(){

        @$data_atual_system = date('YmdHis');
        $dados['page'] = 'sobre';
        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;

        $this->load->view('pages/user/about', $dados);
    }

    public function sala()
    {
        @$data_atual_system = date('YmdHis');

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):

            $this->db->from('leiloes');
            $this->db->where('id', $_GET['p']);
            $this->db->where('status', 1);
            $get = $this->db->get();
            $count = $get->num_rows();
            $result = $get->result_array();

            if(!empty($result[0]['comeco_data'])):

                if($this->Models_model->segundosDif($result[0]['comeco_data']) > 3600):

                    $tp = false;
                    $ppa['status'] = 0;
                    $this->db->where('id',$_GET['p']);
                    $this->db->update('leiloes',$ppa);
                else:
                    $tp = true;
                endif;

            else:

                $tp = true;

            endif;

            $this->db->from('vangancy');
            $this->db->where('id_leilao', $_GET['p']);
            $query_vagancy1 = $this->db->get();
            $row_vagancy1 = $query_vagancy1->num_rows();

            $this->db->from('vangancy');
            $this->db->where('id_leilao', $_GET['p']);
            $this->db->where('id_user', $_SESSION['ID']);
            $query_vagancy2 = $this->db->get();
            $row_vagancy2 = $query_vagancy2->num_rows();


            if ($tp == true and $count > 0 and $row_vagancy1 < $result[0]['maximo_users'] or $tp == true and $count > 0 and $row_vagancy2 > 0):



                $data_inicio = $result[0]['inicio_data'];


                if ($data_inicio < $data_atual_system):
                    $valor_in = $this->Models_model->convertPrize($result[0]['valor_leilao'], 4);


                    $this->db->from('vangancy');
                    $this->db->where('id_leilao', $_GET['p']);
                    $this->db->where('id_user', $_SESSION['ID']);
                    $query_count_US = $this->db->get();
                    if($query_count_US->num_rows() > 0):

                        $dado['user'] = $_SESSION['ID'];
                        $dado['interact_type'] = 2;
                        $this->db->insert('interact_report', $dado);

                        $dados['status'] = $log;
                        $dados['page'] = 'sala';
                        $dados['desconto'] = $valor_in;
                        $this->load->view('pages/user/sala', $dados);

                    else:

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


                        if ($query_count->num_rows() <= $result[0]['maximo_users']):

                            if ($query_count->num_rows() > $result[0]['minimo_users']):
                                $vagas = false;

                            else:
                                $vagas = true;

                            endif;

                        else:

                            $vagas = false;
                        endif;

                        if ($my_credit >= str_replace(',','',$valor_in)):

                            if ($vagas == true):


                                $dos['credito'] = $my_credit - $valor_in;
                                $this->db->where('usuario', $_SESSION['ID']);
                                $this->db->update('creditos', $dos);


                                $ddos['id_leilao'] = $_GET['p'];
                                $ddos['id_user'] = $_SESSION['ID'];
                                $this->db->insert('vangancy', $ddos);
                            endif;

                            $dado['user'] = $_SESSION['ID'];
                            $dado['interact_type'] = 2;
                            $this->db->insert('interact_report', $dado);

                            $dados['status'] = $log;
                            $dados['page'] = 'sala';
                            $dados['desconto'] = $valor_in;
                            $this->load->view('pages/user/sala', $dados);


                        else:
                            redirect(base_url('adicionar/creditos'), 'refresh');
                        endif;


                    endif;






                else:
                    redirect(base_url('home'), 'refresh');
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
            $this->Models_model->addcredit($_SESSION['ID']);
            $dadas['status'] = $log;
            $dadas['page'] = 'account';
            $this->load->view('pages/user/account/account', $dadas);

        else:
            redirect(base_url('home'), 'refresh');

        endif;
    }

    public function arremate()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        if ($log == true):
            $this->db->where('id_user', $_SESSION['ID']);
            $this->db->delete('notificacao_read');
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
            $this->Models_model->addcredit($_SESSION['ID']);
            $dadas['status'] = $log;
            $dadas['page'] = 'pagamentos';
            $this->load->view('pages/user/account/compras', $dadas);
        else:
            redirect(base_url('home'), 'refresh');

        endif;

    }

    public function login()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'login';


        if ($log == true):
            redirect(base_url('home'), 'refresh');
        else:
            $this->load->view('pages/user/acess/login', $dados);

        endif;


    }

    public function register()
    {

        $this->load->library('functions');
        $log = $this->Models_model->logVer();
        $dados['status'] = $log;
        $dados['page'] = 'register';

        if ($log == true):

            redirect(base_url('home'), 'refresh');
        else:
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
            $this->Models_model->addcredit($_SESSION['ID']);
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
            if ($this->Models_model->login($_POST['email'], $_POST['pass']) == 11):
                $this->Models_model->addcredit($_SESSION['ID']);
                echo 11;
            endif;

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
            if ($this->Models_model->newleilao($_POST['maxlance'], $_POST['title'], $_POST['minuser'], $_POST['maxuser'], $_POST['breve_descricao'], $_FILES['image'], $_POST['valor_leilao'], $_POST['descricao_completa'], $_POST['inicio_data'], $_POST['estado'], $_POST['cidade'], $_POST['cep'], $_POST['rua'], $_POST['bairro']) == 1):
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

    public function exibirNf()
    {

        $this->db->from('notificacao');
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
        $allowed = 'jpeg,jpge,jpg,png,gif';
        $upload = $this->Models_model->uploadUs('pp', 'default', 'image_profile', $_FILES['fileUpload'], $allowed, 3);
        echo $upload;

    }

    public function updLeilao()
    {

        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if ($this->Models_model->updleilao($_POST['maxlance'], $_POST['leilao'], $_POST['minuser'], $_POST['maxuser'], $_POST['title'], $_POST['breve_descricao'], $_FILES['image'], $_POST['valor_leilao'], $_POST['descricao_completa'], $_POST['inicio_data'], $_POST['estado'], $_POST['cidade'], $_POST['cep'], $_POST['rua'], $_POST['bairro']) == 1):
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

    public function newcredit(){


        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):

            $this->db->from('creditos');
            $this->db->where('usuario',$_POST['user']);
            $query = $this->db->get();
            $dados['credito'] = $_POST['valor'];
            if($query->num_rows() > 0):

                $this->db->where('usuario',$_POST['user']);
                $this->db->update('creditos',$dados);

            else:
                $dados['usuario'] = $_POST['user'];

                $this->db->insert('creditos',$dados);

            endif;

        endif;

    }

    public function checkverMessage()
    {
        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao']) and !isset($_POST['send'])):

                $this->db->from('chat');
                $this->db->where('id_leilao', $_POST['leilao']);
                $this->db->where('status', 0);
                $this->db->order_by('id', 'desc');
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            endif;
        endif;
    }

    public function chat()
    {

        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao']) and !isset($_POST['send'])):

                $this->db->from('chat');
                $this->db->where('id_leilao', $_POST['leilao']);
                $this->db->order_by('id', 'desc');
                $query = $this->db->get();


                if ($query->num_rows() > 0):

                    foreach ($query->result_array() as $dds) {

                        $this->db->from('user');
                        $this->db->where('id', $dds['id_user']);
                        $query1 = $this->db->get();
                        $result1 = $query1->result_array();

                        ?>


                        <li class="left clearfix">
                <span class=" pull-left">
                        <?php
                        $this->db->from('user');
                        $this->db->where('id',$dds['id_user']);
                        $query = $this->db->get();
                        if(empty($query->result_array()[0]['image'])):
                            ?>
                            <img id="profileimg" class="img-responsive profile-img margin-bottom-20"
                                 src="<?php echo base_url('assets/img/user.jpg'); ?>"
                                 style="width: 50px; object-fit: cover; object-position: center;" alt="">
                        <?php else: ?>
                            <img id="profileimg" class="img-responsive profile-img margin-bottom-20"
                                 src="<?php echo base_url('pages/exibirUs?id=' . $dds['id_user']); ?>"
                                 style="width: 50px;  object-fit: cover; object-position: center;" alt="">
                        <?php endif;?>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <?php if ($dds['id_user'] == $_SESSION['ID']): ?>
                                        <strong
                                            class="primary-font"><?php echo $this->Models_model->limitarTexto(strip_tags($result1[0]['username']), 50); ?></strong>
                                    <?php else: ?>
                                        <span
                                            class="primary-font"><?php echo $this->Models_model->limitarTexto(strip_tags($result1[0]['username']), 50); ?></span>

                                    <?php endif; ?>
                                    <?php if (!empty($dds['data'])): ?>
                                        <small class="pull-right text-muted">
                                            <span
                                                class="glyphicon glyphicon-time"></span><?php echo $this->Models_model->SecsDataConvert($this->Models_model->segundosDif($dds['data'])); ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                                <p>
                                    <?php echo $dds['mensagem']; ?>
                                </p>
                            </div>
                        </li>


                        <?php

                        $dta['status'] = 1;
                        $this->db->where('id', $dds['id']);
                        $this->db->where('status', 0);
                        $this->db->update('chat', $dta);
                    }


                else:

                    echo 'Nenhuma mensagem.';

                endif;
            endif;

            if (isset($_POST['leilao']) and isset($_POST['send'])):

                echo $this->Models_model->messageChat($_POST['leilao'], $_SESSION['ID'], $_POST['mensagem']);
                $this->db->from('vangancy');
                $this->db->where('id_leilao', $_POST['leilao']);
                $query_vagancy = $this->db->get();
                $countss = $query_vagancy->num_rows();
                $result_arrayss = $query_vagancy->result_array();

                if($countss > 0):

                    foreach($result_arrayss as $dds){

                        $dado21['id_user'] = $dds['id_user'];
                        $dado21['id_leilao'] = $_POST['leilao'];
                        $dado21['status'] = 0;
                        $dado21['tp'] = 2;
                        $this->db->insert('report_lance', $dado21);
                    }
                endif;

            endif;
        endif;
    }

    public function checkLeilao()
    {
        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    $min = $result[0]['minimo_users'];
                    $max = $result[0]['maximo_users'];
                    $data_inicio = $result[0]['inicio_data'];
                    $this->db->from('vangancy');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query1 = $this->db->get();
                    $vagas = $query1->num_rows();

                    if ($vagas >= $min and $vagas <= $max) {

                        echo 1;

                    } else {
                        echo 0;
                    }


                } else {

                    echo 0;
                }

            else:
                echo 0;

            endif;
        endif;
    }

    public function winnerName(){
        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $this->db->where('winner >',0);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                $result = $query_prod->result_array();

                if($row_prod > 0):

                    $this->db->from('user');
                    $this->db->where('id', $result[0]['winner']);
                    $query_prod = $this->db->get();
                    $result1 = $query_prod->result_array();
                    echo $result1[0]['username'];
                else:

                    echo 'Indefinido';

                endif;


            endif;
        endif;
    }

    public function permissionButton()
    {
        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):
                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                if ($row_prod > 0):

                    $result_prod = $query_prod->result_array();


                    ?>


                    <?php
                    $this->db->from('vangancy');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query_vagancy = $this->db->get();
                    $row_vagancy = $query_vagancy->num_rows();
                    if ($row_vagancy >= $result_prod[0]['minimo_users'] and $row_vagancy <= $result_prod[0]['maximo_users']):



                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $this->db->limit(1, 0);
                        $query_user = $this->db->get();
                        $row_user = $query_user->num_rows();
                        $result_uss = $query_user->result_array();
                        if ($row_user > 0):

                            if($this->Models_model->segundosDif($result_prod[0]['comeco_data']) > 3600):
                                $ver = false;
                            else:
                                $ver = true;
                            endif;

                            if($ver == false):
                                echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg"  style="background: #cb0000;">Finalizado</button>';

                            endif;

                            if ($query_user->result_array()[0]['id_user'] == $_SESSION['ID'] and $ver == true):
                                echo '<a style="cursor: pointer;" class="btn-u btn-u-sea-shop btn-u-lg" >Na frente</a>';

                            else:
                                if ($this->Models_model->segundosDif($query_user->result_array()[0]['data']) < $query_prod->result_array()[0]['duracao_lance'] and $ver == true):

                                    if (empty($result_prod[0]['comeco_data'])):

                                        $dpsa['comeco_data'] = date('YmdHis');
                                        $this->db->where('id', $_POST['leilao']);
                                        $this->db->update('leiloes', $dpsa);

                                    endif;
                                    echo '
<script>
if(so == 0){
     startCountdown();
                so++;
}

</script>
<span id="btn-lanc"><a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a></span>';

                                else:

                                    echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg"  style="background: #cb0000;">Finalizado</button>';
                                endif;

                            endif;


                        else:
                            $this->db->from('vangancy');
                            $this->db->where('id_leilao', $_POST['leilao']);
                            $this->db->where('id_user', $_SESSION['ID']);
                            $query_vagancyuS = $this->db->get();
                            $row_vagancyUS = $query_vagancyuS->num_rows();
                            if ($row_vagancy <= $result_prod[0]['maximo_users'] and $row_vagancy >= $result_prod[0]['minimo_users']):

                                if (empty($result_prod[0]['comeco_data'])):

                                    $dpsa['comeco_data'] = date('YmdHis');
                                    $this->db->where('id', $_POST['leilao']);
                                    $this->db->update('leiloes', $dpsa);

                                endif;

                                echo '
<script>
if(so == 0){
     startCountdown();
                so++;
}

</script>

<span id="btn-lanc"><a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a></span>';

                            endif;
                            if ($row_vagancy > $result_prod[0]['maximo_users'] and $ver == true):
                                echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #cb0000;" >Sala Cheia</button>';

                            endif;

                            if ($row_vagancy < $result_prod[0]['minimo_users'] and $ver == true):
                                echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #cbb64a;" >Aguarde</button>';
                            endif;
                        endif;


                    else:
                        $this->db->from('vangancy');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->where('id_user', $_SESSION['ID']);
                        $query_vagancyuS = $this->db->get();
                        $row_vagancyUS = $query_vagancyuS->num_rows();
                        if($row_vagancyUS > 0):
                            echo '<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #cbb64a;" >Aguarde</button>';

                        else:
                            if($ver == true):
                                echo '<script>
if(so == 0){
     startCountdown();
                so++;
}

</script>

<span id="btn-lanc"><a style="cursor: pointer;" onclick="lance();" class="btn-u btn-u-sea-shop btn-u-lg" >Dar lance</a></span>';

                            endif;
                        endif;


                    endif;


                endif;
            endif;
        endif;


    }

    public function checktime()
    {


        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                if ($row_prod > 0):
                    $result_prod = $query_prod->result_array();

                    $this->db->from('lances');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query_lances = $this->db->get();
                    $row_lances = $query_lances->num_rows();
                    if ($row_lances > 0):

                        echo $result_prod[0]['duracao_lance'];

                    else:
                        echo 0;
                    endif;
                endif;
            endif;
        endif;
    }


    public function checkTimeSin()
    {

        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                $row_result = $query_prod->result_array();
                if ($row_prod > 0):
                    $this->db->from('lances');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $this->db->order_by('id', 'desc');
                    $this->db->limit(1, 0);
                    $query_lances = $this->db->get();
                    $row_lances = $query_lances->num_rows();
                    if ($row_lances > 0):
                        $result = $query_lances->result_array();

                        $segundos = $this->Models_model->segundosDif($row_result[0]['comeco_data']);
                        if($segundos >  $row_result[0]['duracao_hora']):

                            echo 0;

                        else:

                            echo $row_result[0]['duracao_lance'] - $this->Models_model->segundosDif($result[0]['data']);

                        endif;

                    else:





                    endif;

                endif;


            endif;
        endif;
    }

    public function lance()
    {
        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):

                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();
                $result_prd = $query_prod->result_array();
                if ($row_prod > 0):

                    $this->db->from('vangancy');
                    $this->db->where('id_user', $_SESSION['ID']);
                    $query_vagancy = $this->db->get();
                    $row_vagancy = $query_vagancy->num_rows();
                    if ($row_vagancy > 0):
                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $this->db->limit(1, 0);
                        $query_lance = $this->db->get();
                        $row_lance = $query_lance->num_rows();


                        if ($row_lance > 0) {

                            $user = $query_lance->result_array()[0]['id_user'];

                            if ($user <> $_SESSION['ID']):

                                $dado['id_user'] = $_SESSION['ID'];
                                $dado['id_leilao'] = $_POST['leilao'];
                                $dado['data'] = date('YmdHis');
                                $this->db->insert('lances', $dado);

                                $this->db->from('vangancy');
                                $this->db->where('id_leilao', $_POST['leilao']);
                                $query_vagancy = $this->db->get();
                                $countss = $query_vagancy->num_rows();
                                $result_arrayss = $query_vagancy->result_array();

                                if($countss > 0):

                                    foreach($result_arrayss as $dds){

                                        $dado21['id_user'] = $dds['id_user'];
                                        $dado21['id_leilao'] = $_POST['leilao'];
                                        $dado21['status'] = 0;
                                        $dado21['tp'] = 1;
                                        $this->db->insert('report_lance', $dado21);
                                    }
                                endif;


                                echo 1;
                            endif;

                        } else {

                            $dado['id_user'] = $_SESSION['ID'];
                            $dado['id_leilao'] = $_POST['leilao'];
                            $dado['data'] = date('YmdHis');
                            $this->db->insert('lances', $dado);

                            $this->db->from('vangancy');
                            $this->db->where('id_leilao', $_POST['leilao']);
                            $query_vagancy = $this->db->get();
                            $countss = $query_vagancy->num_rows();
                            $result_arrayss = $query_vagancy->result_array();

                            if($countss > 0):

                                foreach($result_arrayss as $dds){

                                    $dado21['id_user'] = $dds['id_user'];
                                    $dado21['id_leilao'] = $_POST['leilao'];
                                    $dado21['status'] = 0;
                                    $dado21['tp'] = 1;

                                    $this->db->insert('report_lance', $dado21);
                                }
                            endif;
                            echo 1;

                        }





                    else:
                        echo 0;
                    endif;


                endif;
            endif;
        endif;
    }

    public function atualizalance()
    {

        if (isset($_SESSION['ID'])):

            if (isset($_POST['leilao'])):

                $this->db->from('lances');
                $this->db->where('id_leilao', $_POST['leilao']);
                $query_prod = $this->db->get();
                $row_prod = $query_prod->num_rows();


                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query = $this->db->get();
                $row = $query->num_rows();
                $result = $query->result_array();

                if (!empty($result[0]['comeco_data'])):

                    if ($result[0]['comeco_data'] >= date('YmdHis')):

                        if ($row_prod > 0) {
                            $this->db->from('lances');
                            $this->db->where('id_leilao', $_POST['leilao']);
                            $this->db->order_by('id', 'desc');
                            $this->db->limit(1, 0);
                            $query_prod2 = $this->db->get();

                            $this->Models_model->winner($_POST['leilao'], $query_prod2->result_array()[0]['id_user'], $this->Models_model->convertPrize($result[0]['valor_leilao'], 4));

                        } else {

                        }


                    endif;

                endif;

                $this->db->from('vangancy');
                $this->db->where('id_leilao', $_POST['leilao']);
                $queryv = $this->db->get();
                $rowv = $queryv->num_rows();


                if ($row > 0 and $rowv >= $result[0]['minimo_users']):


                    if ($row_prod > 0):


                        $result_prod = $query_prod->result_array();

                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $query_user = $this->db->get();
                        $row_user = $query_user->num_rows();

                        if ($row_user > 0):


                            $this->db->from('lances');
                            $this->db->where('id_leilao', $_POST['leilao']);
                            $this->db->order_by('id', 'desc');
                            $this->db->limit(1, 0);
                            $query_user1 = $this->db->get();
                            $row_user1 = $query_user1->num_rows();

                            if ($query_user1->result_array()[0]['id_user'] == $_SESSION['ID']):
                                if ($result_prod[0]['read'] == 0) {
                                    $ddos['read'] = 1;
                                    $this->db->where('id_leilao', $_POST['leilao']);
                                    $this->db->update('lances', $ddos);
                                    echo 3;

                                } else {

                                    echo 0;
                                }

                            else:

                                if ($result_prod[0]['read'] == 0) {

                                    $ddos['read'] = 1;
                                    $this->db->where('id_leilao', $_POST['leilao']);
                                    $this->db->update('lances', $ddos);
                                    echo 2;

                                } else {

                                    echo 0;
                                }
                            endif;


                        else:
                            echo 1;

                        endif;


                    else:

                        echo 0;

                    endif;

                endif;
            else:
                echo 1;
            endif;
        else:
            echo 0;
        endif;
    }

    public function checkln(){


        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):


                $this->db->from('report_lance');
                $this->db->where('id_leilao', $_POST['leilao']);
                $this->db->where('id_user', $_SESSION['ID']);
                $this->db->where('status', 0);
                $query_lei = $this->db->get();

                if($query_lei->num_rows() > 0):

                    $dp['status'] = 1;
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $this->db->where('id_user', $_SESSION['ID']);
                    $this->db->update('report_lance',$dp);



                    echo 1;
                else:

                    $this->db->from('leiloes');
                    $this->db->where('id', $_POST['leilao']);
                    $this->db->where('status !=', 1);

                    $query = $this->db->get();

                    if($query->num_rows() > 0):
                        echo 1;
                    else:
                        echo 0;

                    endif;



                endif;


            endif;
        endif;


    }

    public function winner()
    {

        if (isset($_SESSION['ID'])):
            if (isset($_POST['leilao']) and !empty($_POST['leilao'])):
                $this->db->from('leiloes');
                $this->db->where('id', $_POST['leilao']);
                $query_lei = $this->db->get();
                $row_lei = $query_lei->num_rows();

                if ($row_lei > 0):

                    $this->db->from('lances');
                    $this->db->where('id_leilao', $_POST['leilao']);
                    $query_lan = $this->db->get();
                    $row_lan = $query_lan->num_rows();
                    if ($row_lan > 0):
                        $this->db->from('lances');
                        $this->db->where('id_leilao', $_POST['leilao']);
                        $this->db->order_by('id', 'desc');
                        $this->db->limit(1, 0);
                        $query_lan_l = $this->db->get();
                        $row_lan_l = $query_lan_l->num_rows();
                        if ($row_lan_l > 0) {

                            if($query_lan_l->result_array()[0]['id_user'] == $_SESSION['ID']):

                                echo $this->Models_model->winner($_POST['leilao'], $query_lan_l->result_array()[0]['id_user'], $_POST['valor']);

                            else:

                                echo 0;

                            endif;
                        } else {

                            $dpos['status'] = 0;
                            $this->db->where('id', $_POST['leilao']);
                            $this->db->update('leiloes',$dpos);
                            echo 0;

                        }

                    else:

                        $dpos['status'] = 0;
                        $this->db->where('id', $_POST['leilao']);
                        $this->db->update('leiloes',$dpos);
                        echo 0;
                    endif;
                endif;
            endif;
        endif;
    }

    public function trackNew()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):

            if (isset($_POST['url']) and !empty($_POST['url']) and isset($_POST['arr']) and !empty($_POST['arr'])):

                $this->db->from('objetos_correios');
                $this->db->where('item_id', $_POST['arr']);
                $query = $this->db->get();
                if ($query->num_rows() == 0):
                    $dado['code'] = $_POST['url'];
                    $dado['item_id'] = $_POST['arr'];
                    $dado['data_send'] = date('YmdHis');
                    $this->db->insert('objetos_correios', $dado);
                endif;
            endif;
        endif;
    }

    public function trackNewup()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):

            if (isset($_POST['url']) and !empty($_POST['url']) and isset($_POST['arr']) and !empty($_POST['arr'])):
                $dado['code'] = $_POST['url'];
                $dado['data_send'] = date('YmdHis');
                $this->db->where('item_id', $_POST['arr']);
                $this->db->update('objetos_correios', $dado);
            endif;
        endif;
    }

    public function done()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if (isset($_GET['id']) and !empty($_GET['id'])):

                $db['done'] = 1;
                $this->db->where('id', $_GET['id']);
                if ($this->db->update('leiloes', $db)):
                    $db2['submit'] = 3;
                    $this->db->where('id_obj_compra', $_GET['id']);
                    $this->db->update('compras', $db2);

                    $db3['status'] = 5;

                    $this->db->where('id', $_GET['id']);
                    $this->db->update('leiloes', $db3);
                    redirect(base_url('adm/leiloes'), 'refresh');



                else:

                    redirect(base_url('adm/leiloes'), 'refresh');

                endif;


            endif;
        endif;

    }

    public function lbcnd()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if (isset($_GET['id']) and !empty($_GET['id'])):

                $db['type'] = 53;
                $this->db->where('id', $_GET['id']);
                if ($this->db->update('user', $db)):

                    redirect(base_url('adm/clientes'), 'refresh');

                else:

                    redirect(base_url('adm/clientes'), 'refresh');

                endif;


            endif;
        endif;

    }

    public function bbcnd()
    {
        if (isset($_SESSION['ID']) and $_SESSION['TYPE'] == 54):
            if (isset($_GET['id']) and !empty($_GET['id'])):

                $db['type'] = 1;
                $this->db->where('id', $_GET['id']);
                if ($this->db->update('user', $db)):

                    redirect(base_url('adm/clientes'), 'refresh');

                else:

                    redirect(base_url('adm/clientes'), 'refresh');

                endif;


            endif;
        endif;

    }

    public function API()
    {

        if (isset($_GET['token']) and isset($_GET['method']) and isset($_GET['code']) and !empty($_GET['token']) and !empty($_GET['code']) and !empty($_GET['method'])):
            var_dump($this->Models_model->API($_GET['token'], $_GET['code'], $_GET['method']));

        else:
            echo 0;
        endif;
    }


    public function sendWin()
    {

        if (isset($_GET['tp']) and isset($_GET['id']) and !empty($_GET['tp']) and !empty($_GET['id'])):
            if (isset($_SESSION['ID'])):

                if($_GET['tp'] <> 3):
                    $dado['submit'] = $_GET['tp'];
                    $this->db->where('id_obj_compra', $_GET['id']);
                    $this->db->where('id_user', $_SESSION['ID']);
                    if ($this->db->update('compras', $dado)):
                        redirect(base_url('meus-arremates'), 'refresh');
                    else:
                        redirect(base_url('home'), 'refresh');

                    endif;
                else:

                    $this->db->from('leiloes');
                    $this->db->where('id',$_GET['id']);
                    $this->db->where('winner',$_SESSION['ID']);
                    $query = $this->db->get();
                    if($query->num_rows()):

                        $this->Models_model->cupon($_SESSION['ID'],$_GET['id'],$_GET['id']);

                        $dp['status'] = 4;
                        $this->db->where('id',$_GET['id']);
                        $this->db->update('leiloes',$dp);

                        /*
                        $this->db->where('id_obj_compra',$_GET['id']);
                        $this->db->where('id_user',$_SESSION['ID']);
                        $this->db->delete('compras');

                        $this->db->where('id_arremate',$_GET['id']);
                        $this->db->where('id_user',$_SESSION['ID']);
                        $this->db->delete('arremates');
*/
                        redirect(base_url('minha-conta'), 'refresh');
                        redirect(base_url('minha-contatp'), 'refresh');

                    endif;

                endif;

            endif;
        endif;

    }

    public function retirada()
    {

        if(isset($_GET['item']) and isset($_SESSION['ID'])):

            $this->db->from('compras');
            $this->db->where('id_obj_compra',$_GET['item']);
            $this->db->where('submit',2);
            $query = $this->db->get();
            if($query->num_rows() > 0):

                if($query->result_array()[0]['id_user'] == $_SESSION['ID']):
                    $this->load->library('functions');
                    $log = $this->Models_model->logVer();
                    $do['page'] = 'invice';
                    $do['status'] = $log;
                    $this->load->view('pages/user/account/invoce',$do);
                endif;
            else:
                redirect(base_url('meus-arremates'), 'refresh');

            endif;
        else:
            @session_destroy();
            redirect(base_url('login'), 'refresh');

        endif;

    }



    public function teste()
    {

        echo $this->Models_model->addcredit($_SESSION['ID']);
    }
}
