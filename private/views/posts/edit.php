<h2 class="page-header-title d-flex align-items-center justify-content-between">
    A editar Postagem
    <a href="/../admin/posts" class="btn btn-danger-soft">
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
        <li class="breadcrumb-item active" aria-current="page">Criar Postagem</li>
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
                        <label class="form-label">Título da Postagem <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="tittle" value="<?php echo $post->tittle ?>" placeholder="Coloque o Título da Postagem" required="">
                    </div>
                </div>

                <!-- Service Name -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Subtítulo da Postagem (opcional) </label>
                        <input type="text" class="form-control" name="subtittle" value="<?php echo $post->subtittle ?>" placeholder="Coloque o Subtítulo da Postagem">
                    </div>
                </div>


                <style>
                    .img-fluid {
                        max-width: 40px;
                        height: auto;
                    }
                </style>

                <div class="col-12">
                    <div class="mb-2">
                        <label class="form-label">Adicionar Imagem(s) <b class="text-danger">*</b> <br> <small class="text-danger">Tamamho máximo Permitido 5 MB</small></label>

                        <div class="styleFile mb-3" style="cursor: pointer;">
                            <div class="fallback">
                                <input name="images[]" type="file" multiple="multiple" class="attachment-input" style="display: none;">
                            </div>
                            <div class="dz-message needsclick d-flex align-items-center justify-content-center" style="min-height: 220px; border: 2px dashed #e9ebec; border-radius: 6px;">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                    </div>
                                    <h4>Clique e selecione a(s) imagem(s)</h4>
                                </div>
                            </div>
                            <ul class="list-unstyled styleFile-preview"></ul>
                        </div>
                        <?php if (!empty($post->images)) { ?>
                            <ul class="list-unstyled">
                                <?php foreach (json_decode($post->images) as $key => $image) { ?>
                                    <li class="mt-2" id="styleFile-preview-list-product-8.jpg">
                                        <div class="border rounded">
                                            <div class="d-flex p-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm bg-light rounded">
                                                        <img class="img-fluid rounded d-block" src="/<?php echo $image ?>">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="pt-1">
                                                        <h5 class="fs-14 mb-1"><?php echo basename($image) ?></h5>
                                                        <p class="fs-13 text-muted mb-0">Tamanho Indisponível</p>
                                                    </div>
                                                </div>
                                                <?php if (count(json_decode($post->images)) > 1) { ?>
                                                    <div class="flex-shrink-0 ms-3">
                                                        <button type="submit" class="btn btn-sm btn-danger" w-tid="98"
                                                            data-alert-config='{
                                                            "type": "action", 
                                                            "redirect": "/../admin/products/delete/images/<?php echo $key ?>/<?php echo $post->identificator ?>",
                                                            "title": "Você tem certeza?", 
                                                            "message": "Esta ação é irreversível. Deseja continuar com a exclusão?", 
                                                            "icon": "warning", 
                                                            "confirmButtonText": "Sim, excluir", 
                                                            "cancelButtonText": "Cancelar", 
                                                            "confirmButtonColor": "danger", 
                                                            "cancelButtonColor": "secondary"
                                                        }'>
                                                            Excluir
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>


                <!-- Video Upload -->
                <div class="col-12">
                    <label class="form-label">Vídeo da Postagem (opcional)</label>
                    <input type="file" class="form-control" name="video" accept="video/*">
                    <?php if (!empty($post->video)): ?>
                        <div class="mt-3">
                            <video controls height="400px" class="w-100">
                                <source src="/<?= $post->video ?>" type="video/mp4">
                                Seu navegador não suporta reprodução de vídeo.
                            </video>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($post->video)) { ?>
                    <button type="submit" class="btn btn-sm btn-danger" w-tid="98"
                        data-alert-config='{
                            "type": "action", 
                            "redirect": "/../admin/posts/delete/video/<?php echo $post->identificator ?>",
                            "title": "Você tem certeza?", 
                            "message": "Esta ação é irreversível. Deseja continuar com a exclusão?", 
                            "icon": "warning", 
                            "confirmButtonText": "Sim, excluir", 
                            "cancelButtonText": "Cancelar", 
                            "confirmButtonColor": "danger", 
                            "cancelButtonColor": "secondary"
                        }'>
                        Excluir Video
                    </button>
                    <?php } ?>

                </div>



                <div class="col-12">
                    <!-- Editor --->
                    <div class="mb-2">
                        <label class="form-label">Informações da Postagem <b class="text-danger">*</b></label>
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
                        <textarea id="editor" name="content" placeholder="Escreva o conteúdo do Serviço" required>
                            <?php echo $post->content ?>
                        </textarea>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Categoria <b class="text-danger">*</b></label>
                        <select name="category" class="form-control" required>
                            <option value="" disabled selected>Selecione a Categoria</option>
                            <?php foreach ($categories as $category) {
                                $category = (object) $category; ?>
                                <option value="<?php echo $category->id ?>" <?php if ($post->category == $category->id) echo 'selected' ?: '' ?>><?php echo $category->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Tags (Opcional) </label>
                        <?php if (!empty($post->tags)) { ?>
                            <input name="tags[]" value="<?php echo implode(separator: ',', array: json_decode(json: $post->tags, associative: true)) ?>" type="text" id="choices-tags" class="form-control" placeholder="Adicione tags...">
                        <?php } else { ?>
                            <input name="tags[]" type="text" id="choices-tags" class="form-control" placeholder="Adicione tags...">
                        <?php } ?>
                    </div>
                </div>


            </div>

            <br><br>
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-lg btn-primary-soft" system-form-filter-validation-start="true">
                    Actualizar Postagem
                </button>
            </div>
    </div>
    </form>
</div>



<!-- Include Choices CSS -->
<link rel="stylesheet" href="/../private/assets/js/choices.js/public/assets/styles/choices.min.css" />
<!-- Include Choices JavaScript -->
<script src="/../private/assets/js/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    // Inicializando Choices no campo de tags
    const tagsInput = new Choices('#choices-tags', {
        removeItemButton: true, // Botão para remover tags
        paste: true, // Permite colar múltiplos valores
        delimiter: ',', // Define o separador para múltiplos valores
        placeholder: true, // Habilita o suporte a placeholder
        placeholderValue: 'Adicione tags...' // Texto do placeholder
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


</body>

</html>