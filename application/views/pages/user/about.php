<?php

if ($page == 'sobre'):
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('fixed_files/user/header');

    $this->db->from('textos');
    $this->db->order_by('id', 'desc');
    $this->db->limit(1, 0);
    $query = $this->db->get();
    $row = $query->num_rows();
    $result = $query->result_array();


    $d1_about = $result[0]['d1_about'];
    $cite_about = $result[0]['cite_about'];
    $d2_about = $result[0]['d2_about'];
    $video = $result[0]['video'];
    ?>
    <div class="container content">
        <div class="row margin-bottom-40">
            <div class="
         <?php if (!empty($video)): ?>
        col-md-6
         <?php
            else: ?>
        col-md-12
        <?php
            endif; ?>
         md-margin-bottom-40">
                <p><?php echo $d1_about; ?></p>
                <br>

                <!-- Blockquotes -->
                <blockquote class="hero-unify">
                    <p><?php echo $cite_about; ?></p>

                </blockquote>
            </div>

            <?php if (!empty($video)): ?>
                <div class="col-md-6 md-margin-bottom-40">
                    <div class="responsive-video">
                        <iframe src="https://www.youtube.com/embed/<?php echo $video; ?>" frameborder="0"
                                webkitallowfullscreen mozallowfullscreen="" allowfullscreen=""></iframe>

                    </div>
                </div>

            <?php endif; ?>
        </div><!--/row-->
        <div class="col-md-12 md-margin-bottom-40">
            <p><?php echo $d2_about; ?></p>

            <br>

        </div>


    </div>

    <?php

    $this->load->view('fixed_files/user/footer');

endif; ?>