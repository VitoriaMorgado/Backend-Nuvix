<?php
// Certifique-se de que a conexão $conn está definida antes deste script

header('Content-Type: application/json; charset=utf-8');

try {
    // Inicializa variáveis
    $result = [];
    $stmt = null;

    // Verifica se há um ID na URL para consulta específica
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];

        $sql = "
            SELECT * 
            FROM users
            WHERE id_user = :id
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
} elseif (isset($_GET["email"]) && is_string($_GET["email"]) &&
    isset($_GET["senha"]) && is_string($_GET["senha"])) {
    $email = trim($_GET["email"]);
    $senha = sha1(trim($_GET["senha"]));

    $sql = "
        SELECT * 
        FROM users
        WHERE email = :email
        AND senha = :senha
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
} elseif (isset($_GET["nome"]) && is_string($_GET["nome"])) {
        $nome = $_GET["nome"];

        $sql = "
            SELECT * 
            FROM users
            WHERE nome LIKE :nome
            ORDER BY nome
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);
    }
    else {
        $sql = "
            SELECT * 
            FROM users
            ORDER BY nome
        ";
        $stmt = $conn->prepare($sql);
    }

    // Executar a sintaxe SQL
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Se for consulta de usuários (login), não processa endereço
    if (
        isset($_GET["email"]) && is_string($_GET["email"]) &&
        isset($_GET["senha"]) && is_string($_GET["senha"])
    ) {
        if (empty($data)) {
            http_response_code(204);
            exit;
        } else {
            $result = [
                'status' => 'success',
                'message' => 'Data found',
                'data' => $data
            ];
        }
    } else {
        // Processa endereço apenas para clientes
        if (empty($data)) {
            http_response_code(204);
            exit;
        } else {
            $users = [];
            foreach ($data as $user) {
                $users[] = [
                    'id_user' => $user->id_user,
                    'nome' => $user->nome,
                    'email' => $user->email,
                    'telefone' => $user->telefone,
                    // Adicione outros campos conforme necessário
                ];
            }

            $result = [
                'status' => 'success',
                'message' => 'Data found',
                'data' => $users
            ];
        }
        
    }
} catch (Exception $e) {
    $result = [
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ];
} finally {
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $conn = null;
}