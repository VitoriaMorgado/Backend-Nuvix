<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if(!empty($postfields)) {
        $nome = $postfields['nome'] ?? null;
        $email = $postfields['email'] ?? null;
        $senha = sha1($postfields['senha']) ?? null;
        $data_emissao = $postfields['data_emissao'] ?? null;
        $data_nascimento = $postfields['data_nascimento'] ?? null;
        $imagem = $postfields['imagem'] ?? null;
        $telefone = $postfields['telefone'] ?? null;
        

        // Verifica campos obrigatórios
        if (empty($email) || empty($senha)) {
            http_response_code(400);
            throw new Exception('Nome e Endereço são obrigatórios');
        }

        $sql = "
        INSERT INTO users (nome, email, senha, data_emissao, data_nascimento, imagem, telefone) VALUES 
        (
            :nome, 
            :email,
            :senha,
            :data_emissao,
            :data_nascimento,
            :imagem,
            :telefone
           
        )";

        $stmt = $conn->prepare($sql);
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
            'message' => 'User cadastrado com sucesso!'
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