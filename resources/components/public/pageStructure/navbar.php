<?php

$sql = new \App\Services\SqlEasy();
$settings = $sql->select(table: 'settings', where: null, limit: 1, order: null, object: true);

?>


<!-- Main Header-->
<header class="main-header header-style-one header-style-home5">
  <div class="outer-box">
    <!-- Header Top -->
    <div class="header-top">
      <div class="inner-container">


        <div class="top-left">
          <!-- Info List -->
          <ul class="list-style-one">
            <li>
              <?php if (isset($settings) && isset($settings->contact_email)) { ?>
                <a href="mailto:<?php echo $settings->contact_email ?>"><?php echo $settings->contact_email ?></a>
              <?php } ?>
            </li>
          </ul>
        </div>


        <div class="top-right">

          <ul class="list-style-two">
            <li>Faça já a sua Marcação ! <a class="active" href="https://web.whatsapp.com/send?phone=+351962674341&text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.." target="_blank">Marcar</a></li>
          </ul>

          <ul class="social-icon-one">
            <li><a><span class="icon fab fa-twitter"></span></a></li>
            <li><a><span class="icon fab fa-facebook-f"></span></a></li>
            <li><a><span class="icon fab fa-pinterest-p"></span></a></li>
            <li><a><span class="icon fab fa-vimeo-v"></span></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Header Top -->

    <div class="header-lower">
      <!-- Main box -->
      <div class="main-box">
        <?php if ($settings->show_logo == true && $settings->site_logo !== null) { ?>
          <div class="logo-box">
            <div class="logo"><a href="/projects/lexyhands"><img src="/../public/assets/images/logo.png" alt="Logo"></a></div>
          </div>
        <?php } else { ?>
          <div class="logo-box">
            <div class="logo"><a href="/projects/lexyhands">
                <?php echo $settings->site_name ?>
              </a>
            </div>
          </div>
        <?php } ?>

        <!--Nav Box-->
        <div class="nav-outer">
          <nav class="nav main-menu">
            <ul class="navigation">
              <li><a href="/projects/lexyhands">Início</a></li>
              <li><a href="/../services">Serviços</a></li>
              <li><a href="/../posts">Comunidade</a></li>
              <li><a href="/../contacts">Contactos</a></li>

              <?php if (!$main->user) { ?>
                <li><a href="/../auth/login">Login</a></li>
              <?php } else { ?>
                <li><a href="/../admin/dashboard">Painel de Controle</a></li>
              <?php } ?>

            </ul>
          </nav>
        </div>

        <!-- Outer Box -->
        <div class="outer-box">

          <!-- 
          Header Search
          <button class="ui-btn search-btn">
            <i class="icon fal fa-search"></i>
          </button>
           -->

          <div class="divider"></div>

          <!-- Button -->
          <div class="btn-box d-none d-xl-block">
            <a href="https://web.whatsapp.com/send?phone=+351962674341&text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.." target="_blank" class="btn-style-one"><span class="btn-title">RESERVAR</span></a>
          </div>

          <!-- Mobile Nav toggler -->
          <div class="mobile-nav-toggler ms-0 ms-sm-4"><span class="icon lnr-icon-bars"></span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Menu  -->
  <div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
    <nav class="menu-box">
      <div class="upper-box">

        <?php if ($settings->show_logo == true && $settings->site_logo !== null) { ?>
          <div class="nav-logo"><a href="/projects/lexyhands"><img src="/../public/assets/images/logo-2.png" alt=""></a></div>
        <?php } else { ?>
          <div class="nav-logo"><a href="/projects/lexyhands"><?php echo $settings->site_name ?></a></div>
        <?php } ?>

        <div class="close-btn"><i class="icon fa fa-times"></i></div>
      </div>
      <ul class="navigation clearfix">
        <!--Keep This Empty / Menu will come through Javascript-->
      </ul>
      <ul class="contact-list-one">
        <li>
          <i class="icon bi bi-whatsapp"></i>
          <span class="title"> RESERVAR </span>
          <div class="text"><a class="active" href="https://web.whatsapp.com/send?phone=+351962674341&text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.." target="_blank">Continuar</a></div>
        </li>
      </ul>
      <ul class="social-links">
        <li><a><i class="icon fab fa-twitter"></i></a></li>
        <li><a><i class="icon fab fa-facebook-f"></i></a></li>
        <li><a><i class="icon fab fa-pinterest-p"></i></a></li>
        <li><a><i class="icon fab fa-vimeo-v"></i></a></li>
      </ul>
    </nav>
  </div><!-- End Mobile Menu -->

  <!-- Header Search -->
  <div class="search-popup">
    <span class="search-back-drop"></span>
    <button class="close-search"><span class="fa fa-times"></span></button>

    <div class="search-inner">
      <form method="post" action="/../">
        <div class="form-group">
          <input type="search" name="search-field" value="" placeholder="Search..." required="">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
  <!-- End Header Search -->

  <!-- Sticky Header  -->
  <div class="sticky-header">
    <div class="auto-container">
      <div class="inner-container">
        <!--Logo-->
        <div class="logo">
          <a href="/../"><img src="/../public/assets/images/logo.png" alt=""></a>
        </div>

        <!--Right Col-->
        <div class="nav-outer">
          <!-- Main Menu -->
          <nav class="main-menu">
            <div class="navbar-collapse show collapse clearfix">
              <ul class="navigation clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
              </ul>
            </div>
          </nav><!-- Main Menu End-->

          <!--Mobile Navigation Toggler-->
          <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Sticky Menu -->
</header>
<!--End Main Header -->