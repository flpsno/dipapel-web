<?php $this->load->view('cabecalho', $titulo); ?>

<div class="container">
    <div class="page-header">
        <h1>Pedidos a Fazer</h1>
            <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-sm" role="button">
                <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
            <a href="<?php echo base_url('index.php/pedidos/pedidos_a_fazer'); ?>" class="btn btn-primary btn-sm" role="button">
                <span class="glyphicon glyphicon-refresh"></span> Recarregar</a>
    </div>
</div>


<div class="container">
    <div class="row">
    	<div class="col-xs-12 col-sm-12">

        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr class="success">
                <th>Pos</th>
                <th>Mover</th>
                <th>Pedido ELO7</th>
                <th>Dt. Pedido</th>
                <th>Itens</th>
                <th></th>
                <th>Tipo Frete</th>
                <th>Vl. Frete</th>
                <th>Vl. Total</th>
                <th></th>
            </tr>
            </thead>

            <?php $i = 1;  foreach ($qryvwpedidos as $row):?>
            <tbody>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php if ($i == 1) { ?>
                        <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-sm disabled" role="button">
                        <span class="glyphicon glyphicon-chevron-up"></span></a>
                    <?php } else { ?>
                        <a href="<?php echo base_url('index.php/pedidos/mover_para_cima/'); ?>/<?php echo $row->IDPEDIDO; ?>/<?php echo $row->POSICAO; ?>" class="btn btn-primary btn-sm" role="button">
                        <span class="glyphicon glyphicon-chevron-up"></span></a>
                    <?php } ?>


                    <?php if ($i == $total_itens) { ?>
                        <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-sm disabled" role="button">
                        <span class=" glyphicon glyphicon-chevron-down"></span></a>
                    <?php } else { ?>
                        <a href="<?php echo base_url('index.php/pedidos/mover_para_baixo/'); ?>/<?php echo $row->IDPEDIDO; ?>/<?php echo $row->POSICAO; ?>" class="btn btn-primary btn-sm" role="button">
                        <span class=" glyphicon glyphicon-chevron-down"></span></a>
                    <?php } ?>
                </td>
                <td><?php echo $row->PEDIDO_ELO7; ?></td>
                <td><?php echo $row->DATA_PEDIDO2; ?></td>
                <form method="post" accept-charset="utf-8" action="<?php echo base_url('index.php/pedidos/salva_itens/'); ?>/<?php echo $row->IDPEDIDO; ?>">
                    <td>
                        <textarea class="form-control" id="itens" name="itens"  rows="3" cols="50"><?php echo $row->ITENS; ?></textarea>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-saved"></span></button>                    
                    </td>
                </form>


                <td><?php echo $row->TIPO_FRETE; ?></td>
                <td><?php echo $row->VALOR_FRETE; ?></td>
                <td><?php echo $row->VALOR_TOTAL; ?></td>
                <td>
                  <a href="<?php echo base_url('index.php/pedidos/marcar_como_feito/'); ?>/<?php echo $row->IDPEDIDO; ?>/<?php echo $row->POSICAO; ?>" class="btn btn-success" role="button">
                  <span class="glyphicon glyphicon glyphicon-ok"></span></a>
                </td>
            </tr>
            </tbody>
            <?php $i = $i + 1; ?>
            <?php endforeach;?>

        </table>

    	</div>
    </div>
</div>



<?php $this->load->view('rodape'); ?>
