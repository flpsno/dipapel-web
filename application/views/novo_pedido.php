<?php $this->load->view('cabecalho', $titulo); ?>

<div class="container"> 
    <div class="page-header">
        <h1>Novo Pedido</h1>
            <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-sm" role="button">
                <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>  
            <a href="<?php echo base_url('index.php/pedidos/novo_pedido'); ?>" class="btn btn-primary btn-sm" role="button">
                <span class="glyphicon glyphicon-refresh"></span> Recarregar</a>         
    </div>
</div>    


<div class="container">
    <div class="jumbotron">        
        <div class="row">
            <form class="form-horizontal" role="form" method="post" accept-charset="utf-8" action="<?php echo base_url('index.php/pedidos/salva_novo_pedido'); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Código:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Entre com o código" name="codigo">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="itens">Descrição dos Itens:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="itens" name="itens"  rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Tipo do Frete:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Entre com o tipo de frete" name="tipo_frete">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Valor do Frete:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Entre com o valor do frete" name="valor_frete">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Valor Total:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pwd" placeholder="Entre com o valor total do pedido" name="valor_total">
                    </div>
                </div>                                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>


<?php $this->load->view('rodape'); ?>