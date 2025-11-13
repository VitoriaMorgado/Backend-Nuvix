<?php

require_once "../verificar-autenticacao.php";

$response = []; 

try {
    if (!$_POST) {
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    $id_adm = $_POST["administradorId"];
    $senha = $_POST["administradorsenha"];

    // NOVO CADASTRO 
    if (empty($id_adm)) {
        
        if (empty($senha)) {
            throw new Exception("O campo Senha é obrigatório para um novo administrador.");
        }
        
        $postifield = array(
            "nome" => $_POST["administradornome"],
            "email" => $_POST["administradoremail"],
            "senha" => $senha,
        );

        require_once("../requests/administradores/post.php");
    
    // 2. EDIÇÃO (PUT)
    } else {
        $postifield = array(
            "id_adm" => $id_adm,
            "nome" => $_POST["administradornome"],
            "email" => $_POST["administradoremail"],
        );

        if (!empty($senha)) {
            $postifield["senha"] = $senha;
        }

        require_once("../requests/administradores/put.php");
    }
    
    $_SESSION["msg"] = $response["message"] ?? "Operação concluída."; 

} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./"); 
    exit;
}