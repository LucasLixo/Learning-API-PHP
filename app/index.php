<?php

require_once(dirname(__FILE__) . '/../config/config.php');

function api_request($class, $function, $method = 'GET', $variables = [], $user = null, $pass = null)
{
    // Inicia o cURL
    $ch = curl_init();

    // Configura as opções do cURL

    // return the result as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Define a URL
    $ch_url = PROJECT_API;

    // Define a requisição como GET / POST
    switch ($method) {
        // if request is GET
        case 'GET':
            curl_setopt($ch, CURLOPT_HTTPGET,  true);
            $ch_url .= '?';
            $ch_url .= http_build_query(array(
                'class' => $class,
                'function' => $function,
            ));
            if(!empty($variables)){
                $ch_url .= '&' . http_build_query($variables, 'OPTION_', '&');
            }
            break;
        // if request if POST
        case 'POST':
            curl_setopt($ch, CURLOPT_POST,  true);
            $variables = array_merge([
                'class' => $class,
                'function' => $function,
            ], $variables);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $variables);
            break;
        default:
            return false;
    }

    // return $ch_url;
    curl_setopt($ch, CURLOPT_URL, $ch_url);

    // Define Headers
    $ch_headers = array(
        'Content-type: charset=UTF-8', // application/json - text/plain; 
        // 'Content-length: 100',
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER,  $ch_headers);
    
    // Autenticação
    if (isset($user) && isset($pass)) {
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
    }
    // Ignora a verificação do certificado SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Versão do HTTP
    curl_setopt($ch, CURLOPT_HTTP_VERSION,  CURL_HTTP_VERSION_2_0);
    // Define o protocolo 
    curl_setopt($ch, CURLOPT_PROTOCOLS,  CURLPROTO_HTTP);
    // Define em milisegundos tempo maximo para a execução 
    curl_setopt($ch, CURLOPT_TIMEOUT_MS,  6000);

    // Resposta da solicitação
    $ch_response = curl_exec($ch);

    // Fecha o cURL
    curl_close($ch);

    if (curl_errno($ch)) {
        $erro = 'Erro cURL: ' . curl_error($ch);
    } else {
        $erro = null;
    }

    // Retorna o resultado
    return array(
        'require' => array(
            'url' => $ch_url,
            'class' => $class,
            'function' => $function,
            'method' => $method,
            'data' => $variables,
            'user' => $user,
            'pass' => $pass,
            'erro' => $erro
        ),
        'response' => json_decode($ch_response, true),
    );
}

?>