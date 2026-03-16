<?php

require_once(dirname(__FILE__) . '/../config/config.php');

function api_request(string $class, string $function, string $method = 'GET', array $variables = [], string|null $user = null, string|null $pass = null)
{
    // Start cURL
    $ch = curl_init();

    // Configure cURL options

    // return the result as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Define the URL
    $ch_url = PROJECT_API;

    // Define the request as GET / POST
    switch ($method) {
        // if request is GET
        case 'GET':
            curl_setopt($ch, CURLOPT_HTTPGET,  true);
            $ch_url .= '?';
            $ch_url .= http_build_query(array(
                'class' => $class,
                'function' => $function,
            ));
            if (!empty($variables)) {
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
            throw new Exception("Error Processing Request", 1);
    }

    // return $ch_url;
    curl_setopt($ch, CURLOPT_URL, $ch_url);

    // Define Headers
    $ch_headers = array(
        'Content-type: charset=' . CHARSET, // application/json - text/plain;
        // 'Content-length: 100',
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER,  $ch_headers);

    // Authentication
    if (isset($user) && isset($pass)) {
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
    }
    // Skip SSL certificate check
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // HTTP version
    curl_setopt($ch, CURLOPT_HTTP_VERSION,  CURL_HTTP_VERSION_2_0);
    // Defines the protocol
    curl_setopt($ch, CURLOPT_PROTOCOLS,  CURLPROTO_HTTP);
    // Defines maximum execution time in milliseconds
    curl_setopt($ch, CURLOPT_TIMEOUT_MS,  6000);

    // Request response
    $ch_response = curl_exec($ch);

    // Close cURL
    curl_close($ch);

    if (curl_errno($ch)) {
        $erro = 'Erro cURL: ' . curl_error($ch);
    } else {
        $erro = null;
    }

    // Returns the result
    // return array(
    // 'require' => array(
    // 'url' => $ch_url,
    // 'class' => $class,
    // 'function' => $function,
    // 'method' => $method,
    // 'data' => $variables,
    // 'user' => $user,
    // 'pass' => $pass,
    // 'error' => $error
    // ),
    // 'response' => json_decode($ch_response, true),
    // );
    return $erro ?? $ch_response;
}

?>