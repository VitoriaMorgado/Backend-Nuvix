<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php"; // Ajustado o caminho para ../verificar-autenticacao.php

// Variável para a pasta de imagens (pode ser ajustada)
$diretorio_imagens = "imagens/"; 


/**
 * Função auxiliar para gerenciar o upload de arquivos.
 * @param string $fileKey A chave do arquivo em $_FILES (ex: 'imagem').
 * @param string $currentKey O nome do campo da imagem atual em $_POST (ex: 'current_imagem').
 * @param string $uploadDir O diretório de upload (ex: 'imagens/').
 * @return string O nome do arquivo a ser salvo no banco de dados.
 */
function processar_upload($fileKey, $currentKey, $uploadDir) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]["name"] != "") {
        $extensao = pathinfo($_FILES[$fileKey]["name"], PATHINFO_EXTENSION);
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        
        // Mover o novo arquivo
        move_uploaded_file($_FILES[$fileKey]["tmp_name"], $uploadDir . $novo_nome);

        // Se existir uma imagem antiga, deletar
        if (isset($_POST[$currentKey]) && $_POST[$currentKey] != "") {
            // UNLINK = DELETAR ARQUIVOS. Ajuste o caminho da exclusão para onde estão as imagens
            if (file_exists($uploadDir . $_POST[$currentKey])) {
                unlink($uploadDir . $_POST[$currentKey]);
            }
        }
        return $novo_nome;
    } else {
        // Se não foi enviado um novo arquivo, retorna o nome do arquivo atual
        return isset($_POST[$currentKey]) ? $_POST[$currentKey] : "";
    }
}


try{
    if(!$_POST){
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    // 1. PROCESSAMENTO DAS IMAGENS MULTIPLAS
    // Cada imagem é tratada separadamente para upload/substituição
    $_POST["imagem"] = processar_upload("imagem", "current_imagem", $diretorio_imagens);
    $_POST["imagencapa"] = processar_upload("imagencapa", "current_imagencapa", $diretorio_imagens);
    $_POST["imagembanner"] = processar_upload("imagembanner", "current_imagembanner", $diretorio_imagens);
    
    // Imagens Exemplo (loop)
    for ($i = 1; $i <= 3; $i++) {
        $field = "imagemexemplo$i";
        $currentField = "current_$field";
        $_POST[$field] = processar_upload($field, $currentField, $diretorio_imagens);
    }
    
    // 2. MONTAGEM DOS DADOS PARA REQUISIÇÃO
    // Mapeamento dos campos do formulário (formulario.php) para a requisição da API
    $id_jogo = isset($_POST["id_jogo"]) ? $_POST["id_jogo"] : ""; 

    $postifield = array(
        "nome" => $_POST["nome_jogo"], // Campo alterado: nome_jogo -> nome
        "descricao" => $_POST["descricao"],
        "preco" => str_replace(',', '.', str_replace('.', '', $_POST["preco"])), // Conversão de R$ para formato float (ex: 1.234,56 -> 1234.56)
        "empresa_game" => $_POST["empresa_game"],
        "codigo_game" => $_POST["codigo_game"],
        "classificacao" => $_POST["classificacao"],
        "avaliacao" => $_POST["avaliacao"],
        "categorias" => $_POST["categorias"],
        // Campos de imagem
        "imagem" => $_POST["imagem"],
        "imagencapa" => $_POST["imagencapa"],
        "imagembanner" => $_POST["imagembanner"],
        "imagemexemplo1" => $_POST["imagemexemplo1"],
        "imagemexemplo2" => $_POST["imagemexemplo2"],
        "imagemexemplo3" => $_POST["imagemexemplo3"],
    );

    $msg = '';
    // 3. VERIFICAÇÃO DE INSERÇÃO OU EDIÇÃO
    if ($id_jogo == "") {
        // Inserção (POST)
        require("../requests/jogos/post.php"); 
        
    } else {
        // Edição (PUT)
        $postifield["id_jogo"] = $id_jogo; // Adiciona o ID para a edição
        require("../requests/jogos/put.php");
    }
    
    // 4. TRATAMENTO DA RESPOSTA
    $msg = isset($response["message"]) ? $response["message"] : "Operação realizada com sucesso.";
    $_SESSION["msg"] = $msg; 

}catch(Exception $e){
    $_SESSION["msg"] = $e->getMessage();
}finally{
    // Redireciona para a listagem (index.php na pasta atual)
    header("Location: ./"); 
    exit;
}
?>