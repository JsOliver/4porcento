<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions {
    public function __construct()
    {
    }
    public function logVer(){


        @session_start();

        if(isset($_SESSION['Auth01']) and isset($_SESSION['NAME']) and isset($_SESSION['EMAIL'])
            and isset($_SESSION['PASS']) and isset($_SESSION['ID'])):

//Aqui tera uma verificação dos dados no banco de dados


                return true;
        else:

            return false;

        endif;


    }



}