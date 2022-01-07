<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
header('Access-Control-Allow-Origin: *');
unset($_SESSION['lojadeaplicativo']);
header("location: https://www.lojadeaplicativo.com/acesso/login.php");
exit();
