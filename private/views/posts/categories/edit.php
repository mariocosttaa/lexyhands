<h2 class="page-header-title d-flex align-items-center justify-content-between">
   Editar Categorias
    <a href="/../admin/posts/categories" class="btn btn-danger-soft">
        <i class="bi bi-arrow-left me-1"></i>
        Voltar
    </a>
</h2>

<nav aria-label="breadcrumb" w-tid="102">
    <ol class="breadcrumb" w-tid="103">
        <li class="breadcrumb-item" w-tid="104">
            <a w-tid="105">
                <i class="bi bi-house-door me-1" w-tid="106"></i>Menu
            </a>
        </li>
        <li class="breadcrumb-item"><a href="/../admin/posts">Comunidade</a></li>
        <li class="breadcrumb-item"><a href="/../admin/posts/categories">Categorias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Categorias</li>
    </ol>
</nav>

<!-- Service Form -->
<div class="card">
    <div class="card-body">
        <h6 class="card-tittle mb-4">Editar Categoria</h6>

        <form action="" method="POST">

            <div class="row">
                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Nome da Categoria <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="name" value="<?php echo $category->name ?>" placeholder="Coloque o Nome da Categoria" required="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Descrição (Opcional)</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $category->description ?>" placeholder="Coloque a descrição da categoria" >
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-2">
                        <label for="" class="form-label">Estado <b class="text-danger">*</b></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="status" name="status" <?php if ($category->status == 1) { echo "checked"; } ?>>
                            <label class="form-check-label" for="status">
                                Ativo
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-primary-soft" system-form-filter-validation-start="true">
                   Actualizar Categoria
                </button>
            </div>

        </form>

    </div>
</div>