<!-- Start main-content -->
<section class="page-title" style="background-image: url(/../public/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Comunidade</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Categorias</h1>
            <ul class="page-breadcrumb">
                <li><a href="/../posts">Comunidade</a></li>
                <li>Categorias</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->


<section class="blog-section-two">
    <div class="auto-container">
        <div class="row">

            <div class="sidebar__single sidebar__tags">
                <h3 class="sidebar__title">Categorias</h3>
                <?php if(!empty($categories)) { ?>
                    <div class="sidebar__tags-list">
                        <?php foreach ($categories as $category) { 
                            $category = (object) $category; 
                            $categoryLink = '/../posts/categories/'.$category->identificator.'';
                            ?>
                            <a href="<?php echo $categoryLink ?>"><?php echo $category->name ?></a> 
                        <?php } ?>
                    </div>
                <?php } else { ?>

                    <div class="alert alert-info" role="alert">
                        Não existem Categorias Disponíveis.
                    </div>
                    
                <?php } ?>
            </div>

        </div>
    </div>
</section>