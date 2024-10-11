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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financeiro Mensal</title>
    <link rel="stylesheet" href="../style/financeiro/mensal.css">
    <link rel="stylesheet" href="../style/layout-header.css">
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

        <section> <!-- section do gráfico mensal -->

            <div class="container"> <!-- 100% da tela -->

                <form action="../js/financeiro/php/processa_financas.php" method="post">

                    <div class="select-input"> <!-- select, input, button -->
                        
                        <input type="text" placeholder="Recebimentos" name="recebimento" id="recebimentos"></input>
                        <input type="text" placeholder="Despesas" name="despesa" id="despesas">

                        <div>
                            <select id="monthSelector" name="mes">
                                <option value="Janeiro">Janeiro</option>
                                <option value="Fevereiro">Fevereiro</option>
                                <option value="Março">Março</option>
                                <option value="Abril">Abril</option>
                                <option value="Maio">Maio</option>
                                <option value="Junho">Junho</option>
                                <option value="Julho">Julho</option>
                                <option value="Agosto">Agosto</option>
                                <option value="Setembro">Setembro</option>
                                <option value="Outubro">Outubro</option>
                                <option value="Novembro">Novembro</option>
                                <option value="Dezembro">Dezembro</option>
                            </select>
                        </div>

                        <button id="atualizarGraph">Atualizar Gráfico</button>
                        <button id="inserirValores">Inserir Valores</button>
                        <button id="editarValores">Editar Valores</button>
                        <button id="excluirValores">Excluir Valor</button>

                    </div> <!-- encerramento do select, input, button-->

                </form> <!-- encerramento form -->
            
                <div class="canvas"> <!-- div pai para o gráfico -->
                    <div class="chart">
                        <canvas id="mensal"></canvas>
                    </div>
                </div>

            </div> <!-- encerramento 100% da tela-->
            
        </section>
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript" src="../js/financeiro/mensal.js"></script>

    </body>

</html>