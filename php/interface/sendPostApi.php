<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();
header("Content-Type: application/json;charset=utf-8");
function send_post($url, $post_data){ // 模拟提交数据函数
    $sendURL=$url;
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_URL, $sendURL); // 要访问的地址
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data)); // Post提交的数据包
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 是否对认证证书来源的检查
//    if(isset($_SESSION["jseSessionId"]))
//    {
        curl_setopt($curl, CURLOPT_HEADER, 1);
//    }
    curl_setopt($curl, CURLOPT_COOKIE, $_SESSION["jseSessionId"]);
    $tmpInfo = curl_exec($curl);   //执行操作
    curl_close($curl);   // 关键CURL会话
    list($header, $body) = explode("\r\n\r\n", $tmpInfo);
    preg_match("/set\-cookie:([^\r\n]*)/i", $header, $matches);
    $matches=explode(' ',$matches[1]);
    $matches = $matches[1].' '.$matches[2].' '.$matches[3];
    if(strlen($matches)>2)
    {
        $_SESSION["jseSessionId"]=$matches;
    }
    echo $body;
    return json_decode($body);
}
?>