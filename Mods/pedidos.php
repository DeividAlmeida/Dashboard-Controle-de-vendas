<template id="date">    
    <div class="col-md-3">
        <div  class="form-group mr-5" >
            <label class="mr-2">Data Inicial:</label>
            <input  oninput="shortTime()"  class="form-control" type="date">
        </div>
    </div>
    <div class="col-md-3">
        <div  class="form-group" >
            <label class="mr-2">Data Final:</label>
            <input oninput="shortTime()"  class="form-control" type="date">
        </div>
    </div>
</template>
<template id="pedidos" >
  <div class="p-4">
    <link rel="stylesheet" href="Mods/src/style/pedidos.css"> 
    <v-client-table 
        :filterByColumn="true" 
        :sortable= "true"
        :columns="['id', 'cliente', 'valor', 'emissao', 'nome_representante', 'acao']" 
        :data="data"
        :options="{  
            headings: 
            {  
                id: 'id do pedido',      
                cliente: 'Cliente',      
                valor: 'Valor Total',      
                emissao: 'Emissão',
                nome_representante: 'Representante',
                acao:'Opções'
            },    
            sortable: ['id', 'cliente'],    
            filterable: ['id', 'cliente', 'valor', 'emissao', 'nome_representante'],  
            
            texts: {
                count: 'Mostrando de {from} a {to} de um total de {count} pedidos|{count} pedidos| Um pedido',
                first: 'Primeiro',
                last: 'Último',
                filter: 'Pesquisar:',
                filterPlaceholder: 'Encontre o pedido',
                limit: 'Pedidos por página:',
                page: 'Página:',
                noResults: 'Nenhum resultado encontrado',
                filterBy: 'Filtrar por {column}',
                loading: 'Carregando...',
                defaultOption: 'Selecionar {column}',
                columns: 'Colunas'
            },
            listColumns: {
                filial: [{
                id: 'http://guardiao.genesysweb.net/IntegracaoGenesysMobile/',
                text: 'Matriz'
                }]
            },
            customFilters: [{
               name: 'date',
               callback: function(row, query) {
               
                  return  new Date(row.emissao.replaceAll('-','/')).getTime() >= query[0] && new Date(row.emissao).getTime() <= query[1];
               }
            }]
        }
            " 
        class="thead-dark"
    >
        <div slot="cliente" slot-scope="props" >
            {{props.row.cod_cliente+" - "+props.row.cliente}}
        </div> 
        
        <div slot="acao" slot-scope="props" >
            <b-button-group>                  
                <b-button variant="Primary" >
                    <router-link to="/foo" class="uil-pen"> </router-link> 
                </b-button>
                <b-button variant="Primary">
                    <router-link :to="{ name: 'PedidosId', params: { id: props.row.id }}" name="IDpedido" class="uil-search"> </router-link>
                </b-button>
                <b-button variant="Primary">
                    <router-link to="/foo" class="uil uil-envelope"> </router-link>
                </b-button> 
                <b-button variant="Primary">
                    <a href="javascript:void(0)" @click="generatePDF(props.row.id)" class="uil-file-download"> </a>
                </b-button>                                  
            </b-button-group>
        </div>
    </v-client-table>
    <script type="application/javascript">
       
      function shortTime () {
        let inicio  = document.querySelectorAll("input[type='date']")[0],
            fim     = document.querySelectorAll("input[type='date']")[1]
            if(inicio.value != '' && fim.value != ''&& new Date(inicio.value).getTime() <= new Date(fim.value).getTime() ){
                Event.$emit('vue-tables.filter::date', [new Date(inicio.value.replaceAll('-','/')).getTime(), new Date(fim.value.replaceAll('-','/')).getTime()]);
            } 
        } 
    </script>
  </div>
</template>
<template id="info">    
    <div class="col-md-2">
        <div  class="form-group mr-5" >
            <label class="mr-2">Data Emissão:</label>
            <b class="form-control"></b>
        </div>
    </div>
    <div class="col-md-2">
        <div  class="form-group mr-5" >
            <label class="mr-2">Valor Total:</label>
            <b class="form-control"></b>
        </div>
    </div>    
    <div class="col-md-6">
        <div  class="form-group mr-5" >
            <label class="mr-2">Cliente:</label>
            <b class="form-control"></b>
        </div>
    </div>
</template>
<template id="pedidosID" >
  <div class="p-4">
    <link rel="stylesheet" href="Mods/src/style/pedidos.css"> 
    <v-client-table 
    :filterByColumn="true" 
        :sortable= "true"
        :columns="['id', 'cod_produto', 'produto', 'quantidade', 'valor', 'un']" 
        :data="data"
        :options="{  
            headings: 
            {  
                id: 'id do produto',      
                cod_produto: 'Código do Produto',      
                produto: 'Produto',
                quantidade: 'Quantidade',
                valor: 'Valor',
                un: 'Valor Unitário'
            },    
            sortable: ['id', 'cod_produto', 'produto', 'quantidade', 'valor', 'un'],    
            filterable: ['id', 'cod_produto', 'produto', 'quantidade', 'valor', 'un'],  
            
            texts: {
                count: 'Mostrando de {from} a {to} de um total de {count} pedidos|{count} pedidos| Um pedido',
                first: 'Primeiro',
                last: 'Último',
                filter: 'Pesquisar:',
                filterPlaceholder: 'Encontre o pedido',
                limit: 'Pedidos por página:',
                page: 'Página:',
                noResults: 'Nenhum resultado encontrado',
                filterBy: 'Filtrar por {column}',
                loading: 'Carregando...',
                defaultOption: 'Selecionar {column}',
                columns: 'Colunas'
            },
            customFilters: [{
               name: 'filtro',
               callback: function(row, query) {               
                  return  query
               }
            }]
        }" 
        class="thead-dark"
        
    >
        <div slot="valor" slot-scope="props" >
            {{ new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'})
     .format(parseFloat(props.row.valor))}}
        </div> 
        <div slot="un" slot-scope="props" >
            {{ new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'})
     .format(parseFloat(props.row.valor)/parseInt(props.row.quantidade))}}
        </div> 
    </v-client-table>
    <script type="application/javascript">
      
    </script>
  </div>
</template>
<script src="Mods/src/script/pedidos.js?v=<?php echo time() + (7 * 24 * 60 * 60); ?>"></script>