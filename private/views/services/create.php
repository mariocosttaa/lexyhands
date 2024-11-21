<h2 class="page-header-title d-flex align-items-center justify-content-between">
    Criar Serviço
</h2>

<nav aria-label="breadcrumb" w-tid="102">
    <ol class="breadcrumb" w-tid="103">
        <li class="breadcrumb-item" w-tid="104">
            <a w-tid="105">
                <i class="bi bi-house-door me-1" w-tid="106"></i>Menu
            </a>
        </li>
        <li class="breadcrumb-item"><a href="/projects/lexyhands/admin/services">Serviços</a></li>
        <li class="breadcrumb-item active" aria-current="page">Criar Serviço</li>
    </ol>
</nav>

<!-- Service Form -->
<div class="card">
    <div class="card-body">
        <form id="createServiceForm" method="POST" action="/projects/lexyhands/service/create/post">
            <div class="row g-4">

                <!-- Service Name -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Nome do Serviço <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="name" placeholder="Coloque o Nome do Serviço" required="">
                    </div>
                </div>

                <!-- Service Name -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Descrição do Serviço (opcional) </label>
                        <input type="text" class="form-control" name="description" placeholder="Coloque a descrição do Serviço">
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="col-12 mb-4">
                    <div class="image-upload-container position-relative" style="min-height: 300px; border: 2px dashed var(--border-dark); border-radius: 12px; overflow: hidden;">
                        <input type="file" id="serviceImage" class="position-absolute w-100 h-100 opacity-0" style="cursor: pointer" accept="image/*">
                        <div id="imagePreviewContainer" class="w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 300px; pointer-events: none;">
                            <div id="uploadPrompt" class="text-center p-4">
                                <i class="bi bi-cloud-upload display-4 mb-3 text-primary"></i>
                                <h5>Arraste uma imagem ou clique para selecionar</h5>
                                <p class="text-muted mb-0">PNG, JPG ou JPEG (max. 2MB)</p>
                            </div>
                            <img id="imagePreview" class="position-absolute w-100 h-100 object-fit-cover d-none" alt="Preview">
                        </div>
                    </div>
                </div>

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

                <!-- Editor --->
                 <div class="mb-2">
                    <label class="form-label">Informações do Serviço <b class="text-danger">*</b></label>
                    <textarea id="editor" nama="content" required>
                        <p>Escreva seu texto ou HTML aqui...</p>
                    </textarea>
                 </div>

            </div>

            <br><br>
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-lg btn-primary-soft" system-form-filter-validation-start="true">
                    Criar Serviço
                </button>
            </div>
            </div>
        </form>
    </div>
</div>
</div>


<script src="http://localhost/projects/lexyhands/private/assets/js/liveImageUpload.js"></script>

</body>
</html>