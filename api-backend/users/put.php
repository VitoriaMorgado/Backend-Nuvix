<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $id = $postfields['id_user'];
        $nome = $postfields['nome'] ?? null;
        $email = $postfields['email'] ?? null;
        $senha = sha1($postfields['senha']) ?? null;
        $data_emissao = $postfields['data_emissao'] ?? null;
        $data_nascimento = $postfields['data_nascimento'] ?? null;
        $imagem = $postfields['imagem'] ?? null;
        $telefone = $postfields['telefone'] ?? null;
       

        // Verifica campos obrigatórios
        if(empty($id)) {
            http_response_code(400);
            throw new Exception('ID do cliente é obrigatório');
        }
        if (empty($nome) || empty($postfields['endereco'])) {
            http_response_code(400);
            throw new Exception('Nome e Endereço são obrigatórios');
        }

        $sql = "
        UPDATE clientes SET 
            nome = :nome, 
            email = :email,
            senha = :senha,
            data_emissao = :data_emissao,
            data_nascimento = :data_nascimento,
            imagem = :imagem,
            telefone = :telefone
        WHERE id_user = :id
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, is_null($email) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, is_null($senha) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':data_emissao', $data_emissao, is_null($data_emissao) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':data_nascimento', $data_nascimento, is_null($data_nascimento) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagem, is_null($imagem) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, is_null($telefone) ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'User alterado com sucesso!'
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