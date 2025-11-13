<?php
include "../verificar-autenticacao.php";

$pagina = "jogos"; // Página alterada para "jogos"

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // Altere o caminho da requisição se necessário
    require("../requests/jogos/get.php"); 
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        // Altere a variável para refletir a entidade (jogo)
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
    <title>Dashboard - Cadastro de Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #f8f9fa 60%, #e3e6f0 100%);
    }

    .card {
        border-radius: 18px;
    }

    .card-header {
        border-radius: 18px 18px 0 0;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        background: #2563eb;
        border: none;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .img-thumbnail {
        border-radius: 10px;
        margin-top: 8px;
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-semibold">
                                <?php echo isset($jogo) ? "Editar Jogo" : "Cadastrar Jogo"; ?>
                            </span>
                            <a href="/jogos/formulario.php" class="btn btn-light btn-sm">Novo Jogo</a>
                            <a href="/jogos" class="btn btn-light btn-sm">Voltar</a>
                        </div>
                    </div>
                    <div class="card-body px-4 py-4">
                        <form id="JogoForm" action="/jogos/cadastrar.php" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="id_jogo" class="form-label">ID Jogo</label>
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
                                    <label for="preco" class="form-label">Preço (R$)</label>
                                    <input type="text" class="form-control" id="preco" name="preco" required
                                        value="<?php echo isset($jogo) ? $jogo["preco"] : ""; ?>">
                                </div>

                                <div class="col-md-8">
                                    <label for="empresa_game" class="form-label">Empresa (Desenvolvedora)</label>
                                    <input type="text" class="form-control" id="empresa_game" name="empresa_game"
                                        required value="<?php echo isset($jogo) ? $jogo["empresa_game"] : ""; ?>"
                                        maxlength="100">
                                </div>

                                <div class="col-md-4">
                                    <label for="codigo_game" class="form-label">Código do Jogo</label>
                                    <input type="text" class="form-control" id="codigo_game" name="codigo_game" required
                                        value="<?php echo isset($jogo) ? $jogo["codigo_game"] : ""; ?>" maxlength="100">
                                </div>

                                <div class="col-md-4">
                                    <label for="classificacao" class="form-label">Classificação</label>
                                    <input type="text" class="form-control" id="classificacao" name="classificacao"
                                        value="<?php echo isset($jogo) ? $jogo["classificacao"] : ""; ?>"
                                        maxlength="50">
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

                                <hr class="my-3">
                                <h5 class="fw-bold mb-3">Imagens do Jogo</h5>

                                <div class="col-md-6">
                                    <label for="imagem" class="form-label">Imagem Principal</label>
                                    <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                                    <?php
                                    if (isset($jogo["imagem"]) && !empty($jogo["imagem"])) {
                                        echo '<input type="hidden" name="current_imagem" value="' . $jogo["imagem"] . '">';
                                        echo '<img width="120" src="imagens/' . $jogo["imagem"] . '" class="img-thumbnail shadow-sm">';
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
                                        echo '<img width="120" src="imagens/' . $jogo["imagencapa"] . '" class="img-thumbnail shadow-sm">';
                                    }
                                    ?>
                                </div>

                                <div class="col-md-6">
                                    <label for="imagembanner" class="form-label">Imagem Banner</label>
                                    <input type="file" class="form-control" id="imagembanner" name="imagembanner"
                                        accept="image/*">
                                    <?php
                                    if (isset($jogo["imagembanner"]) && !empty($jogo["imagembanner"])) {
                                        echo '<input type="hidden" name="current_imagembanner" value="' . $jogo["imagembanner"] . '">';
                                        echo '<img width="120" src="imagens/' . $jogo["imagembanner"] . '" class="img-thumbnail shadow-sm">';
                                    }
                                    ?>
                                </div>

                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                <div class="col-md-4">
                                    <label for="imagemexemplo<?php echo $i; ?>" class="form-label">Imagem Exemplo
                                        <?php echo $i; ?></label>
                                    <input type="file" class="form-control" id="imagemexemplo<?php echo $i; ?>"
                                        name="imagemexemplo<?php echo $i; ?>" accept="image/*">
                                    <?php
                                        $field = "imagemexemplo$i";
                                        if (isset($jogo[$field]) && !empty($jogo[$field])) {
                                            echo '<input type="hidden" name="current_' . $field . '" value="' . $jogo[$field] . '">';
                                            echo '<img width="100" src="imagens/' . $jogo[$field] . '" class="img-thumbnail shadow-sm">';
                                        }
                                        ?>
                                </div>
                                <?php endfor; ?>

                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
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