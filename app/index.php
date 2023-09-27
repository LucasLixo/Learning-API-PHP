<?php

require_once(dirname(__FILE__) . '/../config/config.php');

function require_api($class, $function, $method = 'GET', $data = [], $user = null, $pass = null)
{
    // Inicia o cURL
    $ch = curl_init();

    // Configura as opções do cURL

    // Define a requisição como GET / POST
    switch ($method) {
        case 'GET':
            curl_setopt($ch, CURLOPT_HTTPGET,  true);
            break;
        case 'POST':
            curl_setopt($ch, CURLOPT_POST,  true);
            break;
        default:
            return false;
    }

    // Define a URL
    $ch_url = PROJECT_API;
    $ch_url .= '?';
    $ch_url .= http_build_query(array(
        'class' => $class,
        'function' => $function,
        'data' => $data,
    ), 'VARIABLE_', '&');
    curl_setopt($ch, CURLOPT_URL, $ch_url);
    return $ch_url;

    // Define Headers
    $ch_headers = array(
        'Content-type: charset=UTF-8', // application/json - text/plain; 
        'Content-length: 100',
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER,  $ch_headers);
    
    // Autenticação
    if (isset($user) && isset($pass)) {
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERNAME,  $user);
        curl_setopt($ch, CURLOPT_PASSWORD,  $pass);
    }
    // Retorna a resposta como uma string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Ignora a verificação do certificado SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Versão do HTTP
    curl_setopt($ch, CURLOPT_HTTP_VERSION,  CURL_HTTP_VERSION_1_0);
    // Define porta alternativa
    curl_setopt($ch, CURLOPT_PORT,  8080);
    // Define o protocolo 
    curl_setopt($ch, CURLOPT_PROTOCOLS,  CURLPROTO_HTTP);
    // Define em milisegundos tempo maximo para a execução 
    curl_setopt($ch, CURLOPT_TIMEOUT_MS,  6000);

    // Resposta da solicitação
    $ch_response = curl_exec($ch);

    // Fecha o cURL
    curl_close($ch);

    // Retorna o resultado
    return array('results' => $ch_response);
}

?>