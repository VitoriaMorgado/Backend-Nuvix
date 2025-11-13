<?php
 
try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $id = $postfields['id_jogo'] ?? null;
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
        if(empty($id)) {
            http_response_code(400);
            throw new Exception('ID Do Jogo é Obrigatório');
        }
        if (empty($nome)) {
            http_response_code(400);
            throw new Exception('Nome do Jogo é Obrigatorio');
        }

        $sql = "
        UPDATE jogos SET
        nome = :nome
        descricao = :descricao,
        preco = :preco,
        empresa_game = :empresa_game,
        codigo_game = :codigo_game,
        imagem = :imagem,
        imagemcapa = :imagemcapa,
        imagembanner = :imagembanner,
        imagemexemplo1 = :imagemexemplo1,
        imagemexemplo2 = :imagemexemplo2,
        imagemexemplo3 = :imagemexemplo3,
        categorias = :categorias,
        classificacao = :classificacao,
        avaliacao = :avaliacao
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':empresa_game', $empresa_game, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_game', $codigo_game, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
        $stmt->bindParam(':imagemcapa', $imagemcapa, PDO::PARAM_STR);
        $stmt->bindParam(':imagembanner', $imagembanner, PDO::PARAM_STR);
        $stmt->bindParam(':imagemexemplo1', $imagemexemplo1, PDO::PARAM_STR);
        $stmt->bindParam(':imagemexemplo2', $imagemexemplo2, PDO::PARAM_STR);
        $stmt->bindParam(':imagemexemplo3', $imagemexemplo3, PDO::PARAM_STR);
        $stmt->bindParam(':categorias', $categorias, PDO::PARAM_STR);
        $stmt->bindParam(':classificacao', $classificacao, PDO::PARAM_STR);
        $stmt->bindParam(':avaliacao', $avaliacao, PDO::PARAM_STR);


        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Jogo Atualizado Com Sucesso!'
        );


    } else {
        http_response_code(400);
        // Se não existir dados, retornar erro
        throw new Exception('Nenhum dado foi enviado!');
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