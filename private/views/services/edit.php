<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Editar Serviço
    <a href="/../admin/services" class="btn btn-danger-soft">
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
        <li class="breadcrumb-item"><a href="/../admin/services">Serviços</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Serviço</li>
    </ol>
</nav>

<!-- Service Form -->
<div class="card">
    <div class="card-body">
        <form id="createServiceForm" method="POST" action="" enctype="multipart/form-data">
            <div class="row g-4">

                <!-- Service Name -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Nome do Serviço <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="name" value="<?php echo $service->name ?>" placeholder="Coloque o Nome do Serviço" required="">
                    </div>
                </div>

                <!-- Service Name -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Descrição do Serviço (opcional) </label>
                        <input type="text" class="form-control" name="description"  value="<?php echo $service->description ?>" placeholder="Coloque a descrição do Serviço">
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="col-12 mb-4">
                    <div class="image-upload-container position-relative" style="min-height: 300px; border: 2px dashed var(--border-dark); border-radius: 12px; overflow: hidden;">
                        <input type="file" id="serviceImage" name="image" class="position-absolute w-100 h-100 opacity-0" style="cursor: pointer" accept="image/*">
                        <div id="imagePreviewContainer" class="w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 300px; pointer-events: none;">
                            <div id="uploadPrompt" class="text-center p-4">
                                <i class="bi bi-cloud-upload display-4 mb-3 text-primary"></i>
                                <h5>Arraste uma imagem ou clique para selecionar</h5>
                                <p class="text-muted mb-0">PNG, JPG ou JPEG (max. 3MB)</p>
                            </div>
                            <?php if($service->featured_image ?? null) { ?>
                                <img id="imagePreview" class="position-absolute w-100 h-100 object-fit-cover" src="/<?php echo $service->featured_image ?>" alt="Preview">
                            <?php } else { ?>
                                <img id="imagePreview" class="position-absolute w-100 h-100 object-fit-cover d-none" alt="Preview">
                            <?php } ?>
                            
                        </div>

                    </div>
                </div>

                <script src="/..//private/assets/js/tinymce/tinymce.min.js"></script>
                <script>
                    // Inicializa o editor TinyMCE
                    tinymce.init({
                        selector: '#editor', // Seleciona o textarea pelo ID
                        menubar: false, // Remove a barra de menus
                        language: 'pt_BR', // Configura o idioma para português do Brasil
                        plugins: 'lists link table', // Ativa apenas plugins básicos
                        toolbar: 'undo redo | bold italic underline | bullist numlist | link table', // Configura a barra de ferramentas
                        branding: false, // Remove a marca do TinyMCE
                        height: 300, // Altura do editor
                    });
                </script>

                <!-- Editor --->
                 <div class="mb-2">
                    <label class="form-label">Informações do Serviço <b class="text-danger">*</b></label>
                    <textarea id="editor" name="content" placeholder="Escreva o conteúdo do Serviço" required><?php echo $service->content ?></textarea>
                 </div>

                <!-- Includes Section -->
                <div class="col-12 mb-4">
                    <label class="form-label">O que está incluído no serviço</label>
                    <div id="includesContainer">
                        <?php 
                        $includes = $service->includes_array ?? [];
                        if (empty($includes)) {
                            $includes = [''];
                        }
                        foreach ($includes as $index => $include) { ?>
                            <div class="mb-2 d-flex gap-2 include-row">
                                <input type="text" name="includes[]" class="form-control" value="<?php echo htmlspecialchars($include) ?>" placeholder="Ex: Massagem de corpo completo">
                                <button type="button" class="btn btn-danger-soft remove-include-btn" style="<?php echo count($includes) <= 1 ? 'display: none;' : '' ?>">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="button" id="addIncludeBtn" class="btn btn-sm btn-primary-soft mt-2">
                        <i class="bi bi-plus"></i> Adicionar Item
                    </button>
                </div>

                <!-- Prices Section -->
                <div class="col-12 mb-4">
                    <label class="form-label">Preços do Serviço</label>
                    <div id="pricesContainer">
                        <?php 
                        $prices = $service_prices ?? [];
                        if (empty($prices)) {
                            $prices = [['name' => '', 'price' => '', 'duration' => 60, 'currency' => 'EUR', 'description' => '']];
                        }
                        foreach ($prices as $index => $price) { 
                            $price = (object)$price;
                        ?>
                            <div class="card mb-3 price-row" data-row-id="<?php echo $index ?>">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Preço <?php echo $index + 1 ?></h6>
                                        <button type="button" class="btn btn-sm btn-danger-soft remove-price-btn">
                                            <i class="bi bi-trash"></i> Remover
                                        </button>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="form-label">Preço (€) <b class="text-danger">*</b></label>
                                            <input type="number" step="0.01" name="prices[<?php echo $index ?>][price]" class="form-control" value="<?php echo htmlspecialchars($price->price ?? '') ?>" placeholder="60.00" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Duração (min)</label>
                                            <input type="number" name="prices[<?php echo $index ?>][duration]" class="form-control" value="<?php echo htmlspecialchars($price->duration ?? 60) ?>" placeholder="60">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Moeda</label>
                                            <select name="prices[<?php echo $index ?>][currency]" class="form-select">
                                                <option value="EUR" <?php echo ($price->currency_code ?? 'EUR') == 'EUR' ? 'selected' : '' ?>>EUR - Euro</option>
                                                <option value="USD" <?php echo ($price->currency_code ?? '') == 'USD' ? 'selected' : '' ?>>USD - Dólar</option>
                                                <option value="BRL" <?php echo ($price->currency_code ?? '') == 'BRL' ? 'selected' : '' ?>>BRL - Real</option>
                                                <option value="AOA" <?php echo ($price->currency_code ?? '') == 'AOA' ? 'selected' : '' ?>>AOA - Kwanza</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Descrição do Preço (opcional)</label>
                                            <textarea name="prices[<?php echo $index ?>][description]" class="form-control" rows="2" placeholder="Ex: Ideal para relaxamento completo, incluindo pés e mãos"><?php echo htmlspecialchars($price->description ?? '') ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="button" id="addPriceBtn" class="btn btn-sm btn-primary-soft">
                        <i class="bi bi-plus"></i> Adicionar Preço
                    </button>
                </div>

            </div>

            <br><br>
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-lg btn-primary-soft" system-form-filter-validation-start="true">
                    Actualizar Serviço
                </button>
            </div>
            </div>
        </form>
    </div>
</div>
</div>


<script src="/..//private/assets/js/liveImageUpload.js"></script>

<script>
// Handle includes
let includeCounter = <?php echo count($service->includes_array ?? []) ?>;
document.getElementById('addIncludeBtn').addEventListener('click', function() {
    const container = document.getElementById('includesContainer');
    const newRow = document.createElement('div');
    newRow.className = 'mb-2 d-flex gap-2 include-row';
    newRow.innerHTML = `
        <input type="text" name="includes[]" class="form-control" placeholder="Ex: Massagem de corpo completo">
        <button type="button" class="btn btn-danger-soft remove-include-btn">
            <i class="bi bi-x"></i>
        </button>
    `;
    container.appendChild(newRow);
    updateIncludeButtons();
});

document.getElementById('includesContainer').addEventListener('click', function(e) {
    if (e.target.closest('.remove-include-btn')) {
        e.target.closest('.include-row').remove();
        updateIncludeButtons();
    }
});

function updateIncludeButtons() {
    const rows = document.querySelectorAll('.include-row');
    rows.forEach((row, index) => {
        const btn = row.querySelector('.remove-include-btn');
        btn.style.display = rows.length > 1 ? 'block' : 'none';
    });
}

// Handle prices
let priceCounter = <?php echo count($service_prices ?? []) - 1 ?>;
document.getElementById('addPriceBtn').addEventListener('click', function() {
    priceCounter++;
    const container = document.getElementById('pricesContainer');
    const newRow = document.createElement('div');
    newRow.className = 'card mb-3 price-row';
    newRow.setAttribute('data-row-id', priceCounter);
    newRow.innerHTML = `
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Preço ${priceCounter + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger-soft remove-price-btn">
                    <i class="bi bi-trash"></i> Remover
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">Preço (€) <b class="text-danger">*</b></label>
                    <input type="number" step="0.01" name="prices[${priceCounter}][price]" class="form-control" placeholder="60.00" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Duração (min)</label>
                    <input type="number" name="prices[${priceCounter}][duration]" class="form-control" placeholder="60" value="60">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Moeda</label>
                    <select name="prices[${priceCounter}][currency]" class="form-select">
                        <option value="EUR" selected>EUR - Euro</option>
                        <option value="USD">USD - Dólar</option>
                        <option value="BRL">BRL - Real</option>
                        <option value="AOA">AOA - Kwanza</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Descrição do Preço (opcional)</label>
                    <textarea name="prices[${priceCounter}][description]" class="form-control" rows="2" placeholder="Ex: Ideal para relaxamento completo, incluindo pés e mãos"></textarea>
                </div>
            </div>
        </div>
    `;
    container.appendChild(newRow);
});

document.getElementById('pricesContainer').addEventListener('click', function(e) {
    if (e.target.closest('.remove-price-btn')) {
        e.target.closest('.price-row').remove();
    }
});
</script>

</body>
</html>