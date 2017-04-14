<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends MY_Controller {

/*	function Pedidos()
	{
		parent::Controller();
	}*/

	public function index() {
		$layout['titulo'] = 'Pedidos';
		$this->load->view('pedidos', $layout);
	}

    public function pedidos_a_fazer() {
        $this->load->model('Pedidos_model');
        $qryvwpedidos = $this->Pedidos_model->get_vwpedidos();
        $layout['qryvwpedidos'] = $qryvwpedidos;
        $layout['total_itens'] = count($qryvwpedidos);
        $layout['titulo'] = 'Pedidos a Fazer';
        $this->load->view('pedidos_a_fazer', $layout);
    }


    public function mover_para_cima($idpedido, $posicao) {
        $this->load->model('Pedidos_model');

        $qry = $this->Pedidos_model->get_pedido_by_posicao($posicao - 1);

        foreach ($qry as $row):
            $idpedido_anterior = $row->IDPEDIDO;
        endforeach;

        $this->Pedidos_model->update_pedido_posicao($idpedido_anterior, $posicao);
        $this->Pedidos_model->update_pedido_posicao($idpedido, $posicao - 1);

        $this->pedidos_a_fazer();
    }

    public function mover_para_baixo($idpedido, $posicao) {
        $this->load->model('Pedidos_model');

        $qry = $this->Pedidos_model->get_pedido_by_posicao($posicao + 1);

        foreach ($qry as $row):
            $idpedido_posterior = $row->IDPEDIDO;
        endforeach;

        $this->Pedidos_model->update_pedido_posicao($idpedido_posterior, $posicao);
        $this->Pedidos_model->update_pedido_posicao($idpedido, $posicao + 1);

        $this->pedidos_a_fazer();
    }

    public function salva_itens($idpedido) {
        $this->load->model('Pedidos_model');

        $itens = $this->input->post('itens');
				$email = $this->input->post('email');

        if ($itens != '') {
            $this->Pedidos_model->update_pedido_itens($idpedido, $itens, $email);
        }

         $this->pedidos_a_fazer();
    }

    public function novo_pedido() {
		$layout['titulo'] = 'Novo Pedido';
		$this->load->view('novo_pedido', $layout);
    }

    public function salva_novo_pedido() {
        $this->load->model('Pedidos_model');

        $codigo = $this->input->post('codigo');
        $itens = $this->input->post('itens');
        $tipo_frete = $this->input->post('tipo_frete');
        $valor_frete = $this->input->post('valor_frete');
        $valor_total = $this->input->post('valor_total');

        if ($valor_frete == '')
            $valor_frete = 0;

        if ($valor_total == '')
            $valor_total = 0;

        $idpedido = $this->Pedidos_model->insert_pedido($codigo, $itens, $tipo_frete, $valor_frete, $valor_total);
        $qry =  $this->Pedidos_model->get_ultima_posicao();

        foreach ($qry as $row):
            $posicao = $row->ultima_posicao;
        endforeach;

        $this->Pedidos_model->insert_pedidospos($idpedido, ($posicao +1));

        $this->index();

    }

    public function marcar_como_feito($idpedido, $posicao){
    	$this->remove_item_fila($idpedido, $posicao);

    	$this->pedidos_a_fazer();
    }

    private function remove_item_fila($idpedido, $posicao) {
    	$this->load->model('Pedidos_model');

    	$qry = $this->Pedidos_model->get_pedidos_from_position($idpedido, $posicao);

    	foreach ($qry as $row):
    		$this->Pedidos_model->update_pedido_posicao($row->IDPEDIDO, ($row->POSICAO - 1));
    	endforeach;

    	$this->Pedidos_model->update_pedido_status($idpedido, 'PEDIDO_ENVIADO');
    	$this->Pedidos_model->delete_tblpedidospos($idpedido);
    	$this->Pedidos_model->insert_tblpedidoshis($idpedido, 'PAGO_ESPERANDO_VENDEDOR', 'PEDIDO_ENVIADO', 'U', 'STATUS_ELO7');
    }

    public function teste() {
    	$this->load->model('Pedidos_model');

       	$idpedido = $this->Pedidos_model->teste();
       	echo $idpedido;
    }

		public function grafico_vendas() {
				$this->load->model('Pedidos_model');
				$qrygrafico = $this->Pedidos_model->get_grafico_vendas();

				// monta as arrays com todos os meses zerados
				$data2016_valor_total = Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
				$data2016_qtd_pedidos = Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
				$data2017_valor_total = Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
				$data2017_qtd_pedidos = Array(0,0,0,0,0,0,0,0,0,0,0,0,0);

				foreach ($qrygrafico as $row):
					// carrega os valores de 2016
					if ($row->ANO == 2016) {
							$data2016_valor_total[($row->MES - 1)] = (float)$row->VALOR_TOTAL;
							$data2016_qtd_pedidos[($row->MES - 1)] = (int)$row->TOTAL_PEDIDOS;
					}

					// carrega os valores de 2017
					if ($row->ANO == 2017) {
							$data2017_valor_total[($row->MES - 1)] = (float)$row->VALOR_TOTAL;
							$data2017_qtd_pedidos[($row->MES - 1)] = (int)$row->TOTAL_PEDIDOS;
					}
		  	endforeach;

				$layout['data2016_valor_total'] = $data2016_valor_total;
				$layout['data2016_qtd_pedidos'] = $data2016_qtd_pedidos;
				$layout['data2017_valor_total'] = $data2017_valor_total;
				$layout['data2017_qtd_pedidos'] = $data2017_qtd_pedidos;
				$layout['titulo'] = 'Gráfico de Vendas';
				//
				$this->load->view('grafico_vendas', $layout);
		}

}
