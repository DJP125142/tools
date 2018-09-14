<?php

include_once "wxBizDataCrypt.php";


$appid = '';
$sessionKey = '';

$encryptedData="";

$iv = 'r7BXXKkLb8qrSNn05n0qiA==';

$pc = new WXBizDataCrypt($appid, $sessionKey);
$errCode = $pc->decryptData($encryptedData, $iv, $data );

if ($errCode == 0) {
    print($data . "\n");
} else {
    print($errCode . "\n");
}
