<?php

namespace App\Services;

class Notification extends ServiceHelper
{
    /**
     * Exibe uma notificação imediata com configurações personalizadas.
     */
    public static function notify(
        string $title,
        ?string $message = null,
        ?string $level = 'info',
        ?string $type = 'sweetalert',
        ?string $position = 'top-end',
        ?int $timeout = 3000,
        ?string $redirectUrl = null
    ): void {

        if ($redirectUrl) {
            self::notifyAfterRedirect($title, message: $message, level: $level, type: $type, position: $position, timeout: $timeout, redirectUrl: $redirectUrl);
            return;
        }

        echo self::renderScript(notification: [
            'title' => $title,
            'message' => $message,
            'level' => $level,
            'type' => $type,
            'position' => $position,
            'timeout' => $timeout,
            'redirectUrl' => $redirectUrl
        ]);
    }

    /**
     * Define uma notificação para exibir após redirecionamento com configurações personalizadas e redireciona o usuário.
     */
    public static function notifyAfterRedirect(
        string $title,
        ?string $message = null,
        string $level = 'info',
        string $type = 'sweetalert',
        string $position = 'top-end',
        int $timeout = 3000,
        string $redirectUrl = '/'
    ): void {
        $_SESSION['notification'] = [
            'title' => $title,
            'message' => $message,
            'level' => $level,
            'type' => $type,
            'position' => $position,
            'timeout' => $timeout,
            'timestamp' => time() // Marca o momento da criação
        ];

        // Redireciona para a URL especificada
        header("Location: $redirectUrl");
        exit;
    }

    /**
     * Verifica automaticamente se há uma notificação na sessão e a exibe na página de destino se válida.
     */
    public static function autoDisplayNotification(): void
    {
        if (isset($_SESSION['notification'])) {
            $notification = $_SESSION['notification'];

            // Checa se a notificação ainda está válida (1 minuto de validade)
            if (time() - $notification['timestamp'] <= 60) {
                echo self::renderScript($notification);
            }
            
            // Remove a notificação da sessão após exibi-la ou se estiver expirada
            unset($_SESSION['notification']);
        }
    }

    /**
     * Renderiza o script JavaScript para exibir a notificação de acordo com o tipo configurado.
     */
    private static function renderScript(array $notification): string
    {
        switch ($notification['type']) {
            case 'sweetalert':
                return "

                     <!-- SweetAlert JavaScript e Css -->
                     <script src='/projects/lexyhands/public/default/services/sweetalert2/dist/sweetalert2.all.min.js'></script>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: '{$notification['title']}',
                            html: '{$notification['message']}',
                            icon: '{$notification['level']}',
                            position: '{$notification['position']}',
                            timer: {$notification['timeout']},
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    });
                    </script>";
            
            case 'toastr':
                return "
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.options = {
                            'positionClass': '{$notification['position']}',
                            'timeOut': '{$notification['timeout']}',
                        };
                        toastr['{$notification['level']}']('{$notification['message']}', '{$notification['title']}');
                    });
                    </script>";

            default:
                return "<script>console.error('Tipo de notificação não suportado');</script>";
        }
    }
}
