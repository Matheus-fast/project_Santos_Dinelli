<?php

session_start(); // Iniciar a sessão

ob_start(); // Limpar o buffer de saída

// Importar as classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Definir um fuso horário padrão
date_default_timezone_set('America/Sao_Paulo');

// Incluir o arquivo com a conexão com banco de dados
include_once "./conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulário de E-mail</title>
        <link rel="stylesheet" href="../src/style/login/enviarcodigo.css">
        <link rel="shortcut icon" href="../src/images/icons/logo.ico" type="image/x-icon">

    </head>

    <body>

        <?php
            // Receber os dados do formulário
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Acessar o IF quando o usuário clicar no botão acessar do formulário
        if (!empty($dados['SendEmail'])) {
            //var_dump($dados);

            // Recuperar os dados do usuário no banco de dados
            $query_usuario = "SELECT id, nome, usuario, senha_usuario 
                                FROM usuarios
                                WHERE usuario = :email
                                LIMIT 1";

            // Preparar a QUERY
            $result_usuario = $conn->prepare($query_usuario);

            // Substituir o link da query pelo valor que vem do formulário
            $result_usuario->bindParam(':email', $dados['email']);

            // Executar a QUERY
            $result_usuario->execute();

            // Acessar o IF quando encontrar usuário no banco de dados
            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                // Ler os registros retornando do banco de dados
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                //var_dump($row_usuario);

                // Salvar os dados do usuário na sessão
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['email'] = $row_usuario['usuario'];

                // Recuperar a data atual
                $data = date('Y-m-d H:i:s');

                // Gerar número randômico entre 100000 e 999999
                $codigo_autenticacao = mt_rand(100000, 999999);

                // Salvar o código na sessão
                $_SESSION['codigo_enviado'] = $codigo_autenticacao;

                // QUERY para salvar no banco de dados o código e a data gerada
                $query_up_usuario = "UPDATE usuarios SET
                                codigo_autenticacao =:codigo_autenticacao,
                                data_codigo_autenticacao =:data_codigo_autenticacao
                                WHERE id =:id
                                LIMIT 1";

                // Preparar a QUERY
                $result_up_usuario = $conn->prepare($query_up_usuario);

                // Substituir o link da QUERY pelos valores
                $result_up_usuario->bindParam(':codigo_autenticacao', $codigo_autenticacao);
                $result_up_usuario->bindParam(':data_codigo_autenticacao', $data);
                $result_up_usuario->bindParam(':id', $row_usuario['id']);

                // Executar a QUERY
                $result_up_usuario->execute();

                // Incluir o Composer
                require './lib/vendor/autoload.php';

                // Criar o objeto e instanciar a classe do PHPMailer
                $mail = new PHPMailer(true);

                // Verificar se envia o e-mail corretamente com try catch
                try {
                    // Imprimir os erro com debug
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  

                    // Permitir o envio do e-mail com caracteres especiais
                    $mail->CharSet = 'UTF-8';

                    // Definir para usar SMTP
                    $mail->isSMTP();         

                    // Servidor de envio de e-mail
                    $mail->Host       = 'smtp.gmail.com'; 

                    // Indicar que é necessário autenticar
                    $mail->SMTPAuth   = true;     

                    // Usuário/e-mail para enviar o e-mail                              
                    $mail->Username   = 'testesdogabrielb@gmail.com'; 

                    // Senha do e-mail utilizado para enviar e-mail                  
                    $mail->Password   = 'mjpp ijhi nrkb dkoy';      

                    // Ativar criptografia                         
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  

                    // Porta para enviar e-mail          
                    $mail->Port       = 587;

                    // E-mail do remetente
                    $mail->setFrom('testesdogabrielb@gmail.com', 'Santos Dinelli Climatização');

                    // E-mail de destino
                    $mail->addAddress($row_usuario['usuario'], $row_usuario['nome']);

                    // Definir formato de e-mail para HTML
                    $mail->isHTML(true);  
                    
                    // Título do e-mail
                    // Título do e-mail
                    $mail->Subject = 'Código de Verificação para Autenticação Multifator';

                    // Conteúdo do e-mail em formato HTML
                    ob_start();
                    include __DIR__ . '/redefinir_email_template.php';
                    $mail->Body = ob_get_clean();

                    // Conteúdo do e-mail em formato texto (mantenha isso para clientes de email que não suportam HTML)
                    $mail->AltBody = "Olá {$row_usuario['nome']}!\n\n" .
                                    "Seu código de verificação de 6 dígitos é: {$codigo_autenticacao}\n\n" .
                                    "Este código foi enviado para redefinir sua senha. Por favor, insira-o na página de verificação para continuar.\n\n" .
                                    "Se você não solicitou este código, por favor ignore este email.\n\n" .
                                    "Esta é uma mensagem automática. Por favor, não responda a este email.";

                    // Enviar e-mail
                    $mail->send();

                    // Redirecionar o usuário
                    header('Location: verificar.php');
                    exit();

                } catch (Exception $e) { // Acessa o catch quando não é enviado e-mail corretamente
                    echo "E-mail não enviado com sucesso. Erro: {$mail->ErrorInfo}";
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: E-mail não enviado com sucesso!</p>";
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário inexistente!</p>";
            }
        }
        ?>

        <div class="login-container">

        
            <div class="login-header">
                <h2>Digite seu e-mail</h2>
            </div>

            <form action="" method="post" class="login-form" id="login-form">

            <div class="loading-overlay" id="loadingOverlay">
                <div class="loading-spinner"></div>
                <div class="loading-text">Enviando o codigo...</div>
            </div>

            <div style="margin-bottom: 15px;">
                        <?php
                        // Imprimir a mensagem da sessão
                            if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                            }
                        ?>
            </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" required>
                    <span class="highlight"></span>
                    <label for="email">Seu e-mail:</label>
                </div>
        
                <input type="submit" name="SendEmail" class="login-button">
            </form>
            
        </div>

    </body>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            // Show the loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
        });
    </script>

</html>
