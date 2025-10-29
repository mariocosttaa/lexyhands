<!-- Sidebar -->
<nav class="sidebar px-4 py-4 card overflow-auto" id="sidebar" style="width: 280px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="brand-icon me-2">
                <i class="bi bi-grid-fill text-white"></i>
            </div>
            <h3 class="m-0" style="font-size: 1.25rem; letter-spacing: 0.5px;">Bindamy <small style="font-size:14px;">Site Control</small></h3>
        </div>
        <i class="bi bi-x-lg d-block d-md-none cursor-pointer" id="closeSidebar" style="padding: 8px; border-radius: 8px; transition: all 0.3s; cursor: pointer;" onclick="document.getElementById('sidebar').classList.remove('active'); const overlay = document.querySelector('.sidebar-overlay'); if(overlay) overlay.remove();"></i>
    </div>

    <div class="nav-section mb-4">
        <small class="text-muted text-uppercase fw-bold">Principal</small>
        <div class="nav flex-column mt-2">
            <a href="/../admin/dashboard" class="<?php isActive(dir: '/admin/dashboard') ?> nav-link d-flex align-items-center">
                <i class="bi bi-speedometer2 me-2"></i>
                <span>Dashboard </span>
            </a>
            <a href="/../" class="nav-link d-flex align-items-center">
                <i class="bi bi-globe me-2"></i>
                <span>Website </span>
            </a>
        </div>
    </div>

    <div class="nav-section mb-4">
        <small class="text-muted text-uppercase fw-bold">GESTÃO</small>
        <div class="nav flex-column mt-2">


            <a href="#" class="<?php isActive(dir: '/admin/posts') ?> <?php isActive(dir: '/admin/posts/create') ?> <?php isActive(dir: '/admin/posts/categories') ?> <?php isActive(dir: '/admin/posts/categories/create') ?>  nav-link d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-journal-text me-3"></i>
                <span>Comunidade </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="<?php isActive(dir: '/admin/posts') ?> dropdown-item" href="/../admin/posts">Postagens</a>
                <a class="<?php isActive(dir: '/admin/posts/categories') ?> dropdown-item" href="/../admin/posts/categories">Categorias</a>
                <a class="<?php isActive(dir: '/admin/posts/create') ?> dropdown-item" href="/../admin/posts/create">Criar Postagem</a>
            </div>

            <a href="#" class="
            <?php isActive(dir: '/admin/services') ?> <?php isActive(dir: '/admin/services/create') ?> nav-link d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-wrench me-3"></i>
                <span>Serviços </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="<?php isActive(dir: '/admin/services') ?> dropdown-item" href="/../admin/services">Listar Serviços</a>
                <a class="<?php isActive(dir: '/admin/services/create') ?> dropdown-item" href="/../admin/services/create">Criar Serviço</a>
            </div>

            <a href="#" class="
            <?php isActive(dir: '/admin/products') ?> <?php isActive(dir: '/admin/products/create') ?> nav-link d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-shop me-3"></i>
                <span>Productos </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="<?php isActive(dir: '/admin/products') ?> dropdown-item" href="/../admin/products">Listar Productos</a>
                <a class="<?php isActive(dir: '/admin/products/create') ?> dropdown-item" href="/../admin/products/create">Criar Producto</a>
            </div>

        </div>
    </div>

    <div class="nav-section mb-4">
        <small class="text-muted text-uppercase fw-bold">Definições</small>
        <div class="nav flex-column mt-2">
            <a href="/../admin/settings" class="<?php isActive(dir: '/admin/settings') ?> nav-link d-flex align-items-center">
                <i class="bi bi-wrench me-3"></i>
                <span>Configurações </span>
            </a>
        </div>
    </div>

    <!-- Indisponível
    <div class="mt-auto pt-4">
        <div class="card bg-primary bg-gradient text-white p-3" style="border-radius: 12px;">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-rocket-takeoff fs-4 me-2"></i>
                <h6 class="mb-0">Upgrade to Pro</h6>
            </div>
            <p class="small mb-2" style="opacity: 0.9;">Get access to all features</p>
            <button class="btn btn-light btn-sm w-100">Learn More</button>
        </div>
    </div>
     -->

</nav>

<!-- Main Content -->
<div class="main-content p-4">
    <!-- Header -->
    <header class="mb-4">
        <div class="d-flex justify-content-end align-items-center">
            <button style="margin-right: 45%;" class="btn btn-link d-md-none" id="sidebarToggle">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="d-flex align-items-center">
                <div class="ms-auto d-flex align-items-center header-actions">

                    <div class="theme-switch" id="themeSwitch">
                        <i class="bi bi-sun fs-4 text-white"></i>
                    </div>

                    <!-- Indisponível
                    <div class="dropdown header-dropdown">
                        <button class="btn btn-link position-relative" data-bs-toggle="dropdown">
                            <i class="bi bi-bell fs-4" style="color: inherit;"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill notification-badge">
                                3
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="https://example.com/notifications">
                                    <i class="bi bi-person-plus me-2"></i>
                                    New User Registration
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://example.com/notifications">
                                    <i class="bi bi-arrow-clockwise me-2"></i>
                                    System Update
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://example.com/notifications">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Server Alert
                                </a>
                            </li>
                        </ul>
                    </div>
                    --->

                    <!-- User Profile Dropdown -->
                    <div class="dropdown header-dropdown me-3">
                        <button class="btn btn-link d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                            <div class="avatar-circle me-2 d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold"><?php echo getInitials($main->user->name ?? '', $main->user->surname ?? '') ?></span>
                            </div>
                            <div class="d-none d-md-block text-start">
                                <div class="fw-bold" style="color: inherit"><?php echo $main->user->names ?? 'User' ?></div>
                                <div class="small text-muted"><?php echo (isset($main->user->role) && is_object($main->user->role) && isset($main->user->role->name)) ? $main->user->role->name : 'No Role' ?></div>
                            </div>
                            <i class="bi bi-chevron-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="https://example.com/profile">
                                    <i class="bi bi-person me-2"></i>
                                    Meu Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://example.com/settings">
                                    <i class="bi bi-gear me-2"></i>
                                    Configurações
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="/../auth/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <div class="container">