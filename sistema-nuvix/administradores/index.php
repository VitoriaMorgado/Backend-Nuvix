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
    <title>Dashboard - Listagem de Administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
    :root {
        --bg-dark: #0f121b;
        --bg-card: #151821;
        --text-light: #f0f2f5;
        --primary-blue: #00bcd4;
        --input-bg: #1f232f;
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-light);
    }

    .card {
        background-color: var(--bg-card);
        border-radius: 12px;
        border: 1px solid rgba(0, 188, 212, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .card-header {
        background-color: #1a1e28 !important;
        color: var(--text-light) !important;
        border-bottom: 1px solid rgba(0, 188, 212, 0.1);
    }

    .card-header span,
    .card-body h4 {
        color: var(--text-light);
    }

    .btn-light {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--text-light);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-light:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    .btn-success {
        background-color: #10b981;
        border-color: #10b981;
    }

    .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
    }

    .btn-warning {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }



    .table {
        color: var(--text-light);
        --bs-table-bg: var(--bg-card);
        --bs-table-striped-bg: #1a1e28;
        --bs-table-hover-bg: #1f232f;
    }

    .table-primary {
        --bs-table-bg: #00bcd4;
        color: var(--bg-dark);
        border-color: var(--primary-blue);
    }

    .table-primary th {
        font-weight: bold;
    }

    .dataTables_wrapper .row {
        color: var(--text-light);
    }

    .dataTables_length label,
    .dataTables_filter label,
    .dataTables_info {
        color: var(--text-light);
    }

    .dataTables_filter input {
        background-color: var(--input-bg);
        border-color: #3d4352;
        color: var(--text-light);
    }

    .dataTables_paginate .pagination .page-item .page-link {
        background-color: var(--bg-card);
        border-color: #3d4352;
        color: var(--text-light);
    }

    .dataTables_paginate .pagination .page-item.active .page-link {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
        color: var(--bg-dark);
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <span>Sistema de Administradores</span>
                <div>
                    <a href="/administradores/formulario.php" class="btn btn-light btn-sm me-2">Novo Administrador</a>
                    <a href="exportar_administradores.php" class="btn btn-success btn-sm me-2">Excel</a>
                    <a href="exportar_administradores_pdf.php" class="btn btn-danger btn-sm">PDF</a>
                </div>
            </div>
            <div class="card-body">
                <h4 class="mb-4">Administradores Cadastrados</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col"># ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $key = null;
                             require("../requests/administradores/get.php");
                            if(!empty($response)) {
                                foreach($response["data"] as $key => $administrador) {
                                    echo '
                                    <tr>
                                        <th scope="row">'.$administrador["id_adm"].'</th>
                                        <td>'.$administrador["nome"].'</td>
                                        <td>'.$administrador["email"].'</td>
                                        <td>
                                            <a href="/administradores/formulario.php?key='.$administrador["id_adm"].'" class="btn btn-warning btn-sm">Editar</a>
                                        </td>
                                        <td>
                                            <a href="/administradores/remover.php?key='.$administrador["id_adm"].'" class="btn btn-danger btn-sm">Excluir</a>
                                        </td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum Administrador cadastrado</td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
    let table = new DataTable('#myTable', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        }
    });
    </script>
</body>

</html>