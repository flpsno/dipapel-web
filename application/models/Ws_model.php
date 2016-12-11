<?php
class Ws_model extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    
    public function teste() {
    	header("Content-Type: application/json");
    	$this->db->select('*');
    	$this->db->from('tblpedidos');
    	$query = $this->db->get();

    	return json_encode($query->result());
    }


}
?>