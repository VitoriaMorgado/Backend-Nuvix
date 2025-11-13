<?php
include "../verificar-autenticacao.php";

$pagina = "administradores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/administradores/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $administrador = $response["data"][0];
    } else {
        $administrador = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Administradores | Nuvix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root {
        --bg-dark: #0f121b;
        --bg-card: #000000;
        --text-light: #f0f2f5;
        --primary-blue: #00bcd4;
        --input-bg: #1f232f;
        --input-border: #3d4352;
        --shadow-glow: 0 0 15px rgba(0, 188, 212, 0.3);
        --nuvix-gray: #303030;
    }

    body {
        background-color: var(--bg-dark) !important;
        color: var(--text-light);
    }

    .card-ofc {
        background-color: var(--bg-card);
        border-radius: 12px;
        border: 1px solid rgba(0, 188, 212, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .navbar {
        background-color: var(--bg-card) !important;
        color: var(--text-light) !important;
        border-bottom: 1px solid var(--primary-blue);
    }

    h2,
    label,
    .form-label {
        color: var(--text-light);
        font-weight: 500;
        display: block;
        margin-bottom: 0.25rem;
    }

    .nuvix-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        line-height: 1.2;
    }

    .nuvix-dark {
        color: var(--primary-light);
        font-weight: 900;
    }

    .nuvix-title .brand-color {
        color: var(--primary-blue);
        font-weight: 900;
    }

    /* ======== INPUTS ======== */
    .form-control.bg-dark {
        background-color: var(--input-bg) !important;
        color: var(--text-light) !important;
        border: 1px solid var(--input-border) !important;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        box-shadow: none !important;
    }

    .form-control.bg-dark:focus {
        background-color: var(--input-bg) !important;
        color: var(--text-light) !important;
        border-color: var(--primary-blue) !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 188, 212, 0.3) !important;
    }

    /* ======== BOTÕES ======== */
    .btn-gradient {
        background: linear-gradient(to right, #00bcd4, #2196F3);
        border: none;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: box-shadow 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        box-shadow: 0 5px 15px rgba(0, 188, 212, 0.4);
    }

    .btn-gradient-sm {
        background: linear-gradient(to right, #00bcd4, #2196F3);
        border: none;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-gradient-sm:hover {
        color: #fff;
        opacity: 0.9;
    }

    .label-highlight {
        color: var(--primary-blue);
        font-weight: 600;
        display: inline;
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; ?>
    <?php include "../navbar.php"; ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card-ofc p-5">

                    <a href="/administradores" class="btn-gradient-sm mb-4" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Voltar
                    </a>

                    <h1 class="nuvix-title">
                        <span class="nuvix-dark text-light">Nuvix
                            <span class="brand-color">Cadastro</span>.
                        </span>
                    </h1>

                    <form id="administradorForm" action="/administradores/cadastrar.php" method="POST"
                        enctype="multipart/form-data">

                        <div class="mb-4">
                            <label for="administradorId">Código de <span
                                    class="label-highlight">Administrador</span>.</label>
                            <input type="text" class="form-control bg-dark text-white" id="administradorId"
                                name="administradorId" readonly style="max-width: 150px;"
                                value="<?php echo isset($administrador) ? $administrador['id_adm'] : ''; ?>">
                        </div>

                        <div class="mb-4">
                            <label for="administradornome">Nome:</label>
                            <input type="text" class="form-control bg-dark text-white" id="administradornome"
                                name="administradornome" required
                                value="<?php echo isset($administrador) ? $administrador['nome'] : ''; ?>">
                        </div>

                        <div class="mb-4">
                            <label for="administradoremail">E-mail:</label>
                            <input type="email" class="form-control bg-dark text-white" id="administradoremail"
                                name="administradoremail" required
                                value="<?php echo isset($administrador) ? $administrador['email'] : ''; ?>">
                        </div>

                        <div class="mb-5">
                            <label for="administradorsenha">Senha:</label>
                            <input type="password" class="form-control bg-dark text-white" id="administradorsenha"
                                name="administradorsenha" required
                                value="<?php echo isset($administrador) ? $administrador['senha'] : ''; ?>">
                        </div>

                        <button type="submit" class="btn-gradient">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>