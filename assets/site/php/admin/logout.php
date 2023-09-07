<?php 
session_start();
session_unset();
session_destroy();
//echo "OK now you logout";
$url = '../../../../index.html';
header('Location: '.$url);
?>