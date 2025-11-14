<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

if(isset($_GET["key"])) {
    $key = $_GET["key"];
    // EXCLUIR IMAGEM DO PRODUTO
    // if (file_exists("imagens/" . $_SESSION["clientes"][$key]["clientImage"])) {
    //     unlink("imagens/" . $_SESSION["clientes"][$key]["clientImage"]);
    // }
    
    // EXCLUIR O CLIENTE
    require_once "../requests/jogos/delete.php";
    $_SESSION["msg"] = $response["message"];
}
header("Location: ./");
exit;