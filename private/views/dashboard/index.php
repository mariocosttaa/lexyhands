<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Dashboard
</h2>

<nav aria-label="breadcrumb" w-tid="101">
    <ol class="breadcrumb" w-tid="102">
        <li class="breadcrumb-item" w-tid="103">
            <a href="/../" w-tid="104">
                <i class="bi bi-house-door me-1" w-tid="105"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item" w-tid="106">
            <a w-tid="107">Admin</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" w-tid="108">Dashboard</li>
    </ol>
</nav>


<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-people text-primary"></i>
                    </div>
                    <div>
                        <p class="card-title mb-0">Productos</p>
                        <h3><?php echo $products ?></h3>
                        <span class="badge text-success">
                            <i class="bi bi-arrow-up-short"></i>12%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-clock-history text-info"></i>
                    </div>
                    <div>
                        <p class="card-title mb-0">Postagens</p>
                        <h3><?php echo $posts ?></h3>
                        <span class="badge text-danger">
                            <i class="bi bi-arrow-down-short"></i>3%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-cpu text-warning"></i>
                    </div>
                    <div>
                        <p class="card-title mb-0">Visitas Hoje</p>
                        <h3><?php echo $todayTraffic ?></h3>
                        <span class="badge text-success">
                            <i class="bi bi-arrow-up-short"></i>Stable
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-lightning text-danger"></i>
                    </div>
                    <div>
                        <p class="card-title mb-0">Interações (INOP)</p>
                        <h3>0</h3>
                        <span class="badge text-success">
                            <i class="bi bi-arrow-down-short"></i><small>indisponível</small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Gráfico de Visitas</h5>
                <div class="chart-container">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Distribuição de Visitantes</h5>
                <div class="chart-container">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
