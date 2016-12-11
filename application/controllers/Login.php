<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $dados['erro'] = '';
        $dados['titulo'] = 'Pedidos';
		$this->load->view('v_login', $dados);
	}
	
	public function logar(){
		$this->load->model('Login_model');
		
		$usuario = $this->input->post("usuario");
		$senha = md5($this->input->post("senha"));
		
		
		$bResposta = $this->Login_model->get_usuario_senha($usuario, $senha);
			
		if ($bResposta == true) {
			$this->session->set_userdata("logado", 1);
			redirect(base_url('index.php/pedidos'));
		} else {
			$dados['erro'] = "Usuário/Senha incorretos";
			$dados['titulo'] = 'Pedidos';
			$this->load->view("v_login", $dados);
		}
	}

	public function logout(){
		$this->session->unset_userdata("logado");
		redirect(base_url('index.php'));
		
	}
	
}