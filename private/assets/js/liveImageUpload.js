 // Simplified and fixed image upload handling
 document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('serviceImage');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPrompt = document.getElementById('uploadPrompt');

    fileInput.addEventListener('change', handleFileSelect);
    
    function handleFileSelect(event) {
        const file = event.target.files[0];
        
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            alert('Arquivo muito grande. Por favor selecione uma imagem menor que 2MB.');
            return;
        }

        if (!file.type.match('image.*')) {
            alert('Por favor selecione apenas arquivos de imagem.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('d-none');
            uploadPrompt.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }

    // Drag and drop support
    const dropZone = document.querySelector('.image-upload-container');

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.style.borderColor = 'var(--accent-color)';
        this.style.backgroundColor = 'var(--primary-soft)';
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.style.borderColor = 'var(--border-dark)';
        this.style.backgroundColor = 'transparent';
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.style.borderColor = 'var(--border-dark)';
        this.style.backgroundColor = 'transparent';
        
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect({target: {files: files}});
        }
    });
});




 // Image Upload Preview
 document.addEventListener('DOMContentLoaded', function() {
    const uploadContainer = document.querySelector('.image-upload-container');
    const fileInput = document.getElementById('serviceImage');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPrompt = document.getElementById('uploadPrompt');

    // Click handler
    uploadContainer.addEventListener('click', () => fileInput.click());

    // Drag and drop handlers
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadContainer.style.borderColor = 'var(--accent-color)';
        uploadContainer.style.backgroundColor = 'var(--primary-soft)';
    }

    function unhighlight(e) {
        uploadContainer.style.borderColor = 'var(--border-dark)';
        uploadContainer.style.backgroundColor = 'transparent';
    }

    uploadContainer.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (files[0]) {
            const file = files[0];
            if (file.size > 2 * 1024 * 1024) { // 2MB limit
                alert('Arquivo muito grande. Por favor selecione uma imagem menor que 2MB.');
                return;
            }

            if (!file.type.match('image.*')) {
                alert('Por favor selecione apenas arquivos de imagem.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
                uploadPrompt.classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    }
});