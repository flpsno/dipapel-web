<?php
class Login_model extends CI_Model {
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    
    public function get_usuario_senha($usuario, $senha) {
        $this->db->select('*');
		$this->db->from('tblusuarios');
        $this->db->where('USUARIO', $usuario);
        $this->db->where('SENHA', $senha);      	
        
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
		
//		return $query->result();
    }


}
?>