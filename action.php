<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();
$_SESSION["from"]="weChat";
header("location:index.php");
?>