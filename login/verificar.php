<?php
// Iniciando a sessão e incluindo a conexão com o banco de dados
session_start();
include('conexao.php');

// Função para enviar resposta JSON
function sendJsonResponse($success, $message) {
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'message' => $message]);
    exit();
}

// Verificando se é uma requisição AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Verificando se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtendo o código digitado pelo usuário
        $codigo_digitado = $_POST['codigo'];

        // Obtendo o código enviado por e-mail armazenado na sessão
        if (isset($_SESSION['codigo_enviado'])) {
            $codigo_enviado = $_SESSION['codigo_enviado'];

            // Verificando se os códigos coincidem
            if ($codigo_digitado == $codigo_enviado) {
                sendJsonResponse(true, 'Código válido. Redirecionando...');
            } else {
                sendJsonResponse(false, 'O código está incorreto. Tente novamente.');
            }
        } else {
            sendJsonResponse(false, 'Código não encontrado. Solicite novamente o envio.');
        }
    } else {
        sendJsonResponse(false, 'Método de requisição inválido.');
    }
} else {
    // Se não for uma requisição AJAX, exibir a página normalmente
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <link rel="stylesheet" href="../src/style/login/verificar.css">
    <link rel="shortcut icon" href="../src/images/icons/logo.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Digite o código enviado no E-mail cadastrado</h2>
        </div>
        <div id="message" class="message"></div>
        <form method="POST" action="" class="auth-form" id="auth-form">
            <div class="loading-overlay" id="loadingOverlay">
                <div class="loading-spinner"></div>
                <div class="loading-text" id="loadingText">Validando...</div>
            </div>
            
            <div class="input-group">
                <input type="text" name="codigo" id="verification-code" required maxlength="6">
                <span class="highlight"></span>
                <label for="codigo">Código de Verificação</label>
            </div>
            <input type="submit" class="auth-button" name="ValCodigo" value="Validar" id="botaoTransicao">
            <div class="reenviar">
                <a href="#" id="reenviar-codigo">Reenviar Código</a>
            </div>
        </form>
    </div>

    <script>        
        $(document).ready(function() {
            $('#reenviar-codigo').click(function(e) {
                e.preventDefault();
                $('#loadingText').text('Reenviando código...');
                $('#loadingOverlay').css('display', 'flex');
                $.ajax({
                    url: 'enviar_novo_codigo.php',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        $('#loadingOverlay').css('display', 'none');
                        if (response.success) {
                            $('#message').text('Novo código enviado para o seu e-mail.').removeClass('error-message').addClass('success-message').show();
                        } else {
                            $('#message').text('Erro ao enviar novo código: ' + response.message).removeClass('success-message').addClass('error-message').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loadingOverlay').css('display', 'none');
                        $('#message').text('Erro ao processar a solicitação. Tente novamente. Detalhes: ' + error).removeClass('success-message').addClass('error-message').show();
                    }
                });
            });

            $('#auth-form').submit(function(e) {
                e.preventDefault();
                $('#loadingText').text('Validando...');
                $('#loadingOverlay').css('display', 'flex');
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#loadingOverlay').css('display', 'none');
                        if (response.success) {
                            $('#loadingText').text('Redirecionando...');
                            $('#loadingOverlay').css('display', 'flex');
                            setTimeout(function() {
                                window.location.href = 'redefinir.php';
                            }, 2000);
                        } else {
                            $('#message').text(response.message).removeClass('success-message').addClass('error-message').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loadingOverlay').css('display', 'none');
                        console.log(xhr.responseText); // Log the full response for debugging
                        $('#message').text('Erro ao processar a solicitação. Tente novamente. Detalhes: ' + error).removeClass('success-message').addClass('error-message').show();
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php
}
?>