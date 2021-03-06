<?php
class Pedidos_model extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_vwpedidos() {
        $this->db->select('*,  DATE_FORMAT(DATA_PEDIDO,\'%d/%m/%Y\') AS DATA_PEDIDO2');
		$this->db->from('vwpedidospos');
        $this->db->where('STATUS_ELO7', 'PAGO_ESPERANDO_VENDEDOR');
		$this->db->order_by("POSICAO", "asc");

		$query = $this->db->get();

		return $query->result();
    }


    public function get_pedido_by_posicao($posicao) {
        $this->db->select('IDPEDIDO, POSICAO');
		$this->db->from('tblpedidospos');
        $this->db->where('POSICAO', $posicao);

		$query = $this->db->get();

		return $query->result();
    }

    public function update_pedido_posicao($idpedido, $posicao) {
        $data = array(
               'posicao' => $posicao);

        $this->db->where('idpedido', $idpedido);
        $this->db->update('tblpedidospos', $data);
    }

    public function update_pedido_itens($idpedido, $itens, $email) {
        $data = array(
               'itens' => $itens,
               'email' => $email);

        $this->db->where('idpedido', $idpedido);
        $this->db->update('tblpedidos', $data);
    }

    public function update_pedido_status($idpedido, $status) {
    	$data = array(
    			'STATUS_ELO7' => $status);

    	$this->db->where('idpedido', $idpedido);
    	$this->db->update('tblpedidos', $data);
    }

    public function insert_pedido($codigo, $itens, $tipo_frete, $valor_frete, $valor_total) {
        $data = array(
                'pedido_elo7' => $codigo,
                'status_elo7' => 'PAGO_ESPERANDO_VENDEDOR',
                'itens' => $itens,
                'tipo_frete' => $tipo_frete,
                'valor_frete' => $valor_frete,
                'valor_total' => $valor_total);
        $this->db->set('data_pedido', 'NOW()', FALSE);
        $this->db->insert('tblpedidos', $data);

        return $this->db->insert_id();
    }

    public function insert_pedidospos($idpedido, $posicao) {
        $data = array(
                'idpedido' => $idpedido,
                'posicao' => $posicao);

        $this->db->insert('tblpedidospos', $data);

        return $this->db->insert_id();
    }

    public function get_ultima_posicao() {
        $this->db->select('(select max(posicao) from tblpedidospos) as ultima_posicao');
        $this->db->from('tblpedidospos');
        $query = $this->db->get();

		return $query->result();
    }

    public function get_pedidos_from_position($idpedido, $posicao) {
    	$this->db->select('IDPEDIDO, POSICAO');
    	$this->db->from('tblpedidospos');
    	$this->db->where('POSICAO >', $posicao);
    	$this->db->order_by('POSICAO');

    	$query = $this->db->get();

    	return $query->result();
    }

    public function delete_tblpedidospos($idpedido) {
    	$this->db->where('IDPEDIDO', $idpedido);
    	$this->db->delete('tblpedidospos');
    }

    public function insert_tblpedidoshis($idpedido, $valor_antigo, $valor_novo, $tipo_alteracao, $campo) {
    	$data = array(
    			'IDPEDIDO' => $idpedido,
    			'VALOR_ANTIGO' => $valor_antigo,
    			'VALOR_NOVO' => $valor_novo,
    			'TIPO_ALTERACAO' => $tipo_alteracao,
    			'CAMPO' => $campo
    	);

    	$this->db->insert('tblpedidoshis', $data);
    }

    public function get_grafico_vendas() {
      $this->db->select('year(a.DATA_PEDIDO) AS ANO,
        month(a.DATA_PEDIDO) AS MES,
        count(a.IDPEDIDO) AS TOTAL_PEDIDOS,
        sum(a.VALOR_TOTAL) AS VALOR_TOTAL,
        cast((sum(a.VALOR_TOTAL) / nullif(count(a.IDPEDIDO), 0)) as decimal(15,2)) as VALOR_MEDIO_PEDIDO');
      $this->db->from('tblpedidos a');
      $this->db->join('tblstatuspedido b', ' on b.IDSTATUSPEDIDO = a.IDSTATUSPEDIDO');
      $this->db->where("b.CODIGO in ('PAGO_ESPERANDO_VENDEDOR', 'PEDIDO_ENVIADO') and 0 = ", 0);
      $this->db->group_by('month(a.DATA_PEDIDO),  year(a.DATA_PEDIDO)');
      $this->db->order_by('year(a.DATA_PEDIDO), month(a.DATA_PEDIDO)');

      $query = $this->db->get();

      return $query->result();
    }
}
?>
