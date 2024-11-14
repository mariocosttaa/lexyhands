
  <!-- Main Footer -->
  <footer class="main-footer">

    <!--Widgets Section-->
    <div class="widgets-section">
      <div class="footer1-1 bounce-x"></div>
      <div class="auto-container">
        <div class="row">

          <!--Footer Column-->
          <div class="footer-column col-lg-4 col-sm-6 order-1">
            <div class="footer-widget timetable-widget">
              <h3 class="widget-title">Open Hours</h3>
              <ul class="timetable">
                <li>Monday to Friday : <span>09:00-20:00</span></li>
                <li>Saturday: <span>09:00-18:00</span></li>
                <li>Sunday: <span>09:00-18:00</span></li>
              </ul>
            </div>
          </div>

          <!--Footer Column-->
          <div class="footer-column col-lg-4 col-sm-6 order-0 order-lg-1">
            <div class="footer-widget about-widget text-center">
              <div class="logo"><a href="index.html"><img src="public/assets/images/logo-2.png" alt=""></a></div>
              <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, seddo eiusmod tempor incididunt ut labore et dolore</div>
              <ul class="social-icon">
                <li><a href="#"><i class="icon fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="icon fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="icon fab fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="icon fab fa-vimeo-v"></i></a></li>
              </ul>
            </div>
          </div>

          <!--Footer Column-->
          <div class="footer-column col-lg-4 col-sm-6 order-2">
            <div class="footer-widget contacts-widget">
              <h3 class="widget-title">Contact</h3>
              <div class="text">2972 Westheimer Rd. Santa Ana, <br> Illinois 85486</div>
              <ul class="contact-info">
                <li><a href="tel:555-0101">(907)555-0101</a></li>
                <li><a href="/cdn-cgi/l/email-protection#126b7d676076777f7d52717d7f62737c6b3c717d7f"><span class="__cf_email__" data-cfemail="c7bea8b2b5a3a2aaa887a4a8aab7a6a9bee9a4a8aa">[email�&nbsp;protected]</span></a></li>
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
          <figure class="image"><img src="public/assets/images/footer-bottom-img-1.png" alt="Image"></figure>
          <div class="copyright-text">© Purerelax, <a href="index.html">Reserved By Kodesolution</a></div>
          <a class="link" href="index.html">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </footer>
  <!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<script data-cfasync="false" src="public/assets/js/email-decode.min.js"></script><script src="public/assets/js/jquery.js"></script> 
<script src="public/assets/js/popper.min.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/jquery.fancybox.js"></script>
<script src="public/assets/js/jquery-ui.js"></script>
<script src="public/assets/js/mixitup.js"></script>
<script src="public/assets/js/gsap.min.js"></script>
<script src="public/assets/js/ScrollTrigger.min.js"></script>
<script src="public/assets/js/splitType.js"></script>
<script src="public/assets/js/wow.js"></script>
<script src="public/assets/js/select2.min.js"></script>
<script src="public/assets/js/appear.js"></script>
<script src="public/assets/js/swiper.min.js"></script>
<script src="public/assets/js/owl.js"></script>
<script src="public/assets/js/script.js"></script>
<!-- form submit -->
<script src="public/assets/js/jquery.validate.min.js"></script>
<script src="public/assets/js/jquery.form.min.js"></script>
<script>
  (function($) {
    $("#contact_form").validate({
      submitHandler: function(form) {
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = '#form-result';
        $(form_result_div).remove();
        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
        $(form).ajaxSubmit({
          dataType:  'json',
          success: function(data) {
            if( data.status == 'true' ) {
              $(form).find('.form-control').val('');
            }
            form_btn.prop('disabled', false).html(form_btn_old_msg);
            $(form_result_div).html(data.message).fadeIn('slow');
            setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
          }
        });
      }
    });
  })(jQuery);
</script>

</body></html>