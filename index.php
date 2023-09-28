<?php

require_once(dirname(__FILE__) . '/config/config.php');
require_once(dirname(__FILE__) . '/app/index.php');

// echo api_request('init', 'status', 'POST', array(
//     'force' => true,
//     'number' => 15,
// ));
echo '<pre>';
print_r(api_request('init', 'status', 'GET', array(
    'force' => true,
    'number' => 15,
)));
echo '</pre>';

?>