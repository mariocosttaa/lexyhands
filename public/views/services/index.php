<!-- Start main-content -->
<section class="page-title" style="background-image: url(public/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Serviços</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Serviços</h1>
            <ul class="page-breadcrumb">
                <li><a href="/">íncio</a></li>
                <li>Serviços</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!-- Services Section Two -->
<section class="services-section pt-100">
    <div class="service1-pattrn1 bounce-y"></div>
    <div class="auto-container">
        <div class="outer-box">
            <?php if (!empty($services) && is_array(value: $services)) { ?>
                <div class="row">
                    <?php foreach ($services as $index => $service) {
                        $service = (object) $service; ?>
                        <!-- Service Block -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <div class="bg-image" style="background-image:url(<?php echo $service->image ?>);"></div>
                                        <div class="bg-image-two" style="background-image:url(public/assets/images/resource/service1-2.png);"></div>
                                    </div>
                                    <div class="content-box">
                                        <figure class="icon mb-0"><img src="public/assets/images/icons/theme-icon8.png" alt="Image"></figure>
                                        <h4 class="title"><a href="./service/<?php echo $service->id ?>"><?php echo $service->name ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                </div>
            <?php } else { ?>

            <?php } ?>
        </div>
    </div>
</section>
<!--End Services Section -->

<?php  getComponent(type: 'public', component: 'gallery'); ?>
