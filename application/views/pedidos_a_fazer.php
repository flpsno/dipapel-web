<?php $this->load->view('cabecalho', $titulo); ?>

<div class="container-fluid">
    <div class="page-header">
        <h3>Pedidos a Fazer</h3>
            <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-sm" role="button">
                <span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
            <a href="<?php echo base_url('index.php/pedidos/pedidos_a_fazer'); ?>" class="btn btn-primary btn-sm" role="button">
                <span class="glyphicon glyphicon-refresh"></span> Recarregar</a>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
    	<div class="col-xs-12 col-sm-12">

        <!--table-striped   -->
        <table class="table table-hover table-responsive">
          <!--  <thead>
            <tr class="success">
                <th>Pos</th>
                <th>Mover</th>
                <th>Pedido ELO7</th>
                <th>Dt. Pedido</th>
                <th>Itens</th>
                <th>Salvar Itens</th>
                <th>Tipo Frete</th>
                <th>Vl. Frete</th>
                <th>Vl. Total</th>
                <th>Finalizar</th>
            </tr>
          </thead> -->

            <?php $i = 1;  foreach ($qryvwpedidos as $row):?>
            <tbody>
              <form method="post" accept-charset="utf-8" action="<?php echo base_url('index.php/pedidos/salva_itens/'); ?>/<?php echo $row->IDPEDIDO; ?>">
            <tr>
                <td rowspan="4"><H4><?php echo $i; ?></H4></td>
                <td></td>
                <th>Pedido:</th>
                <td> <a href="https://www.elo7.com.br/sellerOrder.do?query=<?php echo $row->PEDIDO_ELO7; ?>" target="_blank">
                    <?php echo $row->PEDIDO_ELO7; ?></a>
                </td>
                <th>Data Pedido: </th>
                <td><?php echo $row->DATA_PEDIDO2; ?></td>
                <th>Itens: </th>
                <td rowspan="3" valign="top"><textarea class="form-control" id="itens" name="itens"  rows="3" cols="50"><?php  echo $row->ITENS; ?></textarea></td>
            </tr>
            <tr>
              <td>
              <!-- Se é o primeiro registro, o botão mover para cima fica desabilitado -->
              <?php if ($i == 1) { ?>
                  <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-xs disabled" role="button">
                  <span class="glyphicon glyphicon-chevron-up"></span></a>

              <!-- botão mover para cima -->
              <?php } else { ?>
                  <a href="<?php echo base_url('index.php/pedidos/mover_para_cima/'); ?>/<?php echo $row->IDPEDIDO; ?>/<?php echo $row->POSICAO; ?>" class="btn btn-primary btn-xs" role="button">
                  <span class="glyphicon glyphicon-chevron-up"></span></a>
              <?php } ?>
            </td>
                <th>Comprador:</th>
                <td><?php echo $row->COMPRADOR; ?></td>
                <th>Email:</th>
                <td><input class="form-control"  type="text" value="<?php echo $row->EMAIL; ?>" name="email"/></td>
                <td></td>
            </tr>

            <tr>
              <td>
              <!-- Se é o ultimo registro, o botão mover para baixo fica desabilitado -->
              <?php if ($i == $total_itens) { ?>
                  <a href="<?php echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-xs disabled" role="button">
                  <span class=" glyphicon glyphicon-chevron-down"></span></a>
              <!-- botão mover para baixo -->
              <?php } else { ?>
                  <a href="<?php echo base_url('index.php/pedidos/mover_para_baixo/'); ?>/<?php echo $row->IDPEDIDO; ?>/<?php echo $row->POSICAO; ?>" class="btn btn-primary btn-xs" role="button">
                  <span class=" glyphicon glyphicon-chevron-down"></span></a>
              <?php } ?>
            </td>
                <th>Tipo Frete:</th>
                <td><?php echo $row->TIPO_FRETE; ?></td>
                <th>Valor Frete:</th>
                <td><?php echo $row->VALOR_FRETE; ?></td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <th>Valor Total:</th>
                <td><?php echo $row->VALOR_TOTAL; ?></td>
                <th>Salvar Alterações:</th>
                <td>
                  <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-saved"></span></button>
                <th>Finalizar Pedido:</th>
                <td>
                  <a href="<?php // echo base_url('index.php/pedidos/marcar_como_feito/'); ?>/<?php //echo $row->IDPEDIDO; ?>/<?php // echo $row->POSICAO; ?>" class="btn btn-success btn-sm" role="button">
                  <span class="glyphicon glyphicon glyphicon-ok"></span></a>
                </td>
            </tr>
            </form>



          <!--  <tr>
                <td><?php // echo $i; ?></td>
                <td>
                    <?php // if ($i == 1) { ?>
                        <a href="<?php // echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-xs disabled" role="button">
                        <span class="glyphicon glyphicon-chevron-up"></span></a>

                    <?php // } else { ?>
                        <a href="<?php // echo base_url('index.php/pedidos/mover_para_cima/'); ?>/<?php // echo  $row->IDPEDIDO; ?>/<?php // echo $row->POSICAO; ?>" class="btn btn-primary btn-xs" role="button">
                        <span class="glyphicon glyphicon-chevron-up"></span></a>
                    <?php // } ?>

                    <?php // if ($i == $total_itens) { ?>
                        <a href="<?php // echo base_url('index.php/pedidos'); ?>" class="btn btn-primary btn-xs disabled" role="button">
                        <span class=" glyphicon glyphicon-chevron-down"></span></a>
                    <?php // } else { ?>
                        <a href="<?php // echo base_url('index.php/pedidos/mover_para_baixo/'); ?>/<?php // echo $row->IDPEDIDO; ?>/<?php //echo $row->POSICAO; ?>" class="btn btn-primary btn-xs" role="button">
                        <span class=" glyphicon glyphicon-chevron-down"></span></a>
                    <?php // } ?>
                </td>
                <td><?php // echo $row->PEDIDO_ELO7; ?></td>
                <td><?php // echo $row->DATA_PEDIDO2; ?></td>
                <form method="post" accept-charset="utf-8" action="<?php //echo base_url('index.php/pedidos/salva_itens/'); ?>/<?php // echo $row->IDPEDIDO; ?>">
                    <td>
                        <textarea class="form-control" id="itens" name="itens"  rows="3" cols="50"><?php // echo $row->ITENS; ?></textarea>
                    </td>
                    <td align="center">
                        <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-saved"></span></button>
                    </td>
                </form>


                <td><?php // echo $row->TIPO_FRETE; ?></td>
                <td><?php // echo $row->VALOR_FRETE; ?></td>
                <td><?php // echo $row->VALOR_TOTAL; ?></td>
                <td align="center">
                  <a href="<?php // echo base_url('index.php/pedidos/marcar_como_feito/'); ?>/<?php //echo $row->IDPEDIDO; ?>/<?php // echo $row->POSICAO; ?>" class="btn btn-success btn-sm" role="button">
                  <span class="glyphicon glyphicon glyphicon-ok"></span></a>
                </td>
            </tr> -->
            </tbody>
            <?php $i = $i + 1; ?>
            <?php endforeach;?>

        </table>

    	</div>
    </div>
</div>



<?php $this->load->view('rodape'); ?>
