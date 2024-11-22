<!-- Start main-content -->
<section class="page-title" style="background-image: url(/projects/lexyhands/public/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Comunidade</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Comunidade</h1>
            <ul class="page-breadcrumb">
                <li><a href="/projects/lexyhands/posts">Comunidade</a></li>
                <li><?php echo $post->tittle ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!--Blog Details Start-->
<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="blog-details__left">
                    <?php if (!empty($post->images)) {
                        $post->images = json_decode($post->images); ?>
                        <div class="blog-details__img">
                            <?php if($post->video) { ?>
                                <video width="100%" height="400" controls>
                                    <source src="http://localhost/<?php echo $post->video ?>" type="video/mp4">
                                    Ocorreu um erro ao reproduzir o video.
                                </video>
                                <br><br><br>
                            <?php } else { ?>
                            <img src="/<?php echo reset(array: $post->images) ?>" alt="">
                            <?php } ?>
                            <div class="blog-details__date">
                                <span class="day"><?php echo getUserDateTime(date: $post->date, format: 'd') ?></span>
                                <span class="month"><?php echo strtoupper(string: substr(string: getUserDateTime($post->date, format: 'M'), offset: 0, length: 3)) ?></span>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="blog-details__content">
                        <ul class="list-unstyled blog-details__meta">
                            <li><a href="news-details.html"><i class="fas fa-user-circle"></i> <?php echo getUser(id: $post->user_id)->names ?></a> </li>
                            <li><a href="news-details.html"><i class="fas fa-comments"></i> 
                                <?php 
                                    if($post->countComments > 1) echo $post->countComments . ' Comentários'; 
                                    else if ($post->countComments == 1) echo $post->countComments . ' Comentário'; 
                                    else echo 'Sem Comentários'; 
                                ?>
                                </a>
                            </li>
                        </ul>
                        <h3 class="blog-details__title"><?php echo $post->tittle ?></h3>
                        <p class="blog-details__text-2">
                            <?php echo $post->content ?>
                        </p>
                    </div>

                    <?php if (!empty($post->tags)) { ?>
                    <div class="blog-details__bottom">
                        <p class="blog-details__tags"> <span>Tags</span>
                            <?php foreach ($post->tags as $tag) {  ?>
                                    <a href="/projects/lexyhands/posts/tags"><?php echo $tag ?></a> <a href="/projects/lexyhands/posts/tags"><?php echo $tag ?></a>
                            <?php } ?>
                        </p>
                    </div>
                    <?php } ?>

                    <?php if (!empty(getUser(id: $post->user_id)->twitter) || !empty(getUser(id: $post->user_id)->facebook) || !empty(getUser(id: $post->user_id)->pinterest) || !empty(getUser(id: $post->user_id)->instagram)) { ?>
                    <div class="blog-details__social-list mb-4"> 
                        <?php if (!empty(getUser(id: $post->user_id)->x)) { ?>
                            <a href="<?php echo getUser(id: $post->user_id)->x ?>" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php } ?>
                        <?php if (!empty(getUser(id: $post->user_id)->facebook)) { ?>
                            <a href="<?php echo getUser(id: $post->user_id)->facebook ?>" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php } ?>
                        <?php if (!empty(getUser(id: $post->user_id)->pinterest)) { ?>
                            <a href="<?php echo getUser(id: $post->user_id)->pinterest ?>" target="_blank">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        <?php } ?>
                        <?php if (!empty(getUser(id: $post->user_id)->instagram)) { ?>
                            <a href="<?php echo getUser(id: $post->user_id)->instagram ?>" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php } ?>
                    </div>
                    <?php } ?>


                    <?php if(!empty($post->previusPost) || !empty($post->nextPost)) { ?>
                    <div class="nav-links">
                        <?php if (!empty($post->previusPost)) { ?>
                        <div class="prev">
                            <a  href="/<?php echo $post->previusPost->link ?>" rel="prev"><?php echo $post->previusPost->tittle ?></a>
                        </div>
                        <?php } ?>
                        <?php if (!empty($post->nextPost)) { ?>
                        <div class="next">
                            <a href="/<?php echo $post->nextPost->link ?>" rel="next"><?php echo $post->nextPost->tittle ?></a>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>



                    <div class="comment-one">
                        <h3 class="comment-one__title">
                            <?php 
                                if($post->countComments > 1) echo $post->countComments . ' Comentários'; 
                                else if ($post->countComments == 1) echo $post->countComments . ' Comentário'; 
                                else echo 'Sem Comentários, Seja o Primeiro'; 
                            ?>
                        </h3>
                    
                        <?php if(!empty($post->comments)) { 
                            foreach($post->comments as $comment) { 
                                $comment = (object) $comment;
                                $user = getUser(id: $comment->user_id);
                                ?>
                            <div class="comment-one__single">
                                <div class="comment-one__image"> 
                                    <?php if(!empty($user->image)) { ?>
                                        <img src="/<?php echo $user->image ?>" alt="" style="object-fit: cover; width: 140px; height: 120px;"> 
                                    <?php } else { ?>
                                        <img src="/projects/lexyhands/public/assets/images/users/avatar.png" alt="" style="object-fit: cover; width: 140px; height: 120px;"> 
                                    <?php } ?>
                                </div>
                                <div class="comment-one__content">
                                    <h3><?php echo $user->names ?></h3>
                                    <p><?php echo $comment->comment ?></p>
                                    <a href="#" style="font-size: 15px; color: #BFA54E; text-decoration: underline;">Responder</a>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } ?>



                    <?php if($main->user) { ?>
                        <div class="comment-form">
                            <h3 class="comment-form__title">Fazer Comentário <samall style="font-size:14px;">(indisponível)</samall></h3>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <textarea name="form_message" name="comment" class="form-control" rows="5" placeholder="Escreva o que deseja comentar para esta publicação"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input name="post_id" type="hidden" value="<?php echo $post->id ?>">
                                    <button type="submit" class="theme-btn btn-style-one">
                                        <span class="btn-title">Comentar</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php } else { ?> 
                            <div class="comment-form">
                            <h4 class="comment-form__title">Fazer um comentário</h4>
                                <div class="mb-2">
                                   <small> Ao continuar você será redirecionado para a página de Login, para ser autenticado.</small>
                                </div>

                                <div class="mb-3">
                                    <a href="/projects/lexyhands/auth/login?continue=<?php echo $main->currentUrl ?>" class="theme-btn btn-style-one">Comentar</a>
                                </div>
                        </div>
                        <?php } ?> 
                    </div>
                
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">
                    <div class="sidebar__single sidebar__search">
                        <form action="#" class="sidebar__search-form">
                            <input type="search" placeholder="Search here">
                            <button type="submit"><i class="lnr-icon-search"></i></button>
                        </form>
                    </div>
                    <?php if($lastPosts) { ?>
                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">Últimas Postagens</h3>
                        <ul class="sidebar__post-list list-unstyled">
                            <?php foreach($lastPosts as $lastPost) { 
                                    $lastPost = (object) $lastPost;  
                                    $user = getUser(id: $lastPost->user_id);

                                    if(!empty($lastPost->images)) {
                                        $lastPost->images = json_decode(json: $lastPost->images, associative: true);
                                        if(count($lastPost->images) <= 2) {
                                            $lastPost->images = array_fill(0, 2, $lastPost->images[0]);
                                        } else {
                                            $lastPost->images = array_slice($lastPost->images, 0, 2);
                                        }
                                      } else {
                                        $lastPost->images = [];
                                      }
                                      
                                    $lasPostLink = "/projects/lexyhands/posts/".$lastPost->identificator."/" .date('d-m-Y', strtotime($lastPost->date)) ."/". $lastPost->id;  
                                 ?>
                                <li>
                                    <?php if(!empty($lastPost->images)) { ?>
                                        <div class="sidebar__post-image"> 
                                            <img src="/<?php echo reset(array: $lastPost->images) ?>" alt=""> 
                                        </div>
                                    <?php } ?>
                                    <div class="sidebar__post-content">
                                        <h3> <span class="sidebar__post-content-meta"><i class="fas fa-user-circle"></i><?php echo $user->names ?></span> <a href="<?php echo $lasPostLink ?>"><?php echo $lastPost->tittle ?></a>
                                        </h3>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>

                    <div class="sidebar__single sidebar__category">
                        <h3 class="sidebar__title">Categorias</h3>
                        <ul class="sidebar__category-list list-unstyled">
                            <li class="active"><a href="/projects/lexyhands/posts/<?php echo 'categories/' . slug(string: $post->category->name) . '/' . $post->category->id; ?>"><?php echo $post->category->name ?></a><span class="icon-right-arrow"></span></a></li>
                          
                          <?php if(!empty($categories)) { ?>
                            <?php foreach ($categories as $category) { 
                                        $category = (object) $category; 
                                        $categoryLink = '/projects/lexyhands/posts/categories/' . slug(string: $category->name) . '/' . $category->id;
                                ?>
                                <li><a href="<?php echo $categoryLink ?>"><?php echo $category->name ?><span class="icon-right-arrow"></span></a></li>
                            <?php } ?>
                          <?php } ?> 

                        </ul>
                    </div>

                    <?php if($tags) { ?>
                    <div class="sidebar__single sidebar__tags">
                        <h3 class="sidebar__title">Tags</h3>
                        <div class="sidebar__tags-list">
                            <?php foreach($tags as $tag) { ?>
                                <a href="/projects/lexyhands/posts/tags/<?php echo slug(string: $tag) ?>"><?php echo $tag ?></a> 
                             <?php } ?>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Blog Details End-->