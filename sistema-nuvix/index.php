<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "home";

?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos customizados para o tema escuro -->
    <style>
    body {
        /* Fundo escuro garantido, mesmo sem a classe bg-body-dark do Bootstrap */
        background-color: #020202ff !important;
    }

    .bi {
        /* Cor de destaque para os ícones */
        color: #019EC2;
    }

    .btn-gradient {
        background: linear-gradient(to right, #00bcd4, #2196F3);
        /* Gradiente ciano para azul */
        border: none;
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 80px;
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
    </style>
</head>

<body>
    <?php
    include "mensagens.php";
    include "navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="row g-4">
                    <!-- Card de Usuários -->
                    <div class="col-md-4">
                        <div class="card text-bg-dark">
                            <div class="card-body text-center">
                                <i class="bi bi-people" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Administradores
                                    <?php
                                    // Certifique-se de que os arquivos requisitados existem
                                    require("requests/administradores/get.php");
                                    ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0;?>)
                                </h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"];?>/Administradores"
                                    class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card de Desenvolvedores -->
                    <div class="col-md-4">
                        <div class="card text-bg-dark">
                            <div class="card-body text-center">
                                <i class="bi bi-pc-display" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Games
                                    <?php
                                    require("requests/jogos/get.php");
                                    ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0;?>)
                                </h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"];?>/jogos" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card de Games -->
                    <div class="col-md-4">
                        <div class="card text-bg-dark">
                            <div class="card-body text-center">
                                <i class="bi bi-joystick" style="font-size: 2rem;"></i>
                                <h5 class="card-title mt-2">Users
                                    <?php
                                    require("requests/users/get.php");
                                    ?>
                                    (<?php echo isset($response['data']) ? count($response['data']) : 0;?>)
                                </h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo $_SESSION["url"];?>/users" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>