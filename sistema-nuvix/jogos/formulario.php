<?php
include "../verificar-autenticacao.php";

$pagina = "jogos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/jogos/get.php");
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        $jogo = $response["data"][0];
    } else {
        $jogo = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Jogos | Nuvix</title>
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
        color: var(--primary-light);
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

    /* Input readonly style adjustment */
    .form-control[readonly] {
        background-color: #151820 !important;
        opacity: 0.7;
    }

    /* Arquivo Input Wrapper */
    input[type="file"]::file-selector-button {
        background-color: var(--nuvix-gray);
        color: white;
        border: none;
        margin-right: 10px;
        border-radius: 4px;
        cursor: pointer;
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

    /* Imagens Preview */
    .img-thumbnail {
        background-color: var(--input-bg);
        border-color: var(--input-border);
        border-radius: 8px;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; ?>
    <?php include "../navbar.php"; ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card-ofc p-4 p-md-5">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="/jogos" class="btn-gradient-sm" style="width: fit-content;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                            Voltar
                        </a>
                        <a href="/jogos/formulario.php" class="btn-gradient-sm text-white">Novo Jogo</a>
                    </div>

                    <h1 class="nuvix-title">
                        <span class="nuvix-dark text-light">Nuvix
                            <span class="brand-color">Jogos</span>.
                        </span>
                    </h1>

                    <p class="text-muted mb-4">
                        <?php echo isset($jogo) ? "Editando jogo existente" : "Cadastrando novo jogo no sistema"; ?></p>

                    <form id="JogoForm" action="/jogos/cadastrar.php" method="POST" enctype="multipart/form-data"
                        autocomplete="off">

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="id_jogo" class="form-label">ID <span
                                        class="label-highlight">Jogo</span></label>
                                <input type="text" class="form-control" id="id_jogo" name="id_jogo" readonly
                                    value="<?php echo isset($jogo) ? $jogo["id_jogo"] : ""; ?>">
                            </div>

                            <div class="col-md-9">
                                <label for="nome_jogo" class="form-label">Nome do Jogo</label>
                                <input type="text" class="form-control" id="nome_jogo" name="nome_jogo" required
                                    value="<?php echo isset($jogo) ? $jogo["nome"] : ""; ?>" maxlength="100">
                            </div>

                            <div class="col-12">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"
                                    required><?php echo isset($jogo) ? htmlspecialchars($jogo["descricao"]) : ""; ?></textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="preco" class="form-label">Preço <span
                                        class="label-highlight">(R$)</span></label>
                                <input type="text" class="form-control" id="preco" name="preco" required
                                    value="<?php echo isset($jogo) ? $jogo["preco"] : ""; ?>">
                            </div>

                            <div class="col-md-8">
                                <label for="empresa_game" class="form-label">Empresa (Desenvolvedora)</label>
                                <input type="text" class="form-control" id="empresa_game" name="empresa_game" required
                                    value="<?php echo isset($jogo) ? $jogo["empresa_game"] : ""; ?>" maxlength="100">
                            </div>

                            <div class="col-md-4">
                                <label for="codigo_game" class="form-label">Código do Jogo</label>
                                <input type="text" class="form-control" id="codigo_game" name="codigo_game" required
                                    value="<?php echo isset($jogo) ? $jogo["codigo_game"] : ""; ?>" maxlength="100">
                            </div>

                            <div class="col-md-4">
                                <label for="classificacao" class="form-label">Classificação</label>
                                <input type="text" class="form-control" id="classificacao" name="classificacao"
                                    value="<?php echo isset($jogo) ? $jogo["classificacao"] : ""; ?>" maxlength="50">
                            </div>

                            <div class="col-md-4">
                                <label for="avaliacao" class="form-label">Avaliação</label>
                                <input type="text" class="form-control" id="avaliacao" name="avaliacao"
                                    value="<?php echo isset($jogo) ? $jogo["avaliacao"] : ""; ?>" maxlength="50">
                            </div>

                            <div class="col-12">
                                <label for="categorias" class="form-label">Categorias (separar por vírgula)</label>
                                <textarea class="form-control" id="categorias" name="categorias"
                                    rows="2"><?php echo isset($jogo) ? htmlspecialchars($jogo["categorias"]) : ""; ?></textarea>
                            </div>

                            <div class="col-12">
                                <hr class="my-4" style="border-color: var(--input-border);">
                                <h5 class="nuvix-dark text-light mb-3">Mídia do Jogo</h5>
                            </div>

                            <div class="col-md-6">
                                <label for="imagem" class="form-label">Imagem Principal</label>
                                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                                <?php
                                if (isset($jogo["imagem"]) && !empty($jogo["imagem"])) {
                                    echo '<input type="hidden" name="current_imagem" value="' . $jogo["imagem"] . '">';
                                    echo '<div class="mt-2"><img width="120" src="imagens/' . $jogo["imagem"] . '" class="img-thumbnail"></div>';
                                }
                                ?>
                            </div>

                            <div class="col-md-6">
                                <label for="imagencapa" class="form-label">Imagem de Capa</label>
                                <input type="file" class="form-control" id="imagencapa" name="imagencapa"
                                    accept="image/*">
                                <?php
                                if (isset($jogo["imagencapa"]) && !empty($jogo["imagencapa"])) {
                                    echo '<input type="hidden" name="current_imagencapa" value="' . $jogo["imagencapa"] . '">';
                                    echo '<div class="mt-2"><img width="120" src="imagens/' . $jogo["imagencapa"] . '" class="img-thumbnail"></div>';
                                }
                                ?>
                            </div>

                            <div class="col-12">
                                <label for="imagembanner" class="form-label">Imagem Banner</label>
                                <input type="file" class="form-control" id="imagembanner" name="imagembanner"
                                    accept="image/*">
                                <?php
                                if (isset($jogo["imagembanner"]) && !empty($jogo["imagembanner"])) {
                                    echo '<input type="hidden" name="current_imagembanner" value="' . $jogo["imagembanner"] . '">';
                                    echo '<div class="mt-2"><img width="100%" style="max-height: 150px; object-fit: cover;" src="imagens/' . $jogo["imagembanner"] . '" class="img-thumbnail"></div>';
                                }
                                ?>
                            </div>

                            <?php for ($i = 1; $i <= 3; $i++): ?>
                            <div class="col-md-4">
                                <label for="imagemexemplo<?php echo $i; ?>" class="form-label">Exemplo
                                    <?php echo $i; ?></label>
                                <input type="file" class="form-control" id="imagemexemplo<?php echo $i; ?>"
                                    name="imagemexemplo<?php echo $i; ?>" accept="image/*">
                                <?php
                                    $field = "imagemexemplo$i";
                                    if (isset($jogo[$field]) && !empty($jogo[$field])) {
                                        echo '<input type="hidden" name="current_' . $field . '" value="' . $jogo[$field] . '">';
                                        echo '<div class="mt-2"><img width="100" src="imagens/' . $jogo[$field] . '" class="img-thumbnail"></div>';
                                    }
                                ?>
                            </div>
                            <?php endfor; ?>

                            <div class="col-12 mt-5">
                                <button type="submit" class="btn-gradient">Salvar Dados do Jogo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    // Máscara para o campo Preço
    $(function() {
        $('#preco').mask('000.000.000,00', {
            reverse: true
        });
    });
    </script>
</body>

</html>