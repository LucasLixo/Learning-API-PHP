<?php

require_once(dirname(__FILE__) . '/config/config.php');
require_once(dirname(__FILE__) . '/app/index.php');

echo require_api('init', 'status', 'POST', array(true, 15));

?>