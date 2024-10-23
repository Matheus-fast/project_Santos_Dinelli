<?php
session_start();
ob_start();

include_once "./conexao.php";

// Remover o token de "lembrar-me" do banco de dados
if (isset($_SESSION['id'])) {
    $query = "UPDATE usuarios SET remember_token = NULL WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
    $stmt->execute();
}

// Destruir as sessões
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['usuario'], $_SESSION['codigo_autenticacao']);

// Remover o cookie "lembrar-me"
if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, '/');
}

// Redirecionar o usuário
$_SESSION['msg'] = "<p style='color: green;'>Deslogado com sucesso!</p>";
header("Location: ./index.php");
exit();
?>