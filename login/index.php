<?php
session_set_cookie_params(0);
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('America/Sao_Paulo');

include_once "./conexao.php";

// Verificar o cookie "lembrar-me"
if (!isset($_SESSION['id']) && isset($_COOKIE['remember_me'])) {
    list($user_id, $token) = explode(':', $_COOKIE['remember_me']);
    
    $query_check = "SELECT id, usuario FROM usuarios WHERE id = :id AND remember_token = :token LIMIT 1";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt_check->bindParam(':token', $token);
    $stmt_check->execute();
    
    if ($stmt_check->rowCount() > 0) {
        $user = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['login_token'] = bin2hex(random_bytes(16));
        header('Location: ../src/pages/home.php');
        exit();
    } else {
        // Token inválido, remover o cookie
        setcookie('remember_me', '', time() - 3600, '/');
    }
}

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['SendLogin'])) {
    $query_usuario = "SELECT id, nome, usuario, senha_usuario 
                        FROM usuarios
                        WHERE usuario =:usuario
                        LIMIT 1";

    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario', $dados['usuario']);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

        if (password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])) {
            $_SESSION['id'] = $row_usuario['id'];
            $_SESSION['usuario'] = $row_usuario['usuario'];
            $_SESSION['login_token'] = bin2hex(random_bytes(16));

            if (isset($dados['manterlogin'])) {
                $token = bin2hex(random_bytes(16));
                $expires = time() + (30 * 24 * 60 * 60); // 30 dias

                $query_remember = "UPDATE usuarios SET remember_token = :token WHERE id = :id";
                $stmt_remember = $conn->prepare($query_remember);
                $stmt_remember->bindParam(':token', $token);
                $stmt_remember->bindParam(':id', $row_usuario['id']);
                $stmt_remember->execute();

                setcookie('remember_me', $row_usuario['id'] . ':' . $token, $expires, '/', '', true, true);
            }

            $data = date('Y-m-d H:i:s');
            $codigo_autenticacao = mt_rand(100000, 999999);

            $query_up_usuario = "UPDATE usuarios SET
                            codigo_autenticacao =:codigo_autenticacao,
                            data_codigo_autenticacao =:data_codigo_autenticacao
                            WHERE id =:id
                            LIMIT 1";

            $result_up_usuario = $conn->prepare($query_up_usuario);
            $result_up_usuario->bindParam(':codigo_autenticacao', $codigo_autenticacao);
            $result_up_usuario->bindParam(':data_codigo_autenticacao', $data);
            $result_up_usuario->bindParam(':id', $row_usuario['id']);
            $result_up_usuario->execute();

            // Código para enviar e-mail (mantido como está)

            header('Location: validar_codigo.php');
            exit();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
        }
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/style/login/index.css">
    <link rel="shortcut icon" href="../src/images/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Bem-vindo de volta</h2>
            <p>faça seu login</p>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
        <div class="error-message">
            <?php 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
        </div>
        <?php endif; ?>
        
        <form method="POST" action="" class="login-form" id="login-form">
            <div class="input-group">
                <input type="text" name="usuario" placeholder="Digite o usuário" id="email">
                <span class="highlight"></span>
                <label for="email">E-mail</label>
            </div>

            <div class="input-group">
                <input type="password" name="senha_usuario" id="password" placeholder="Digite a senha">
                <span class="highlight"></span>
                <label for="password">Senha</label>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            
            <div class="lembrar-me">
                <input type="checkbox" name="manterlogin" id="manterlogin" value="1" class="lembrar-checkbox">
                <label for="manterlogin" class="lembrar-label">Lembrar-me</label>
            </div>

            <input type="submit" name="SendLogin" value="Acessar" class="login-button">    
            <div class="forgot-password">
                <a href="enviarcodigo.php">Esqueceu a senha?</a>
            </div>
        </form>
    </div>    

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle i');
        const toggleContainer = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
        
        toggleContainer.classList.add('animate');
        
        setTimeout(() => {
            toggleContainer.classList.remove('animate');
        }, 300);
    }
    </script>

</body>
</html>