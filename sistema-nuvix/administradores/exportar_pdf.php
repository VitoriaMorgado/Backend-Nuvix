<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// CARREGAR BIBLIOTECA MPDF
require_once '../mpdf/vendor/autoload.php';

// DEFINE TIMEZONE PARA BRASIL
date_default_timezone_set('America/Sao_Paulo');

// --- INÍCIO DA BUSCA DE DADOS DOS ADMINISTRADORES ---
// 1. Inclui o arquivo que faz a requisição para obter todos os administradores.
// Ajustado para obter os dados do sistema, não da sessão.
require("./requests/administradores/get.php"); 

$administradores = [];
if (isset($response["data"]) && is_array($response["data"])) {
    $administradores = $response["data"];
}
$total_administradores = count($administradores);

// --- FIM DA BUSCA DE DADOS DOS ADMINISTRADORES ---

$lista = "";
if($total_administradores > 0) {
    foreach($administradores as $administrador) {
        // .= ADICIONA ITENS NA VARIÁVEL $lista
        $lista .= '
        <tr>
            <th scope="row">'.$administrador["id_adm"].'</th>
            <td>'.$administrador["nome"].'</td>
            <td>'.$administrador["email"].'</td>
        </tr>
        ';
    }
} else {
    $lista = '
    <tr>
        <td colspan="3" style="text-align:center;">Nenhum administrador cadastrado</td>
    </tr>
    ';
}

$html = '
<html>
<head>
    <meta charset="utf-8">
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid black;
    }
    th {
        font-size: 14px;
    }
    </style>
</head>
<body>
    <h1 style="text-align:center">Lista de Administradores</h1>
    <p style="text-align:center">Data de Geração: '.date('d/m/Y H:i:s').'</p>
    <p style="text-align:center">Total de Administradores: '.$total_administradores.'</p>
    <table>
        <thead>
            <tr>
                <th style="background:gray;font-weight:bold" scope="col">ID</th>
                <th style="background:gray;font-weight:bold;" scope="col">Nome</th>
                <th style="background:gray;font-weight:bold;" scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody id="administradorTableBody">
            '.$lista.'
        </tbody>
    </table>
</body>
</html>
';

// Cria uma instância do MPDF
$mpdf = new \Mpdf\Mpdf();

// Escreve o conteúdo HTML no PDF
$mpdf->WriteHTML($html);

// Define o nome do arquivo PDF para download (Ajustado para administradores)
$nomeArquivo = 'administradores_'.date('YmdHis').'.pdf';
// Define as dimensões e margens do PDF
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetMargins(10, 10, 10);
$mpdf->SetDefaultBodyCSS('background', '#FFF');

// Gera o PDF e força o download
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);