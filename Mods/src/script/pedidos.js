  const  pedidos = { 
      template: '#pedidos',      
      data() {
        return {
          data:pedidosAll,
          cliente: null,
          cnpj: null,
          cidade: null,
          estado: null,
          representante: null,
          emissao: null,
          valor: null,
          qtd: null,
          empresa_nome: null,
          empresa:[],
          items: []
        }
      },
      methods: {
        applyFilter(letter) {
          Event.$emit('vue-tables.filter::date', letter);
        },
        async generatePDF(id){ 
          let qtd = 0
           Object.keys(pedidosAll).forEach( a=>{
            pedidosAll[a].detalhes.filter(async b=>{
              if(b.idpedido == id){                
                b.un = new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'})
                  .format(b.valor/b.quantidade) 
                  qtd=qtd+parseInt(b.quantidade)
                  b.valor = new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'})
                  .format(b.valor) 
                detalhes.push(b)
                this.emissao = new Intl.DateTimeFormat('pt-br').format(new Date(pedidosAll[a].emissao))
                this.valor = pedidosAll[a].valor
                this.cliente = pedidosAll[a].cliente
                this.cnpj = pedidosAll[a].cnpj.replaceAll(/\s+/g, '')
                this.cidade = pedidosAll[a].cidade
                this.estado = pedidosAll[a].estado
                this.representante = pedidosAll[a].nome_representante
                this.codigo = pedidosAll[a].cod_cliente
                this.empresa_nome = empresaNome

              } 
                this.items = await detalhes
                this.qtd   = await qtd
            })
          })
          this.empresa = await empresasCad.filter(dados=>{return dados.nome ==  this.empresa_nome  })            
          detalhes = []
          const doc = new jsPDF({
              orientation: "portrait",
              unit: "in",
              format: "letter" 
            });

          await   doc
            .setFontSize(16)
            .setFontStyle("bold")
            .text(this.empresa_nome, doc.internal.pageSize.width / 1.65 , .5 , { align: 'center'})

          await doc 
            .setFontSize(12)
            .setFontStyle("normal")
            .text(`Código: ${this.empresa[0].id_empresa}`, doc.internal.pageSize.width / 1.65 , .75 , { align: 'center'})  
            .text(`Cidade / UF: ${this.empresa[0].cidade} / ${this.empresa[0].estado}`, doc.internal.pageSize.width / 1.65 , 1 , { align: 'center'})  
            .text(`Endereço: ${this.empresa[0].endereco}`, doc.internal.pageSize.width / 1.65 , 1.25 , { align: 'center'}) 
            .text(`CNPJ: ${this.empresa[0].cnpj_cpf}`, doc.internal.pageSize.width / 1.65 , 1.5 , { align: 'center'})  
            .text(`E-mail / Fone: ${this.empresa[0].email} / ${this.empresa[0].telefone}`, doc.internal.pageSize.width / 1.65 , 1.75 , { align: 'center'}) 
          
          await doc
            .setLineWidth(0.01)
            .setFontSize(15)
            .setFontStyle("bold")
            .addImage(logoimg, "PNG", .3, .2, 2, 1.7)
            .line(.5, 2, 8.0, 2)

          await doc 
            .setFontSize(12)
            .setFontStyle("bold")
            .text(`${this.cliente} - ${this.codigo}`, doc.internal.pageSize.width / 36 , 2.25 , { align: 'left'})
          
          await  doc 
            .setFontSize(12)
            .setFontStyle("normal")
            .text(`Cidade/UF: ${this.cidade} / ${this.estado}`, doc.internal.pageSize.width / 14 , 2.5 , { align: 'left'})
            .text(`CNPJ/CPF: ${this.cnpj}`, doc.internal.pageSize.width / 14 , 2.75 , { align: 'left'})
            .text(`Representante: ${this.representante}`, doc.internal.pageSize.width / 14 , 3 , { align: 'left'})
           
          await doc 
            .setFontSize(12)
            .setFontStyle("bold")
            .text(`Nº Pedido: ${id}`, doc.internal.pageSize.width / 14 , 3.5 , { align: 'left'})  
            .text(`Data Emissão: ${this.emissao}`, doc.internal.pageSize.width / 1.1 , 3.5  , { align: 'right'}) 

          await doc.autoTable({
            foot: [['Total', null, this.qtd, null, this.valor]],
            columns:[
              { title: "Código", dataKey: "cod_produto" },
              { title: "Descrição", dataKey: "produto" },
              { title: "Qtde", dataKey: "quantidade" },
              { title: "Vlr. Unit.", dataKey: "un" },
              { title: "Vlr. Tot.", dataKey: "valor" }
            ],
            body: this.items,
            margin: { left: 0.5, top: 3.6 },
            headfootStyles: {
              fillColor: [46, 122, 255],
            },
            footStyles: {
              fillColor: [0, 57, 78],
            }
          });

          // Using array of sentences
          await doc
            .setFont("helvetica")
            .setFontSize(12)
            .text(`*** Pedido Sujeito a Aprovação ***`, doc.internal.pageSize.width /2, 7.5, { align: "center", maxWidth: "7.5" })
            .text(`*** O Faturamento dos Pedidos está sujeito à disponibilidade de Estoque ***`, doc.internal.pageSize.width /2, 7.75, { align: "center", maxWidth: "7.5" })

          await doc
            .setFont("helvetica")
            .setFontSize(11)
            .setFontStyle("bold")
            .setTextColor(0, 0, 0)
            .setLineWidth(0.01)
            .line(0.5, 10.1, 8.0, 10.1)
            .addImage(logoimg, "PNG", .5, 10.15, 1, 0.85)
            .text(
              `Relatório gerado por Re9 em ${new Intl.DateTimeFormat('pt-br', {  timeStyle: "medium",  dateStyle: "short"}).format(new Date())} | www.seusite.com.br`,
              doc.internal.pageSize.width - 5.8,
              doc.internal.pageSize.height - 0.3
            )
            .save(`Pedido-${id}.pdf`);
          this.items = await []
        } 
      },
      mounted() {
        let rowElement = document.querySelector('.row'),
         temp = document.getElementById('date'),
         clon = temp.content.cloneNode(true)
        rowElement.appendChild(clon)
        document.querySelector('.col-md-12').setAttribute('class','col-md-3')
        rowElement.setAttribute('class','row justify-content-center pb-4 d-flex')
        setInterval(async () => {
          if(this.$route.name == 'Pedidos'){
            ctrl.$emit('reloadPedidos')
            this.data = await pedidosAll
          }
        }, 6000);
      }
    },
    pedidosID = { 
      template: '#pedidosID',
      props: { 
        data: 
        {
          type: Array, 
          default: () => detalhes
        } 
      },
      data(){
        return{
          emissao: null,
          cliente: null,
          valor: null
        }
      },
      methods: {
        applyFilter(letter) {
          Object.keys(pedidosAll).forEach( a=>{
            pedidosAll[a].detalhes.filter(async b=>{
              if(b.idpedido == this.$route.params.id){
                detalhes.push(b)
                this.emissao = new Intl.DateTimeFormat('pt-br').format(new Date(pedidosAll[a].emissao))
                this.valor = pedidosAll[a].valor
                this.cliente = pedidosAll[a].cliente

              }             
              await Event.$emit('vue-tables.filter::filtro', detalhes);
            })
          })
               detalhes = []
        }
      },
      mounted() {
        let rowElement = document.querySelector('.row'),
         temp = document.getElementById('info'),
         clon = temp.content.cloneNode(true)
        rowElement.appendChild(clon)
        document.querySelector('.col-md-12').setAttribute('class','col-md-2')
        rowElement.setAttribute('class','row justify-content-start pb-4 d-flex')
        this.applyFilter()
        rowElement.childNodes[2].childNodes[1].childNodes[3].innerText = this.emissao
        rowElement.childNodes[4].childNodes[1].childNodes[3].innerText = "R$ "+this.valor
        rowElement.childNodes[6].childNodes[1].childNodes[3].innerText = this.cliente
      }
    }
