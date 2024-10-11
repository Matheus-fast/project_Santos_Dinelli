<?php

session_start(); // Iniciar a sessão

ob_start(); // Limpar o buffer de saída

// Definir um fuso horario padrao
date_default_timezone_set('America/Sao_Paulo');

// Acessar o IF quando o usuário não estão logado e redireciona para página de login
if((!isset($_SESSION['id'])) and (!isset($_SESSION['usuario'])) and (!isset($_SESSION['codigo_autenticacao']))){
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário realizar o login para acessar a página!</p>";

    // Redirecionar o usuário
    header("Location: /project_Santos_Dinelli/login/index.php");

    // Pausar o processamento
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../style/layout-header.css">
    <link rel="stylesheet" href="../style/financeiro/finance.css">
    <link rel="shortcut icon" href="../images/icons/logo.ico" type="image/x-icon">
    
</head>

    <body>
        
        <header class="header"> <!-- começo menu fixo no topo -->
        
            <nav class="menu-lateral"> <!-- primeiro item do menu -->

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

                <nav> <!-- começar com uma nav para definir os itens do menu-->

                <ul class="menu-fixo"> <!-- começo dos itens do menu-->

                    <li><a class="link" href="./agenda.php">AGENDA</a></li>
                    <li><a class="link" href="./finance.php">FINANCEIRO</a></li>
                    <li><a class="link" href="./client.php">CLIENTES</a></li>

                </ul>

            </nav>

            <div> <!-- finalizar com a logo da empresa na direita-->

                <a href="https://www.santosedinelli.com.br/" target="_blank">
                <img class="logo" src="../images/santos-dinelli.png"  alt="logo da empresa"></a>

            </div> <!-- final da div da logo-->

        </header> <!-- fim header fixo -->


        <section> <!-- começo da sessão-->

            <div class="container"> <!-- organizar as opções de seleção-->

                <div class="child child-1"> <!-- organizar cada filho -->

                    <h4>Cadastrar</h4>
                    <p>Cadastrar um novo clinte <br> Pessoa Física ou Pessoa Jurídica.</p>
                    <a class="btn btn-1 link" href="../php/clientes/cadastro.php">VISUALIZAR</a>

                </div>

                <div class="child child-2"> <!-- organizar cada filho-->

                    <h4>Lista</h4>
                    <p>Lista de clientes ja cadastrados<br> Pessoa Física ou Pessoa Jurídica.</p>
                    <a class="btn btn-2 link" href="../php/clientes/visualizar.php">VISUALIZAR</a>

                </div>

            </div> <!-- fim da organização de seleção de mês/anual-->

        </section>


    </body>

</html>