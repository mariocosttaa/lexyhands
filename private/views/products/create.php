<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Criar Productos
    <a href="/projects/lexyhands/admin/products" class="btn btn-danger-soft">
        <i class="bi bi-arrow-left me-1"></i>
        Voltar
    </a>
</h2>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a>
                <i class="bi bi-house-door me-1"></i>Menu
            </a>
        </li>
        <li class="breadcrumb-item"><a href="/projects/lexyhands/admin/products">Productos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Criar Productos</li>
    </ol>
</nav>

<!-- Service Form -->
<div class="card">
    <div class="card-body">
        <h6 class="card-title mb-4">Criar Productos</h6>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Nome e Descrição -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Nome do Producto <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="name" placeholder="Coloque o Nome do Produto" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Descrição Curta (Opcional)</label>
                        <input type="text" class="form-control" name="short_description" placeholder="Coloque a descrição do produto">
                    </div>
                </div>


            </div>

            <div class="accordion" id="productDescription">
                <!-- Definição de Preço -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="productDescription">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription" aria-expanded="true" aria-controls="collapseDescription">
                            Descrição do Producto (Opcional)
                        </button>
                    </h2>
                    <div id="collapseDescription" class="accordion-collapse collapse show" aria-labelledby="productDescription" data-bs-parent="#productDescription">
                        <div class="accordion-body">
                            <div class="col-12 mb-2">
                                <!-- Editor --->
                                <script src="http://localhost/projects/lexyhands/private/assets/js/tinymce/tinymce.min.js"></script>
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
                                <textarea id="editor" name="description" placeholder="Escreva o conteúdo do Serviço">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="accordion" id="price">
                <!-- Definição de Preço -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPrice">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="true" aria-controls="collapsePrice">
                            Definição de Preço &nbsp;<b class="text-danger">*</b>
                        </button>
                    </h2>
                    <div id="collapsePrice" class="accordion-collapse collapse show" aria-labelledby="headingPrice" data-bs-parent="#price">
                        <div class="accordion-body">
                            <div id="priceContainer">
                                <div class="row price-row" data-row-id="1">
                                    <div class="col-md-4 mb-2">
                                        <label for="totalPrice1" class="form-label">Preço Total</label>
                                        <input type="text" id="totalPrice1" name="price[]" class="form-control currency-input" placeholder="Digite o preço total">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="fakePrice1" class="form-label">Preço Fake</label>
                                        <input type="text" id="fakePrice1" name="fake_price[]" class="form-control currency-input" placeholder="Digite o preço fake">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="prices_description1" class="form-label">Descrição (Opcinal)</label>
                                        <input type="text" id="prices_description1" name="prices_description[]" class="form-control" placeholder="Descrição (opcionao)">
                                    </div>
                                    <div class="col-md-2 mb-8">
                                        <label for="currency1" class="form-label">Moeda</label>
                                        <select id="currency1" name="currency[]" class="form-select currency-select">
                                            <option value="USD">USD - Dólar</option>
                                            <option value="EUR">EUR - Euro</option>
                                            <option value="BRL">BRL - Real</option>
                                            <option value="AOA">AOA - Kwanza</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button id="addPrice" type="button" class="btn btn-sm btn-primary-soft">Adicionar Preço</button>
                            <button id="removePrice" type="button" class="btn btn-sm btn-danger-soft d-none">Remover Preço</button>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- Collapsible Sections -->
            <div class="accordion mb-4" id="productDetailsAccordion">
                <!-- Especificações -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSpecifications">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpecifications" aria-expanded="false" aria-controls="collapseSpecifications">
                            Especificações do Produto (Opcinal)
                        </button>
                    </h2>
                    <div id="collapseSpecifications" class="accordion-collapse collapse" aria-labelledby="headingSpecifications" data-bs-parent="#productDetailsAccordion">
                        <div class="accordion-body">
                            <!-- Especificações Técnicas -->
                            <div class="mb-2">
                                <label for="specifications" class="form-label">Especificações Técnicas</label>
                                <textarea class="form-control" name="specifications" placeholder="Detalhes técnicos do produto"></textarea>
                            </div>

                            <!-- Dimensões -->
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <label for="product_length" class="form-label">Comprimento (cm)</label>
                                    <input type="number" class="form-control" name="product_length" placeholder="Comprimento do produto">
                                </div>
                                <div class="col-4">
                                    <label for="product_width" class="form-label">Largura (cm)</label>
                                    <input type="number" class="form-control" name="product_width" placeholder="Largura do produto">
                                </div>
                                <div class="col-4">
                                    <label for="product_height" class="form-label">Altura (cm)</label>
                                    <input type="number" class="form-control" name="product_height" placeholder="Altura do produto">
                                </div>
                            </div>

                            <!-- Peso -->
                            <div class="mb-2">
                                <label for="product_weight" class="form-label">Peso (kg)</label>
                                <input type="number" class="form-control" name="product_weight" placeholder="Peso do produto">
                            </div>

                            <!-- Material -->
                            <div class="mb-2">
                                <label for="product_material" class="form-label">Material</label>
                                <input type="text" class="form-control" name="product_material" placeholder="Material do produto">
                            </div>

                            <!-- Cor -->
                            <div class="mb-2">
                                <label for="product_color" class="form-label">Cor</label>
                                <input type="text" class="form-control" placeholder="Adicione a(s) cor(es)..." id="choices-color" name="product_color[]" placeholder="Cor do produto">
                            </div>

                            <!-- Outras Características Opcionais -->
                            <div class="mb-2">
                                <label for="other_features" class="form-label">Outras Características (Opcional)</label>
                                <textarea class="form-control" name="other_features" placeholder="Características adicionais do produto (Ex: Tecnologia, Funcionalidades, etc.)"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Estoque -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingStock">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStock" aria-expanded="false" aria-controls="collapseStock">
                            Definição de Estoque &nbsp;<b class="text-danger">*</b>
                        </button>
                    </h2>
                    <div id="collapseStock" class="accordion-collapse collapse" aria-labelledby="headingStock" data-bs-parent="#productDetailsAccordion">
                        <div class="accordion-body">
                            <div class="mb-2">
                                <div class="form-check">
                                    <input type="hidden" name="unlimited_stock" value="0">
                                    <input class="form-check-input" type="checkbox" id="unlimitedStock" name="unlimited_stock" value="1">
                                    <label class="form-check-label" for="unlimitedStock">Estoque Ilimitado</label>
                                </div>
                            </div>


                            <div id="stockDetails">
                                <!-- Estoque por Tamanho -->
                                <div class="accordion" id="stocks">

                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingSizeStock">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneralStock" aria-expanded="false" aria-controls="collapseGeneralStock">
                                                Estoque Geral
                                            </button>
                                        </h2>
                                        <div id="collapseGeneralStock" class="accordion-collapse collapse" aria-labelledby="headingSizeStock" data-bs-parent="#stocks">
                                            <div class="accordion-body">
                                                <div id="">
                                                    <div class="row g-2 mb-2">
                                                        <div class="col-12">
                                                            <input type="number" class="form-control" name="general_stock" placeholder="Quantidade">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingSizeStock">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSizeStock" aria-expanded="false" aria-controls="collapseSizeStock">
                                                Estoque por Tamanho
                                            </button>
                                        </h2>
                                        <div id="collapseSizeStock" class="accordion-collapse collapse" aria-labelledby="headingSizeStock" data-bs-parent="#stocks">
                                            <div class="accordion-body">
                                                <div id="sizeStockContainer">
                                                    <div class="row g-2 mb-2">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" name="size[]" placeholder="Tamanho (Ex: P, M, G)">
                                                        </div>
                                                        <div class="col-5">
                                                            <input type="number" class="form-control" name="size_stock[]" placeholder="Quantidade">
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="button" class="btn btn-danger btn-sm remove-size-stock">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="addSizeStock" class="btn btn-sm btn-secondary">Adicionar Estoque por Tamanho</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Estoque por Cor -->
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingColorStock">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColorStock" aria-expanded="false" aria-controls="collapseColorStock">
                                                Estoque por Cor
                                            </button>
                                        </h2>
                                        <div id="collapseColorStock" class="accordion-collapse collapse" aria-labelledby="headingColorStock" data-bs-parent="#stocks">
                                            <div class="accordion-body">
                                                <div id="colorStockContainer">
                                                    <div class="row g-2 mb-2">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" name="color[]" placeholder="Cor (Ex: Azul, Vermelho)">
                                                        </div>
                                                        <div class="col-5">
                                                            <input type="number" class="form-control" name="color_stock[]" placeholder="Quantidade">
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="button" class="btn btn-danger btn-sm remove-color-stock">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="addColorStock" class="btn btn-sm btn-secondary">Adicionar Estoque por Cor</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Estoque por Tamanho e Cor -->
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingVariantStock">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVariantStock" aria-expanded="false" aria-controls="collapseVariantStock">
                                                Estoque por Tamanho e Cor
                                            </button>
                                        </h2>
                                        <div id="collapseVariantStock" class="accordion-collapse collapse" aria-labelledby="headingVariantStock" data-bs-parent="#stocks">
                                            <div class="accordion-body">
                                                <div id="variantStockContainer">
                                                    <div class="row g-2 mb-2">
                                                        <div class="col-4">
                                                            <input type="text" class="form-control" name="variant_size[]" placeholder="Tamanho (Ex: P, M, G)">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" class="form-control" name="variant_color[]" placeholder="Cor (Ex: Azul, Vermelho)">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="number" class="form-control" name="variant_stock[]" placeholder="Quantidade">
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="addVariant" class="btn btn-sm btn-secondary">Adicionar Estoque por Tamanho e Cor</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <br>

            <style>
                .img-fluid {
                    max-width: 40px;
                    height: auto;
                }
            </style>

            <div class="col-12 mb-4">
                <div class="mb-2">
                    <label class="col-sm-3 col-form-label form-label">Adicionar Imagem(s) <br><small class="text-danger">Tamamho máximo Permitido 5 MB</small>
                    </label>

                    <div class="styleFile mb-3" style="cursor: pointer;">
                        <div class="fallback">
                            <input name="images[]" type="file" multiple="multiple" class="attachment-input" style="display: none;">
                        </div>
                        <div class="dz-message needsclick d-flex align-items-center justify-content-center" style="min-height: 250px; border: 3px dashed #e9ebec; border-radius: 6px;">
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                </div>
                                <h4>Clique e selecione a(s) imagem(s)</h4>
                            </div>
                        </div>
                        <ul class="list-unstyled styleFile-preview"></ul>
                    </div>

                </div>
            </div>


            <br><br>

            <!-- Estado -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="mb-2">
                        <label for="" class="form-label">Estado <b class="text-danger">*</b></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="status" name="status" checked>
                            <label class="form-check-label" for="status">Ativo</label>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Submit -->
            <div class="d-flex justify-content-end align-items-center mt-4">
                <button type="submit" class="btn btn-primary-soft">Criar Produto</button>
            </div>
        </form>
    </div>
</div>

<!-- Include Choices CSS -->
<link rel="stylesheet" href="/projects/lexyhands/private/assets/js/choices.js/public/assets/styles/choices.min.css" />
<!-- Include Choices JavaScript -->
<script src="/projects/lexyhands/private/assets/js/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    // Inicializando Choices no campo de tags
    const colorInput = new Choices('#choices-color', {
        removeItemButton: true, // Botão para remover tags
        paste: true, // Permite colar múltiplos valores
        delimiter: ',', // Define o separador para múltiplos valores
        placeholder: true, // Habilita o suporte a placeholder
        placeholderValue: 'Adicione a(s) cor(s)...' // Texto do placeholder
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let priceCounter = 1; // Contador de preços
        const availableCurrencies = {
            'usd': 'Dólar (USD)',
            'eur': 'Euro (EUR)',
            'brl': 'Real (BRL)',
            'aoa': 'Kwanza Angolano (AOA)',
        }; // Moedas disponíveis
        const priceContainer = document.getElementById('priceContainer');
        const addButton = document.getElementById('addPrice');
        const removeButton = document.getElementById('removePrice');

        // Função para formatar moeda
        const formatCurrency = (value, currencyCode) => {
            if (!value) return "";
            const options = {
                style: 'currency',
                currency: currencyCode,
                minimumFractionDigits: currencyCode === 'aoa' ? 3 : 2,
                maximumFractionDigits: currencyCode === 'aoa' ? 3 : 2
            };
            return new Intl.NumberFormat('pt-BR', options).format(value);
        };

        // Atualiza os campos de input com base na moeda selecionada
        const updateCurrencyInputs = () => {
            document.querySelectorAll('.currency-input').forEach(input => {
                const rawValue = input.value.replace(/[^\d.,]/g, '').replace(',', '.');
                const numericValue = parseFloat(rawValue) || 0;
                const currency = input.closest('.price-row').querySelector('.currency-select').value;
                input.value = formatCurrency(numericValue, currency);
            });
        };

        // Habilita/Desabilita o botão de adicionar/remover preços
        const toggleButtons = () => {
            const activeCurrencies = Array.from(document.querySelectorAll('.currency-select'))
                .map(select => select.value);
            addButton.style.display = activeCurrencies.length >= Object.keys(availableCurrencies).length ? 'none' : 'inline-block';
            removeButton.classList.toggle('d-none', priceCounter <= 1);
        };

        // Adiciona uma nova linha de preço
        const addPriceRow = () => {
            priceCounter++;
            const newRow = document.createElement('div');
            newRow.className = 'row price-row';
            newRow.dataset.rowId = priceCounter;

            const availableOptions = Object.keys(availableCurrencies)
                .filter(currency => !Array.from(document.querySelectorAll('.currency-select')).map(select => select.value).includes(currency))
                .map(currency => `<option value="${currency}">${availableCurrencies[currency]}</option>`)
                .join('');

            newRow.innerHTML = `

            <div class="col-12"><hr></div>

            <div class="col-md-4 mb-2">
                <label for="totalPrice${priceCounter}" class="form-label">Preço Total</label>
                <input type="text" id="totalPrice${priceCounter}" name="price[${availableCurrencies[Object.keys(availableCurrencies)[priceCounter-1]]}]" class="form-control currency-input" placeholder="Digite o preço total">
            </div>
            <div class="col-md-4 mb-2">
                <label for="fakePrice${priceCounter}" class="form-label">Preço Fake</label>
                <input type="text" id="fakePrice${priceCounter}" name="fake_price[${availableCurrencies[Object.keys(availableCurrencies)[priceCounter-1]]}]" class="form-control currency-input" placeholder="Digite o preço fake">
            </div>
            <div class="col-md-2 mb-2">
                <label for="fakePrice${priceCounter}" class="form-label">Descrição (Opcional) </label>
                <input type="text" id="description${priceCounter}" name="prices_description[${availableCurrencies[Object.keys(availableCurrencies)[priceCounter-1]]}]" class="form-control" placeholder="Digite a Descrição">
            </div>
            <div class="col-md-2 mb-2">
                <label for="currency${priceCounter}" class="form-label">Moeda</label>
                <select id="currency${priceCounter}" name="currency[${availableCurrencies[Object.keys(availableCurrencies)[priceCounter-1]]}]" class="form-select currency-select">${availableOptions}</select>
            </div>
        `;

            priceContainer.appendChild(newRow);
            toggleButtons();
        };

        // Remove a última linha de preço
        const removePriceRow = () => {
            if (priceCounter > 1) {
                priceContainer.lastElementChild.remove();
                priceCounter--;
                toggleButtons();
            }
        };

        // Atualiza os campos quando a moeda é alterada
        priceContainer.addEventListener('change', (e) => {
            if (e.target.classList.contains('currency-select')) {
                updateCurrencyInputs();
                toggleButtons();
            }
        });

        // Adiciona eventos aos campos de input para formatação
        priceContainer.addEventListener('input', (e) => {
            if (e.target.classList.contains('currency-input')) {
                const row = e.target.closest('.price-row');
                const currency = row.querySelector('.currency-select').value;
                const rawValue = e.target.value.replace(/[^\d]/g, '');
                const numericValue = parseFloat(rawValue) / (currency === 'AOA' ? 1000 : 100);
                e.target.value = formatCurrency(numericValue, currency);
            }
        });

        // Adiciona/Remove linhas ao clicar nos botões
        addButton.addEventListener('click', addPriceRow);
        removeButton.addEventListener('click', removePriceRow);

        // Inicializa os botões
        toggleButtons();
    });
</script>












<script>
    // Lógica para alternar estoque ilimitado
    document.getElementById('unlimitedStock').addEventListener('change', function() {
        const stockDetails = document.getElementById('stockDetails');
        stockDetails.style.display = this.checked ? 'none' : 'block';
    });

    // Adicionar e remover linhas para estoque por Tamanho
    document.getElementById('addSizeStock').addEventListener('click', function() {
        const container = document.getElementById('sizeStockContainer');
        const row = createRow('size', 'Tamanho (Ex: P, M, G)', 'size_stock', 'Quantidade');
        container.appendChild(row);
        toggleRemoveButtons('remove-size-stock');
    });

    document.getElementById('sizeStockContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-size-stock')) {
            e.target.closest('.row').remove();
            toggleRemoveButtons('remove-size-stock');
        }
    });

    // Adicionar e remover linhas para estoque por Cor
    document.getElementById('addColorStock').addEventListener('click', function() {
        const container = document.getElementById('colorStockContainer');
        const row = createRow('color', 'Cor (Ex: Azul, Vermelho)', 'color_stock', 'Quantidade');
        container.appendChild(row);
        toggleRemoveButtons('remove-color-stock');
    });

    document.getElementById('colorStockContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-color-stock')) {
            e.target.closest('.row').remove();
            toggleRemoveButtons('remove-color-stock');
        }
    });

    // Adicionar e remover linhas para estoque por Tamanho e Cor
    document.getElementById('addVariant').addEventListener('click', function() {
        const container = document.getElementById('variantStockContainer');
        const row = document.createElement('div');
        row.className = 'row g-2 mb-2';
        row.innerHTML = `
        <div class="col-4">
            <input type="text" class="form-control" name="variant_size[]" placeholder="Tamanho (Ex: P, M, G)">
        </div>
        <div class="col-4">
            <input type="text" class="form-control" name="variant_color[]" placeholder="Cor (Ex: Azul, Vermelho)">
        </div>
        <div class="col-3">
            <input type="number" class="form-control" name="variant_stock[]" placeholder="Quantidade">
        </div>
        <div class="col-1">
            <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
        </div>
    `;
        container.appendChild(row);
        toggleRemoveButtons('remove-variant');
    });

    document.getElementById('variantStockContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.row').remove();
            toggleRemoveButtons('remove-variant');
        }
    });

    // Função utilitária para criar linhas dinâmicas
    function createRow(name, placeholderName, stockName, placeholderStock) {
        const row = document.createElement('div');
        row.className = 'row g-2 mb-2';
        row.innerHTML = `
        <div class="col-6">
            <input type="text" class="form-control" name="${name}[]" placeholder="${placeholderName}">
        </div>
        <div class="col-5">
            <input type="number" class="form-control" name="${stockName}[]" placeholder="${placeholderStock}">
        </div>
        <div class="col-1">
            <button type="button" class="btn btn-danger btn-sm remove-${name}-stock">X</button>
        </div>
    `;
        return row;
    }

    // Alternar visibilidade do botão de remover
    function toggleRemoveButtons(className) {
        const buttons = document.querySelectorAll(`.${className}`);
        buttons.forEach(button => {
            button.style.display = buttons.length > 1 ? 'inline-block' : 'none';
        });
    }

    // Inicializar os botões de remover
    toggleRemoveButtons('remove-size-stock');
    toggleRemoveButtons('remove-color-stock');
    toggleRemoveButtons('remove-variant');
</script>











<script>
    // Função para verificar se o tipo de arquivo é permitido
    function isValidFileType(file) {
        const allowedTypes = [
            'image/jpeg', 'image/png', 'image/gif', // Imagens
            'video/mp4', 'video/avi', 'video/mkv', // Vídeos
            'application/pdf', // PDFs
            'application/msword', // .doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
            'application/vnd.ms-excel', // .xls
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // .xlsx
        ];
        return allowedTypes.includes(file.type);
    }

    // Função para criar um novo elemento de preview de arquivo
    function createFilePreview(file, container, deleteHandler, renameHandler) {
        // Verifica se o tipo de arquivo é válido
        if (!isValidFileType(file)) {
            alert('Tipo de arquivo não permitido: ' + file.type);
            return;
        }

        const li = document.createElement("li");
        li.className = "mt-2";
        li.id = `styleFile-preview-list-${file.name}`;

        const div = document.createElement("div");
        div.className = "border rounded";

        const dFlex = document.createElement("div");
        dFlex.className = "d-flex p-2";

        const flexShrink0 = document.createElement("div");
        flexShrink0.className = "flex-shrink-0 me-3";

        const avatarSm = document.createElement("div");
        avatarSm.className = "avatar-sm bg-light rounded";

        const img = document.createElement("img");
        img.className = "img-fluid rounded d-block";

        // Verifique se o arquivo é uma imagem
        if (file.type.match("image.*")) {
            // Adicione a imagem à lista de preview
            const reader = new FileReader();
            reader.onload = (e) => {
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else if (file.type.match("video.*")) {
            // Adicione uma imagem de pré-visualização para vídeos
            img.src = "../public/assets/images/files/all.png"; // Imagem de thumbnail para vídeos
        } else {
            // Adicione a imagem padrão para outros documentos
            img.src = "../public/assets/images/files/all.png";
        }

        avatarSm.appendChild(img);
        flexShrink0.appendChild(avatarSm);
        dFlex.appendChild(flexShrink0);

        const flexGrow1 = document.createElement("div");
        flexGrow1.className = "flex-grow-1";

        const pt1 = document.createElement("div");
        pt1.className = "pt-1";

        const h5 = document.createElement("h5");
        h5.className = "fs-14 mb-1";

        // Criar input para edição do nome
        const inputFileName = document.createElement("input");
        inputFileName.className = "form-control form-control-sm";
        inputFileName.type = "text";

        // Separar o nome do arquivo da extensão
        const fileName = file.name.split('.').slice(0, -1).join('.');
        const fileExtension = file.name.split('.').pop();
        inputFileName.value = fileName;

        // Atualiza o nome do arquivo quando o usuário altera o input
        inputFileName.addEventListener('change', function() {
            const newFileName = inputFileName.value.trim();
            if (newFileName) {
                h5.textContent = `${newFileName}.${fileExtension}`;
                renameHandler(file, newFileName + '.' + fileExtension); // Função para renomear o arquivo
            }
        });

        h5.appendChild(inputFileName); // Substitui o título por um campo editável
        pt1.appendChild(h5);

        const p = document.createElement("p");
        p.className = "fs-13 text-muted mb-0";
        p.textContent = file.size + " bytes";

        pt1.appendChild(p);
        flexGrow1.appendChild(pt1);
        dFlex.appendChild(flexGrow1);

        const flexShrink02 = document.createElement("div");
        flexShrink02.className = "flex-shrink-0 ms-3";

        const button = document.createElement("button");
        button.className = "btn btn-sm btn-danger";
        button.textContent = "Apagar";
        button.addEventListener("click", (event) => {
            // Impede a propagação do evento de clique
            event.stopPropagation();
            // Remova o arquivo da lista de preview
            li.remove();

            // Chame a função de exclusão do arquivo
            deleteHandler(file);
        });

        flexShrink02.appendChild(button);
        dFlex.appendChild(flexShrink02);
        div.appendChild(dFlex);
        li.appendChild(div);
        container.appendChild(li);
    }

    // Função para renomear o arquivo no input de arquivos
    function renameFile(fileInput, file, newFileName) {
        const dataTransfer = new DataTransfer();
        const files = Array.from(fileInput.files);

        // Substitua o nome do arquivo na lista de arquivos
        files.forEach(f => {
            if (f === file) {
                const renamedFile = new File([f], newFileName, {
                    type: f.type
                });
                dataTransfer.items.add(renamedFile);
            } else {
                dataTransfer.items.add(f);
            }
        });

        fileInput.files = dataTransfer.files;
    }

    // Adiciona eventos a todos os elementos com a classe .styleFile
    document.querySelectorAll('.styleFile').forEach(styleFile => {
        const inputFile = styleFile.querySelector('.attachment-input');
        const previewContainer = styleFile.querySelector('.styleFile-preview');

        // Adiciona o evento de clique na div .styleFile
        styleFile.addEventListener('click', function(event) {
            // Verifica se o clique foi fora da lista de pré-visualização
            if (!event.target.closest('.styleFile-preview')) {
                inputFile.click();
            }
        });

        // Adiciona um evento para quando um arquivo for selecionado
        inputFile.addEventListener('change', function() {
            // Obtenha os arquivos selecionados
            const files = this.files;

            // Limpe a lista de preview
            previewContainer.innerHTML = "";

            // Adicione os arquivos à lista de preview
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                createFilePreview(file, previewContainer, (fileToRemove) => {
                    removeFile(inputFile, fileToRemove);
                }, (fileToRename, newFileName) => {
                    renameFile(inputFile, fileToRename, newFileName);
                });
            }
        });

        // Adiciona os eventos de arrastar e soltar
        styleFile.addEventListener('dragover', function(event) {
            event.preventDefault();
            event.stopPropagation();
            styleFile.classList.add('dragging');
        });

        styleFile.addEventListener('dragleave', function(event) {
            event.preventDefault();
            event.stopPropagation();
            styleFile.classList.remove('dragging');
        });

        styleFile.addEventListener('drop', function(event) {
            event.preventDefault();
            event.stopPropagation();
            styleFile.classList.remove('dragging');

            // Obtém os arquivos arrastados
            const files = event.dataTransfer.files;

            // Limpe a lista de preview
            previewContainer.innerHTML = "";

            // Adiciona os arquivos à lista de preview
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                createFilePreview(file, previewContainer, (fileToRemove) => {
                    removeFile(inputFile, fileToRemove);
                }, (fileToRename, newFileName) => {
                    renameFile(inputFile, fileToRename, newFileName);
                });
            }

            // Atualiza o campo de entrada com os arquivos arrastados
            const dataTransfer = new DataTransfer();
            Array.from(inputFile.files).forEach(f => dataTransfer.items.add(f));
            Array.from(files).forEach(f => dataTransfer.items.add(f));
            inputFile.files = dataTransfer.files;
        });
    });
</script>