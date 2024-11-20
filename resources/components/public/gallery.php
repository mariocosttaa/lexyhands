<?php if (isset($gallery) && is_array($gallery)) { ?>
    <!-- Instagram Section -->
    <section class="instagram-section">
        <div class="icon-instagram1-6 bounce-x"></div>
        <div class="icon-instagram1-7 bounce-y"></div>
        <div class="auto-container">
            <div class="sec-title text-center">
                <h4 class="words-slide-up text-split">Seguir nas Redes Sociais</h4>
            </div>
            <div class="row">

                <?php foreach ($gallery as $gallery) {
                    $gallery = (object) $gallery; ?>

                    <!-- pricing-block -->
                    <div class="instagram-block col-lg-2 col-md-3 col-sm-6">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="#"><img src="<?php echo $gallery->image ?>" alt="Nome da Imagem"></a>
                                </figure>
                                <i class="icon fab fa-instagram"></i>
                            </div>
                        </div>
                    </div>

                <?php } ?>


            </div>
        </div>
    </section>
    <!-- End Instagram Section -->
<?php } ?>
<?php return; ?>