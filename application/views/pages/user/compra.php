<?php
if($page == 'compra'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');

?>

    <br>
    <div class="container">

        <div class="row margin-bottom-60">
            <?php for($p=0;$p<6;$p++):?>

        <div class="col-md-4 product-service">
            <div class="product-service-heading">
                <i class="fa fa-money"></i>
            </div>
            <div class="product-service-in">
                <h3>0 créditos</h3>
                <p>0 créditos para participar de leilões</p>
                <a href="#">Comprar por <b>R$ 0,00</b></a>
            </div><br>
        </div><?php endfor;?>
    </div>

</div>
<?php

    $this->load->view('fixed_files/user/footer');

endif;

?>
