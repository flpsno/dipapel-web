<?php $this->load->view('cabecalho', $titulo); ?>

<div class="container-fluid">

  <!-- cabeçalho da página -->
  <div class="page-header">
    <h3>Grafico de Vendas</h3>
    <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-sm" role="button">
      <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
      <a href="<?php echo base_url('index.php/pedidos/grafico_vendas'); ?>" class="btn btn-primary btn-sm" role="button">
        <span class="glyphicon glyphicon-refresh"></span> Recarregar</a>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <script src="<?php echo base_url('js/Chart.js'); ?>"></script>

    <div class="container-fluid"><center>
      <!-- gráfico de vendas por quantidade de pedidos -->
      <canvas id="chart1" width="920" height="400" class="canvas"></canvas>
      <br>
      <!-- gráfico de vendas por valor total -->
      <canvas id="chart2" width="920" height="400" class="canvas"></canvas></center>
    </div>

    <script>
    var ctx = document.getElementById("chart1");
    var ctx2 = document.getElementById("chart2");

    // carrega o nome dos meses na array label que será utilizada no chart.js
    var labels= ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

    var chart1 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: '2016',
          data: <?php echo json_encode(array_values($data2016_qtd_pedidos)); ?>,
          fill: false,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)'
          ],
          borderWidth: 1
        },

        {
          label: '2017',
          data: <?php echo json_encode(array_values($data2017_qtd_pedidos)); ?>,
          fill: false,
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Gráfico de Vendas por Qtd. de Pedidos',
          fontSize: 20,
          fontColor: "#FFFFFF"
        },
        responsive: false,
        legend: {
          position: 'right',
          labels: {
            fontSize: 12
          }
        }
        /*  scales: {
        yAxes: [{
        ticks: {
        beginAtZero:true
      }
    }]
  }*/
}
});

var chart2 = new Chart(ctx2, {
  type: 'line',
  data: {
    labels: labels,
    datasets: [

      {
        label: '2016',
        data: <?php echo json_encode(array_values($data2016_valor_total)); ?>,
        fill: false,
        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgba(255,99,132,1)'],
        borderWidth: 1
      },

      {
        label: '2017',
        data: <?php echo json_encode(array_values($data2017_valor_total)); ?>,
        fill: false,
        backgroundColor: ['rgba(54, 162, 235, 0.2)'],
        borderColor: ['rgba(54, 162, 235, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Gráfico de Vendas por Valor Total',
        fontSize: 20,
        fontColor: "#FFFFFF"
      },
      responsive: false,
      legend: {
        position: 'right',
        labels: {
          fontSize: 12
        }
      }
      /*  scales: {
      yAxes: [{
      ticks: {
      beginAtZero:true
    }
  }]
}*/
}
});
</script>


<?php $this->load->view('rodape'); ?>
