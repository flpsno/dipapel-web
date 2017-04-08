<?php $this->load->view('cabecalho', $titulo); ?>

<div class="container">
    <div class="page-header">
        <h1>Opções Disponíveis</h1>
    </div>
</div>

<div class="container">
        <div class="jumbotron">
        <div class="row">
            <div class="col-sm-4 "></div>
            <div class="col-sm-4 ">
                <a href="<?php echo base_url('index.php/pedidos/pedidos_a_fazer'); ?>" class="btn btn-primary btn-md" role="button">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Pedidos pagos a produzir</a>
            </div>
            <div class="col-sm-4 "></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4 "></div>
            <div class="col-sm-4 ">
                <a href="<?php echo base_url('index.php/pedidos/novo_pedido'); ?>" class="btn btn-primary btn-md" role="button">
                    <span class="glyphicon glyphicon-plus"></span> Adicionar Pedido</a>
            </div>
            <div class="col-sm-4 "></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4 "></div>
            <div class="col-sm-4 ">
                <a href="<?php echo base_url('index.php/login/logout'); ?>" class="btn btn-primary btn-md" role="button">
                    <span class="glyphicon glyphicon-log-out"></span> LogOut</a>
            </div>
            <div class="col-sm-4 "></div>
        </div>

        <div class="row">
            <div class="col-sm-4 "></div>
            <div class="col-sm-4 ">
               <!-- <div class="ct-chart ct-golden-section" id="chart1"></div> -->
            </div>
            <div class="col-sm-4 "></div>
        </div>



    </div>
</div>



<?php $this->load->view('rodape'); ?>
