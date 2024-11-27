<!-- Start main-content -->
<section class="page-title" style="background-image: url(/../public/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Comunidade</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Tags</h1>
            <ul class="page-breadcrumb">
                <li><a href="/../posts">Comunidade</a></li>
                <li>Tags</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->


<section class="blog-section-two">
    <div class="auto-container">
        <div class="row">

            <div class="sidebar__single sidebar__tags">
                <h3 class="sidebar__title">Tags</h3>
                <?php if(!empty($tags)) { ?>
                    <div class="sidebar__tags-list">
                        <?php foreach ($tags as $tag) {  ?>
                            <a href="/../posts/tags/<?php echo slug(string: $tag) ?>"><?php echo $tag ?></a> 
                        <?php } ?>
                    </div>
                <?php } else { ?>

                    <div class="alert alert-info" role="alert">
                        Não existem Tags Disponíveis.
                    </div>
                    
                <?php } ?>
            </div>

        </div>
    </div>
</section>