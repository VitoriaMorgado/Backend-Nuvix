<?php
include "../verificar-autenticacao.php";

$pagina = "users";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/users/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $user = $response["data"][0];
    } else {
        $user = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuários | Nuvix</title>
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
    h5,
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
        color: var(--text-light);
        font-weight: 900;
    }

    .nuvix-title .brand-color {
        color: var(--primary-blue);
        font-weight: 900;
    }

    /* ======== INPUTS ======== */
    .form-control {
        background-color: var(--input-bg) !important;
        color: var(--text-light) !important;
        border: 1px solid var(--input-border) !important;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        box-shadow: none !important;
    }

    .form-control:focus {
        background-color: var(--input-bg) !important;
        color: var(--text-light) !important;
        border-color: var(--primary-blue) !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 188, 212, 0.3) !important;
    }

    .form-control[readonly] {
        background-color: #151820 !important;
        opacity: 0.7;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

    input[type="file"]::file-selector-button {
        background-color: var(--nuvix-gray);
        color: white;
        border: none;
        margin-right: 10px;
        border-radius: 4px;
        cursor: pointer;
        padding: 5px 10px;
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
        color: white;
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

    .text-muted-light {
        color: #adb5bd;
        font-size: 0.85rem;
    }

    .img-thumbnail {
        background-color: var(--input-bg);
        border-color: var(--input-border);
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

                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">
                            <?php echo isset($user) ? "Editar Usuário" : "Cadastrar Usuário"; ?>
                        </h4>
                        <a href="/users/formulario.php" class="btn btn-light btn-sm">Novo Usuário</a>
                        <a href="/users" class="btn btn-light btn-sm">Voltar</a>

                        <h1 class="nuvix-title">
                            <span class="nuvix-dark">Nuvix
                                <span class="brand-color">Usuários</span>.
                            </span>
                        </h1>

                        <form id="userForm" action="/users/cadastrar.php" method="POST" enctype="multipart/form-data"
                            autocomplete="off">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="userId" class="form-label">ID <span
                                            class="label-highlight">User</span></label>
                                    <input type="text" class="form-control" id="userId" name="userId" readonly
                                        value="<?php echo isset($user) ? $user["id_user"] : ""; ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="userImage" class="form-label">Imagem</label>
                                    <input type="file" class="form-control" id="clientImage" name="userImage"
                                        accept="image/*">
                                    <?php
                                    if (isset($user["imagem"])) {
                                        echo '
                                        <input type="hidden" name="currentUserImage" value="' . $user["imagem"] . '">
                                        <img width="120" class="img-thumbnail img-preview mt-2" src="imagens/' . $user["imagem"] . '">
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="userName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="userName" name="userName" required
                                    value="<?php echo isset($user) ? htmlspecialchars($user["nome"], ENT_QUOTES) : ""; ?>">
                            </div>

                            <div class="col-12">
                                <label for="userEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" required
                                    value="<?php echo isset($user) ? htmlspecialchars($user["email"], ENT_QUOTES) : ""; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="usertelefone" class="form-label">Telefone</label>
                                <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="usertelefone"
                                    name="usertelefone" required
                                    value="<?php echo isset($user) ? htmlspecialchars($user["telefone"], ENT_QUOTES) : ""; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="userDataNascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="userDataNascimento"
                                    name="userDataNascimento" required
                                    value="<?php echo isset($user) ? htmlspecialchars($user["data_nascimento"], ENT_QUOTES) : ""; ?>">
                            </div>

                            <div class="col-12">
                                <label for="userSenha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="userSenha" name="userSenha"
                                    <?php echo isset($user) ? "" : "required"; ?>>
                                <div class="text-muted-light mt-1">
                                    <?php echo isset($user) ? "Deixe em branco para manter a senha atual." : "Defina uma senha segura."; ?>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-gradient">Salvar Usuário</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Máscara para telefone
    $(function() {
        $('[data-mask]').each(function() {
            var m = $(this).data('mask');
            $(this).mask(m);
        });
    });

    // Preview de imagem (JS Puro)
    (function() {
        const input = document.getElementById('clientImage');
        const preview = document.getElementById('clientPreview');

        if (!input || !preview) return;

        function showPreview(file) {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }

        input.addEventListener('change', function() {
            const file = this.files && this.files[0];
            if (file && file.type.startsWith('image/')) {
                showPreview(file);
            }
        });
    })();
    </script>
</body>

</html>