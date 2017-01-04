<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('fixed_files/user/header');


if($page == 'home'):
    $data_atual_system = date('YmdHis');


    ?>
    <!--=== Slider ===-->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 1">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/1.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch1 sft start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="100"
                         data-speed="1500"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endeasing="Power1.easeIn"
                         data-endspeed="300">
                        The New <br>
                        <strong>Collection</strong><br>
                        is here
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                         data-x="center"
                         data-hoffset="0"
                         data-y="380"
                         data-speed="1600"
                         data-start="1800"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Shop Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/5.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch3 sft start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="140"
                         data-speed="1500"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endeasing="Power1.easeIn"
                         data-endspeed="300">
                        Latest <strong>Fashion</strong> Trends
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch4 sft"
                         data-x="center"
                         data-hoffset="-14"
                         data-y="210"
                         data-speed="1400"
                         data-start="2000"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        Cras non dui et quam auctor pretium.<br>
                        Aenean enim tortr, tempus et iteus m
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                         data-x="center"
                         data-hoffset="0"
                         data-y="300"
                         data-speed="1600"
                         data-start="1800"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Shop Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 3">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/3.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch3 sft start"
                         data-x="right"
                         data-hoffset="5"
                         data-y="130"
                         data-speed="1500"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endeasing="Power1.easeIn"
                         data-endspeed="300">
                        <strong>Luxury</strong> Watches
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch4 sft"
                         data-x="right"
                         data-hoffset="0"
                         data-y="210"
                         data-speed="1400"
                         data-start="2000"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        lectus. Cras non dui et quam auctor.<br>
                        Aenean enim tortor, tempus et im
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                         data-x="right"
                         data-hoffset="0"
                         data-y="300"
                         data-speed="1600"
                         data-start="2800"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Shop Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 4">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/2.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch1 sft start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="100"
                         data-speed="1500"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endeasing="Power1.easeIn"
                         data-endspeed="300">
                        Girl's Accesories
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch2 sft"
                         data-x="center"
                         data-hoffset="0"
                         data-y="280"
                         data-speed="1400"
                         data-start="2000"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        Super Promo
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                         data-x="center"
                         data-hoffset="0"
                         data-y="370"
                         data-speed="1600"
                         data-start="2800"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">View More</a>
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Shop Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->

                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 5">
                    <!-- MAIN IMAGE -->
                    <img src="assets/img/4.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

                    <div class="tp-caption revolution-ch5 sft start"
                         data-x="right"
                         data-hoffset="5"
                         data-y="130"
                         data-speed="1500"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endeasing="Power1.easeIn"
                         data-endspeed="300">
                        <strong>Jeans</strong> Collection
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption revolution-ch4 sft"
                         data-x="right"
                         data-hoffset="-14"
                         data-y="210"
                         data-speed="1400"
                         data-start="2000"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        Cras non dui et quam auctor pretium.<br>
                        Aenean enim tortr, tempus et iteus m
                    </div>

                    <!-- LAYER -->
                    <div class="tp-caption sft"
                         data-x="right"
                         data-hoffset="0"
                         data-y="300"
                         data-speed="1600"
                         data-start="2800"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">
                        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Shop Now</a>
                    </div>
                </li>
                <!-- END SLIDE -->
            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
        </div>
    </div>
    <!--=== End Slider ===-->

    <!--=== Inicio - Leilões ===-->
    <div class="container content-md">

<?php

$sql = "SELECT * FROM leiloes WHERE inicio_data < ? AND status=? LIMIT 0,15";
$query =  $this->db->query($sql, array($data_atual_system,1));
$count = $query->num_rows();

if($count > 0):
?>

        <!--===Inicio - Leilões que o usuario pode entrar  ===-->

        <div class="heading heading-v1 margin-bottom-20">
            <h2>Leilões disponiveis</h2>

        </div>

        <div class="illustration-v2 margin-bottom-60">


            <ul class="list-inline owl-slider">
                <?php

                $result = $query->result_array();
                foreach ($result as $dds){
                    $ind = $dds['inicio_data'];
                    $ano = substr($ind, 0, 4);
                    $mes = substr($ind, 4, 2);
                    $dia = substr($ind, 6, 2);
                    $hora = substr($ind, 8, 2);
                    $minuto = substr($ind, 10, 2);
                    $segundo = substr($ind, 12, 2);

                    $data_inicio_system = $ano.$mes.$dia.$hora.$minuto.$segundo;


                    ?>
                    <li class="item">
                        <div class="product-img">
                            <a href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><img class="full-width img-responsive" src="<?php echo base_url('pages/exibir?id='.$dds['id']);?>" alt="" style="height: 300px;object-fit: cover; object-position: center;"></a>
                            <a class="product-review" href="<?php echo base_url('sala?p='.$dds['id'].'');?>">0 pessoas online</a>
                        </div>
                        <div class="product-description product-description-brd">
                            <div class="overflow-h margin-bottom-5">
                                <div class="pull-left">
                                    <h4 class="title-price"><a href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><?php echo $dds['title'];?></a></h4>
                                    <?php
                                    if(!empty($dds['cidade']) and !empty($dds['estado'])):
                                    ?>
                                    <span class="gender text-uppercase"><small><?php echo $dds['cidade'];?> - <b><?php echo $dds['estado'];?></b> </small></span>
                                        <?php endif;?>
                                    <span class="gender" title="<?php echo $dds['breve_descricao'];?>"><?php echo $this->Models_model->limitarTexto($dds['breve_descricao'],30);?></span>
                                </div>
                                <div class="product-price">
                                    <!--Inicio - Preço atual -->
                                    <span class="title-price">R$ <?php echo $dds['valor_leilao'];?></span>
                                    <!--Fim - Preço atual -->

                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>

            </ul>
        </div>

        <!--===Fim - Leilões que o usuario pode entrar  ===-->
<?php endif;?>

<?php
$sql = "SELECT * FROM leiloes WHERE inicio_data > ? AND status=? LIMIT 0,15";
$query =  $this->db->query($sql, array($data_atual_system,1));
$count = $query->num_rows();

$count = $query->num_rows();
if($count > 0):
?>
        <!--===Inicio - Leilões que o usuario pode entrar mais tarde  ===-->

        <div class="heading heading-v1 margin-bottom-20">
            <h2>Proximos leilões</h2>

        </div>

        <div class="illustration-v2 margin-bottom-60">


            <ul class="list-inline owl-slider">
                <?php

                $result = $query->result_array();
                foreach ($result as $dds){
                    $ind = $dds['inicio_data'];
                    $ano = substr($ind, 0, 4);
                    $mes = substr($ind, 4, 2);
                    $dia = substr($ind, 6, 2);
                    $hora = substr($ind, 8, 2);
                    $minuto = substr($ind, 10, 2);
                    $segundo = substr($ind, 12, 2);



                ?>
                    <li class="item">
                        <div class="product-img">
                            <a href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><img class="full-width img-responsive" src="<?php echo base_url('pages/exibir?id='.$dds['id']);?>" style="height: 300px; object-fit: cover; object-position: center;" alt=""></a>
                            <a class="product-review"  href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><b>Começa em:</b> <span id="start<?php echo $dds['id'];?>"></span></a>
                        </div>
                        <div class="product-description product-description-brd">
                            <div class="overflow-h margin-bottom-5">
                                <div class="pull-left">
                                    <h4 class="title-price"><a href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><?php echo $dds['title'];?></a></h4>
                                    <span class="gender text-uppercase">Valor: <b>R$ <?php echo $dds['valor_leilao'];?></b></span>
                                </div>
                                <div class="product-price">
                                    <!--Inicio - Preço atual -->
                                    <!--Fim - Preço atual -->

                                </div>
                            </div>
                        </div>
                    </li>
                    <script type="text/javascript">
                        $("#start<?php echo $dds['id']; ?>")
                            .countdown("<?php echo $ano;?>/<?php echo $mes;?>/<?php echo $dia;?> <?php echo $hora;?>:<?php echo $minuto;?>:<?php echo $segundo;?>", function(event) {
                                $(this).text(
                                    event.strftime('%D dias %H:%M:%S')
                                );
                            });
                    </script>



                <?php } ?>
            </ul>
        </div>


        <!--===Fim - Leilões que o usuario pode entrar mais tarde ===-->

        <?php endif;?>
        <?php
        $sql = "SELECT * FROM leiloes WHERE status=? OR status=? LIMIT 0,15";
        $query =  $this->db->query($sql, array(0,2555));
        $count = $query->num_rows();
        if($count > 0):

            ?>
        <!--=== Inicio Leilões Finalizados ===-->


        <div class="heading heading-v1 margin-bottom-40">
            <h2>Leilões finalizados</h2>
        </div>

        <div class="illustration-v2 margin-bottom-60">


            <ul class="list-inline owl-slider">
                <?php


                $result = $query->result_array();
                foreach ($result as $dds){
                ?>
                    <li class="item">
                        <div class="product-img">
                            <a href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><img class="full-width img-responsive" src="<?php echo base_url('pages/exibir?id='.$dds['id']);?>" alt="" style="height: 300px;object-fit: cover; object-position: center;"></a>
                            <?php if($dds['status'] == 0):?>
                                <a class="product-review" href="<?php echo base_url('sala?p='.$dds['id'].'');?>">Finalizado</a>
                            <?php endif;?>

                            <?php if($dds['status'] == 2555):?>
                                <a class="product-review" href="<?php echo base_url('sala?p='.$dds['id'].'');?>">Arrematado</a>
                            <?php endif;?>
                        </div>
                        <div class="product-description product-description-brd">
                            <div class="overflow-h margin-bottom-5">
                                <div class="pull-left">
                                    <h4 class="title-price"><a href="<?php echo base_url('sala?p='.$dds['id'].'');?>"><?php echo $dds['title'];?></a></h4>
                    <?php if($dds['status'] == 2555):?>

                        <?php
                        if($dds['winner'] == 0):

                        ?>

                        <span class="gender">Vencedor: <b>Indisponivel</b></span>
<?php else:

                            $this->db->from('user');
                            $this->db->where('id',$dds['winner']);
                            $query1 = $this->db->get();
                            $count = $query1->num_rows();
                            $result = $query1->result_array();
                            if($count > 0):

                            ?>
                            <span class="gender">Vencedor: <b><?php echo $result[0]['username'];?></b></span>

                        <?php

                            else:
                                ?>

                                <span class="gender">Vencedor: <b>Indisponivel</b></span>


                                <?php

                                endif;
                        endif;
                        endif;
                        ?>
                                </div>
                                <div class="product-price">

                                </div>
                            </div>
                        </div>
                    </li>

                <?php } ?>

            </ul>
        </div>

        <!--=== Fim Leilões Finalizados ===-->

    <?php endif;?>

    </div>
    <!--=== Fim - Leilões ===-->




<?php

    $this->load->view('fixed_files/user/footer');
endif;?>
