<?php

namespace App\Controllers;

use App\Models\users as Users;

class AuthController extends ControllerHelper
{
    public static function connect(): void
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!empty($_POST['continue'])) {
            $baseUrl = false;
            $continueUrl = $_POST['continue'];
        } else {
            $continueUrl = '/projects/lexyhands/admin/dashboard';
            $baseUrl = true;
        }

        if (self::validateUser($email, $password) !== true) {
            if ($baseUrl === true) {
                $continueUrl = null;
            } else {
                $continueUrl = '?continue=' . $continueUrl . '';
            }

            parent::notification(
                title: 'Falha ao Logar',
                message: 'O email ou Senha Estão Incorrectos',
                level: 'error',
                type: 'sweetalert',
                position: 'center',
                redirectUrl: '/projects/lexyhands/auth/login' . $continueUrl . ''
            );
            exit();
        }

        parent::notification(
            title: 'Conectado !',
            message: false,
            level: 'success',
            type: 'sweetalert',
            position: 'top-end',
            redirectUrl: $continueUrl
        );
        exit();
    }

    public static function logout(): void
    {
        if (isset($_SESSION['auth'])) {
            unset($_SESSION['auth']);
            parent::notification(
                title: 'Você foi desconectado',
                message: false,
                level: 'warning',
                type: 'sweetalert',
                position: 'top-end',
                redirectUrl: '/projects/lexyhands/auth/login'
            );
            exit();
        } else {
            header(header: 'Location: /projects/lexyhands/auth/login');
            exit();
        }
    }

    private static function validateUser(?string $email, ?string $password): bool
    {

        if (empty($email) || empty($password)) return false;
        //validação
        \App\Services\FormFilter::validate(
            data: ['email' => $email, 'password' => $password],
            rules: [
                'email' => 'email|required|max:255',
                'password' => 'string|required|min:6|max:20',
            ],
            notifyError: true,
        );

        $user = Users::getByEmail(email: $email);
        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION['auth'] = $user->user_id;
                return true;
            }
        }

        //se n for encontrado
        unset($_SESSION['auth']);
        return false;
    }
}
