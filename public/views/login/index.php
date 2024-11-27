<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container-fluid {
            height: 100%;
            padding: 0;
        }

        .row {
            height: 100%;
            margin: 0;
        }

        .left-side {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 2rem;
        }

        .right-side {
            background-image: url('/../public/assets/images/website/banner-4.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .right-side::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-floating>.form-control {
            padding: 1rem 0.75rem;
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }

        .form-floating>label {
            padding: 1rem 0.75rem;
        }

        .btn-primary {
            background-color: #6c63ff;
            border-color: #6c63ff;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 50px;
        }

        .btn-primary:hover {
            background-color: #5a52d5;
            border-color: #5a52d5;
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.3);
        }

        .logo {
            width: 200px;
            height: auto;
            margin-bottom: 1rem;
        }

        h4 {
            color: #333;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .form-check-label {
            color: #666;
        }

        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.25);
        }

        .login-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .forgot-password {
            text-align: right;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        .forgot-password a {
            color: #6c63ff;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 left-side">
                <div class="login-container">

                <?php if ($settings->show_logo == true && $settings->site_logo !== null) { ?>
                        <img src="/../public/assets/images/logo.png" alt="Horariux logo - um relógio estilizado com ponteiros formando a letra X, em tons de azul e roxo" class="logo">
                    <?php } else { ?>
                        <?php echo $settings->site_name ?>
                <?php } ?>
                    <h4>Iniciar Sessão</h4>
                    <p class="login-description">Bem-vindo de volta ao Horariux! Por favor, insira suas credenciais para acessar sua conta e gerenciar seus agendamentos de forma eficiente.</p>
                    <form action="/../auth/connect" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                            <label for="floatingInput">Endereço de e-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                            <label for="floatingPassword">Senha</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Manter-me conectado <small>(Indisponível)</small>
                            </label>
                        </div>
                        <div class="forgot-password">
                            <a href="#">Esqueceu a senha?</a>
                        </div>

                        <?php if(isset($_GET['continue'])) { ?>
                            <input type="hidden" name="continue" value="<?php echo $_GET['continue'] ?>">
                        <?php } ?>
                        
                        <button class="btn btn-primary w-100" type="submit">Acessar Conta</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8 right-side">
                <!-- Imagem de fundo -->
            </div>
        </div>
    </div>
</body>

</html>