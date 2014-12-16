<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - genRndDgt()
* - genRndSalt()
* - encryptUserPwd()
* Classes list:
* - Encrypt_Model extends CI_Model
*/
class Encrypt_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Generate Random Digit
    public function genRndDgt($length = 8, $specialCharacters = true)
    {
        $digits = '';
        $chars  = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";

        if ($specialCharacters === true) $chars .= "!?=/&+,.";

        for ($i = 0; $i < $length; $i++)
        {
            $x       = mt_rand(0, strlen($chars) -1);
            $digits .= $chars{$x};
        }

        return $digits;
    }

    // Generate Random Salt for Password encryption
    public function genRndSalt()
    {
        return $this->genRndDgt(8, true);
    }

    // Encrypt User Password
    public function encryptUserPwd($pwd, $salt)
    {
        return sha1(md5($pwd) . $salt);
    }

}
?>
