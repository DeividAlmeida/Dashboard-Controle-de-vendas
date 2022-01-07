<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<template id="home" >
  <div class="p-4">
    <div class="welcome">
      <div class="content rounded-3 p-3">
        <h1 class="fs-3"> Re9 Dashboard</h1>
        <p class="mb-0">Bem vindo ao seu Re9 Dashboard!</p>
      </div>
    </div>
    
    <section class="statis mt-4 text-center">
      <div class="row">
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="box bg-primary p-3">
            <i class="uil-shopping-cart"></i>
            <h3 id="sessenta"></h3>
            <p class="lead">Vendas nos últimos 60 dias</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="box bg-primary p-3">
            <i class="uil-shopping-cart"></i>
            <h3 id="trinta"></h3>
            <p class="lead">Vendas nos últimos 30 dias</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
          <div class="box bg-primary p-3">
            <i class="uil-shopping-cart"></i>
            <h3 id="sete"></h3>
            <p class="lead">Vendas nos últimos 7 dias</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="box bg-primary p-3">
            <i class="uil-shopping-cart"></i>
            <h3 id="hoje"></h3>
            <p class="lead">Vendas <br>Hoje</p>
          </div>
        </div>
      </div>
    </section>

    <section class="statis mt-4 text-center">
      <div class="row">
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="box bg-primary p-3">
            <i class="uil uil-usd-circle"></i>
            <h5 id="sessentaM"></h5>
            <p class="lead">Valor de vendas nos últimos 60 dias</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="box bg-primary p-3">
            <i class="uil uil-usd-circle"></i>
            <h5 id="trintaM"></h5>
            <p class="lead">Valor de vendas nos últimos 30 dias</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
          <div class="box bg-primary p-3">
            <i class="uil uil-usd-circle"></i>
            <h5 id="seteM"></h5>
            <p class="lead">Valor de vendas nos últimos 7 dias</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="box bg-primary p-3">
            <i class="uil uil-usd-circle"></i>
            <h5 id="hojeM"></h5>
            <p class="lead">Valor de vendas <br>Hoje</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="charts mt-4">
      <div class="chart-container p-3"> 
        <div class="row d-flex justify-content-center">
          <div class="col-md-5 text-center">
            <h3 class="fs-6 mb-3 text-uppercase">
              Vendas no Período
              <input type="date" name="" id="periodo" class="form-control mt-2" value="" :max="new Date(new Date().setDate(new Date().getDate()-5)).toISOString().slice(0, 10)">
            </h3>
          </div>
        </div>     
        <div style="height: 300px">
          <canvas id="chart" ></canvas>
        </div>
      </div>
    </section>
    <script type="application/javascript" >
      // Global defaults
      Chart.defaults.global.animation.duration = 2000; // Animation duration
      Chart.defaults.global.title.display = false; // Remove title
      Chart.defaults.global.defaultFontColor = '#fff'; // Font color
      Chart.defaults.global.defaultFontSize = 13; // Font size for every label
  
      // Tooltip global resets
      Chart.defaults.global.tooltips.backgroundColor = '#000'
      Chart.defaults.global.tooltips.borderColor = 'blue'
  
      // Gridlines global resets
      Chart.defaults.scale.gridLines.zeroLineColor = '#3b3d56'
      Chart.defaults.scale.gridLines.color = '#fff'
      Chart.defaults.scale.gridLines.drawBorder = false
  
      // Legend global resets
      Chart.defaults.global.legend.labels.padding = 0;
      Chart.defaults.global.legend.display = false;
  
      // Ticks global resets
      Chart.defaults.scale.ticks.fontSize = 12
      Chart.defaults.scale.ticks.fontColor = '#fff'
      Chart.defaults.scale.ticks.beginAtZero = false
      Chart.defaults.scale.ticks.padding = 10
  
      // Elements globals
      Chart.defaults.global.elements.point.radius = 0
  
      // Responsivess
      Chart.defaults.global.responsive = true
      Chart.defaults.global.maintainAspectRatio = false

      var 
        dateBase = document.getElementById('periodo'),
        sessenta  = document.getElementById('sessenta'),
        trinta    = document.getElementById('trinta'),
        sete      = document.getElementById('sete'),
        hoje      = document.getElementById('hoje')
        sessentaM  = document.getElementById('sessentaM'),
        trintaM    = document.getElementById('trintaM'),
        seteM      = document.getElementById('seteM'),
        hojeM      = document.getElementById('hojeM')
        dateBase.value = new Date(new Date().setDate(new Date().getDate()-30)).toISOString().slice(0, 10)

      var 
        sixty   = 0,
        thirty  = 0, 
        seven   = 0, 
        today   = 0,
        sixtyM   = 0,
        thirtyM  = 0, 
        sevenM   = 0, 
        todayM   = 0,
        chart = document.getElementById('chart'),
        primeiro = new Date(dateBase.value.replaceAll('-','/')).getTime(),
        quinto = new Date (),
        unit = parseInt(Math.ceil((quinto - primeiro) / (1000 * 3600 * 24))/5),
        segundo = new Date (new Date(primeiro).setDate(new Date().getDate()+unit*2)),
        terceiro = new Date (new Date(segundo).setDate(new Date().getDate()+(unit*3))),
        quarto = new Date (new Date(terceiro).setDate(new Date().getDate()+(unit*4))),
        vendas = [0,0,0,0,0],     
        grafico = new Chart(chart, {
          type: 'line',
          data: {
            labels: [
              `${new Intl.DateTimeFormat('pt-br').format(primeiro)} - ${new Intl.DateTimeFormat('pt-br').format(new Date(segundo).setHours(0,0,-1))}`, 
              `${new Intl.DateTimeFormat('pt-br').format(segundo)}  - ${new Intl.DateTimeFormat('pt-br').format(new Date(terceiro).setHours(0,0,-1))}`, 
              `${new Intl.DateTimeFormat('pt-br').format(terceiro)} - ${new Intl.DateTimeFormat('pt-br').format(new Date(quarto).setHours(0,0,-1))}`, 
              `${new Intl.DateTimeFormat('pt-br').format(quarto)} - ${new Intl.DateTimeFormat('pt-br').format(new Date(quinto).setHours(0,0,-1))}`, 
              `${new Intl.DateTimeFormat('pt-br').format(quinto)} - ${new Intl.DateTimeFormat('pt-br').format(new Date(quinto))}`
              
            ],
            datasets: [
              {
                label: "Vendas",
                lineTension: 0.2,
                borderColor: '#fff',
                borderWidth: 3,
                showLine: true,
                data: vendas,
                backgroundColor: 'transparent'
              } 
            ]
          },
          options: {
            scales: {
              yAxes: [{
                gridLines: {
                  drawBorder: false
                },
                ticks: {
                  stepSize: 12
                }
              }],
              xAxes: [{
                gridLines: {
                  display: false,
                },
              }],
            }
          }
        })
        pedidosAll.filter(async (b)=>{              
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date().setDate(new Date().getDate()-60)) {
              sixty++
              sixtyM = parseFloat(b.valor.replace(",","."))+sixtyM
          }
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date().setDate(new Date().getDate()-30)) {
            thirty++
            thirtyM = parseFloat(b.valor.replace(",","."))+thirtyM
          }                
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date().setDate(new Date().getDate()-7) ) {
              seven++
              sevenM = parseFloat(b.valor.replace(",","."))+sevenM
          }                
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date().setDate(new Date().getDate()-1) ) {
              today++
              vendas[4]++
              todayM = parseFloat(b.valor.replace(",","."))+todayM

          }                
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(primeiro) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(segundo).setHours(0,0,-1)) {
              vendas[0]++
          }
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(segundo) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(terceiro).setHours(0,0,-1)) {
            vendas[1]++
          }                
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(terceiro) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(quarto).setHours(0,0,-1)) {
            vendas[2]++
          }                
          if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(quarto) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(quinto).setHours(0,0,-1)) {
            vendas[3]++
          }
          grafico.config.data.datasets[0].data = await vendas 
          sessenta.innerText  = await sixty                
          trinta.innerText    = await thirty                
          sete.innerText     = await seven                
          hoje.innerText     = await today
          sessentaM.innerText  = await "R$ " + new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(sixtyM.toFixed(2))                
          trintaM.innerText    = await "R$ " + new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(thirtyM.toFixed(2))          
          seteM.innerText     = await  "R$ " + new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(sevenM.toFixed(2))        
          hojeM.innerText     = await "R$ " + new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2,maximumFractionDigits:2, currency: 'usd',   currencyDisplay: 'narrowSymbol'}).format(todayM.toFixed(2))
          await  grafico.update()
      })
           
      dateBase.addEventListener('input', async a=>{
        vendas = [0,0,0,0,0]     
        primeiro = new Date(dateBase.value.replaceAll('-','/')).getTime()        
        unit = await  parseInt(Math.ceil((new Date () - primeiro) / (1000 * 3600 * 24))/6)
        if (unit<=1) {
          unit = 1
        }

        segundo = await new Date (new Date(primeiro).setDate(new Date(primeiro).getDate()+unit*2))
        terceiro = await new Date (new Date(primeiro).setDate(new Date(primeiro).getDate()+(unit*3)))
        quarto = await new Date (new Date(primeiro).setDate(new Date(primeiro).getDate()+(unit*4)))
        quinto = await new Date (new Date(primeiro).setDate(new Date(primeiro).getDate()+(unit*5)))
        
          grafico.config.data.labels = []
        pedidosAll.filter(async (b)=>{ 
            if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(primeiro) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(segundo).setHours(0,0,-1)) {
              vendas[0]++
            }
            if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(segundo) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(terceiro).setHours(0,0,-1)) {
              vendas[1]++
            }               
            if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(terceiro) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(quarto).setHours(0,0,-1)) {
              vendas[2]++
            }               
            if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(quarto) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<new Date(quinto).setHours(0,0,-1)) {
              vendas[3]++
            }
            if (new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()>=new Date(quinto).setHours(23,59,59) && new Date(new Date(b.emissao).toLocaleDateString('pt-BR', {timeZone: 'UTC'})).getTime()<=new Date()) {
              vendas[4]++
            }
            grafico.config.data.labels[0] = `${new Intl.DateTimeFormat('pt-br').format(new Date(primeiro))} - ${new Intl.DateTimeFormat('pt-br').format(new Date(segundo).setHours(0,0,-1))}`
            grafico.config.data.labels[1] = `${new Intl.DateTimeFormat('pt-br').format(new Date(segundo))} - ${new Intl.DateTimeFormat('pt-br').format(new Date(terceiro).setHours(0,0,-1))}`
            grafico.config.data.labels[2] = `${new Intl.DateTimeFormat('pt-br').format(new Date(terceiro))} - ${new Intl.DateTimeFormat('pt-br').format(new Date(quarto).setHours(0,0,-1))}`  
            grafico.config.data.labels[3] = `${new Intl.DateTimeFormat('pt-br').format(new Date(quarto))} - ${new Intl.DateTimeFormat('pt-br').format(new Date(quinto).setHours(0,0,-1))}`
            grafico.config.data.labels[4] = `${new Intl.DateTimeFormat('pt-br').format(new Date(quinto))} - ${new Intl.DateTimeFormat('pt-br').format(new Date())}` 
            grafico.config.data.datasets[0].data = await vendas 
            await  grafico.update()
        })
                     
        await  grafico.update()
      })
    </script>
  </div>
</template>
<script src="src/script/home.js?gd"></script>