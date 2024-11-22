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

        <form action="" method="POST">
            <div class="row">
                <!-- Nome e Descrição -->
                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Nome do Producto <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="name" placeholder="Coloque o Nome do Produto" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Descrição Curta (Opcional)</label>
                        <input type="text" class="form-control" name="short_description" placeholder="Coloque a descrição do produto">
                    </div>
                </div>

            </div>

            <!-- Collapsible Sections -->
            <div class="accordion" id="productDetailsAccordion">
                <h6 class="mb-4"><strong>Informações do producto</strong></h6>
                <!-- Especificações -->
                <!-- Definição de Preço -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPrice">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="true" aria-controls="collapsePrice">
                            Definição de Preço
                        </button>
                    </h2>
                    <div id="collapsePrice" class="accordion-collapse collapse show" aria-labelledby="headingPrice" data-bs-parent="#productDetailsAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="totalPrice" class="form-label">Preço Total</label>
                                    <input type="text" id="totalPrice" name="total_price" class="form-control currency-input" placeholder="Digite o preço total">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="fakePrice" class="form-label">Preço Fake</label>
                                    <input type="text" id="fakePrice" name="fake_price" class="form-control currency-input" placeholder="Digite o preço fake">
                                </div>
                            </div>


                            <div class="mb-2">
                                <label for="currency" class="form-label">Moeda</label>
                                <select id="currency" class="form-select">
                                    <option value="USD">USD - Dólar</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="BRL">BRL - Real</option>
                                    <option value="AOA">AOA - Kwanza</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSpecifications">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpecifications" aria-expanded="false" aria-controls="collapseSpecifications">
                            Especificações do Produto
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
                                <input type="text" class="form-control" name="product_color" placeholder="Cor do produto">
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
                            Definição de Estoque
                        </button>
                    </h2>
                    <div id="collapseStock" class="accordion-collapse collapse" aria-labelledby="headingStock" data-bs-parent="#productDetailsAccordion">
                        <div class="accordion-body">
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="unlimitedStock" name="unlimited_stock" value="1">
                                    <label class="form-check-label" for="unlimitedStock">Estoque Ilimitado</label>
                                </div>
                            </div>

                            <div id="stockDetails">
                                <div class="mb-2">
                                    <label for="stock_quantity" class="form-label">Quantidade Total de Estoque</label>
                                    <input type="number" class="form-control" name="stock_quantity" placeholder="Digite a quantidade em estoque">
                                </div>

                                <div id="variantStock" class="mb-2">
                                    <label class="form-label">Definir Estoque por Variações</label>
                                    <div id="variantStockContainer">
                                        <div class="row g-2 mb-2">
                                            <div class="col-4">
                                                <input type="text" class="form-control" name="variant_size[]" placeholder="Tamanho (Ex: P, M, G)">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" name="variant_color[]" placeholder="Cor (Ex: Azul, Vermelho)">
                                            </div>
                                            <div class="col-4">
                                                <input type="number" class="form-control" name="variant_stock[]" placeholder="Quantidade">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="addVariant" class="btn btn-sm btn-secondary">Adicionar Variação</button>
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

<script>
    // Formatar número como moeda
    function formatCurrency(value, currencyCode) {
        if (!value) return "";
        const options = {
            style: 'currency',
            currency: currencyCode,
            minimumFractionDigits: currencyCode === 'AOA' ? 3 : 2, // 3 casas para AOA
            maximumFractionDigits: currencyCode === 'AOA' ? 3 : 2
        };

        const formatter = new Intl.NumberFormat('pt-BR', options);
        return formatter.format(value);
    }

    // Lógica para formatar os campos de entrada
    document.querySelectorAll('.currency-input').forEach(input => {
        input.addEventListener('input', function(e) {
            const currency = document.getElementById('currency').value; // Moeda selecionada
            const rawValue = this.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
            const numericValue = parseFloat(rawValue) / 1000; // Ajusta para Kwanza (três casas)
            this.value = formatCurrency(numericValue, currency); // Aplica a formatação
        });

        input.addEventListener('blur', function() {
            if (!this.value) this.value = formatCurrency(0, document.getElementById('currency').value); // Preenche com 0 caso esteja vazio
        });
    });

    // Atualizar os preços ao alterar a moeda
    document.getElementById('currency').addEventListener('change', function() {
        const currency = this.value;
        document.querySelectorAll('.currency-input').forEach(input => {
            const rawValue = input.value.replace(/[^\d.,]/g, '').replace(',', '.'); // Remove símbolos e converte
            const numericValue = parseFloat(rawValue) || 0; // Converte o valor
            input.value = formatCurrency(numericValue, currency); // Atualiza com a nova moeda
        });
    });
</script>


<script>
    // Lógica para alternar entre estoque ilimitado e detalhado
    document.getElementById('unlimitedStock').addEventListener('change', function() {
        const stockDetails = document.getElementById('stockDetails');
        stockDetails.style.display = this.checked ? 'none' : 'block';
    });

    // Lógica para adicionar mais variações de estoque
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
            <div class="col-4">
                <input type="number" class="form-control" name="variant_stock[]" placeholder="Quantidade">
            </div>
        `;
        container.appendChild(row);
    });
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