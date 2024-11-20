/**
 * Função de Validação de Formulários Personalizada
 *
 * Esta função valida os formulários HTML com base em atributos personalizados definidos nos elementos <form>
 * e <input>. Ela lida com diferentes tipos de validação, exibe mensagens de erro apropriadas e suporta a
 * exibição de erros em um modal, se especificado. O comportamento pode ser ajustado com os seguintes parâmetros:
 *
 * Parâmetros do Formulário:
 * - system-form-filter-modal="true": Exibe um modal com os erros ao submeter o formulário.
 * - system-form-filter-modal-show-error-first="true": Exibe os erros embaixo dos inputs na primeira
 *   tentativa de envio, e depois mostra-os no modal nas tentativas subsequentes.
 *
 * Parâmetros do Input (no elemento <input>):
 * - system-form-filter-name: Nome do campo para validação.
 * - system-form-filter-type: Tipo de validação (STRING, NUMBER, BOOLEAN, EMAIL, INT, FLOAT, PASSWORD).
 * - system-form-filter-maxsize: Limite máximo de caracteres permitidos.
 * - system-form-filter-allowEmpty: Indica se o campo pode estar vazio (true/false).
 * - system-form-filter-message: Mensagem de erro personalizada a ser exibida se a validação falhar.
 *
 * Comportamento da Validação:
 * - A validação é realizada quando o usuário sai do campo de entrada (evento 'blur') e ao tentar enviar o formulário.
 * - Se o formulário contém os atributos para modal, os erros são agregados e exibidos em um alerta modal.
 * - Se houver erros, o formulário não é enviado e as mensagens de erro são exibidas abaixo dos inputs correspondentes.
 *
 * Como Usar:
 * 1. Inclua o script JavaScript no final do seu arquivo HTML, antes do fechamento da tag </body>.
 * 2. Certifique-se de que a biblioteca SweetAlert2 está incluída no seu projeto.
 * 3. Adicione os atributos apropriados aos seus formulários e inputs conforme necessário.
 * 4. Quando o usuário interagir com os formulários, a validação será aplicada automaticamente.
 *
 * Exemplo de HTML:
 * <form system-form-filter-modal="true" system-form-filter-modal-show-error-first="true">
 *     <input type="text" system-form-filter-name="username" system-form-filter-type="STRING"
 *            system-form-filter-maxsize="10" system-form-filter-allowEmpty="false"
 *            system-form-filter-message="Nome de usuário inválido." />
 *     <input type="password" system-form-filter-name="password" system-form-filter-type="PASSWORD"
 *            system-form-filter-maxsize="20" system-form-filter-allowEmpty="false"
 *            system-form-filter-message="Senha inválida." />
 *     <button type="submit">Enviar</button>
 * </form>
 *
 * Certifique-se de ajustar os atributos conforme necessário para atender aos requisitos de validação do seu projeto.
 */

// Funções de verificação
function validateString(fieldName, value, maxSize, allowEmpty) {
    if (!allowEmpty && !value) {
        return `O ${fieldName} é obrigatório.`;
    }
    if (value && value.length > maxSize) {
        return `O ${fieldName} deve ter no máximo ${maxSize} caracteres.`;
    }
    return null;
}

function validateNumber(fieldName, value, maxSize, allowEmpty) {
    if (!allowEmpty && !value) {
        return `O ${fieldName} é obrigatório.`;
    }
    if (value && value.length > maxSize) {
        return `O ${fieldName} deve ter no máximo ${maxSize} caracteres.`;
    }
    if (value && isNaN(value)) {
        return `O ${fieldName} deve ser um número.`;
    }
    return null;
}

function validateBoolean(fieldName, value, allowEmpty) {
    if (!allowEmpty && !value) {
        return `O ${fieldName} é obrigatório.`;
    }
    if (value && value !== '1' && value !== '0') {
        return `O ${fieldName} é inválido.`;
    }
    return null;
}

function validateEmail(fieldName, value, allowEmpty) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!allowEmpty && !value) {
        return `O ${fieldName} é obrigatório.`;
    }
    if (value && !emailRegex.test(value)) {
        return `O ${fieldName} não é válido.`;
    }
    return null;
}

function validateInt(fieldName, value, maxSize, allowEmpty) {
    if (!allowEmpty && !value) {
        return `O ${fieldName} é obrigatório.`;
    }
    if (value && value.length > maxSize) {
        return `O ${fieldName} deve ter no máximo ${maxSize} caracteres.`;
    }
    if (value && !Number.isInteger(Number(value))) {
        return `O ${fieldName} é inválido.`;
    }
    return null;
}

function validateFloat(fieldName, value, maxSize, allowEmpty) {
    if (!allowEmpty && !value) {
        return `O ${fieldName} é obrigatório.`;
    }
    if (value && value.length > maxSize) {
        return `O ${fieldName} deve ter no máximo ${maxSize} caracteres.`;
    }
    if (value && isNaN(parseFloat(value))) {
        return `O ${fieldName} deve ser um número decimal.`;
    }
    return null;
}

function validatePassword(fieldName, value, maxSize, allowEmpty) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/;
    if (!allowEmpty && !value) {
        return `A ${fieldName} é obrigatório.`;
    }
    if (value && value.length > maxSize) {
        return `A ${fieldName} deve ter no máximo ${maxSize} caracteres.`;
    }
    if (value && !passwordRegex.test(value)) {
        return `A ${fieldName} deve conter no mínimo 8 caracteres, letras maiúsculas, minúsculas, números e caracteres especiais.`;
    }
    return null;
}

// Lógica de verificação nos inputs e no submit do form
function setupFormValidation() {
    const forms = document.querySelectorAll('form'); // Captura todos os forms

    forms.forEach(form => {
        const inputs = form.querySelectorAll('[system-form-filter-name]');
        const radios = form.querySelectorAll('input[type="radio"]'); // Captura todos os radios
        const submitElements = form.querySelectorAll('[type="submit"]'); // Captura todos os elementos de envio

        // Adiciona o atributo de validação ao botão no início
        submitElements.forEach(submitElement => {
            submitElement.setAttribute('system-form-filter-validation-start', 'true');
            submitElement.disabled = false; // Inicializa o botão como habilitado
        });

        let formIsValidBtn = true;
        inputs.forEach(input => {
            if (isVisible(input)) { // Verifica se o input e seus pais estão visíveis
                const error2 = validateInput(input, true);
                if (error2) {
                    formIsValidBtn = false;
                }
            } else {
                // Se o campo ficou invisível, remove o erro associado
                removeError(input);
            }
        });

        if (!formIsValidBtn) {
            submitElements.forEach(submitElement => {
                submitElement.removeAttribute('type');
            });
        }

        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                if (isVisible(input)) { // Verifica se o input está visível
                    validateInput(input);
                } else {
                    // Se o campo ficou invisível, remove o erro associado
                    removeError(input);
                    checkFormErrors(form, submitElements); // Verifica se há erros visíveis restantes
                }
            });

            // Verificação em tempo real ao digitar
            input.addEventListener('input', () => {
                if (isVisible(input)) { // Verifica se o input está visível
                    const error = validateInput(input);
                    updateSubmitButtons(submitElements, error);
                } else {
                    removeError(input); // Remove erro se o campo não for mais visível
                    checkFormErrors(form, submitElements); // Verifica se há erros visíveis restantes
                }
            });
        });

        // Adiciona listener para os rádios, para verificar os erros quando a visibilidade de campos mudar
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                inputs.forEach(input => {
                    if (isVisible(input)) {
                        validateInput(input); // Revalida o input se estiver visível
                    } else {
                        removeError(input); // Remove erro se o campo ficou invisível
                    }
                });
                checkFormErrors(form, submitElements); // Verifica o formulário após o clique em radio
            });
        });

        form.addEventListener('submit', (e) => {
            let formIsValid = true;
            let errorMessages = [];

            inputs.forEach(input => {
                if (isVisible(input)) { // Verifica se o input está visível
                    const error = validateInput(input);
                    if (error) {
                        formIsValid = false;
                        errorMessages.push(error);
                    }
                } else {
                    // Se o campo está invisível, remove o erro associado
                    removeError(input);
                }
            });

            if (!formIsValid) {
                e.preventDefault(); // Impede o envio do formulário se houver erro
                submitElements.forEach(submitElement => {
                    submitElement.disabled = true; // Desativa o botão de envio
                    submitElement.setAttribute('system-form-filter-validation-start', 'true'); // Reatribui o atributo de validação

                    // Remove o type="submit" se houver erro
                    if (submitElement.getAttribute('type') === 'submit') {
                        submitElement.removeAttribute('type');
                    }
                });

                // Exibe mensagens de erro conforme sua lógica existente
                if (form.hasAttribute('system-form-filter-modal') && form.getAttribute('system-form-filter-modal') === 'true') {
                    Swal.fire({
                        title: 'Erro de Validação',
                        html: errorMessages.join('<br>'),
                        icon: 'warning',
                        timerProgressBar: true,
                        timer: 99500,
                        showConfirmButton: true,
                        confirmButtonClass: 'btn btn-sm btn-primary ',
                        confirmButtonText: 'Verificar',
                    });
                } else {
                    showErrorDivs(inputs);
                }
            } else {
                e.preventDefault(); // Impede o envio padrão para controlar via AJAX
                submitElements.forEach(submitElement => {
                    submitElement.disabled = false; // Garante que o botão esteja habilitado
                    submitElement.removeAttribute('system-form-filter-validation-start'); // Remove o atributo de validação

                    // Adiciona novamente o type="submit" se o formulário for válido
                    if (!submitElement.hasAttribute('type')) {
                        submitElement.setAttribute('type', 'submit');
                    }
                });

                // Dispara um evento customizado para sinalizar que a validação foi bem-sucedida
                const event = new CustomEvent('formValidated', { detail: { form: form } });
                form.dispatchEvent(event);
            }
        });
    });
}

// Função para remover o erro de um campo específico
function removeError(input) {
    const errorElement = document.querySelector(`#error-${input.name}`);
    if (errorElement) {
        errorElement.remove(); // Remove o elemento de erro
    }
}

// Função para verificar se um elemento e seus pais estão visíveis
function isVisible(element) {
    return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
}

// Função para verificar se ainda existem erros visíveis no formulário
function checkFormErrors(form, submitElements) {
    const errorElements = form.querySelectorAll('.error-message'); // Captura todas as mensagens de erro
    let formHasVisibleErrors = false;

    errorElements.forEach(errorElement => {
        if (isVisible(errorElement)) {
            formHasVisibleErrors = true; // Se o erro estiver visível, o formulário ainda está inválido
        }
    });

    // Habilita ou desabilita o botão de envio com base nos erros visíveis
    submitElements.forEach(submitElement => {
        if (!formHasVisibleErrors) {
            submitElement.disabled = false;
            submitElement.setAttribute('type', 'submit');
        } else {
            submitElement.disabled = true;
            submitElement.removeAttribute('type');
        }
    });
}



function updateSubmitButtons(submitElements, error) {
    submitElements.forEach(submitElement => {
        const allInputs = submitElement.closest('form').querySelectorAll('[system-form-filter-name]');
        const hasInvalidFields = Array.from(allInputs).some(input => {
            const allowEmpty = input.getAttribute('system-form-filter-allowEmpty') === 'false';
            const value = input.value.trim();
            return allowEmpty && !value; // Retorna true se houver campos não preenchidos que não permitem vazio
        });

        if (!error && !hasInvalidFields) {
            submitElement.disabled = false; // Ativa o botão se não há erros e todos os campos obrigatórios estão preenchidos
            submitElement.removeAttribute('system-form-filter-validation-start'); // Remove o atributo de validação
        } else {
             // Desativa o botão se há erros ou campos obrigatórios não preenchidos
            submitElement.setAttribute('system-form-filter-validation-start', 'true'); // Reatribui o atributo de validação
        }
    });
}

  
  

function validateInput(input, OnlyVerify) {
    const fieldName = input.getAttribute('system-form-filter-name');
    const fieldType = input.getAttribute('system-form-filter-type');
    const maxSize = parseInt(input.getAttribute('system-form-filter-maxsize'), 10);
    const allowEmpty = input.getAttribute('system-form-filter-allowEmpty') === 'true';
    const customMessage = input.getAttribute('system-form-filter-message');
    const value = input.value.trim();

    let errorMessage = null;

    switch (fieldType) {
        case 'STRING':
            errorMessage = validateString(fieldName, value, maxSize, allowEmpty);
            break;
        case 'NUMBER':
            errorMessage = validateNumber(fieldName, value, maxSize, allowEmpty);
            break;
        case 'BOOLEAN':
            errorMessage = validateBoolean(fieldName, value, allowEmpty);   
            break;
        case 'EMAIL':
            errorMessage = validateEmail(fieldName, value, allowEmpty);
            break;
        case 'INT':
            errorMessage = validateInt(fieldName, value, maxSize, allowEmpty);
            break;
        case 'FLOAT':
            errorMessage = validateFloat(fieldName, value, maxSize, allowEmpty);
            break;
        case 'PASSWORD':
            errorMessage = validatePassword(fieldName, value, maxSize, allowEmpty);
            break;
        default:
            errorMessage = `Tipo de validação desconhecido: ${fieldType}`;
            break;
    }

    // Se houver uma mensagem customizada, ela sobrescreve a mensagem de erro padrão
    if (customMessage && errorMessage) {
        errorMessage = customMessage;
    }

    // Se OnlyVerify for true, retorne apenas true ou false, dependendo da existência de erro
    if (OnlyVerify) {
        return !!errorMessage; // Retorna true se houver erro (mensagem), false caso contrário
    } else {
        showErrorMessage(input, errorMessage); // Exibe o erro se não for verificação simples
        return errorMessage; // Retorna a mensagem de erro
    }
}

function showErrorMessage(input, message) {
    let errorElement = input.nextElementSibling;

    if (errorElement && errorElement.classList.contains('error-message')) {
        errorElement.textContent = message;
    } else {
        errorElement = document.createElement('div');
        errorElement.classList.add('error-message');
        errorElement.style.color = "red";
        errorElement.style.fontSize = "12px";
        errorElement.style.marginTop = "5px";
        errorElement.textContent = message;
        input.parentNode.insertBefore(errorElement, input.nextSibling);
    }

        if (errorElement && !errorElement.textContent) {
            errorElement.remove();
        }
       
    
}

function showErrorDivs(inputs) {
    inputs.forEach(input => {
        const error = validateInput(input);
        if (error) {
            showErrorMessage(input, error);
        }
    });
}

document.addEventListener('DOMContentLoaded', setupFormValidation);