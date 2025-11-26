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
    <title>Dashboard - Administradores | Nuvix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
    :root {
        --bg-dark: #0f121b;
        --bg-card: #000000;
        --text-light: #f0f2f5;
        --text-muted: #adb5bd;
        --primary-blue: #00bcd4;
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

    /* Títulos */
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
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-outline-custom:hover {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
    }

    /* ======== DATATABLES OVERRIDES ======== */

    /* Tabela Base */
    .table {
        --bs-table-bg: transparent;
        --bs-table-color: var(--text-light);
        --bs-table-border-color: var(--input-border);
    }

    .table-hover tbody tr:hover {
        color: var(--text-light);
        background-color: var(--table-hover) !important;
    }

    /* Header */
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

    /* Inputs e Selects */
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

    /* Paginação */
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

    /* Avatar */
    .admin-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--input-bg);
        border: 1px solid var(--primary-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--primary-blue);
        margin-right: 10px;
    }

    /* Ações */
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
                                    <span class="brand-color">Admins</span>.
                                </span>
                            </h1>
                            <p class="text-muted mb-0">Gerenciamento de acesso e administradores</p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/administradores/formulario.php" class="btn-gradient-sm">
                                + Novo Admin
                            </a>
                            <div class="btn-group">
                                <a href="exportar_administradores.php" class="btn btn-outline-custom btn-sm"
                                    title="Exportar Excel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2zM8 12a1 1 0 0 1-1-1V7.333C7 6.603 7.5 6 8.134 6h.732C9.5 6 10 6.603 10 7.333V11a1 1 0 0 1-1 1H8z" />
                                    </svg>
                                    Excel
                                </a>
                                <a href="exportar_administradores_pdf.php" class="btn btn-outline-custom btn-sm"
                                    title="Exportar PDF">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2zM4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 3.798-.861c.297 0 .62.017.918.052.295.035.583.09.844.158a2.745 2.745 0 0 1 1.801 1.164c.18.296.268.615.268.917 0 .268-.089.51-.268.726a1.63 1.63 0 0 1-1.22.618c-.432.028-.91-.037-1.398-.168-.548-.147-1.17-.393-1.848-.738a8.64 8.64 0 0 1-1.534-.985z" />
                                    </svg>
                                    PDF
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover align-middle w-100">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Administrador</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col" class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $key = null;
                                require("../requests/administradores/get.php");
                                
                                if(!empty($response) && isset($response["data"])) {
                                    foreach($response["data"] as $administrador) {
                                        // Gera iniciais para o avatar
                                        $iniciais = strtoupper(substr($administrador["nome"], 0, 1));
                                        
                                        echo '
                                        <tr>
                                            <td class="text-muted">#'.$administrador["id_adm"].'</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="admin-avatar">'.$iniciais.'</div>
                                                    <span class="fw-semibold text-white">'.$administrador["nome"].'</span>
                                                </div>
                                            </td>
                                            <td class="text-muted">'.$administrador["email"].'</td>
                                            <td class="text-end">
                                                <a href="/administradores/formulario.php?key='.$administrador["id_adm"].'" class="action-btn btn-edit me-1">Editar</a>
                                                <a href="/administradores/remover.php?key='.$administrador["id_adm"].'" class="action-btn btn-del" onclick="return confirm(\'Tem certeza que deseja remover '.$administrador["nome"].'?\')">Excluir</a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Nenhum administrador cadastrado.
                                        </td>
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
        $('#myTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
            },
            dom: '<"d-flex justify-content-between mb-3"lf>rt<"d-flex justify-content-between mt-3"ip>',
            pageLength: 10,
            order: [
                [0, "asc"]
            ]
        });
    });
    </script>
</body>

</html>