<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Lista de Postagens
    <a href="/../admin/posts/categories/create" class="btn btn-primary-soft">
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

<?php if (!empty($categories)) { ?>
    <div class="row g-4" w-tid="91">
        <?php foreach ($categories as $category) {  $category = (object) $category;
        ?>
            <!-- Web Development Card -->
            <div class="col-12 col-md-6 col-lg-4" w-tid="92">
                <div class="card h-100 position-relative service-card" w-tid="93">
                    <div class="card-body" w-tid="95">
                        <h5 class="card-title mb-0" w-tid="96"><?php echo $category->name ?></h5>
                        <p class="card-text text-muted" w-tid="97"><?php echo $category->description ?: 'Sem Nenhuma Descrição'; ?></p>
                    </div>
                    <div class="card-footer mb-2">
                        <form action="/../admin/posts/categories/delete/<?php echo $category->identificator ?>" method="POST">
                            <a href="/../admin/posts/categories/edit/<?php echo  $category->identificator ?>" class="btn btn-sm btn-success-soft" w-tid="98">Editar</a> |
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
                            <a target="_blank" href="/../posts/categories/<?php echo $category->identificator ?>" class="btn btn-sm btn-primary-soft" w-tid="98">Visualizar</a>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if (empty($categories)) { ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Ops!</h4>
        <p>Não existem Categorias criadas.</p>
        <p>Clique <a href="/../admin/posts/categories/create">aqui</a> para criar uma nova Categoria.</p>
    </div>
<?php } ?>