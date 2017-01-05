<?php
if ($page == 'account'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');
    $data_atual_system = date('YmdHis');

?>


<?php

    $this->load->view('fixed_files/user/footer');

endif;
?>
