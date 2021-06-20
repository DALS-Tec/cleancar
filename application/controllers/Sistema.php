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
			'titulo' => 'Editar informações do sistema',
			'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1 /* pedindo 1 pois existe apenas 1 registro*/))
		);

		// echo '<pre>';
		// print_r($data['sistema']);
		// exit();

		$this->load->view('layout/header', $data);
		$this->load->view('sistema/index');
		$this->load->view('layout/footer');
		
	}

}