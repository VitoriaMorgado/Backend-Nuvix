<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// DEFINE TIMEZONE PARA BRASIL
date_default_timezone_set('America/Sao_Paulo');
$filename = "administradores_".date('YmdHis').".xls";

// --- INÍCIO DA BUSCA DE DADOS DOS ADMINISTRADORES ---

// 1. Inclui o arquivo que faz a requisição para obter todos os administradores.
// Assumindo que este arquivo está na mesma pasta que o "requests"
require("./requests/administradores/get.php"); 

// 2. Tenta obter os dados do array de resposta
$administradores = [];
if (isset($response["data"]) && is_array($response["data"])) {
    $administradores = $response["data"];
}

// --- FIM DA BUSCA DE DADOS DOS ADMINISTRADORES ---

// CABEÇALHO PARA EXPORTAR O ARQUIVO EM EXCEL
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// O buffer de saída é limpo para evitar problemas com cabeçalhos e conteúdo HTML
if (ob_get_contents()) ob_end_clean(); 
echo "\xEF\xBB\xBF"; // Adiciona BOM para garantir o UTF-8 no Excel

?>

<head>
    <meta charset="utf-8">
</head>
<table>
    <thead>
        <tr>
            <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">ID</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:400px" scope="col">Nome</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">E-mail</th>
        </tr>
    </thead>
    <tbody id="administradorTableBody">
        <?php
        if(!empty($administradores)) {
            foreach($administradores as $administrador) {
                echo '
                <tr>
                    <td style="border:1px solid black">'.$administrador["id_adm"].'</td>
                    <td style="border:1px solid black">'.$administrador["nome"].'</td>
                    <td style="border:1px solid black">'.$administrador["email"].'</td>
                </tr>
                ';
            }
        } else {
            echo '
            <tr>
                <td colspan="3" style="border:1px solid black; text-align:center;">Nenhum administrador cadastrado</td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>