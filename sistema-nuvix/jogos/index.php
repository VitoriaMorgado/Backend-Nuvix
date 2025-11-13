<?php
include "../verificar-autenticacao.php";

$pagina = "jogos";

// Variável para armazenar o array de jogos
$jogos = []; 

// Lógica de pré-preenchimento com 'key' foi removida do index.php,
// pois o index é a tela de listagem e não de edição.
// A linha abaixo foi ajustada para puxar a lista completa de jogos.
require("../requests/jogos/get.php"); 

if(isset($response["data"])) {
    $jogos = $response["data"];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Listagem de Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body style="background: #f8f9fa;">
    <?php include "../mensagens.php"; include "../navbar.php"; ?> <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-semibold">Listagem de Jogos</span>
                            <div>
                                <a href="/jogos/formulario.php" class="btn btn-light btn-sm me-2">Novo Jogo</a>
                                <a href="exportar.php" class="btn btn-success btn-sm me-2 disabled">Excel</a>
                                <a href="exportar_pdf.php" class="btn btn-danger btn-sm disabled">PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light rounded-bottom">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Imagem</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Classificação</th>
                                        <th scope="col">Avaliação</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="jogoTableBody">
                                    <?php
                                    // Utiliza a variável $jogos populada acima
                                    if(!empty($jogos)) { 
                                        foreach($jogos as $jogo) {
                                            echo '
                                            <tr>
                                                <th scope="row">'.$jogo["id_jogo"].'</th>
                                                <td><img width="60" src="/jogos/imagens/'.$jogo["imagem"].'" class="img-fluid rounded shadow-sm border"></td>
                                                <td class="fw-semibold">'.$jogo["nome"].'</td>
                                                <td>'.$jogo["empresa_game"].'</td>
                                                <td>R$ '.number_format($jogo["preco"], 2, ',', '.').'</td>
                                                <td>'.$jogo["classificacao"].'</td>
                                                <td>'.$jogo["avaliacao"].'</td>
                                                <td>
                                                    <a href="/jogos/formulario.php?key='.$jogo["id_jogo"].'" class="btn btn-warning btn-sm mb-1">Editar</a>
                                                    <a href="/jogos/remover.php?key='.$jogo["id_jogo"].'" class="btn btn-danger btn-sm mb-1" onclick="return confirm(\'Tem certeza que deseja remover o jogo '.$jogo["nome"].'?\')">Excluir</a>
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    } else {
                                        echo '
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Nenhum Jogo cadastrado</td> 
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    /* Estilos CSS mantidos/ajustados minimamente */
    body {
        background: linear-gradient(135deg, #e3f0ff 0%, #f8f9fa 100%);
    }

    .card {
        border-radius: 1rem;
    }

    .card-header {
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .card-body {
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
    // Configuração do DataTables
    let table = new DataTable('#myTable', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        }
    });
    </script>
</body>

</html>