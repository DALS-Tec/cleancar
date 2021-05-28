<?php

	defined('BASEPATH') OR exit('Ação não permitida');

	class Usuarios extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			

			// definir se há sessão
		}

		public function index() {

			$data = array(

				'styles' => array(
					'vendor/datatables/dataTables.bootstrap4.min.css',
				),

				'scripts' => array(
					'vendor/datatables/jquery.dataTables.min.js',
					'vendor/datatables/dataTables.bootstrap4.min.js',
					'vendor/datatables/app.js',
				),

				'usuarios' => $this->ion_auth->users()->result(), // recupera todos os usuarios
			);

			// echo '<pre>';
			// print_r($data['usuarios']);
			// exit();

			$this->load->view('layout/header', $data);
			$this->load->view('usuarios/index');
			$this->load->view('layout/footer');

		}
		
	}
