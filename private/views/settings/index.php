
<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Configurações
</h2>

<nav aria-label="breadcrumb" w-tid="101">
    <ol class="breadcrumb" w-tid="102">
        <li class="breadcrumb-item" w-tid="103">
            <a href="/../" w-tid="104">
                <i class="bi bi-house-door me-1" w-tid="105"></i>Início
            </a>
        </li>
        <li class="breadcrumb-item" w-tid="106">
            <a w-tid="107">Admin</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" w-tid="108">Configurações</li>
    </ol>
</nav>


<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Configurações</h5>

            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Gerais</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Logotipo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Redes Sociais</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-12 mb-2">
                        <form action="/../admin/settings/general" method="POST" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label class="form-label">Nome do Site (Empresa) <b class="text-danger">*</b></label>
                                <input type="text" name="site_name" value="<?php echo $settings->site_name ?>" class="form-control" placeholder="Escreva o nome do Site" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Email <b class="text-danger">*</b></label>
                                <input type="email" name="email" value="<?php echo $settings->email ?? $settings->contact_email ?? '' ?>" class="form-control" placeholder="coloque o email" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Número de Telefone </label>
                                <input type="text" name="phone" value="<?php echo $settings->phone ?? $settings->contact_phone ?? '' ?>" class="form-control" placeholder="Coloque o Número de Telefone">
                            </div>
                            <div class="d-flex justify-content-end align-items-center mt-4">
                                <a href="" class="btn btn-danger-soft">Reverter Alterações</a> &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary-soft">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-12 mb-2">
                        <form action="/../admin/settings/logos" method="POST" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label class="form-label">Logotipo <small>(Versão Branca ou Transparente /Recomendado)</small></label>
                                <small class="text-danger d-block  mb-0">Em caso de alteração, é substituido o logotipo actual, caso exista.</small>
                                <?php if (!empty($settings->site_logo)) echo '<img src="/' . $settings->site_logo . '" width="200" height="50" style="object-fit: cover;" alt="">'; ?>
                                <input type="file" name="site_logo[]" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Logotipo <small>(Versão Dark ou Transparente / Opcional)</small></label>
                                <small class="text-danger d-block  mb-0">Em caso de alteração, é substituido o logotipo actual, caso exista.</small>
                                <?php if (!empty($settings->site_logo_dark)) echo '<img src="/' . $settings->site_logo_dark . '" width="200" height="50" style="object-fit: cover;" alt="">'; ?>
                                <input type="file" name="site_logo_dark[]" class="form-control">
                            </div>

                            <div class="form-check form-switch form-check-md mb-3">
                                <input class="form-check-input" name="show_image" value="1" type="checkbox" <?php if (!empty($settings->show_logo)) echo 'checked' ?> <?php if (empty($settings->site_logo)) echo 'disabled' ?>>
                                <label class="form-check-label pt-1" for="checkPrivacy1">&nbsp;Mostrar Imagem</label>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-4">
                                <a href="" class="btn btn-danger-soft">Reverter Alterações</a> &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary-soft">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="col-12 mb-2">
                        <form action="/../admin/settings/social-media" method="POST" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label class="form-label">WhatsApp </label>
                                <input type="text" name="whatssap" value="<?php echo $settings->whatssap ?? $settings->whatsapp ?? '' ?>" class="form-control" placeholder="Coloque o número indicado no WhatsApp">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Facebook </label>
                                <input type="text" name="facebook" value="<?php echo $settings->facebook ?? $settings->facebook_url ?? '' ?>" class="form-control" placeholder="Coloque o link do seu Perfil">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">YouTube </label>
                                <input type="text" name="youtube" value="<?php echo $settings->youtube ?? '' ?>" class="form-control" placeholder="Coloque o link do seu Perfil">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">LinkedIn </label>
                                <input type="text" name="linkedin" value="<?php echo $settings->linkedin ?? $settings->linkedin_url ?? '' ?>" class="form-control" placeholder="Coloque o link do seu Perfil">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Pinterest </label>
                                <input type="text" name="pinterest" value="<?php echo $settings->pinterest ?? '' ?>" class="form-control" placeholder="Coloque o link do seu Perfil">
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-4">
                                <a href="" class="btn btn-danger-soft">Reverter Alterações</a> &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary-soft">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
