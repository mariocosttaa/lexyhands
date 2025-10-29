<!-- Start main-content -->
<section class="page-title" style="background-image: url(/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Serviços</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Serviços</h1>
            <ul class="page-breadcrumb">
                <li><a href="<?php echo url('/') ?>">Início</a></li>
                <li><a href="<?php echo url('/services') ?>">Serviços</a></li>
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
                                        <li><a href="<?php echo url('/service/' . $otherService->identificator) ?>"><i class="fas fa-angle-right"></i><span><?php echo $otherService->name ?></span></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <div class="service-details-help">
                            <div class="help-shape-1"></div>
                            <div class="help-shape-2"></div>
                            <h2 class="help-title">Estamos a um Clique</h2>
                            <div class="help-icon">
                                <a href="tel:<?php echo $settings->contact_phone ?? '' ?>"><span class=" lnr-icon-phone-handset"></span></a>
                            </div>
                            <div class="help-contact">
                                <p>Precisa de Ajuda ? Entre em Contacto </p>
                                <a href="tel:<?php echo $settings->contact_phone ?? '' ?>"><?php echo $settings->contact_phone ?? '' ?></a>
                            </div>
                        </div>

                        <?php if(isset($settings->contact_phone) && !empty($settings->contact_phone)) { ?>
                        <!--Start Services Details Sidebar Single-->
                        <div class="sidebar-widget service-sidebar-single mt-4">
                            <div class="service-sidebar-single-btn wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1200m">
                                <a href="https://web.whatsapp.com/send?phone=<?php echo str_replace([' ', '-', '(', ')'], '', $settings->contact_phone) ?>&amp;text=Ol%C3%A1,%20tudo%20bem%20?%20Vim%20pelo%20website.." class="theme-btn btn-style-one d-grid" style="background-color: #25D366; border-color: #25D366;">
                                    <span class="btn-title h4">
                                        <span class="fab fa-whatsapp"></span> <?php echo $settings->contact_phone ?>
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
                        <img src="<?php echo asset($service->image) ?>" alt="" style="object-fit: cover; width: 900px; height: 500px;">
                    <?php } ?>
                    <h3 class="mt-4">Informações do Serviço</h3>

                    <p><?php echo $service->content ?></p>

                    <!-- Includes Section -->
                    <?php 
                    $includes = !empty($service->includes) ? json_decode($service->includes, true) : [];
                    if (!empty($includes)) { ?>
                    <div class="mt-4 mb-4">
                        <h4>O que está incluído:</h4>
                        <ul class="list-unstyled">
                            <?php foreach ($includes as $include) { ?>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <span><?php echo htmlspecialchars($include) ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>

                    <!-- Prices Section -->
                    <?php 
                    // Make sure we have the prices variable
                    $prices = $service_prices ?? [];
                    if(!empty($prices) && is_array($prices)) { ?>
                    <div class="mt-4 mb-4">
                        <h4 class="mb-4">Preços</h4>
                        <div class="row g-4">
                            <?php foreach ($prices as $price) { 
                                $price = (object)$price; ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 shadow-sm" style="transition: transform 0.2s; border-radius: 12px; border: 2px solid #BFA54E;">
                                        <div class="card-body d-flex flex-column p-4">
                                            <div class="mb-3">
                                                <h2 class="mb-1" style="font-size: 2rem; font-weight: bold; color: #BFA54E;">
                                                    <?php echo number_format($price->price, 2, ',', '.') ?> 
                                                    <small class="text-muted" style="font-size: 0.7em;"><?php echo htmlspecialchars($price->currency_code) ?></small>
                                                </h2>
                                                <?php if (!empty($price->duration)) { ?>
                                                    <div class="text-muted small">
                                                        <i class="far fa-clock me-1"></i> <?php echo $price->duration ?> minutos
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php if (!empty($price->description)) { ?>
                                                <p class="text-muted mb-auto" style="line-height: 1.6;">
                                                    <?php echo nl2br(htmlspecialchars($price->description, ENT_QUOTES, 'UTF-8')) ?>
                                                </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    
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