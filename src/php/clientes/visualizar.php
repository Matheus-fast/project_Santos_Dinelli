<?php
// Iniciar a sessão
session_start();

// Configurações do banco de dados
$host = "localhost";
$dbname = "santos_dinelli"; // Substitua pelo nome do seu banco de dados
$user = "root"; // Substitua pelo seu usuário do banco de dados
$pass = ""; // Substitua pela sua senha do banco de dados

try {
    // Criar a conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Definir o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}

// Consultar os dados da tabela clientes
$query = "SELECT * FROM clientes";
$stmt = $conn->prepare($query);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../style/clientes/visualizar.css">
    <link rel="shortcut icon" href="../../images/icons/logo.ico" type="image/x-icon">
    <title>Visualizar Clientes</title>
</head>

<body>
    <!-- tem que colocar o header fiquei com preguiça -->
    <hedader>
        <h1>Clientes Cadastrados</h1>
    </hedader>

    <!-- pessoa fisica pra vc mexer nao criei div se vira -->
    <h2>Pessoas Físicas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th>Complemento</th>
                <th>Forma de Pagamento</th>
            </tr>
        </thead>

        <!-- parte do banco-->
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <?php if ($cliente['tipo_pessoa'] == 1): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['id'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome_cliente'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email_cliente'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cpf_cliente'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['endereco'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cidade'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['bairro'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cep'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['complemento'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['forma_pagamento'] ?? ''); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
                    <!-- pessoa juridica pra vc mexer nao criei div se vira -->
    <h2>Pessoas Jurídicas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Razão Social</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th>Complemento</th>
                <th>Forma de Pagamento</th>
            </tr>
        </thead>
        <!-- parte do banco-->
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <?php if ($cliente['tipo_pessoa'] == 2): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['id'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['razao_social'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email_cliente_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cnpj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['endereco_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cidade_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['bairro_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cep_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['complemento_pj'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($cliente['forma_pagamento'] ?? ''); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
<!-- acabou -->