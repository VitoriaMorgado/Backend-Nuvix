<style>
:root {
    --bg-dark: #0f121b;
    /* Fundo principal escuro */
    --bg-card: #000000;
    /* Fundo do card/container */
    --text-light: #f0f2f5;
    --primary-blue: #00bcd4;
    /* Cor de destaque (ciano) */
    --input-bg: #1f232f;
    /* Fundo dos inputs (azul escuro) */
    --input-border: #3d4352;
    --shadow-glow: 0 0 15px rgba(0, 188, 212, 0.3);
    --nuvix-gray: #1a1a1a;
    /* Tom mais claro para listras pares (similar à imagem) */
    --dark-line: #0e0e0e;
    /* Tom mais escuro para listras ímpares */
    --gradient-blue: linear-gradient(to right, #00bcd4, #2196F3);
    /* Gradiente azul */
}

body {
    background-color: var(--bg-dark) !important;
    color: var(--text-light);
}

.card-ofc {
    /* Fundo preto do container principal, sem borda ciano lateral */
    background-color: var(--bg-card);
    border-radius: 6px;
    border: none;
    /* Removido a borda de 1px solid rgba(0, 188, 212, 0.1) */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}

.navbar {
    background-color: var(--bg-card) !important;
    color: var(--text-light) !important;
    border-bottom: 1px solid var(--primary-blue);
}

h2,
h4,
span,
label,
.form-label {
    color: var(--text-light);
    font-weight: 700;
    /* Títulos mais fortes */
}

/* Estilo do título principal "Sistema de Administradores" */
.header-title {
    font-size: 1.5rem;
    font-weight: 700;
}

/* Estilo do subtítulo "Administradores Cadastrados" */
.subheader-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-top: 1rem;
    margin-bottom: 1rem;
}


/* ======== BOTÕES GRADIENTE (Novo Administrador) ======== */
.btn-gradient-sm {
    background: var(--gradient-blue);
    border: none;
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: opacity 0.3s ease-in-out;
}

.btn-gradient-sm:hover {
    color: #fff;
    opacity: 0.9;
}

/* Ajustes para botões de exportação (Excel e PDF) */
.btn-excel {
    background-color: #28a745;
    border: none;
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: opacity 0.3s ease-in-out;
}

.btn-pdf {
    background-color: #dc3545;
    border: none;
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: opacity 0.3s ease-in-out;
}

/* ======== TABELA ======== */
.table-ofc {
    background-color: var(--bg-card) !important;
    color: var(--text-light) !important;
    border: none !important;
    /* Removendo qualquer borda extra da tabela */
}

/* Linhas ÍMPARES (mais escuras na imagem) */
.table-ofc tbody tr:nth-child(odd) {
    background-color: var(--dark-line) !important;
    /* Cor mais escura que o fundo do card (similar à imagem) */
}

/* Linhas PARES (mais claras na imagem) */
.table-ofc tbody tr:nth-child(even) {
    background-color: var(--nuvix-gray) !important;
    /* Cor um pouco mais clara que a linha ímpar */
}

/* Cabeçalho da Tabela */
.table-ofc thead {
    /* Usando o gradiente do botão no cabeçalho */
    background: var(--gradient-blue) !important;
    color: var(--text-light) !important;
}

.table-ofc thead th {
    border-bottom: none !important;
    /* Sem borda entre header e body */
    color: white !important;
    /* Texto branco no cabeçalho */
    font-weight: 600;
    padding: 0.75rem;
    vertical-align: middle;
}

/* ======== DataTables UI (Exibir x, Pesquisar, Paginação) ======== */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    color: var(--text-light) !important;
}

.dataTables_wrapper .dataTables_filter input {
    background-color: var(--input-bg) !important;
    color: var(--text-light) !important;
    border: 1px solid var(--input-border) !important;
    /* Altura menor para o campo de pesquisa */
    height: 28px;
}

.dataTables_wrapper .dataTables_length select {
    background-color: var(--input-bg) !important;
    color: var(--text-light) !important;
    border: 1px solid var(--input-border) !important;
    /* Altura menor para o select */
    height: 28px;
}

/* Paginação Ativa */
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: var(--gradient-blue) !important;
    /* Fundo gradiente */
    border: none !important;
    color: white !important;
}

/* Paginação Normal/Hover */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    background-color: var(--nuvix-gray) !important;
    /* Fundo cinza */
    border: none !important;
    color: var(--text-light) !important;
    margin: 0 4px;
    border-radius: 4px;
    padding: 4px 10px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #3d4352 !important;
}

/* Botões Editar e Excluir na Tabela */
.table-ofc .btn-warning {
    background-color: #ffc107;
    /* Amarelo Bootstrap */
    border: none;
    font-size: 0.75rem;
    padding: 4px 8px;
}

.table-ofc .btn-danger {
    background-color: #dc3545;
    /* Vermelho Bootstrap */
    border: none;
    font-size: 0.75rem;
    padding: 4px 8px;
}
</style>