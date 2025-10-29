  <!-- Main Footer -->
  <footer class="main-footer footer-style-two">
    <div class="bg bg-image" style="background-image:url(/assets/images/background/bg-footer1.jpg);"></div>

    <!--Widgets Section-->
    <div class="widgets-section">
      <div class="footer1-1 bounce-x"></div>
      <div class="footer-pattrn1 bounce-y"></div>
      <div class="auto-container">
        <div class="row">

          <!--Footer Column-->
          <div class="footer-column col-xl-3  col-lg-6 col-md-6 col-sm-6">
            <div class="footer-widget about-widget">

            <?php if ($settings->show_logo == true && $settings->site_logo !== null) { ?>
              <div class="logo">
                <a href="/"><img src="/assets/images/logo.png" alt=""></a>
              </div>
            <?php } else { ?>
              <div class="logo">
                <a href="/projects/lexyhands">
                  <?php echo $settings->site_name ?>
                </a>
              </div>
            <?php } ?>
             

              <div class="text">Desfrute das melhores experiências de terapia e massagem.</div>
              <div class="subscribe-form">
                <form method="post" action="#">
                  <div class="form-group">
                    <input type="email" name="email" class="email" value="" placeholder="Escreva o seu Email" required="">
                    <button type="button" class="theme-btn"><span class="btn-title"><i class="fa-sharp fa-thin fa-paper-plane"></i></span></button>
                  </div>
                </form>
              </div>
              <ul class="social-icon">
                <li><a href="#"><i class="icon fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="icon fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="icon fab fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="icon fab fa-vimeo-v"></i></a></li>
              </ul>
            </div>
          </div>

          <!--Footer Column-->
          <div class="footer-column col-xl-3  col-lg-6 col-md-6 col-sm-6">
            <div class="footer-widget links-widget">
              <h3 class="widget-title">Links</h3>
              <ul class="user-links">
                <li><a href="/projects/lexyhands">Início</a></li>
                <li><a href="/../services">Serviços</a></li>
                <li><a href="/../posts">Comunidade</a></li>
                <li><a href="/../contacts">Contactos</a></li>
              </ul>
            </div>
          </div>

          <!--Footer Column-->
          <div class="footer-column col-xl-3  col-lg-6 col-md-6 col-sm-6">
            <div class="footer-widget timetable-widget">
              <h3 class="widget-title">Disponibilidade</h3>
              <ul class="timetable">
                <li>Horários: 11:00h às 20:00h</li>
              </ul>
            </div>
          </div>

          <!--Footer Column-->
          <div class="footer-column col-xl-3  col-lg-6 col-md-6 col-sm-6">
            <div class="footer-widget contacts-widget">
              <h3 class="widget-title">Contactos</h3>
              <div class="text">InCalls e OutCalls</div>
              <ul class="contact-info">
                <li><a class="text-style-two" href="tel:555-0101">+351 962674341</a></li>
                <li><a class="text-style-two">geral@lexyhands.com</a></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
      <div class="auto-container">
        <div class="inner-container">
          <div class="copyright-text"> Copyright &copy; <?php echo getUserDateTime(date('Y'), 'Y') ?> <?php echo $settings->site_name ?>. All Rights Reserved  <a href="https://bindamy.com">By Bindamy.com</a></div>
        </div>
      </div>
    </div>
  </footer>
  <!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<script data-cfasync="false" src="/../public/assets/js/email-decode.min.js"></script><script src="/../public/assets/js/jquery.js"></script> 


<!--Revolution Slider-->
<script src="/../public/assets/js/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="/../public/assets/js/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="/../public/assets/js/main-slider-script.js"></script>
<!--Revolution Slider-->

<script src="/../public/assets/js/popper.min.js"></script>
<script src="/../public/assets/js/bootstrap.min.js"></script>
<script src="/../public/assets/js/jquery.fancybox.js"></script>
<script src="/../public/assets/js/jquery-ui.js"></script>
<script src="/../public/assets/js/mixitup.js"></script>
<script src="/../public/assets/js/gsap.min.js"></script>
<script src="/../public/assets/js/ScrollTrigger.min.js"></script>
<script src="/../public/assets/js/splitType.js"></script>
<script src="/../public/assets/js/wow.js"></script>
<script src="/../public/assets/js/select2.min.js"></script>
<script src="/../public/assets/js/appear.js"></script>
<script src="/../public/assets/js/swiper.min.js"></script>
<script src="/../public/assets/js/owl.js"></script>
<script src="/../public/assets/js/script.js"></script>
<!-- form submit -->
<script src="/../public/assets/js/jquery.validate.min.js"></script>
<script src="/../public/assets/js/jquery.form.min.js"></script>


</body></html>