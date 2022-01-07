<?php
if(!isset($_SESSION))   { 
    session_start(); 
}
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");
require_once('DBconnect.php');
require_once('vendasConnect.php');
$valida = @mysqli_query($MySQLiVendas, "SELECT id, nome, url, id_empresa, id_filial, estoque_negativo, tipo_politica_desconto, endereco, cidade, estado, telefone, site, email, logo, nome_logo, cnpj_cpf, usuario, privilegio FROM empresas WHERE id = '{$_SESSION['lojadeaplicativo'][0]}' AND senha = '{$_SESSION['lojadeaplicativo'][1]}' LIMIT 1 ") or die (mysqli_error($MySQLiVendas));
$valida = mysqli_fetch_assoc($valida);
if ($valida['privilegio'] == 1) { 
  $empresa = @mysqli_query($MySQLiVendas, "SELECT id, nome, url, id_empresa, id_filial, estoque_negativo, tipo_politica_desconto, endereco, cidade, estado, telefone, site, email, logo, nome_logo, cnpj_cpf, usuario FROM empresas") or die (mysqli_error($MySQLiVendas));
  $empresa = mysqli_fetch_all($empresa, MYSQLI_ASSOC);
  $usuarios = @mysqli_query($MySQLiVendas, "SELECT * FROM usuarios ORDER BY  created_at ASC") or die (mysqli_error($MySQLiVendas));
  $usuarios = mysqli_fetch_all($usuarios);
}else {  
  $empresa = $valida; 
  $usuarios = @mysqli_query($MySQLiVendas, "SELECT * FROM usuarios WHERE empresa_id = '{$valida['id']}' ORDER BY  created_at ASC") or die (mysqli_error($MySQLiVendas));
  $usuarios = mysqli_fetch_all($usuarios);
}
if (empty($valida)) {    
    header("location: login.php?NO-ALLOW");
}
$path = 'uploads/'.$valida['logo'];
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.lojadeaplicativo.com/acesso/apis/pedidos.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
    "Authorization: Basic " . base64_encode($_SESSION['lojadeaplicativo'][0] . ":" . $_SESSION['lojadeaplicativo'][1]),
    'Cookie: _d2id=158348cf-9209-4017-aa35-0ee8cb0ab3a1-n'
  ),
));
$pedidos = curl_exec($curl);
curl_close($curl);
?>
<!DOCTYPE html>
<html lang="pt-br" >
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="imagex/png" href="src/img/logo_efeito_re9_painel.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/bootstrap-vue@2.0.0/dist/bootstrap-vue.min.css,npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="src/style/index.css?v=<?php echo time() + (7 * 24 * 60 * 60); ?>">  
</head>
<body>
<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
  <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
  <img src="src/img/logo_efeito_re9_painel.png" width="250" alt="re9">

  <ul class="categories list-unstyled">
    <li class="">
      <i class="uil-estate fa-fw"></i><a href="./#/"> Início</a>
    </li>
    <li class="">
      <i class="uil-shopping-cart-alt"></i><a href="./#/Pedidos"> Pedidos</a>
    </li>
    <li class="has-dropdown">
      <i class="uil-building"></i><a href="#"> Empresas</a>
      <ul class="sidebar-dropdown list-unstyled">
        <?php if ($valida['privilegio'] == 1) { ?>    
          <li><a href="./#/cadastroEmpresas">Cadastro</a></li>
        <?php } ?>
        <li><a href="./#/consultaEmpresas">Consulta</a></li>
      </ul>
    </li>
    <li class="has-dropdown">
      <i class="uil-users-alt"></i><a href="#"> Usuários</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="./#/cadastroUsuarios">Cadastro</a></li>
        <li><a href="./#/consultaUsuarios">Consulta</a></li>
      </ul>
    </li>
    <li class="has-dropdown">
      <i class="uil-setting"></i><a href="#"> Configurações</a>
      <ul class="sidebar-dropdown list-unstyled d-none">
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">ipsum dolor</a></li>
        <li><a href="#">dolor ipsum</a></li>
        <li><a href="#">amet consectetur</a></li>
        <li><a href="./#/Contas">Contas</a></li>
      </ul>
    </li>
    <li class="">
      <i class="uil-sign-out-alt"></i><a href="apis/logout.php"> Sair</a>
    </li>
  </ul>
</aside>

<section id="wrapper">
  <nav class="navbar navbar-expand-md">
    <div class="container-fluid mx-2">
      <div class="navbar-header">
        <ul class="navbar-nav ms-auto">          
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i data-show="show-side-navigation1" class="uil-bars show-side-btn"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="preloader_container">
    <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
      <circle cx="170" cy="170" r="160" stroke="#00394e"/>
      <circle cx="170" cy="170" r="135" stroke="#2e7aff"/>
      <circle cx="170" cy="170" r="110" stroke="#00394e"/>
      <circle cx="170" cy="170" r="85" stroke="#2e7aff"/>
    </svg>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-router@3.0.7/dist/vue-router.min.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap-vue@2.0.0-rc.11/dist/bootstrap-vue.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/vue-tables-2@2.0.0/dist/vue-tables-2.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/jspdf@1.5.3/dist/jspdf.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.4/jspdf.plugin.autotable.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert@2/dist/sweetalert.min.js"></script>
  <script  src="src/script/index.js?v=<?php echo time() + (7 * 24 * 60 * 60); ?>"></script>
  <div id="vue" ></div>
</section>
    <?php
      require_once('Mods/home.php');
      require_once('Mods/Configuracoes/contas.php');
      require_once('Mods/pedidos.php');
      require_once('Mods/empresas.php');
      require_once('Mods/usuarios.php');
    ?>
<script>
  let 
  <?php if ($valida['privilegio'] == 1) { ?> 
      empresasCad = <?php echo json_encode($empresa); ?>,
  <?php }else{ ?>
      empresasCad = [<?php echo json_encode($empresa); ?>],
  <?php } ?>
      usuariosCad = [<?php echo json_encode($usuarios); ?>],
      pedidosAll = <?php echo $pedidos; ?>,
      empresaNome = "<?php echo $valida['nome']; ?>",
      logoimg = '<?php echo $base64; ?>'
  const 
    home = { template: '#home' },    
    contas = { 
      template: '#contas', 
      props: { 
        users: 
        {
          type: Array, 
          default: () =>  []
        } 
      }
    }  
  const Event = VueTables.Event
  Vue.use(VueTables.ClientTable,{
  filterByColumn: true
  });

  var router = new VueRouter({
    routes: [
      { 
        path: '/', 
        name: 'Home', 
        component: home 
      },
      { 
        path: '/Pedidos', 
        name: 'Pedidos', 
        component: pedidos 
      },
      { 
        path: '/Pedidos/:id', 
        name: 'PedidosId', 
        component: pedidosID 
      },
      { 
        path: '/cadastroEmpresas', 
        name: 'cadEmpresas', 
        component: cadEmpresas 
      },
      { 
        path: '/consultaEmpresas', 
        name: 'empresas', 
        component: empresas 
      },
      { 
        path: '/cadastroUsuarios', 
        name: 'cadUsuarios', 
        component: cadUsuarios 
      },
      { 
        path: '/Empresa/:id', 
        name: 'editEmpresa', 
        component: editEmpresa 
      },
      { 
        path: '/consultaUsuarios', 
        name: 'usuarios', 
        component: usuarios 
      },
      { 
        path: '/Usuario/:id', 
        name: 'editUsuario', 
        component: editUsuario 
      },
      { 
        path: '/Contas', 
        name:'Contas',  
        component: contas
      }       
    ]
})

var ctrl = new Vue({
  el: '#vue',
  router: router,
  components: { 
    'home': home,
    'pedidos': pedidos, 
    'pedidosID': pedidosID, 
    'empresas': empresas, 
  <?php if ($valida['privilegio'] == 1) { ?> 
    'cadEmpresas': cadEmpresas,
  <?php } ?>
    'editEmpresa': editEmpresa,
    'usuarios': usuarios, 
    'cadUsuarios': cadUsuarios,  
    'editUsuario': editUsuario,  
    'contas': contas 
    },
    methods:{
      <?php if ($valida['privilegio'] == 1) { ?> 
        removeEmpresa: function (index) {       
            empresasCad.splice(index, 1)
        },
      <?php } ?>
      addEmpresa: function (newArray) {
        <?php if ($valida['privilegio'] == 1) { ?> 
          empresasCad=newArray
        <?php }else{ ?> 
          empresasCad[0]=newArray        
        <?php } ?>
      },
      removeUsuario: function (index) {       
          usuariosCad[0].splice(index, 1)
      },
      addUsuario: function (newArray) {
          usuariosCad[0]=newArray
      },
      fadeout: async function () {
          
      },
      reloadPedidos: async function () {
        fetch(`apis/pedidos.php`,{
            method: "GET",
            headers: {
                "Authorization": "Basic <?php echo base64_encode($_SESSION['lojadeaplicativo'][0] . ":" . $_SESSION['lojadeaplicativo'][1]) ?>",                        
            }
        })
        .then(a=>a.json())
        .then(a=>{
          if(a!=undefined){
            pedidosAll = a            
          }
        })
      }
    },
    beforeCreate: async function() {
        document.getElementsByClassName('preloader_container')[0].style.opacity = '0'
    },
    created: function() {
		  this.$on('removeEmpresa', this.removeEmpresa);
		  this.$on('addEmpresa', this.addEmpresa);
		  this.$on('removeUsuario', this.removeUsuario);
		  this.$on('addUsuario', this.addUsuario);
		  this.$on('reloadPedidos', this.reloadPedidos);
      setTimeout(() => {
          document.getElementsByClassName('preloader_container')[0].style.display = 'none'
      }, 6000);
	},
  render: h => h('router-view') 
})

</script>
</body>
</html>
