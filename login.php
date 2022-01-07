<?php
    if(!isset($_SESSION))   { 
        session_start(); 
    }
require_once('vendasConnect.php');
$valida = @mysqli_query($MySQLiVendas, "SELECT id_empresa, 	usuario, privilegio FROM empresas WHERE id = '{$_SESSION['lojadeaplicativo'][0]}' AND senha = '{$_SESSION['lojadeaplicativo'][1]}' LIMIT 1 ") or die (mysqli_error($MySQLiVendas));
$valida = mysqli_fetch_assoc($valida);
    if (!empty($valida)) {    
        header("location: index.php");
    }
    header("Cache-Control: no-cache, no-store, must-revalidate"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    #echo md5("csgnusyel1a1");
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="viewport" content="width=device-width" />
        <link rel="shortcut icon" type="imagex/png" href="src/img/logo_efeito_re9_painel.png">
        <link href="src/style/themesbe4b.css?v3" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert@2/dist/sweetalert.min.js"></script>
    </head>
    <body class="hold-transition login-page">        
        <div class="login-box">
            <div class="login-logo">
                <a href="#!">
                    <img src="src/img/logo_efeito_re9_painel.png" width="250" alt="re9">
                </a>
            </div>
            <div class="login-box-body">
                <form  class="" method="post">                    
                    <div class="form-group has-feedback">
                        <label for="Usuario">Usu&#225;rios</label>
                        <input class="form-control" data-val="true" data-val-required="O campo Usuários é obrigatório." id="Usuario" name="Usuario" placeholder="Digite o usuario" type="text" value="" />
                        <span class="fas fa-user form-control-feedback"></span>
                        <span class="field-validation-valid" data-valmsg-for="Usuario" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="Senha">Senha</label>
                        <input autocomplete="on" class="form-control" data-val="true" data-val-required="O campo Senha é obrigatório." id="Senha" name="Senha" placeholder="Digite a senha" type="password" />
                        <span class="fas fa-lock form-control-feedback"></span>
                        <span class="field-validation-valid" data-valmsg-for="Senha" data-valmsg-replace="true"></span>
                    </div>    
                        
                    <div class="row">
                        <div class="col-xs-8">
                            </div>
                            <div class="col-xs-4">
                                <button type="button"  class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                    </div>
                </form>    
            </div>
        </div>
        <script src="src/script/login.js"></script>
        <?php
        if (isset($_GET['NO-ALLOW'])) {?>
        <script>
            swal("Erro!","Acesso Negado!","error");
        </script>
        <?php } ?>
    </body>
</html>