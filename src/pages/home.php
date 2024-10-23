<?php
session_start();
ob_start();

date_default_timezone_set('America/Sao_Paulo');

include_once "../../login/conexao.php";

function checkRememberMeToken($user_id, $token) {
    global $conn;
    $query = "SELECT id FROM usuarios WHERE id = :id AND remember_token = :token LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function getUserEmail($user_id) {
    global $conn;
    $query = "SELECT usuario FROM usuarios WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['usuario'] : null;
}

// Verificar se o usuário está logado ou tem um cookie válido
if (!isset($_SESSION['id']) || !isset($_SESSION['usuario'])) {
    if (isset($_COOKIE['remember_me'])) {
        list($user_id, $token) = explode(':', $_COOKIE['remember_me']);
        
        if (checkRememberMeToken($user_id, $token)) {
            $_SESSION['id'] = $user_id;
            $_SESSION['usuario'] = getUserEmail($user_id);
            $_SESSION['login_token'] = bin2hex(random_bytes(16));
        } else {
            // Redirecionar para login se o token não for válido
            setcookie('remember_me', '', time() - 3600, '/');
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Sessão expirada. Por favor, faça login novamente.</p>";
            header("Location: /project_Santos_Dinelli/login/index.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário realizar o login para acessar a página!</p>";
        header("Location: /project_Santos_Dinelli/login/index.php");
        exit();
    }
}

// Atualizar o tempo de expiração da sessão, se aplicável
if (isset($_SESSION['expira'])) {
    $_SESSION['expira'] = time() + (30 * 60); // Renovar por mais 30 minutos
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../style/layout-header.css">
    <link rel="stylesheet" href="../style/home.css">
    <link rel="shortcut icon" href="../images/icons/logo.ico" type="image/x-icon">
</head>

<body>
    <header class="header">
        <nav class="menu-lateral">
            <input type="checkbox" class="fake-tres-linhas">
            <div><img class="tres-linhas" src="../images/menu-tres-linhas.png" alt="menu de três linhas"></div>
            <ul>
                <li><a class="link" href="./home.php">ÍNICIO</a></li>
                <li><a class="link" href="./agenda.php">AGENDA</a></li>
                <li><a class="link" href="./finance.php">FINANCEIRO</a></li>
                <li><a class="link" href="./client.php">CLIENTES</a></li>
                <li><a class="link" href="https://WA.me/+5511947295062/?text=Olá, preciso de ajuda com o software." target="_blank">SUPORTE</a></li>
                <li><a class="link" href="../../login/sair.php">SAIR</a></li>
            </ul>
        </nav>

        <nav>
            <ul class="menu-fixo">
                <li><a class="link" href="./home.php">ÍNICIO</a></li>
                <li><a class="link" href="./agenda.php">AGENDA</a></li>
                <li><a class="link" href="./finance.php">FINANCEIRO</a></li>
                <li><a class="link" href="./client.php">CLIENTES</a></li>
                <li><a class="link" href="https://WA.me/+5511947295062/?text=Olá, preciso de ajuda com o software." target="_blank">SUPORTE</a></li>
            </ul>
        </nav>

        <nav>
            <a href="https://www.santosedinelli.com.br/" target="_blank">
            <img class="logo" src="../images/santos-dinelli.png"  alt="logo da empresa"></a>
        </nav>
    </header>

    <section>
        <div class="canvas">
            <div class="chart">
                <canvas id="inicial"></canvas>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="../js/inicial.js"></script>
</body>
</html>