<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Lista de Postagens
    <a href="/projects/lexyhands/admin/posts/create" class="btn btn-primary-soft">
        <i class="bi bi-plus me-1"></i>
        Criar Postagem
    </a>
</h2>
<nav aria-label="breadcrumb" w-tid="102">
    <ol class="breadcrumb" w-tid="103">
        <li class="breadcrumb-item" w-tid="104">
            <a w-tid="105">
                <i class="bi bi-house-door me-1" w-tid="106"></i>Menu
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" w-tid="109">Comunidade</li>
    </ol>
</nav>

<?php if (!empty($posts)) { ?>
    <div class="row g-4" w-tid="91">
        <?php foreach ($posts as $post) {
            $post = (object) $post; 

            if(!empty($post->images)) {
                $post->images = json_decode(json: $post->images, associative: true);
                $post->images = reset($post->images);
            } else {
                $post->images = null;
            }

            $category = getPostCategory(id: $post->category);  
        ?>
            <!-- Web Development Card -->
            <div class="col-12 col-md-6 col-lg-4" w-tid="92">
                <div class="card h-100 position-relative service-card" w-tid="93">
                    <img src="/<?php echo $post->images ?>" alt="Imagem do Serviço" class="card-img-top" height="200" style="object-fit: cover;" w-tid="94">
                    <div class="card-body" w-tid="95">
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-muted me-2">
                                Por <?php echo getUser(id: $post->user_id)->names ?> - 
                            </span>
                            <span class="text-muted">
                                <?php echo getUserDateTime(date: $post->date, format: 'd/m/Y'); ?> -
                            </span>
                            <span class="text-muted ms-2 ">
                                <?php echo $category->name ?>
                            </span>
                        </div>
                        <h5 class="card-title mb-0" w-tid="96"><?php echo $post->tittle ?></h5>
                        <p class="card-text text-muted" w-tid="97"><?php echo $post->subtittle ?></p>
                    </div>
                    <div class="card-footer mb-2">
                        <form action="/projects/lexyhands/admin/posts/delete/<?php echo $post->identificator ?>" method="POST">
                            <a href="/projects/lexyhands/admin/posts/edit/<?php echo $post->identificator ?>" class="btn btn-sm btn-success-soft" w-tid="98">Editar</a> |
                            <button type="submit" class="btn btn-sm btn-danger-soft" w-tid="98"
                                data-alert-config='{
                                        "type": "delete", 
                                        "title": "Você tem certeza?", 
                                        "message": "Esta ação é irreversível. Deseja continuar com a exclusão?", 
                                        "icon": "warning", 
                                        "confirmButtonText": "Sim, excluir", 
                                        "cancelButtonText": "Cancelar", 
                                        "confirmButtonColor": "danger", 
                                        "cancelButtonColor": "secondary"
                                    }'>
                                Excluir
                            </button> |
                            <a target="_blank" href="/projects/lexyhands/posts/<?php echo $post->identificator ?>/<?php echo date('d-m-Y', strtotime($post->date)) ?>/<?php echo $post->id ?>" class="btn btn-sm btn-primary-soft" w-tid="98">Visualizar</a>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if (empty($posts)) { ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Ops!</h4>
        <p>Não existem serviços criados.</p>
        <p>Clique <a href="/projects/lexyhands/admin/services/create">aqui</a> para criar um novo serviço.</p>
    </div>
<?php } ?>