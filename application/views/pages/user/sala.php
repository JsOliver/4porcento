<?php

defined('BASEPATH') OR exit('No direct script access allowed');



if($page == 'sala'):
    $this->load->view('fixed_files/user/header');
    ?>


    <!--=== Shop Product ===-->
    <div class="shop-product" xmlns="http://www.w3.org/1999/html">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Products</a></li>
                <li class="active">New</li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->

        <div class="container">
            <div class="row">
                <div class="col-md-4 md-margin-bottom-50">
                    <div class="ms-showcase2-template">
                        <!-- Master Slider -->
                        <div class="master-slider ms-skin-default" id="masterslider">
                            <div class="ms-slide">
                                <img class="ms-brd" src="assets/img/blank.gif" data-src="assets/img/blog/28.jpg" alt="lorem ipsum dolor sit">
                                <img class="ms-thumb" src="assets/img/blog/28-thumb.jpg" alt="thumb">
                            </div>
                            <div class="ms-slide">
                                <img src="assets/img/blank.gif" data-src="assets/img/blog/29.jpg" alt="lorem ipsum dolor sit">
                                <img class="ms-thumb" src="assets/img/blog/29-thumb.jpg" alt="thumb">
                            </div>
                            <div class="ms-slide">
                                <img src="assets/img/blank.gif" data-src="assets/img/blog/30.jpg" alt="lorem ipsum dolor sit">
                                <img class="ms-thumb" src="assets/img/blog/30-thumb.jpg" alt="thumb">
                            </div>
                        </div>
                        <!-- End Master Slider -->
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="shop-product-heading">
                        <h2>Corinna Foley</h2>

                    </div><!--/end shop product social-->


                    <p>Integer <strong>dapibus ut elit</strong> non volutpat. Integer auctor purus a lectus suscipit fermentum. Vivamus lobortis nec erat consectetur elementum.</p><br>

                    <ul class="list-inline shop-product-prices margin-bottom-30">
                        <li class="shop-red">$57.00</li>
                        <li class="line-through">$70.00</li>
                        <li><small class="shop-bg-red time-day-left">4 days left</small></li>
                    </ul><!--/end shop product prices-->

                    <script type="text/javascript">
                        $("#restante")
                            .countdown("2017/01/05 10:02:19", function(event) {
                                $(this).text(
                                    event.strftime('%D dias %H:%M:%S')
                                );
                            });
                    </script>



                    <h3 class="shop-product-title">Tempo restante</h3>
                    <div class="margin-bottom-40">
<span id="restante" class="btn-u btn-u-sea-shop btn-u-lg" style="background: #98acff;">0 segundos</span>
                        <button type="button" class="btn-u btn-u-sea-shop btn-u-lg">Dar lance</button>
                    </div><!--/end product quantity-->

                    <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                        <li class="wishlist-in">
                            <i class="fa fa-eye"></i>
                            <a href="#">Ultimos Lances</a>
                        </li>
                        <li class="compare-in">

                        </li>
                    </ul>
                    <p class="wishlist-category"><i class="fa fa-hand-o-up"></i> <strong>JonyCash</strong> clicou</p>
                    <p class="wishlist-category"><i class="fa fa-hand-o-up"></i> <strong>Marciaryb</strong> clicou</p>
                    <p class="wishlist-category"><i class="fa fa-hand-o-up"></i> <strong>Marcelogonzaga</strong> clicou</p>
                </div>

                <style>
                    body{
                        overflow-x: hidden;
                    }
                    .chat
                    {
                        list-style: none;
                        margin: 0;
                        padding: 0;

                    }

                    .chat li
                    {
                        margin-bottom: 10px;
                        padding-bottom: 5px;
                        border-bottom: 1px dotted #B3A9A9;
                    }

                    .chat li.left .chat-body
                    {
                        margin-left: 60px;
                    }

                    .chat li.right .chat-body
                    {
                        margin-right: 60px;
                    }


                    .chat li .chat-body p
                    {
                        margin: 0;
                        color: #777777;
                    }

                    .panel .slidedown .glyphicon, .chat .glyphicon
                    {
                        margin-right: 5px;
                    }

                    .panel-body
                    {
                        overflow-y: scroll;
                        height: 400px;
                    }

                    .panel-body ::-webkit-scrollbar-track
                    {
                        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                        background-color: #F5F5F5;
                    }

                    .panel-body   ::-webkit-scrollbar
                    {
                        width: 12px;
                        background-color: #F5F5F5;
                    }

                    .panel-body  ::-webkit-scrollbar-thumb
                    {
                        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                        background-color: #555;
                    }

                    textarea
                    {
                        resize: none;
                    }
                </style>
                <div  class="col-md-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel ">

                                    <div class="panel-collapse collapse in" id="collapseOne">
                                        <div class="panel-body">
                                            <ul class="chat">
                                                <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=US" alt="User Avatar" class="img-circle" />
                        </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                                                <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                                        </div>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                                            dolor, quis ullamcorper ligula sodales.
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=EU" alt="User Avatar" class="img-circle" />
                        </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                                        </div>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                                            dolor, quis ullamcorper ligula sodales.
                                                        </p>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="input-group">
                                                <textarea id="txtArea" cols="50" rows="3" class="form-control input-sm" placeholder="Digite sua mensagem aqui..." ></textarea>

                                                <script>
                                                    $("#txtArea").on("keypress",function(e) {
                                                        var key = e.keyCode;

                                                    // If the user has pressed enter
                                                       if (key == 13) {
                                                        document.getElementById("txtArea").value =document.getElementById("txtArea").value + "\n";
                                                           alert('ok');
                                                        return false;
                                                    }
                                                    else {
                                                        return true;
                                                    }
                                                    });
                                                    </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!--/end row-->
        </div>

    </div>
    <!--=== End Shop Product ===-->


<?php
    $this->load->view('fixed_files/user/footer');

endif;

?>

