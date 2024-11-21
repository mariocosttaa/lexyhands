<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Lista de Serviços
    <a href="/projects/lexyhands/admin/services/create" class="btn btn-primary-soft">
        <i class="bi bi-plus me-1"></i>
        Adicionar
    </a>
</h2>
<nav aria-label="breadcrumb" w-tid="102">
    <ol class="breadcrumb" w-tid="103">
        <li class="breadcrumb-item" w-tid="104">
            <a w-tid="105">
                <i class="bi bi-house-door me-1" w-tid="106"></i>Menu
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" w-tid="109">Serviços</li>
    </ol>
</nav>

<?php if (!empty($services)) { ?>
    <div class="row g-4" w-tid="91">
        <?php foreach ($services as $service) {
            $service = (object) $service; ?>
            <!-- Web Development Card -->
            <div class="col-12 col-md-6 col-lg-4" w-tid="92">
                <div class="card h-100 position-relative service-card" w-tid="93">
                    <img src="/projects/lexyhands/<?php echo $service->image ?>" alt="Web Development illustration showing code and design elements" class="card-img-top" height="200" style="object-fit: cover;" w-tid="94">
                    <div class="card-body" w-tid="95">
                        <h5 class="card-title mb-0" w-tid="96"><?php echo $service->name ?></h5>
                        <p class="card-text text-muted" w-tid="97"><?php echo $service->description ?></p>
                    </div>
                    <div class="card-footer mb-2">
                        <a href="/projects/lexyhands/admin/services/edit/<?php echo $service->id ?>" class="btn btn-sm btn-success-soft" w-tid="98">Editar</a> |
                        <a href="/projects/lexyhands/admin/services/delete/<?php echo $service->id ?>" class="btn btn-sm btn-danger-soft" w-tid="98">Apagar</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if (empty($services)) { ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Ops!</h4>
        <p>Não existem serviços criados.</p>
        <p>Clique <a href="/projects/lexyhands/admin/services/create">aqui</a> para criar um novo serviço.</p>
    </div>
<?php } ?>