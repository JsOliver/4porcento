<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--=== Shop Suvbscribe ===-->
<div class="shop-subscribe">
    <div class="container">
        <div class="row">
            <div class="col-md-8 md-margin-bottom-20">
                <h2>Se inscreva e para receber <strong>emails</strong> de promoções</h2>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Seu e-mail...">
                    <span class="input-group-btn">
							<button class="btn" type="button"><i class="fa fa-envelope-o"></i></button>
						</span>
                </div>
            </div>
        </div>
    </div><!--/end container-->
</div>
<!--=== End Shop Suvbscribe ===-->
<!--=== Footer v4 ===-->
<div class="footer-v4">

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <?php echo date('Y'); ?> &copy; Todos os direitos reservados.
                        Desenvolvido por <a href="http://rjcriacaodesites.com.br" target="_blank">RJ Criação de
                            Sites</a>
                    </p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline sponsors-icons pull-right">
                        <li><i class="fa fa-money"></i></li>
                        <li><i class="fa fa-cc-visa"></i></li>
                        <li><i class="fa fa-cc-mastercard"></i></li>
                        <li><i class="fa fa-cc-discover"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--/copyright-->
</div>
<!--=== End Footer v4 ===-->
</div><!--/wrapper-->

<!-- Wait Block
<div class="g-popup-wrapper">
    <div class="g-popup g-popup--discount2">
        <div class="g-popup--discount2-message">
            <h3>Want 10% Off?</h3>
            <h4>You Are Fabulous!</h4>
            <p>Get 10% Off Your Next Purchase! Just Type Email Below!</p>

            <form action="#" class="sky-form">
                <label class="input">
                    <input type="email" placeholder="Email" class="form-control">
                </label>
                <label class="input">
                    <button class="btn btn-default" type="button">Subscribe</button>
                </label>
            </form>
        </div>
        <img src="assets/img/blog/26.jpg" alt="ALT" width="270">
        <a href="javascript:void(0);" class="g-popup__close g-popup--discount2__close"><span class="icon-close" aria-hidden="true"></span></a>
    </div>
</div>
<!-- End Wait Block -->
<?php

if ($page == 'sala'):
    ?>

    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>/assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Master Slider -->
    <script src="<?php echo base_url(); ?>/assets/plugins/master-slider/masterslider/masterslider.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/master-slider/masterslider/jquery.easing.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>/assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/owl-carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/master-slider.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/forms/product-quantity.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/style-switcher.js"></script>
    <script>
        jQuery(document).ready(function () {
            App.init();
            App.initScrollBar();
            OwlCarousel.initOwlCarousel();
            StyleSwitcher.initStyleSwitcher();
            MasterSliderShowcase2.initMasterSliderShowcase2();
        });
    </script>

    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>/assets/plugins/respond.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/html5shiv.js"></script>
    <script src="<?php echo base_url();?>/assets/js/plugins/placeholder-IE-fixes.js"></script>
    <![endif]-->

<?php endif; ?>
<?php if ($page == 'home' or $page = 'compra'): ?>
    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>/assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery.parallax.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script
        src="<?php echo base_url(); ?>/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script
        src="<?php echo base_url(); ?>/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>/assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/owl-carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/revolution-slider.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/style-switcher.js"></script>

    <!-- Countdown -->


    <script>
        jQuery(document).ready(function () {
            App.init();
            App.initScrollBar();
            App.initParallaxBg();
            OwlCarousel.initOwlCarousel();
            RevolutionSlider.initRSfullWidth();
            StyleSwitcher.initStyleSwitcher();
        });
    </script>

    <script src="<?php echo base_url(); ?>/assets/plugins/respond.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/placeholder-IE-fixes.js"></script>

<?php endif; ?>

<?php if($page == 'arrematados' and !isset($_GET['info'])):?>

    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>/assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery.parallax.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script
        src="<?php echo base_url(); ?>/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script
        src="<?php echo base_url(); ?>/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>/assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/owl-carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/revolution-slider.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/style-switcher.js"></script>

    <!-- Countdown -->


    <script>
        jQuery(document).ready(function () {
            App.init();
            App.initScrollBar();
            App.initParallaxBg();
            OwlCarousel.initOwlCarousel();
            RevolutionSlider.initRSfullWidth();
            StyleSwitcher.initStyleSwitcher();
        });
    </script>

    <script src="<?php echo base_url(); ?>/assets/plugins/respond.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/placeholder-IE-fixes.js"></script>

<?php endif;?>
<?php if ($page == 'account' or $page == 'configuracoes'  or $page == 'pagamentos'): ?>
    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>/assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery.parallax.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script
        src="<?php echo base_url(); ?>/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script
        src="<?php echo base_url(); ?>/assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>/assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/owl-carousel.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/revolution-slider.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/style-switcher.js"></script>

    <!-- Countdown -->


    <script>
        jQuery(document).ready(function () {
            App.init();
            App.initScrollBar();
            App.initParallaxBg();
            OwlCarousel.initOwlCarousel();
            RevolutionSlider.initRSfullWidth();
            StyleSwitcher.initStyleSwitcher();
        });
    </script>

    <script src="<?php echo base_url(); ?>/assets/plugins/respond.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/placeholder-IE-fixes.js"></script>

<?php endif; ?>


<?php

if ($page == 'login'):

    ?>

    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>/assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>/assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/forms/page_login.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/style-switcher.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/forms/page_contact_form.js"></script>
    <script>
        jQuery(document).ready(function () {
            App.init();
            Login.initLogin();
            App.initScrollBar();
            StyleSwitcher.initStyleSwitcher();
            PageContactForm.initPageContactForm();
        });
    </script>

    <script src="<?php echo base_url(); ?>/assets/plugins/respond.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/plugins/placeholder-IE-fixes.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>


    <script src="<?php echo base_url(); ?>/assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>


<?php endif; ?>


<?php
if ($page == 'register'):
    ?>

    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/style-switcher.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/forms/page_registration.js"></script>
    <script>
        jQuery(document).ready(function () {
            App.init();
            App.initScrollBar();
            Registration.initRegistration();
            StyleSwitcher.initStyleSwitcher();
        });
    </script>
<?php endif; ?>


<?php

if ($page == 'leiloes'):

    ?>
    <!-- JS Global Compulsory -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script src="<?php echo base_url(); ?>assets/plugins/back-to-top.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/smoothScroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/noUiSlider/jquery.nouislider.all.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- JS Customization -->
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <!-- JS Page Level -->
    <script src="<?php echo base_url(); ?>assets/js/shop.app.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/mouse-wheel.js"></script>
    <script src="assets/js/plugins/style-switcher.js"></script>
    <script>
        jQuery(document).ready(function () {
            App.init();
            App.initScrollBar();
            MouseWheel.initMouseWheel();
            StyleSwitcher.initStyleSwitcher();
        });
    </script>

<?php endif; ?>
</body>
</html>

