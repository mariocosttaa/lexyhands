<!-- Start main-content -->
<section class="page-title" style="background-image: url(/assets/images/background/page-title-bg.png);">
    <h1 class="large-title">Comunidade</h1>
    <div class="image-curve"></div>
    <div class="auto-container">
        <div class="title-outer text-center">
            <h1 class="title">Tag - <?php echo $tag ?></h1>
            <ul class="page-breadcrumb">
                <li><a href="/../posts">Comunidade</a></li>
                <li><a href="/../posts/tags">Tags</a></li>
                <li><?php echo $tag ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->


	<!-- News Section -->
    <section class="blog-section-two">
    <div class="auto-container">
      <div class="row">
        <?php foreach($posts as $post) { 
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
                            <li class="categories"><a href="/../<?php echo  $postLink ?>"><?php echo $category->name ?></a></li>
                            <li class="date"><?php echo getUserDateTime(date: $post->date, format: 'd/m/Y'); ?></li>
                        </ul>
                        <h4 class="title mb-0"><a href="<?php echo  $postLink ?>"><?php echo $post->tittle ?></a></h4>
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
	<!--End News Section -->