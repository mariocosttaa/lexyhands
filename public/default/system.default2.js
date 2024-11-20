
function addUrlParam(event) {
    // Get the clicked element
    const elem = event.target;
  
    // Check if the element has the attribute "add-url-param"
    if (elem.hasAttribute("add-url-param")) {
      // Get the parameter value from the attribute
      const param = elem.getAttribute("add-url-param");
  
      // Check if the element has the attribute "url-param-delete-old"
      const deleteOldParams = elem.hasAttribute("url-param-delete-old") && elem.getAttribute("url-param-delete-old") === "true";
  
      // Get the current URL
      let currentUrl = window.location.href;
  
      // Parse the URL parameters
      const urlParams = new URLSearchParams(window.location.search);
  
      if (deleteOldParams) {
        // Remove all existing parameters
        urlParams.forEach((value, key) => {
          urlParams.delete(key);
        });
      }
  
      // Add or update the parameter to the URL parameters
      const paramName = param.split("=")[0];
      const paramValue = param.split("=")[1];
      urlParams.set(paramName, paramValue);
  
      // Build the new URL
      let newUrl = window.location.origin + window.location.pathname;
      if (urlParams.toString() !== "") {
        newUrl += "?" + urlParams.toString();
      }
  
      // Update the URL in the browser's address bar
      window.history.pushState({}, '', newUrl);
    }
  }
  
  // Add an event listener to all elements with the "add-url-param" attribute
  document.addEventListener("click", (event) => {
    addUrlParam(event);
  });







    // Seleciona todos os inputs do tipo radio com o atributo data-div-number
    const radios = document.querySelectorAll('input[type="radio"][data-div-number]');

    // Adiciona um evento de mudança para cada input
     radios.forEach((radio) => {
      radio.addEventListener('change', () => {
        // Pega o nome do input
        const name = radio.name;

        // Pega o valor do atributo data-div-number do input selecionado
        const divNumber = radio.getAttribute('data-div-number');

        // Seleciona todas as divs com o atributo div-show-number igual ao valor do input
        const divs = document.querySelectorAll(`div[div-show-number="${divNumber}"]`);

        // Mostra a div correspondente
        divs.forEach((div) => {
          div.style.display = 'block';
        });

        // Esconde as outras divs com o mesmo nome
        document.querySelectorAll(`input[name="${name}"]`).forEach((input) => {
          if (input !== radio) {
            const otherDivNumber = input.getAttribute('data-div-number');
            const otherDivs = document.querySelectorAll(`div[div-show-number="${otherDivNumber}"]`);
            otherDivs.forEach((div) => {
              div.style.display = 'none';
            });
          }
        });
      });
    });











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
            const renamedFile = new File([f], newFileName, { type: f.type });
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










// Função para verificar o número de caracteres em um input
function verificarCaracteres(e, maxCaracteres) {
    const valor = e.target.value;

    if (valor.length > maxCaracteres) {
        e.target.style.border = '1px solid red';
        e.target.style.color = 'red';
        e.target.value = valor.substring(0, maxCaracteres);
    } else {
        e.target.style.border = '';
        e.target.style.color = '';
    }
}

// Função para adicionar evento de keyup em todos os inputs com o atributo "data-max-caracteres"
function adicionarEvento() {
    const inputs = document.querySelectorAll('[data-max-caracteres]');

    inputs.forEach((input, index) => {
        input.addEventListener('keyup', (e) => {
            const maxCaracteres = input.getAttribute('data-max-caracteres');
            verificarCaracteres(e, maxCaracteres);
        });
    });
}







//função para BAIXAR FICHEIROS USANDO NO HTMLK, 
// download-file= AO VALOR DA DIREÇÃO DO FICHEITO


// Função para verificar o número de cliques em um cookie
function getclickCountDownload() {
    const cookies = document.cookie.split(';');
    let clickCountDownload = 0;

    cookies.forEach((cookie) => {
        const [key, value] = cookie.trim().split('=');
        if (key === 'clickCountDownload') {
            clickCountDownload = parseInt(value);
        }
    });

    return clickCountDownload;
}



// Função para atualizar o número de cliques em um cookie
function updateclickCountDownload() {
    const clickCountDownload = getclickCountDownload() + 1;

    //COLOCANDO PARA APAGAR O COOKIE A CADA 5 MINUTOS
    const clickCountDownloadCookie5 = new Date();
    clickCountDownloadCookie5.setMinutes(clickCountDownloadCookie5.getMinutes() + 5);

    return document.cookie = `clickCountDownload=${clickCountDownload}; expires=${clickCountDownloadCookie5.toUTCString()}`;
}

// Função para verificar se o usuário pode realizar o download
function canDownload() {
    const clickCountDownload = getclickCountDownload();
    const lastDownloadTime = getlastDownloadTime();

    if (clickCountDownload >= 5 && Date.now() - lastDownloadTime < 60000) {
        return false;
    }

    return true;
}



function canDownloadSec() {
    const clickCountDownload = getclickCountDownload();
    const lastDownloadTime = getlastDownloadTime();

    if (clickCountDownload >= 5 && Date.now() - lastDownloadTime < 60000) {
        const tempoRestante = 60 - Math.floor((Date.now() - lastDownloadTime) / 1000);
        return tempoRestante * 1000;
    }

    return 60000;
}


// Função para obter a data do último download
function getlastDownloadTime() {
    const cookies = document.cookie.split(';');
    let lastDownloadTime = 0;

    cookies.forEach((cookie) => {
        const [key, value] = cookie.trim().split('=');
        if (key === 'lastDownloadTime') {
            lastDownloadTime = parseInt(value);
        }
    });

    return lastDownloadTime;
}

// Função para atualizar a data do último download
function updatelastDownloadTime() {
    //criar o cookie,
    const dateDownload = new Date();
    //  cookie expirando a cada 5 minutos
    dateDownload.setMinutes(dateDownload.getMinutes() + 5);
    return document.cookie = `lastDownloadTime=${Date.now()}; expires=${dateDownload.toUTCString()}`;
}

function downloadFile(url) {
    const a = document.createElement('a');
    a.href = url;
    a.download = '';
    a.click();
    a.remove();
}

function secRemaingingShowF() {
    let receiveSegunds = canDownloadSec() / 1000;
    if (canDownloadSec() >= 50000) {
        return '1 Minuto';
    } else {
        return receiveSegunds + ' Segundos';
    }
}



document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('[download-file]');

    elements.forEach((element) => {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            const url = element.getAttribute('download-file');

            let remainingTime = canDownloadSec();
            let secRemaingingShow = secRemaingingShowF();

            if (!canDownload()) {

                Swal.fire({
                    position: 'top-end',
                    title: `Aguarde ${secRemaingingShow} e tente novamente`,
                    icon: 'warning',
                    timer: remainingTime,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    didClose: () => {
                        // Atualiza o tempo restante quando o modal é fechado
                        secRemaingingShow = canDownloadSec() + ' Segundos';
                        remainingTime = secRemaingingShowF();
                    }
                });
                return;
            }

            updateclickCountDownload();
            updatelastDownloadTime();

            Swal.fire({
                title: 'Preparando download...',
                icon: 'info',
                timer: 3000,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {

                    Swal.fire({
                        position: 'top-end',
                        html: 'Ficheiro Descarregado ! <br> <small>Se não consegui descarregar, tente novamente</small>',
                        icon: 'success',
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 5500,
                        timerProgressBar: true,
                    });


                    //    Swal.fire({
                    //        title: 'Ficheiro Descarregado !',
                    //        html: 'Não conseguiu descarregar ?',
                    //        icon: 'success',
                    //        showConfirmButton: true,
                    //        confirmButtonText: 'Baixar Novamente',
                    //        confirmButtonColor: '#3085d6',
                    //        confirmButtonClass: 'btn btn-success',
                    //        showCancelButton: true,
                    //        cancelButtonText: 'Fechar',
                    //        cancelButtonColor: '#d33',
                    //        cancelButtonClass: 'btn btn-danger',
                    //    }).then((result) => {
                    //        if (result.isConfirmed) {
                    //            downloadFile(url);
                    //        }
                    //    });

                    downloadFile(url);
                }
            });
        });
    });
});








// Função para calcular o IVA e atualizar o resultado
function calculateVat() {
    // Seleciona todos os inputs com atributo 'vat-input'
    const vatInputs = document.querySelectorAll('[vat-input]');

    vatInputs.forEach((input) => {
        // Obtém o valor do input, remove pontos (milhares) e substitui vírgulas por pontos
        let inputValue = input.value.replace(/\./g, '').replace(',', '.');

        // Converte o valor para um número flutuante
        let vatInputValue = parseFloat(inputValue);

        if (!isNaN(vatInputValue)) {
            // Calcula o valor do IVA
            const vatAmount = vatInputValue * vatRate;

            // Atualiza o elemento HTML que exibe o resultado
            const vatCalculationResultElement = document.querySelector(`[vat-calculation-result="${input.getAttribute('vat-input')}"]`);

            if (vatCalculationResultElement) {
                vatCalculationResultElement.value = formatMoneyVat(vatAmount);
            }
        }
    });
}

// Função para formatar o valor monetário
function formatMoneyVat(value) {

    // Certifica-se que o valor é numérico e arredonda para o número correto de casas decimais
    value = parseFloat(value).toFixed(decimalPlaces);

    // Divide o valor em parte inteira e decimal
    let parts = value.split('.');
    let integerPart = parts[0];
    let decimalPart = parts[1];

    // Adiciona separadores de milhar na parte inteira
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Retorna o valor formatado com separadores de milhar e decimais
    return `${integerPart},${decimalPart}`;
}

// Adiciona um event listener para os inputs com 'vat-input'
document.querySelectorAll('[vat-input]').forEach((input) => {
    input.addEventListener('input', calculateVat);
});


//função apra alterar o status
document.querySelectorAll('#changeStatus').forEach(function(button) {
    button.addEventListener('click', function() {
        this.closest('form').submit();  // Submete o formulário mais próximo ao botão clicado
    });
});
