<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $nome = $postfields['nome'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $empresa_game = $postfields['empresa_game'] ?? null;
        $codigo_game = $postfields['codigo_game'] ?? null;
        $imagem = $postfields['imagem'] ?? null;
        $imagemcapa = $postfields['imagemcapa'] ?? null;
        $imagembanner = $postfields['imagembanner'] ?? null;
        $imagemexemplo1 = $postfields['imagemexemplo1'] ?? null;
        $imagemexemplo2 = $postfields['imagemexemplo2'] ?? null;
        $imagemexemplo3 = $postfields['imagemexemplo3'] ?? null;
        $categorias = $postfields['categorias'] ?? null;
        $classificacao = $postfields['classificacao'] ?? null;
        $avaliacao = $postfields['avaliacao'] ?? null;
        


        // Verifica campos obrigatórios
        if (empty($nome)) {
            http_response_code(400);
            throw new Exception('Nome do Jogo é Obrigatorio');
        }

        $sql = "
        INSERT INTO jogos (nome, descricao, preco, empresa_game, codigo_game, imagem , imagemcapa, imagembanner, imagemexemplo1 , imagemexemplo2, imagemexemplo3 , categorias, classificacao, avaliacao ) VALUES 
        (
            :nome,
            :descricao,
            :preco,
            :empresa_game,
            :codigo_game,
            :imagem,
            :imagemcapa,
            :imagembanner,
            :imagemexemplo1,
            :imagemexemplo2,
            :imagemexemplo3,
            :categorias,
            :classificacao,
            :avaliacao
            
        )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, is_null($descricao) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, is_null($preco) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':empresa_game', $empresa_game, is_null($empresa_game) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':codigo_game', $codigo_game, is_null($codigo_game) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagem, is_null($imagem) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagemcapa', $imagemcapa, is_null($imagemcapa) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagembanner', $imagembanner, is_null($imagembanner) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagemexemplo1', $imagemexemplo1, is_null($imagemexemplo1) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagemexemplo2', $imagemexemplo2, is_null($imagemexemplo2) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagemexemplo3', $imagemexemplo3, is_null($imagemexemplo3) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':categorias', $categoria, is_null($categorias) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':classificacao', $classificacao, is_null($classificacao) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':avaliacao', $avaliacao, is_null($avaliacao) ? PDO::PARAM_NULL : PDO::PARAM_STR);



        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Este Jogo Foi Cadastrado Com Sucesso!'
        );


    } else {
        http_response_code(400);
        // Se não existir dados, retornar erro
        throw new Exception('Os Dados Deste Jogo Não Pode Ser Enviado!');
    }

} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage(),
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}