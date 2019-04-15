<?php
/**
 * Created by PhpStorm.
 * User: damai
 * Date: 2019/4/9
 * Time: 10:15
 */

function createKeys($length = 2048, $type = OPENSSL_KEYTYPE_RSA)
{

    $config = array(
        "digest_alg" => "sha512",
        "private_key_bits" => $length,           //字节数  512 1024 2048  4096 等 ,不能加引号，此处长度与加密的字符串长度有关系，可以自己测试一下
        "private_key_type" => $type,   //加密类型
        "config" => 'D:/PHPTutorial/Apache/conf/openssl.cnf'
    );
    $res = openssl_pkey_new($config);

//提取私钥
    openssl_pkey_export($res, $private_key, null, $config);

//生成公钥
    $public_key = openssl_pkey_get_details($res);
// var_dump($public_key);

    $public_key = $public_key["key"];

//显示数据
    return ['private_key' => $private_key, 'public_key' => $public_key];

}