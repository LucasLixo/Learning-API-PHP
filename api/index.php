<?php

require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/./inc/api_verify.php');

// ===============================================================
// instanciate the api_classe
$api_verify = new api_verify();

// ===============================================================
// check if method is valid
if(!$api_verify->check_method($_SERVER['REQUEST_METHOD']))
{
    // send error reponse
    $api_verify->api_request_error('Invalid request method.');
}

// ===============================================================
// set request method
$api_verify->set_method($_SERVER['REQUEST_METHOD']);
$params = null;
if($api_verify->get_method() == 'GET'){
    $api_verify->set_class($_GET['class']);
    $api_verify->set_function($_GET['function']);
    $params = $_GET;
} elseif($api_verify->get_method() == 'POST'){
    $api_verify->set_class($_POST['class']);
    $api_verify->set_function($_POST['function']);
    $params = $_POST;
}

$request_class_name = $api_verify->get_class();
$request_function = $api_verify->get_function();

if (!file_exists(dirname(__FILE__) . "/class/$request_class_name.php")) {
    $api_verify->api_request_error('Classe não encontrada.');
}

require_once(dirname(__FILE__) . "/class/$request_class_name.php");

// Verifica se a classe existe
if (!class_exists($request_class_name)) {
    $api_verify->api_request_error('Classe não encontrada.');
}

// Instancia a classe
$request_class = new $request_class_name($request_function, $params);

// Verifica se o método existe na classe
if (!$request_class->endpoint_exists()) {
    $api_verify->api_request_error('Método não encontrado.');
}

// Executa o método
$request_results = $request_class->$request_function();

$api_verify->add_data('lenght', count($request_results));
$api_verify->add_data('results', $request_results);

$api_verify->send_response();

?>
