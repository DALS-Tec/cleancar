<?php

	defined('BASEPATH') OR exit ('Ação não permitida');

	class Home extends CI_Controller {
		
		public function __construct() 
		{
			parent::__construct();

			// se não há sessao
			if (!$this->ion_auth->logged_in()) {
				$this->session->set_flashdata('info', 'Sua sessão expirou');
				redirect('login');
			}

		}

		public function index() {

			redirect('sistema');
			
		}
		
	}
