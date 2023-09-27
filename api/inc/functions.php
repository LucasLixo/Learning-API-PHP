<?php

require_once(dirname(__FILE__) . '/../../config/config.php');

class functions
{
    // ============================================================
    // FUNCTIONS
    // ============================================================
    private $key = AES_KEY;
    private $iv = AES_IV;
    // ============================================================
    public function __AesEncrypt($string)
    {

        // ENCRYPT STRING
        return bin2hex(openssl_encrypt($string, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $this->iv));
    }
    // ============================================================
    public function __AesDecrypt($string)
    {

        if (strlen($string) % 2 != 0) {
            return -1;
        }

        // DECRYPT STRING
        return openssl_decrypt(hex2bin($string), 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $this->iv);
    }

    // ============================================================
    public function __GeneratorHash($length = PURL)
    {
        $Chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $CharsLength = strlen($Chars);
        $Hash = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $CharsLength - 1);
            $Hash .= $Chars[$randomIndex];
        }

        return $Hash;
    }

}

?>