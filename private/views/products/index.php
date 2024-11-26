<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Lista de Productos
    <a href="/projects/lexyhands/admin/products/create" class="btn btn-primary-soft">
        <i class="bi bi-plus me-1"></i>
        Criar Producto
    </a>
</h2>
<nav aria-label="breadcrumb" w-tid="102">
    <ol class="breadcrumb" w-tid="103">
        <li class="breadcrumb-item" w-tid="104">
            <a w-tid="105">
                <i class="bi bi-house-door me-1" w-tid="106"></i>Menu
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" w-tid="109">Productos</li>
    </ol>
</nav>



<?php if (!empty($products)) { ?>
    <div class="row g-4 mb-2" w-tid="91">
        <?php foreach ($products as $product) {
            $product = (object) $product;

            if (!empty($product->images)) {
                $product->images = json_decode($product->images, true);
                $product->images = reset($product->images);
            } else {
                $product->images = null;
            }

            $prices = getPricebyProductId($product->id);
        ?>

            <div class="col-md-6 col-xl-4">
                <div class="card card-hover-shadow pb-0 h-100">
                    <!-- Card body START -->
                    <div class="card shadow p-2 pb-0 h-100">
                        <div class="card-body px-3">
                            <img style="object-fit: cover; width: 100%; height: 160px" src="/<?php echo $product->images ?>" class="card-img rounded-2" alt="Card image">
                            <!-- Title -->
                            <h5 class="card-title mb-0"><a href="/../admin/offers/view?id=37"><?php echo $product->name ?></a></h5>
                            <span><?php echo $product->description ?: 'Sem descrição' ?></span>
                        </div>
                        <!-- Card body END -->
                        <!-- Card footer START-->
                        <div class="card-footer pt-0 mb-0">
                            <!-- Price and Button -->
                            <div class="hstack gap-2">
                                <h6 class="fw-normal mb-0">Stock Total:</h6>
                                <span class="fw-semibold ms-1">120</span>
                            </div>
                            <?php foreach ($prices as $price) {
                                $price = (object) $price; ?>
                                <div class="hstack gap-2">
                                    <small><?php echo getCurrencyByCode(code: $price->currency)->name ?> <i class="bi bi-arrow-right"></i> </small>
                                    <h6 class="fw-normal text-success mb-0"><?php echo formatMoney(amount: $price->price, decimalPlaces: 2, currency: $price->currency, formatWithSymbol: true) ?></h6>
                                    <?php if (!empty($price->promo)) { ?>
                                        <span class="text-decoration-line-through text-danger"><?php echo formatMoney(amount: $price->price_promo, decimalPlaces: 2, currency: $price->currency) ?></span>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="mt-2 mt-sm-0">
                                <br>
                                <form action="/projects/lexyhands/admin/products/delete/<?php echo $product->identificator ?>" method="POST">
                                    <a href="/projects/lexyhands/admin/products/edit/<?php echo $product->identificator ?>" class="btn btn-sm btn-success-soft" w-tid="98">Editar</a> |
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
                                    <a href="/projects/lexyhands/admin/products/details/<?php echo $product->identificator ?>" class="btn btn-sm btn-info-soft disabled" w-tid="98">Detalhes</a> |
                                    <a class="btn btn-sm btn-primary-soft disable disabled" w-tid="98">
                                        Visualizar
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
<?php } ?>
<?php if (empty($products)) { ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Ops!</h4>
        <p>Não existem Productos criados.</p>
        <p>Clique <a href="/projects/lexyhands/admin/services/create">aqui</a> para criar um novo serviço.</p>
    </div>
<?php } ?>