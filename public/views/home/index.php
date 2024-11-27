<!-- Banner Start -->

<!-- Banner Start -->
<section class="banner-style1-home5">
    <div class="leaf-1 d-none d-xxl-block bounce-y"><img src="public/assets/images/home5-banner3.png" alt=""></div>
    <div class="banner-bottom"><img src="public/assets/images/home5-banner-bottom.png" alt=""></div>
    <div class="auto-container">
        <div class="row">
            <div class="col-xl-6 d-none d-xl-block">
                <div class="image-content">
                    <div class="bg-circle zoom-one"></div>
                    <img class="img" src="public/assets/images/home5-banner1.png" alt="">
                    <img class="img-2 bounce-x" src="public/assets/images/home5-banner2.png" alt="">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="content-column">
                    <div class="inner-content">
                        <h4 class="" style="color: #BFA54E;">Lexy Hands</h4>
                        <h2 class="title"> Restabeleça o equilíbrio</h2>
                        <p class="text"> Renove sua energia <br class="d-none d-xxl-block"> Melhore sua produtividade
                            com massagens profissionais.</p>
                        <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.."
                            target="_blank" class="theme-btn btn-style-transparent mt-25">EXPERIMENTAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner End -->



<?php if (!empty($services) && is_array(value: $services)) { ?>
<!-- Services Section -->
<section class="services-section-three bg-white">
    <div class="service1-pattrn1 bounce-y"></div>
    <div class="auto-container">
        <div class="outer-box">
            <div class="sec-title text-center">
                <div class="title-stroke-text">Serviços</div>
                <figure class="image"><img src="public/assets/images/icon2.png" alt="Image"></figure>
                <span class="sub-title">Maxímo Relaxamento</span>
                <h2 class="words-slide-up text-split">Os nossos serviços</h2>
            </div>
            <div class="row">
                <?php $i = 1;
          foreach ($services as $index => $service) {
            $i++;
            $service =  (object) $service; ?>
                <!-- Service Block -->
                <div class="service-block-three col-lg-3 col-md-6 col-sm-6">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="bg-image" style="background-image:url(/<?php echo $service->image ?>);"></div>
                        </div>
                        <div class="content-box">
                            <figure class="icon mb-0"><img src="public/assets/images/icon-leaf<?php if ($i >= 4) {
                                                                                      echo 1;
                                                                                    } else {
                                                                                      echo $i;
                                                                                    } ?>.png" alt="Image"></figure>
                            <h4 class="title"><a
                                    href="/../service/<?php echo $service->slug_name ?>"><?php echo $service->name ?></a></h4>
                            <div class="text"><?php echo $service->description ?></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <br>
            <div class="text-center">
                <a href="/../services" target="_blank" class="theme-btn btn-style-transparent mt-25">Ver Todos
                    Serviços</a>
            </div>
        </div>
    </div>
</section>
<!-- End Services Section-->
<?php } ?>


<!-- Services Section -->
<section class="services-section">
    <div class="service1-pattrn1 bounce-y"></div>
    <div class="auto-container">
        <div class="outer-box">
            <div class="sec-title">
                <div class="row">
                    <div class="col-xl-6">
                        <figure class="image"><img src="public/assets/images/icons/icon1.png" alt="Image"></figure>
                        <span class="sub-title">Você Está Apenas a Um Passo</span>
                        <h2 class="words-slide-up text-split">Você sabia dos beneficios ?</h2>
                    </div>
                    <div class="col-xl-5 offset-xl-1">
                        <div class="text">Confira os benéficios de uma sessão profissional de Massagem.</div>
                    </div>
                </div>
            </div>
            <div class="carousel-outer">
                <!-- Swiper -->
                <div class="swiper service-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon5.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Relaxamento</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon6.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Alívio</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon7.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Circulação</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon8.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Flexibilidade</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon5.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Postura</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon6.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Sono</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon7.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Ansiedade</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image"
                                            style="background-image:url(public/assets/images/resource/service1-1.png);">
                                        </div>
                                        <div class="bg-image-two"
                                            style="background-image:url(public/assets/images/resource/service1-2.png);">
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon8.png"
                                                alt="Image"></figure>
                                        <h4 class="title"><a href="page-service-details.html">Ansiedade</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- swiper scrollbar -->
                    <div class="swiper-scrollbar styled-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services Section-->

<!-- Marquee Section -->
<section class="marquee-section">
    <div class="marquee">
        <div class="marquee-group">
            <div class="text" data-text="Terapêutica">Terapêutica</div>
            <div class="text" data-text="Rejuvenescimento">Rejuvenescimento</div>
            <div class="text" data-text="Alívio">Alívio</div>
            <div class="text" data-text="Revitalização">Revitalização</div>
        </div>

        <div aria-hidden="true" class="marquee-group">
            <div class="text" data-text="Terapêutica">Terapêutica</div>
            <div class="text" data-text="Rejuvenescimento">Rejuvenescimento</div>
            <div class="text" data-text="Alívio">Alívio</div>
            <div class="text" data-text="Revitalização">Revitalização</div>
        </div>
    </div>
</section>
<!-- End Marquee Section -->


<!-- About Section Home5 -->
<section class="about-section-home5">
    <div class="container-fluid p-0">
        <div class="outer-box">
            <div class="row align-items-center">
                <!-- About Block -->
                <div class="about-block-home5 mb-5 mb-lg-0 col-lg-6">
                    <div class="thumb-box">
                        <img src="public/assets/images/website/banner-1.png" alt=""
                            style="object-fit: cover; width: 900px; height: 500px;">
                    </div>
                </div>

                <!-- About Block -->
                <div class="about-block-home5 col-lg-6 col-xxl-4">
                    <div class="inner-box">
                        <div class="sec-title mb-20">
                            <figure class="image"><img src="public/assets/images/icon1.png" alt="Image"></figure>
                            <span class="sub-title">Você precisa experimentar</span>
                            <h2 class="words-slide-up text-split">Experiência <br class="d-none d-xxl-block"> de
                                Relaxamento </h2>
                        </div>
                        <div class="about-content">
                            <p class="text mb-30">Relaxe e desfrute de uma experiência de massagem única. Entre em
                                contato conosco agora e agende sua sessão de massagem ! </p>
                            <small>Experimente os benefícios de uma massagem personalizada e comece a cuidar de sí hoje
                                mesmo!</small><br>
                            <div class="list-style1-home4 d-flex align-items-center">
                                <ul class="list-style1-home4">
                                    <li class="mb-25"><img class="me-2" src="public/assets/images/list-style-icon1.svg"
                                            alt=""> Intensivas </li>
                                    <li><img class="me-2" src="public/assets/images/list-style-icon1.svg" alt="">
                                        Específicas</li>
                                </ul>
                                <ul class="list-style1-home4 ml-40">
                                    <li class="mb-25"><img class="me-2" src="public/assets/images/list-style-icon1.svg"
                                            alt=""> Estéticas</li>
                                    <li><img class="me-2" src="public/assets/images/list-style-icon1.svg" alt="">
                                        Energéticas </li>
                                </ul>
                            </div>
                            <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.."
                                target="_blank" class="theme-btn btn-style-one mt-40">RESERVAR AGORA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services Section-->

<!-- About Section Home5 -->
<section class="about-section2-home5 pt-0">
    <div class="container-fluid p-0">
        <div class="outer-box">
            <div class="row align-items-center">
                <!-- About Block -->
                <div class="about-block2-home5 col-lg-6 col-xxl-4 offset-xxl-2 ps-4 ps-xxl-0 mb-5 mb-lg-0">
                    <div class="inner-box">
                        <div class="sec-title mb-20">
                            <figure class="image"><img src="public/assets/images/icon1.png" alt="Image"></figure>
                            <span class="sub-title">Massagista Terapêutica</span>
                            <h2 class="words-slide-up text-split">Descubra sua nova versão</h2>
                        </div>
                        <div class="about-content">
                            <p class="text mb-30">Desfrute de uma verdadeira experiência de autoconhecimento e novas
                                sensações. </p>
                            <p>Você sempre estará a um passo de descobrir novas sensações de conforto, libertação e
                                regeneração, experimente sansações aliviantes e relaxantes. </p>
                            <div class="list-style1-home4 d-flex align-items-center">
                                <ul class="list-style1-home4">
                                    <li class="mb-25"><img class="me-2" src="public/assets/images/list-style-icon1.svg"
                                            alt=""> 3 Anos de Experiência</li>
                                </ul>
                            </div>
                            <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.."
                                target="_blank" class="theme-btn btn-style-one mt-40">RESERVAR AGORA</a>
                        </div>
                    </div>
                </div>
                <!-- About Block -->
                <div class="about-block2-home5 col-lg-6 text-end">
                    <div class="thumb-box">
                        <img src="public/assets/images/website/professional.png" alt=""
                            style="object-fit: cover; width: 900px; height: 500px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services Section-->


<?php if (!empty($products)) { 
  
    $totalProducts = count(value: $products);
    $halfTotalProducts = (int) ($totalProducts / 2);
    $firstHalfProducts = array_slice(array: $products, offset: 0, length: $halfTotalProducts);
    $secondHalfProducts = array_slice(array: $products, offset: $halfTotalProducts);

    if(empty($firstHalfProducts)) {
      $defaultCol = 6;
      $firstHalfProducts = $secondHalfProducts;
      $secondHalfProducts = [];
    } else {
      $defaultCol = 4;
    }

    

?>

<section class="pricing-section-four">
    <div class="leaf1"></div>
    <div class="leaf2"></div>
    <div class="leaf3"></div>
    <div class="leaf4"></div>
    <div class="leaf5"></div>
    <div class="leaf6"></div>
    <div class="auto-container">
        <div class="sec-title text-center">
            <div class="title-stroke-text">Preçário</div>
            <figure class="image"><img src="public/assets/images/icons/icon1.png" alt="Image"></figure>
            <span class="sub-title">LexyHands</span>
            <h2 class="words-slide-up text-split">Você escolhe a sua primeira experiência</h2>
        </div>
        <div class="row align-items-center">
            <div class="content-column col-lg-<?php echo $defaultCol ?>">
                <!-- pricing-block -->
                <div class="row align-items-center">
                    <?php foreach ($firstHalfProducts as  $product) {
                          $product = (object) $product;
                          if (!empty($product->images)) {
                            $product->images = json_decode(json: $product->images, associative: true);
                          }
                          if ($product->name == $product->name) {
                            $prices = getPrices(id: $product->id);
                          } ?>

                    <!-- pricing-block -->
                    <div class="pricing-block">
                        <h4 class="title"><a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Estou%20a%20entrar%20em%20contacto%20a%20partir%20do%20Website,%20e%20gostaria%20de%20reservar%20a%20Sess%C3%A3o%20de%20Massagem%20de%20<?php echo urlencode($product->name); ?>."
                        target="_blank"><?php echo $product->name; ?></a></h4>
                        <div class="inner-box">
                            <?php if (!empty($product->images)) { ?>
                            <div class="image-box">
                                <figure class="image overlay-anim mb-0">
                                    <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Estou%20a%20entrar%20em%20contacto%20a%20partir%20do%20Website,%20e%20gostaria%20de%20reservar%20a%20Sess%C3%A3o%20de%20Massagem%20de%20<?php echo urlencode($product->name); ?>."
                                    target="_blank"><img src="<?php echo reset($product->images) ?>" alt="Image"></a>
                                </figure>
                            </div>
                            <?php } ?>
                            <?php if (!empty($prices)) { ?>
                            <div class="row">
                                <?php foreach ($prices as $p) { 
                                  $p = (object) $p; 
                                  if(!empty($p->description)) {
                                    $ColInSight = "col-6";
                                  } else {
                                     $ColInSight = "col-12";
                                  }
                                  ?>
                                  
                                <?php if($ColInSight == "col-6") { ?>
                                <div class="col-6">
                                    <div class="content-box">
                                        <div class="inner">
                                          <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Estou%20a%20entrar%20em%20contacto%20a%20partir%20do%20Website,%20e%20gostaria%20de%20reservar%20a%20Sess%C3%A3o%20de%20Massagem%20de%20<?php echo urlencode($product->name); ?>."
                                          target="_blank"><div class="text-secondary"><?php echo $p->description; ?></div></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="<?php echo $ColInSight ?>">
                                    <div class="content-box">
                                        <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Estou%20a%20entrar%20em%20contacto%20a%20partir%20do%20Website,%20e%20gostaria%20de%20reservar%20a%20Sess%C3%A3o%20de%20Massagem%20de%20<?php echo urlencode($product->name); ?>."
                                        target="_blank"><span class="price"><?php echo currencyOrganizer(value: $p->price, decimalPlaces: 2); ?></span></a>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>

            <div class="image-column col-lg-<?php echo $defaultCol ?>">
                <div class="inner-box">
                    <div class="bg bg-image bounce-y"
                        style="background-image: url(public/assets/images/resource/flower1.png);"></div>
                    <figure class="image overlay-anim mb-0">
                        <img src="public/assets/images/website/banner-4.png" alt="Image">
                    </figure>
                </div>
            </div>

            <div class="content-column col-lg-<?php echo $defaultCol ?>">
                <!-- pricing-block -->
                <?php if(!empty($secondHalfProducts )) { ?>
                <div class="row align-items-center">
                    <?php foreach ($secondHalfProducts  as  $product) {
                            $product = (object) $product;
                            if (!empty($product->images)) {
                              $product->images = json_decode(json: $product->images, associative: true);
                            }
                            if ($product->name == $product->name) {
                              $prices = getPrices(id: $product->id);
                            } ?>

                    <!-- pricing-block -->
                    <div class="pricing-block">
                        <h4 class="title"><a href=""><?php echo $product->name; ?></a></h4>
                        <div class="inner-box">
                            <?php if (!empty($product->images)) { ?>
                            <div class="image-box">
                                <figure class="image overlay-anim mb-0">
                                    <a href=""><img src="<?php echo reset($product->images) ?>" alt="Image"></a>
                                </figure>
                            </div>
                            <?php } ?>
                            <?php if (!empty($prices)) { ?>
                            <div class="row">
                            <?php foreach ($prices as $p) { 
                                  $p = (object) $p; 
                                  if(!empty($p->description)) {
                                    $ColInSight = "col-6";
                                  } else {
                                     $ColInSight = "col-12";
                                  }
                                  ?>
                                  
                                <?php if($ColInSight == "col-6") { ?>
                                <div class="col-6">
                                    <div class="content-box">
                                        <div class="inner">
                                          <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Estou%20a%20entrar%20em%20contacto%20a%20partir%20do%20Website,%20e%20gostaria%20de%20reservar%20a%20Sess%C3%A3o%20de%20Massagem%20de%20<?php echo urlencode($product->name); ?>."
                                          target="_blank"><div class="text-secondary"><?php echo $p->description; ?></div></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="<?php echo $ColInSight ?>">
                                    <div class="content-box">
                                        <a href="https://web.whatsapp.com/send?phone=+351962674341&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Estou%20a%20entrar%20em%20contacto%20a%20partir%20do%20Website,%20e%20gostaria%20de%20reservar%20a%20Sess%C3%A3o%20de%20Massagem%20de%20<?php echo urlencode($product->name); ?>."
                                        target="_blank"><span class="price"><?php echo currencyOrganizer(value: $p->price, decimalPlaces: 2); ?></span></a>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php }?>
            </div>

        </div>
    </div>
</section>
<?php }?>

<!-- Seção Funfact -->
<section class="funfact-section-home5">
    <div class="auto-container">
        <div class="fact-counter">
            <div class="row">
                <!-- Bloco de contagem -->
                <div class="counter-block-home5-style col-md-3 col-sm-6">
                    <div class="inner-box">
                        <div class="count-box"><span class="count-text" data-speed="10000" data-stop="3">0</span></div>
                        <div class="counter-text">Anos de <br> Experiência</div>
                    </div>
                </div>
                <!-- Bloco de contagem -->
                <div class="counter-block-home5-style col-md-3 col-sm-6">
                    <div class="inner-box">
                        <div class="count-box"><span class="count-text" data-speed="6000" data-stop="1000">0</span></div>
                        <div class="counter-text">+ Clientes <br> Atendidos</div>
                    </div>
                </div>
                <!-- Bloco de contagem -->
                <div class="counter-block-home5-style col-md-3 col-sm-6">
                    <div class="inner-box">
                        <div class="count-box"><span class="count-text" data-speed="10000" data-stop="20">0</span></div>
                        <div class="counter-text">Sessões <br> de Terapia  </div>
                    </div>
                </div>
                <!-- Bloco de contagem -->
                <div class="counter-block-home5-style col-md-3 col-sm-6">
                    <div class="inner-box">
                        <div class="count-box"><span class="count-text" data-speed="10000" data-stop="90">0</span></div>
                        <div class="counter-text">Taxa <br> de Satisfação</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fim da Seção Funfact -->

<?php if(!empty($posts)) { ?> 
<!-- Blog Section Home4 -->
<section class="blog-section-home4">
    <div class="auto-container">
        <div class="sec-title text-center">
            <figure class="image"><img src="public/assets/images/icon1.png" alt="Image"></figure>
            <span class="sub-title">Comunidade</span>
            <h2 class="words-slide-up text-split">Confira as Úlltimas Novidades da Nossa Comunidade</h2>
        </div>
        <div class="row">
          <?php foreach ($posts as $post) { 
            $post = (object) $post;
            if(!empty($post->images)) {
              $post->images = json_decode(json: $post->images, associative: true);
              if(count($post->images) <= 2) {
                $post->images = array_fill(0, 2, $post->images[0]);
              } else {
                $post->images = array_slice($post->images, 0, 2);
              }
            } else {
              $post->images = [];
            }

            $category = getPostCategory(id: $post->category);  
            $postLink = "/../posts/".$post->identificator."/" .date('d-m-Y', strtotime($post->date)) ."/". $post->id;  
            ?>
            <!-- News Block -->
            <div class="blog-block col-lg-4 col-md-6">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image">
                            <a href="<?php echo  $postLink ?>">
                              <?php if(!empty($post->images)) { ?>
                                <?php foreach($post->images as $image) { ?>
                                  <img src="/<?php echo $image ?>" alt="Image">
                                <?php } ?>
                                <?php } ?>
                            </a>
                        </figure>
                    </div>
                    <div class="content-box">
                        <ul class="post-meta">
                            <li class="categories"><a href="<?php echo  $postLink ?>"><?php echo $category->name ?></a></li>
                            <li class="date"><?php echo getUserDateTime(date: $post->date, format: 'd/m/Y'); ?></li>
                        </ul>
                        <h4 class="title mb-0"><a href="<?php echo $postLink ?>"><?php echo $post->tittle ?></a></h4>
                        <p><?php echo $post->subtittle ?></p>
                        <a class="read-more" href="<?php echo  $postLink ?>">Abrir <i
                                class="icon fa-regular fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        </div>
    </div>
</section>
<!--End Blog Section -->
<?php } ?>


<!-- Seção de Testemunhos -->
<section class="testimonial-section-three pt-120 pb-90">
    <div class="image-1 bounce-y"><img src="public/assets/images/resource/testimonial-pattrn1-2.png" alt=""></div>
    <div class="auto-container">
        <div class="sec-title text-center">
            <figure class="image"><img src="public/assets/images/icons/icon1.png" alt="Image"></figure>
            <span class="sub-title">Testemunhos</span>
            <h2 class="words-slide-up text-split">O que dizem?</h2>
        </div>
        <div class="carousel-outer col-lg-12">
            <div class="testimonial-carousel-two owl-carousel owl-theme">

                <!-- Bloco de Testemunho -->
                <div class="testimonial-block-three">
                    <div class="inner-box">
                        <img class="img-1 bounce-y" src="public/assets/images/resource/testi-pattern-1.png" alt="">
                        <img class="img-2 bounce-x" src="public/assets/images/resource/testi-leaf-1.png" alt="">
                        <span class="icon bounce-y fa fa-quote-right"></span>
                        <figure class="thumb">
                            <img src="public/assets/images/website/avatar.png" alt="">
                        </figure>
                        <div class="info-box">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="text">"Tive uma massagem relaxante na LexyHands e foi uma experiência maravilhosa. O ambiente era tranquilo, e o atendimento foi muito atencioso. Senti uma diferença imediata nas minhas costas."</div>
                            <h4 class="name">Mariana Oliveira</h4>
                            <span class="designation">Cliente</span>
                        </div>
                    </div>
                </div>

                <!-- Bloco de Testemunho -->
                <div class="testimonial-block-three">
                    <div class="inner-box">
                        <img class="img-1 bounce-y" src="public/assets/images/resource/testi-pattern-1.png" alt="">
                        <img class="img-2 bounce-x" src="public/assets/images/resource/testi-leaf-1.png" alt="">
                        <span class="icon bounce-y fa fa-quote-right"></span>
                        <figure class="thumb">
                            <img src="public/assets/images/website/avatar.png" alt="">
                        </figure>
                        <div class="info-box">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="text">"Fiz uma massagem terapêutica para aliviar dores no pescoço, e o resultado foi excelente. A massagista foi muito profissional e se certificou de que eu estava confortável o tempo todo."</div>
                            <h4 class="name">João Mendes</h4>
                            <span class="designation">Cliente</span>
                        </div>
                    </div>
                </div>

                <!-- Bloco de Testemunho -->
                <div class="testimonial-block-three">
                    <div class="inner-box">
                        <img class="img-1 bounce-y" src="public/assets/images/resource/testi-pattern-1.png" alt="">
                        <img class="img-2 bounce-x" src="public/assets/images/resource/testi-leaf-1.png" alt="">
                        <span class="icon bounce-y fa fa-quote-right"></span>
                        <figure class="thumb">
                            <img src="public/assets/images/website/avatar.png" alt="">
                        </figure>
                        <div class="info-box">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="text">"Minha primeira sessão foi incrível. O ambiente é acolhedor, e a equipe é muito simpática. Já marquei minha próxima massagem para continuar cuidando de mim."</div>
                            <h4 class="name">Sofia Almeida</h4>
                            <span class="designation">Cliente</span>
                        </div>
                    </div>
                </div>

                <!-- Bloco de Testemunho -->
                <div class="testimonial-block-three">
                    <div class="inner-box">
                        <img class="img-1 bounce-y" src="public/assets/images/resource/testi-pattern-1.png" alt="">
                        <img class="img-2 bounce-x" src="public/assets/images/resource/testi-leaf-1.png" alt="">
                        <span class="icon bounce-y fa fa-quote-right"></span>
                        <figure class="thumb">
                            <img src="public/assets/images/website/avatar.png" alt="">
                        </figure>
                        <div class="info-box">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="text">"Eu estava muito estressado, e a massagem relaxante me ajudou a desconectar e recarregar minhas energias. Recomendo para quem precisa de uma pausa na rotina."</div>
                            <h4 class="name">Carlos Ferreira</h4>
                            <span class="designation">Cliente</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Fim da Seção de Testemunhos -->

