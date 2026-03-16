<?php

require_once(dirname(__FILE__) . '/config/config.php');
require_once(dirname(__FILE__) . '/app/index.php');

session_write_close();
header("Content-Type:application/json");

echo api_request(/* class */'init', /* function */'customers', /* method */'GET', /* variables */[], /* user */'admin', /* pass */'password123');
die(1);

?>