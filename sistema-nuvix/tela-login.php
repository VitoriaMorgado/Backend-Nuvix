<?php

session_start();
// VERIFICA SE HÁ COOKIE DE NAVEGAÇÃO DOS ACESSOS
if (
    isset($_COOKIE["email"]) && 
    isset($_COOKIE["senha"]) && 
    isset($_COOKIE["remember"])
) {
    $email = $_COOKIE["email"];
    $senha = $_COOKIE["senha"];
    $remember = "checked";
} else {
    $email = "";
    $senha = "";
    $remember = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Estilos Globais para o Tema Escuro */
    body {
        background: linear-gradient(to bottom, #051E32, #050709);
        /* Fundo bem escuro, quase preto */
        color: #c9d1d9;
        /* Cor de texto padrão clara */
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        height: 100vh;
        /* Altura total da viewport */
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 20px;
        /* Padding para telas menores */
        box-sizing: border-box;
        /* Garante que padding não cause overflow */
    }

    /* Container do Formulário */
    .login-container {
        width: 100%;
        max-width: 400px;
        /* Largura máxima similar à imagem */
        background-color: #000000;
        /* Fundo do card um pouco mais claro */
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        /* Sombra mais intensa */
        text-align: left;
    }

    /* Logo/Título "Nuvix." */
    .login-title {
        font-size: 2.8rem;
        /* Tamanho da fonte grande */
        font-weight: 700;
        /* Negrito */
        color: #ffffff;
        /* Cor branca para o destaque */
        margin-bottom: 40px;
        /* Espaçamento abaixo do título */
        letter-spacing: -1px;
        /* Ajuste para parecer mais compacto */
    }

    /* Labels dos Campos */
    .form-label {
        color: #c9d1d9;
        /* Cor do texto da label */
        font-weight: 600;
        /* Mais negrito */
        margin-bottom: 8px;
        /* Espaçamento entre label e input */
        display: block;
        /* Garante que a label ocupe sua própria linha */
    }

    /* Campos de Input */
    .form-control {
        background-color: #0d1117;
        /* Fundo dos inputs bem escuro */
        color: #ffffff;
        /* Texto digitado em branco */
        border: 1px solid #30363d;
        /* Borda sutil */
        border-radius: 6px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .form-control::placeholder {
        color: #6a737d;
        /* Cor do placeholder */
    }

    .form-control:focus {
        background-color: #0d1117;
        color: #ffffff;
        border-color: #00bcd4;
        /* Azul ciano ao focar */
        box-shadow: 0 0 0 0.2rem rgba(0, 188, 212, 0.25);
        /* Sombra ciano */
    }

    /* Checkbox "Lembrar-me" */
    .form-check {
        margin-top: 20px;
        margin-bottom: 20px;
        /* Espaçamento para o botão */
        display: flex;
        align-items: center;
    }

    .form-check-input {
        width: 1.25em;
        /* Tamanho do checkbox */
        height: 1.25em;
        background-color: #0d1117;
        border: 1px solid #30363d;
        border-radius: 4px;
        margin-right: 10px;
        cursor: pointer;
        flex-shrink: 0;
        /* Evita que o checkbox encolha */
    }

    .form-check-input:checked {
        background-color: #00bcd4;
        /* Azul ciano quando marcado */
        border-color: #00bcd4;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        /* Ícone de check branco */
    }

    .form-check-label {
        color: #c9d1d9;
        cursor: pointer;
        font-size: 0.95rem;
    }

    /* Link "Esqueci senha" */
    .forgot-password-link {
        float: right;
        /* Alinha à direita */
        color: #00bcd4;
        /* Azul ciano */
        text-decoration: none;
        font-size: 0.95rem;
        margin-top: 8px;
        /* Para alinhar com a label */
    }

    .forgot-password-link:hover {
        color: #00e5ff;
        /* Azul mais claro ao passar o mouse */
        text-decoration: underline;
    }

    /* Botão "Iniciar Sessão" */
    .btn-gradient {
        background: linear-gradient(to right, #00bcd4, #2196F3);
        /* Gradiente ciano para azul */
        border: none;
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;
    }

    .btn-gradient:hover {
        opacity: 0.9;
        /* Pequena opacidade ao passar o mouse */
        color: #ffffff;
        /* Garante que a cor do texto não mude */
    }

    /* Linha divisória */
    .separator {
        border-top: 1px solid #30363d;
        margin-top: 40px;
        margin-bottom: 20px;
        position: relative;
        text-align: center;
    }

    .separator span {
        background-color: #161b22;
        color: #8b949e;
        /* Cor do texto "Outras formas de log in" */
        padding: 0 10px;
        position: relative;
        top: -12px;
        /* Ajusta a posição do texto sobre a linha */
        font-size: 0.9rem;
    }

    .ponto {
        color: #00BFFF;
        /* Azul vibrante (Deep Sky Blue) */
        font-size: 40px;
        font-weight: bold;
        text-align: center;

        /* Combinação de textShadowColor, textShadowOffset e textShadowRadius em CSS padrão */
        text-shadow: 0px 2px 2px rgba(0, 0, 0, 0.75);
    }
    </style>

</head>

<body>

    <?php
    include "mensagens.php";
    ?>

    <div class="login-container">
        <h2 class="login-title text-center">Nuvix
            <span class="ponto">.</span>
        </h2>
        <!-- ACTION É O CAMINHO DO ARQUIVO QUE VAI RECEBER OS DADOS -->
        <form method="post" action="validar-login.php" autocomplete="on">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input value="<?php echo $email; ?>" type="email" class="form-control" id="email" name="email"
                    placeholder="email@email.com" required autofocus>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-baseline">
                    <label for="senha" class="form-label">Senha:</label>
                    <a href="#" class="forgot-password-link">Esqueci senha</a>
                </div>
                <input value="<?php echo $senha; ?>" type="senha" class="form-control" id="senha" name="senha"
                    placeholder="******">
            </div>
            <div class="form-check">
                <input <?php echo $remember; ?> type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Lembrar-me</label>
            </div>
            <button type="submit" class="btn-gradient">Iniciar Sessão</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>