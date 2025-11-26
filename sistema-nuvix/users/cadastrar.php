<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";


try{
    if(!$_POST){
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    // VERIFICAR SE O ARQUIVO FOI ENVIADO
    if ($_FILES["userImage"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["userImage"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["userImage"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["userImage"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM, DELETAR A IMAGEM
        if ($_POST["currentUserImage"] != "") {
            // UNLINK = DELETAR ARQUIVOS
            unlink("imagens/" . $_POST["currentUserImage"]);
        }

    } else {
        // SE NÃO FOI ENVIADO ARQUIVO, PEGAR O NOME DO ARQUIVO ATUAL
        $_POST["userImage"] = $_POST["currentUserImage"];
    }

    $msg = '';
    if ($_POST["userId"] == "") {
        $postifield = array(
            "nome" => $_POST["userName"],
            "email" => $_POST["userEmail"],
            "imagem" => $_POST["userImage"],
            "senha" => $_POST["userPassword"],
            "data_emissao" => $_POST["userIssueDate"],
            "data_nascimento" => $_POST["userBirthDate"],
            "telefone" => $_POST["userPhone"]
           
        );



    require("../requests/users/post.php");
        
    } else {
        $postifield = array(
            "id_user" => $_POST["userId"],
           "nome" => $_POST["userName"],
            "email" => $_POST["userEmail"],
            "imagem" => $_POST["userImage"],
            "senha" => $_POST["userPassword"],
            "data_emissao" => $_POST["userIssueDate"],
            "data_nascimento" => $_POST["userBirthDate"],
            "telefone" => $_POST["userPhone"]
        );

        require("../requests/users/put.php");
    }
    $_SESSION["msg"] = $response["message"]; 

}catch(Exception $e){
    $_SESSION["msg"] = $e->getMessage();
}finally{
    header("Location: ./");
}