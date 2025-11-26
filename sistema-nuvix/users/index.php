<?php
include "../verificar-autenticacao.php";

$pagina = "users";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/users/get.php");
    $user = (isset($response["data"]) && !empty($response["data"])) ? $response["data"][0] : null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Clientes | Nuvix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
    :root {
        --bg-dark: #0f121b;
        --bg-card: #000000;
        --text-light: #f0f2f5;
        --text-muted: #adb5bd;
        --primary-blue: #00bcd4;
        --primary-dark: #008ba3;
        --input-bg: #1f232f;
        --input-border: #3d4352;
        --table-hover: #1a1d29;
        --nuvix-gray: #303030;
    }

    body {
        background-color: var(--bg-dark) !important;
        color: var(--text-light);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Card Principal */
    .card-ofc {
        background-color: var(--bg-card);
        border-radius: 12px;
        border: 1px solid rgba(0, 188, 212, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    /* Tipografia */
    .nuvix-title {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .nuvix-dark {
        color: var(--text-light);
        font-weight: 900;
    }

    .brand-color {
        color: var(--primary-blue);
        font-weight: 900;
    }

    /* Botões */
    .btn-gradient-sm {
        background: linear-gradient(to right, #00bcd4, #2196F3);
        border: none;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .btn-gradient-sm:hover {
        opacity: 0.9;
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 188, 212, 0.3);
    }

    .btn-outline-custom {
        background: transparent;
        border: 1px solid var(--input-border);
        color: var(--text-muted);
        transition: all 0.3s;
    }

    .btn-outline-custom:hover {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
    }

    /* ======== DATATABLES DARK MODE OVERRIDES ======== */

    /* Tabela base */
    .table {
        --bs-table-bg: transparent;
        --bs-table-color: var(--text-light);
        --bs-table-border-color: var(--input-border);
    }

    .table-hover tbody tr:hover {
        color: var(--text-light);
        background-color: var(--table-hover) !important;
    }

    /* Cabeçalho */
    thead th {
        background-color: #151924 !important;
        color: var(--primary-blue) !important;
        border-bottom: 2px solid var(--input-border) !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    td {
        vertical-align: middle;
        border-color: var(--input-border) !important;
    }

    /* Inputs de Busca e Select */
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        background-color: var(--input-bg) !important;
        border: 1px solid var(--input-border) !important;
        color: var(--text-light) !important;
        border-radius: 6px;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: var(--primary-blue) !important;
        box-shadow: 0 0 0 2px rgba(0, 188, 212, 0.2);
    }

    .dataTables_wrapper label,
    .dataTables_info {
        color: var(--text-muted) !important;
    }

    /* Paginação Dark */
    .page-item.disabled .page-link {
        background-color: var(--input-bg);
        border-color: var(--input-border);
        color: #6c757d;
    }

    .page-item .page-link {
        background-color: var(--input-bg);
        border-color: var(--input-border);
        color: var(--text-light);
    }

    .page-item.active .page-link {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
        color: #fff;
    }

    .page-link:hover {
        background-color: var(--input-border);
        color: var(--primary-blue);
    }



    .avatar-table {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid var(--input-border);
    }

    .action-btn {
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-edit {
        background: rgba(255, 193, 7, 0.15);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.2);
    }

    .btn-edit:hover {
        background: #ffc107;
        color: #000;
    }

    .btn-del {
        background: rgba(244, 67, 54, 0.15);
        color: #f44336;
        border: 1px solid rgba(244, 67, 54, 0.2);
    }

    .btn-del:hover {
        background: #f44336;
        color: #fff;
    }
    </style>
</head>

<body>
    <?php include "../mensagens.php"; include "../navbar.php"; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-ofc p-4 p-md-5">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                        <div>
                            <h1 class="nuvix-title mb-0">
                                <span class="nuvix-dark">Nuvix
                                    <span class="brand-color">Clientes</span>.
                                </span>
                            </h1>
                            <p class="text-muted mb-0">Gerenciamento de clientes</p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/users/formulario.php" class="btn-gradient-sm">
                                Novo Cliente
                            </a>
                            <div class="btn-group">
                                <a href="exportar.php" class="btn btn-outline-custom btn-sm d-flex align-items-center"
                                    title="Exportar Excel">Excel</a>
                                <a href="exportar_pdf.php"
                                    class="btn btn-outline-custom btn-sm d-flex align-items-center"
                                    title="Exportar PDF">PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover align-middle w-100">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Data de Cadastro</th>
                                    <th scope="col" colspan="2" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <?php
                                $key = null;
                                require("../requests/users/get.php");
                                
                                if (!empty($response) && !empty($response["data"])) {
                                    foreach ($response["data"] as $user) 
                                        {
                                        echo '
                                        <tr>
                                            <th scope="row">'.$user["id_user"].'</th>

                                            <td><img width="60" src="/users/imagens/'.$user["imagem"].'" class="img-fluid rounded shadow-sm border"></td>
                                            <td class="fw-semibold">'.$user["nome"].'</td>
                                            <td>'.$user["email"].'</td>
                                            <td>'.$user["telefone"].'</td>
                                            <td>'.$user["data_nascimento"].'</td>
                                            <td>'.$user["data_criacao"].'</td>
                                            
                                            <td class="text-center">
                                                <a href="/users/formulario.php?key='.$user["id_user"].'" class="btn btn-warning btn-sm mb-1">Editar</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="/users/remover.php?key='.$user["id_user"].'" class="btn btn-danger btn-sm mb-1">Excluir</a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Nenhum cliente cadastrado.</td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        // Atualizado para usar o CSS do DataTables v1.13.4 (compatível com o CSS copiado)
        $('#myTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
            },
            // Layout: Filtro e Length no topo, Tabela, Info e Paginação em baixo
            dom: '<"d-flex justify-content-between mb-3"lf>rt<"d-flex justify-content-between mt-3"ip>',
            pageLength: 10,
            order: [
                [0, "desc"]
            ] // Ordena por ID decrescente
        });
    });
    </script>
</body>

</html>