<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ws extends CI_Controller {
	/*
	function Ws()
	{
		parent::Controller();
	}*/
	
	function teste() {
		$usuario = '';
		$senha = '';
		
/*		if (isset($_POST['usuario'])) {
			$usuario = $_POST['usuario'];
		}
		
		if (isset($_POST['senha'])) {
			$senha = $_POST['senha'];
		}
			
		if ($this->validaAcesso($usuario, $senha)) {*/
			$this->load->model('Ws_model');
			echo $this->Ws_model->teste();
	/*	} else {
			echo 'login inválido';
		}*/
	}	
	
	public function validaAcesso($usuario, $senha) {
		
		$this->load->model('Login_model');		
		return  $this->Login_model->get_usuario_senha($usuario, md5($senha));		
	}
	
}