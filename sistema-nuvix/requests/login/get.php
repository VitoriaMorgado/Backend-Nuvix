<?php

// INICIAR SESSÃO GLOBAL
$curl = curl_init();
// CONFIGURAR O CURL
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://10.63.45.33:8080/administradores/?email=$email&senha=$senha",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        //NOSSO TOKEN JÁ CADASTRADO
        'Authorization: 7110eda4d09e062aa5e4a390b0a572ac0d2c0220'
    ),
));
// RECUPERA O RETORNO DO CURL
$response = curl_exec($curl);
// ENCERRAR O CURL
curl_close($curl);

if(empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}