<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Definição das cores para reutilização */
    :root {
        --nuvix-blue: #019EC2;
        --nuvix-dark: #000000;
        --nuvix-light: #F6F7F8;
        --nuvix-gradient: linear-gradient(to right, #019EC2, #198097);
    }

    /* Fundo Escuro com Blur (similar a bg-black/50 backdrop-blur-xl do Tailwind) */
    .navbar-nuvix {
        background-color: rgba(0, 0, 0, 0.5) !important;
        /* Fundo semi-transparente */
        backdrop-filter: blur(10px);
        /* Efeito de Blur/Desfoque */
        border-bottom: 1px solid rgba(1, 158, 194, 0.2);
        /* Borda inferior sutil */
        box-shadow: none;
        /* Remove a sombra padrão do Bootstrap se houver */
    }

    /* Estilo do link de navegação padrão */
    .nav-link-nuvix {
        color: var(--nuvix-light) !important;
        position: relative;
        padding: 10px 15px !important;
        transition: color 0.3s ease;
    }

    /* Efeito Hover nos links de navegação */
    .nav-link-nuvix:hover,
    .nav-link-nuvix.active {
        color: var(--nuvix-blue) !important;
        background-color: rgba(1, 158, 194, 0.1);
        /* Fundo sutil ao passar o mouse */
        border-radius: 6px;
    }

    /* Linha de destaque para links ativos/hover (similar ao efeito do Tailwind) */
    .nav-link-nuvix::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        /* Começa no centro */
        transform: translateX(-50%);
        width: 0;
        /* Começa com largura zero */
        height: 2px;
        background: var(--nuvix-gradient);
        transition: width 0.3s ease;
    }

    .nav-link-nuvix:hover::after,
    .nav-link-nuvix.active::after {
        width: calc(100% - 30px);
        /* Linha de destaque com margem lateral */
    }

    /* Estilo do Texto do Logo (Gradiente) */
    .text-nuvix-gradient {
        background: linear-gradient(to right, var(--nuvix-light), var(--nuvix-blue));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        /* Ajuste o tamanho da fonte conforme necessário */
    }

    /* Ajuste do botão toggler */
    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.25rem rgba(1, 158, 194, 0.5);
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-nuvix">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="<?php echo $_SESSION["url"];?>/">
                <span class="text-nuvix-gradient fw-bold">Nuvix</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-nuvix <?php echo $pagina == "administradores" ? 'active' : ''; ?>"
                            href="<?php echo $_SESSION["url"];?>/administradores">Administradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-nuvix <?php echo $pagina == "jogos" ? 'active' : ''; ?>"
                            href="<?php echo $_SESSION["url"];?>/jogos">Jogos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-nuvix <?php echo $pagina == "dev" ? 'active' : ''; ?>"
                            href="<?php echo $_SESSION["url"];?>/dev">Desenvolvedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-nuvix text-danger"
                            href="<?php echo $_SESSION["url"];?>/encerrar-sessao.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>