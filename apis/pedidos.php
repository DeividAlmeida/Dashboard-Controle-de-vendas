<?php
header('Access-Control-Allow-Origin: *');
 require_once('../vendasConnect.php');
 $manter = file_get_contents('php://input');
 $id_user = $_SERVER['PHP_AUTH_USER'];
 $senha = $_SERVER['PHP_AUTH_PW'];
 $empresa = @mysqli_query($MySQLiVendas, "SELECT * FROM empresas WHERE id = '{$id_user}' AND senha = '{$senha}' LIMIT 1 ") or die (mysqli_error($MySQLiVendas));
 $empresa = mysqli_fetch_assoc($empresa);
 if(empty($empresa)){
     die();
 }

 $pedidos = @mysqli_query($MySQLiVendas, "SELECT * FROM pedidos_re9vendas WHERE base = '{$empresa['url']}'  ORDER BY id DESC ") or die (mysqli_error($MySQLiVendas));
 $itens = @mysqli_query($MySQLiVendas, "SELECT * FROM itens_pedidos_re9vendas") or die (mysqli_error($MySQLiVendas));

 $pedidos = mysqli_fetch_all($pedidos);
 $itens = mysqli_fetch_all($itens);
 
 $view = [];
 foreach ($pedidos as $key => $value) {
    $vendedor = @mysqli_query($MySQLiVendas, "SELECT * FROM usuarios WHERE id_vendedor = '{$value[11]}' ") or die (mysqli_error($MySQLiVendas));
    $vendedor = mysqli_fetch_assoc($vendedor);
    if($vendedor['empresa_id'] ==  $id_user ){
        $createDate = new DateTime($value[3]);
        $view[$key]['id'] = $value[0];
        $view[$key]['valor'] = $value[2];
        $view[$key]['cod_cliente'] = $value[4];
        $view[$key]['cliente'] = $value[7];
        $view[$key]['emissao'] = $createDate->format('d/m/Y');
        $view[$key]['filial'] = $value[13];
        $view[$key]['cnpj'] = $value[8];
        $view[$key]['cidade'] = $value[9];
        $view[$key]['estado'] = $value[10];
        $view[$key]['nome_representante'] = $value[12];
        $view[$key]['detalhes'] = [];
        $id = 0;
        foreach ($itens as $chave => $valor) {
            if ($valor[1] == $value[0]) {
                $view[$key]['detalhes'][$id]['id'] = $valor[0];
                $view[$key]['detalhes'][$id]['idpedido'] = $valor[1];
                $view[$key]['detalhes'][$id]['produto'] = $valor[4];
                $view[$key]['detalhes'][$id]['cod_produto'] = $valor[3];
                $view[$key]['detalhes'][$id]['valor'] = $valor[5];
                $view[$key]['detalhes'][$id]['quantidade'] = $valor[6];
                $id++;
            }
        }
    }     
 }
 echo json_encode(array_values($view));

 @mysqli_close($MySQLiVendas) or die (mysqli_error($MySQLiVendas));