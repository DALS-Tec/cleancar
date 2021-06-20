<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		// se nao estiver logado ele redireciona para tela de login
		if (!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	public function index() {

		$data = array(
			'titulo' => 'Editar informações do sistema'
		);

		$this->load->view('layout/header', $data);
		$this->load->view('sistema/index');
		$this->load->view('layout/footer');
		
	}

}