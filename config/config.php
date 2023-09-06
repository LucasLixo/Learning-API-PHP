<?php

try {

    // ============================================================
    // CONFIG .json
    // ============================================================
    $json_file = dirname(__FILE__) . '/config.json';

    if (!file_exists($json_file)) {
        throw new Exception("Configuration file not found: $json_file");
    }

    if (!is_readable($json_file)) {
        throw new Exception("Unable to read config file: $json_file");
    }

    $json = file_get_contents($json_file);
    if ($json === false) {
        throw new Exception("Error reading configuration file: $json_file");
    }

    $config = json_decode($json, false);
    if ($config === null) {
        throw new Exception("Error parsing configuration file: $json_file");
    }

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error parsing configuration file: $json_file");
    }

    $Json = $config->Config;

    // ============================================================
    // DEFINE .json
    // ============================================================
    // CRYPT
    define('AES_KEY',                   $Json->Crypt->AesKey);
    define('AES_IV',                    $Json->Crypt->AesIv);
    
    // REFFERER
    define('RefPrimary',                $Json->Get->Referrer[0]);
    define('RefSecundary',              $Json->Get->Referrer[1]);
    define('RefTertiarty',              $Json->Get->Referrer[2]);
    define('RefFourth',                 $Json->Get->Referrer[3]);

    // REQUIRE
    define('ReqPrimary',                $Json->Get->Require[0]);

    // ============================================================
    // PROJECT
    // ============================================================
    define('PROJECT_NAME',              'Data Manage');
    define('PROJECT_VERSION',           '1.8.7');
    define('PROJECT_HTTP',              'http://localhost/php-api/public/index.php');

    // ============================================================
    // CONFIG CLASS
    // ============================================================
    define('PURL',                      24);
    define('TOKEN',                     32);
    define('CHARSET',                   'UTF8');

    // ============================================================
    // EMAIL
    // ============================================================
    define('EMAIL_HOST',                'smtp.gmail.com');
    define('EMAIL_FROM',                'responseconfirm2891471@gmail.com');
    define('EMAIL_PASS',                'ezbgkimvfiolrizn');
    define('EMAIL_PORT',                465);

    // ============================================================
    // DATABASE
    // ============================================================
    define('DB_SERVER',                 'localhost');
    define('DB_NAME',                   'clientes');
    define('DB_CHARSET',                CHARSET);    
    define('DB_USERNAME',               'usuario');
    define('DB_PASSWORD',               'L4VA22WO8oQizO68kAj16ET234Bu6u');

    // ============================================================
    // TIME (in SECONDS)
    // ============================================================
    define('__MINUTE',                  60);
    define('__HOUR',                    60 * 60);
    define('__DAY',                     60 * 60 * 24);
    define('__WEEK',                    60 * 60 * 24 * 7);
    define('__MONTH',                   60 * 60 * 24 * 30);
    define('__YEAR',                    60 * 60 * 24 * 30 * 365);

} catch (Exception $e) {
    header('HTTP/1.0 404');
    // $e->getMessage();
    die;
}

?>