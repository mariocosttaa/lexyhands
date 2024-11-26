/**
 * Configura e exibe alertas dinâmicos para ações variadas.
 * - Usa um único atributo `data-alert-config` para definir as configurações como JSON.
 * - Suporta mensagens personalizadas, ícones, redirecionamento, envio de formulários e personalização de botões.
 */
function initializeDynamicAlerts() {
    // Mapa de cores Bootstrap para hexadecimais
    const bootstrapColors = {
        primary: '#007bff',
        secondary: '#6c757d',
        success: '#28a745',
        danger: '#dc3545',
        warning: '#ffc107',
        info: '#17a2b8',
        light: '#f8f9fa',
        dark: '#343a40'
    };

    // Selecione todos os elementos que possuem o atributo `data-alert-config`
    const alertElements = document.querySelectorAll('[data-alert-config]');

    // Itere sobre os elementos encontrados
    alertElements.forEach(alertElement => {
        // Adicione o evento de clique
        alertElement.addEventListener('click', (e) => {
            e.preventDefault(); // Previna o comportamento padrão

            // Obtenha e parse o JSON do atributo `data-alert-config`
            const alertConfig = JSON.parse(alertElement.getAttribute('data-alert-config') || '{}');

            // Extraia as configurações do JSON ou defina valores padrão
            const {
                type = 'action',                          // Tipo de alerta (action, delete, etc.)
                title = 'Você tem certeza?',             // Título do alerta
                message = 'Deseja continuar com esta ação?', // Mensagem do alerta
                icon = 'warning',                        // Ícone do alerta (info, warning, success, etc.)
                redirect,                                // URL para redirecionamento
                form = true,                             // Se `true`, tenta enviar o formulário mais próximo
                confirmButtonText = 'Ok',         // Texto do botão de confirmação (padrão)
                cancelButtonText = '',           // Texto do botão de cancelamento (padrão)
                confirmButtonColor = 'secondary',           // Cor do botão de confirmação (pode ser Bootstrap ou hexadecimal)
                cancelButtonColor = null,         // Cor do botão de cancelamento (pode ser Bootstrap ou hexadecimal)
            } = alertConfig;

            const formElement = alertElement.closest('form'); // Formulário mais próximo (se aplicável)

            // Converta as cores de Bootstrap para hexadecimais, se necessário
            const resolveColor = (color) => {
                return bootstrapColors[color] || color; // Use a cor de Bootstrap ou mantenha a original
            };

            // Exiba o alerta com SweetAlert2
            Swal.fire({
                title: title,
                html: message,
                icon: icon,
                showCancelButton: true,
                confirmButtonText: confirmButtonText,
                cancelButtonText: cancelButtonText,
                confirmButtonColor: resolveColor(confirmButtonColor),
                cancelButtonColor: resolveColor(cancelButtonColor)
            }).then((result) => {
                if (result.isConfirmed) {
                    // Execute a ação com base no tipo de alerta
                    if (redirect) {
                        // Redireciona para a URL especificada
                        window.location.href = redirect;
                    } else if (form && formElement) {
                        // Simula o envio do formulário
                        formElement.submit();
                    } else {
                        // Caso nenhuma ação esteja configurada, exiba um aviso no console
                        console.warn('Nenhuma ação configurada para este alerta.');
                    }
                }
            });
        });
    });
}

// Inicialize os alertas dinâmicos
initializeDynamicAlerts();
