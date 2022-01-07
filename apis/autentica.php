<?php
header('Access-Control-Allow-Origin: *');
require_once('../vendasConnect.php');
$manter = file_get_contents('php://input');
$usuario = $_SERVER['PHP_AUTH_USER'];
$senha = md5($_SERVER['PHP_AUTH_PW']);
$sql = @mysqli_query($MySQLiVendas, "SELECT * FROM empresas WHERE usuario = '{$usuario}' AND senha = '{$senha}' LIMIT 1 ") or die (mysqli_error($MySQLiVendas));
$valida = mysqli_fetch_assoc($sql);
if(empty($valida)){
    header('HTTP/1.0 401 Unauthorized');
    echo 'E-mail ou senha inválido!';
}else{
    if(!isset($_SESSION))   { 
        session_start(); 
    }
    $_SESSION['lojadeaplicativo'] = [$valida['id'], $senha];
    //abc 123
    echo 1;
}
@mysqli_close($MySQLiVendas) or die (mysqli_error($MySQLiVendas));
