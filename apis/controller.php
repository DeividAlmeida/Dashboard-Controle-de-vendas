<?php
if(!isset($_SESSION))   { 
    session_start(); 
}
header('Access-Control-Allow-Origin: *');
require_once('../vendasConnect.php');
$body = file_get_contents('php://input');
$usuario = $_SERVER['PHP_AUTH_USER'];
$senha = $_SERVER['PHP_AUTH_PW'];
$sql = @mysqli_query($MySQLiVendas, "SELECT * FROM empresas WHERE id = '{$_SERVER['PHP_AUTH_USER']}' AND senha = '{$_SERVER['PHP_AUTH_PW']}'") or die (mysqli_error($MySQLiVendas));
$valida = mysqli_fetch_assoc($sql);
if(empty($valida)){
    die();
}
$target_dir = "../uploads/";
$file_name = md5(uniqid(rand(), true)).'.jpg';
$target_file = $target_dir.$file_name;
if(!empty($_FILES['logo']['name'])){ 
    move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file); 
    $_POST['logo']=$file_name;
}else {
    unset($_POST['logo']);
}

if(isset($_GET['createEmpresa']) && $valida['privilegio'] == 1 ){
        $_POST['senha'] = md5($_POST['senha']);
      $campos = implode(', ', array_keys($_POST));
      $values = "'".implode("', '", $_POST)."'";  
     if(@mysqli_query($MySQLiVendas, "INSERT INTO empresas ({$campos}) VALUES ({$values})")){
          $empresa = @mysqli_query($MySQLiVendas, "SELECT id, nome, url, id_empresa, id_filial, estoque_negativo, tipo_politica_desconto, endereco, cidade, estado, telefone, site, email, logo, nome_logo, cnpj_cpf, usuario  FROM empresas") or die (mysqli_error($MySQLiVendas));
          $empresa = mysqli_fetch_all($empresa, MYSQLI_ASSOC);
          echo json_encode($empresa);
     }else{
          die (mysqli_error($MySQLiVendas));
     } 
}
if(isset($_GET['createUsuario']) ){
    $campos = implode(', ', array_keys($_POST));
    $values = "'".implode("', '", $_POST)."'";
    if(@mysqli_query($MySQLiVendas, "INSERT INTO usuarios ({$campos}) VALUES ({$values})")){
        if ($valida['privilegio'] == 1) {
            $newUsuarios = @mysqli_query($MySQLiVendas, "SELECT * FROM usuarios ORDER BY  created_at ASC") or die (mysqli_error($MySQLiVendas));
            $newUsuarios = mysqli_fetch_all($newUsuarios);
        }else{
            $newUsuarios = @mysqli_query($MySQLiVendas, "SELECT * FROM usuarios WHERE empresa_id = '{$_POST['empresa_id']}' ORDER BY  created_at ASC") or die (mysqli_error($MySQLiVendas));
            $newUsuarios = mysqli_fetch_all($newUsuarios);
        }
        echo json_encode($newUsuarios);
    }else{
        die (mysqli_error($MySQLiVendas));
    } 
}
if(isset($_GET['removeEmpresa']) && $valida['privilegio'] == 1){
    if(@mysqli_query($MySQLiVendas, "DELETE FROM empresas WHERE id = '{$_GET['removeEmpresa']}'")){
        echo 1;
    }else{
        die (mysqli_error($MySQLiVendas));
    } 
}
if(isset($_GET['removeUsuario'])){
    if(@mysqli_query($MySQLiVendas, "DELETE FROM usuarios WHERE id_usuario = '{$_GET['removeUsuario']}' ")){
        echo 1;
    }else{
        die (mysqli_error($MySQLiVendas));
    } 
}
if(isset($_GET['editEmpresa'])){
    $_POST['senha'] = md5($_POST['senha']);
    foreach ($_POST as $key => $value) {
        $update[] = "{$key} = '{$value}'";
    } 
    $update = implode(', ', $update);
    if(@mysqli_query($MySQLiVendas, "UPDATE empresas SET {$update} WHERE id = '{$_GET['editEmpresa']}'")){
         if(isset($_POST['senha']) ){                
             $_SESSION['lojadeaplicativo'][1] = $_POST['senha'];
         }                                
        if ($valida['privilegio'] == 1) {
            $empresa = @mysqli_query($MySQLiVendas, "SELECT id, nome, url, id_empresa, id_filial, estoque_negativo, tipo_politica_desconto, endereco, cidade, estado, telefone, site, email, logo, nome_logo, cnpj_cpf, usuario  FROM empresas") or die (mysqli_error($MySQLiVendas));
            $empresa = mysqli_fetch_all($empresa, MYSQLI_ASSOC);
        }else{
            $empresa = @mysqli_query($MySQLiVendas, "SELECT id, nome, url, id_empresa, id_filial, estoque_negativo, tipo_politica_desconto, endereco, cidade, estado, telefone, site, email, logo, nome_logo, cnpj_cpf, usuario  FROM empresas WHERE id = '{$_GET['editEmpresa']}' ") or die (mysqli_error($MySQLiVendas));
            $empresa = mysqli_fetch_assoc($empresa);
        }
        echo json_encode($empresa);       
    }else{
         die (mysqli_error($MySQLiVendas));
 } 
}
if(isset($_GET['editUsuario'])){
    foreach ($_POST as $key => $value) {
        $update[] = "{$key} = '{$value}'";
    } 
    $update = implode(', ', $update);
    if(@mysqli_query($MySQLiVendas, "UPDATE usuarios SET {$update} WHERE id_usuario = '{$_GET['editUsuario']}'")){
        
        $newUsuarios = @mysqli_query($MySQLiVendas, "SELECT *  FROM usuarios WHERE  empresa_id = '{$_POST['empresa_id']}' ORDER BY  created_at ASC") or die (mysqli_error($MySQLiVendas));
        $newUsuarios = mysqli_fetch_all($newUsuarios);
        echo json_encode($newUsuarios);
    }else{
        die (mysqli_error($MySQLiVendas));
    } 
}
@mysqli_close($MySQLiVendas) or die (mysqli_error($MySQLiVendas));

