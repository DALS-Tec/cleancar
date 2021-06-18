<?php 

defined('BASEPATH') OR exit ('Ação não permitida');

class Placa extends CI_Controller{
	public function index(){

		$data = array(
			'titulo' => 'Placa',
		);

		$this->load->view('layout/header', $data);
		$this->load->view('placa/index');
		$this->load->view('layout/footer');

	}

	public function buscar() {
		
	}

}
