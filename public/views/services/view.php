<!-- Start main-content -->
<section class="page-title" style="background-image: url(/projects/lexyhands/public/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Serviços</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Serviços</h1>
            <ul class="page-breadcrumb">
                <li><a href="/projects/lexyhands">Início</a></li>
                <li><a href="/projects/lexyhands/services">Serviços</a></li>
                <li><?php echo $service->name ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!--Start Services Details-->
<section class="services-details">
    <div class="container">
        <div class="row">
            <!--Start Services Details Sidebar-->
            <div class="col-xl-4 col-lg-4">
                <div class="service-sidebar">
                    <!--Start Services Details Sidebar Single-->
                    <div class="sidebar-widget service-sidebar-single">

                        <?php if (!empty($othersServices)) { ?>
                            <div class="sidebar-service-list">
                                <ul>
                                    <li class="current"><a><span><?php echo $service->name ?></span></a></li>
                                    <?php foreach ($othersServices as $otherService) {
                                        $otherService = (object) $otherService; ?>
                                        <li><a href="../service/<?php echo $otherService->slug_name ?>"><i class="fas fa-angle-right"></i><span><?php echo $otherService->name ?></span></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <div class="service-details-help">
                            <div class="help-shape-1"></div>
                            <div class="help-shape-2"></div>
                            <h2 class="help-title">Estamos a um Clique</h2>
                            <div class="help-icon">
                                <a href="tel:<?php echo $settings->phone ?>"><span class=" lnr-icon-phone-handset"></span></a>
                            </div>
                            <div class="help-contact">
                                <p>Precisa de Ajuda ? Entre em Contacto </p>
                                <a href="tel:<?php echo $settings->phone ?>"><?php echo $settings->phone ?></a>
                            </div>
                        </div>

                        <?php if($settings->whatssap !== null) { ?>
                        <!--Start Services Details Sidebar Single-->
                        <div class="sidebar-widget service-sidebar-single mt-4">
                            <div class="service-sidebar-single-btn wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1200m">
                                <a href="https://web.whatsapp.com/send?phone=<?php echo $settings->whatssap ?>&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.." class="theme-btn btn-style-one d-grid" style="background-color: #25D366; border-color: #25D366;">
                                    <span class="btn-title h4">
                                        <span class="fab fa-whatsapp"></span> <?php echo $settings->whatssap ?>
                                    </span></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!--End Services Details Sidebar-->
                </div>
            </div>
            <!--Start Services Details Content-->
            <div class="col-xl-8 col-lg-8">
                <div class="services-details__content">
                    <?php if(!empty($service->image)) {?>
                        <img src="/<?php echo $service->image ?>" alt="" style="object-fit: cover; width: 900px; height: 500px;">
                    <?php } ?>
                    <h3 class="mt-4">Informações do Serviço</h3>

                    <p><?php echo $service->content ?></p>
                    
                    <?php if(!empty($service_faq)) {?>
                    <div class=" mt-25 mb-4">
                        <h3>Pergutas Frequentes</h3>
                        <p>Tem alguma dúvida sobre nossos serviços? Confira as perguntas mais comuns abaixo para obter respostas rápidas e claras. Se ainda precisar de ajuda, não hesite em entrar em contato conosco.</p>
                        <ul class="accordion-box wow fadeInRight">
                            <?php foreach($service_faq as $faq) { $faq = (object) $faq; ?>
                            <!--Block-->
                            <li class="accordion block">
                                <div class="acc-btn"><?php echo $faq->question ?>
                                    <div class="icon fa fa-plus"></div>
                                </div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text"><?php echo $faq->answer ?></div>
                                    </div>
                                </div>
                            </li>
                            <!--Block-->
                            <?php } ?>
                           
                        </ul>
                    </div>
                    <?php } ?>
                    <br><br>
                </div>
            </div>
            <!--End Services Details Content-->
        </div>
    </div>
</section>
<!--End Services Details-->