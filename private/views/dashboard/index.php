
    <nav aria-label="breadcrumb" w-tid="101">
            <ol class="breadcrumb" w-tid="102">
                <li class="breadcrumb-item" w-tid="103">
                    <a href="https://example.com/home" w-tid="104">
                        <i class="bi bi-house-door me-1" w-tid="105"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item" w-tid="106">
                    <a href="https://example.com/admin" w-tid="107">Admin</a>
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
                                <p class="card-title mb-0">Users</p>
                                <h3>1,534</h3>
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
                                <p class="card-title mb-0">Sessions</p>
                                <h3>423</h3>
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
                                <p class="card-title mb-0">CPU Load</p>
                                <h3>65%</h3>
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
                                <p class="card-title mb-0">Response</p>
                                <h3>0.8s</h3>
                                <span class="badge text-success">
                                    <i class="bi bi-arrow-down-short"></i>Fast
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
                        <h5 class="card-title">Traffic Overview</h5>
                        <div class="chart-container">
                            <canvas id="trafficChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Distribution</h5>
                        <div class="chart-container">
                            <canvas id="userChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recent Activity</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Updated profile</td>
                                <td>2 minutes ago</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Created new post</td>
                                <td>15 minutes ago</td>
                                <td><span class="badge bg-info">In Progress</span></td>
                            </tr>
                            <tr>
                                <td>Mike Johnson</td>
                                <td>Deleted comment</td>
                                <td>1 hour ago</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

