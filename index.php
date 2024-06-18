<?php

require_once(dirname(__FILE__) . '/config/config.php');
require_once(dirname(__FILE__) . '/app/index.php');

header("Content-Type:application/json");
echo api_request('init', 'clients', 'GET');
die(1);

?>