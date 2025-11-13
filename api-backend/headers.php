<?php
// Conecta-se ao banco de dados
require_once 'conn.php';

// Define as configurações de cabeçalho para permitir o acesso à API
header('Access-Control-Allow-Origin: *'); // Permite acesso de qualquer origem
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Permite métodos HTTP específicos
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Permite cabeçalhos específicos
header('Access-Control-Allow-Credentials: true'); // Permite o envio de cookies e credenciais
header('Content-Type: application/json; charset=utf-8'); // Define o tipo de conteúdo como JSON

// Define uma constante com o método HTTP da requisição
define('method', $_SERVER['REQUEST_METHOD']);

// Recupera informações do cabeçalho da requisição
$server = apache_request_headers();
// Recupero o token de autorização do cabeçalho
$token = $server['Authorization'] ?? null;
// Obtém o token de autorização, se presente

//Se a requisição for OPTIONS, retorna a resposts 200
if (method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// //VERIFICA SE O TOKEN DE AUTORIZAÇÃO ESTÁ PRESENTE
if ($token === null) {
    http_response_code(401); // CODIGO DE ERRO 401 - NÃO AUTORIZADO
    $result = array(
        'status' => 'error',
        'message' => 'NECESSARIO UM TOKEN DE AUTORIZAÇÃO'
    );
    echo json_encode($result);
    exit;
} else {
    //MONTA UMA SINTAXE SQL PARA BUSCAR O TOKEN NO BANCO DE DADOS
    $sql = "
        SELECT cliente, validade, status
        FROM token
        WHERE token like :token 
    ";
}
    //PREPARA A SINTAXE SQL
    $stmt = $conn->prepare($sql);
 
    //VINCULA O PARÂMETRO :token COM O VALOR DA VARIÁVEL $token
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
 
    //EXECUTA A SINTAXE SQL
    $stmt->execute();
 
    //OBTEM OS DADOS DO BANCO DE DADOS COMO OBJETO
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
 
    //VERIFICA SE O RESULTADO DA PESQUISA É VAZIO
    if (empty($data)) {
        http_response_code(401); // CODIGO DE ERRO 401 - NÃO AUTORIZADO
        $result = array(
            'status' => 'error',
            'message' => 'INEXISTENTE'
        );
        echo json_encode($result);
        exit;
    } else {
        //VERIFICA SE O TOKEN ESTÁ INATIVO OU EXPIRADO
        if ($data[0]->status == 0) {
            http_response_code(401); // CODIGO DE ERRO 401 - NÃO AUTORIZADO
 
            //VERIFICA SE A DATA DE VALIDADE DO TOKEN É MENOR QUE A DATA ATUAL (OU SEJA VERIFICA SE ELE NAO ESTÁ EXPIRADO)
            $result = array(
                'status' => 'error',
                'message' => 'TOKEN INATIVO '
            );
        echo json_encode($result);
            exit;
        } elseif (strtotime($data[0]->validade) < strtotime(date('Y-m-d'))) {
            http_response_code(401); // CODIGO DE ERRO 401 - NÃO AUTORIZADO
            $result = array(
                'status' => 'error',
                'message' => 'TOKEN EXPIRADO'
            );
            echo json_encode($result);
            exit;
        }
    }
 