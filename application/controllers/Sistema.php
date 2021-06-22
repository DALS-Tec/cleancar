<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		// se nao estiver logado ele redireciona para tela de login
		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'Sua sessão expirou');
			redirect('login');
		}
	}

	public function index() {

		$data = array(
			'titulo' => 'Editar informações do sistema',
			'scripts' => array(
				'vendor/mask/jquery.mask.min.js',
				'vendor/mask/app.js'
			),
			'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1 /* pedindo 1 pois existe apenas 1 registro*/))
		);

		$this->form_validation->set_rules('sistema_razao_social', '','required|max_length[145]');
		$this->form_validation->set_rules('sistema_nome_fantasia', '','required|max_length[145]');
		$this->form_validation->set_rules('sistema_cnpj', 'CNPJ','required|exact_length[18]');
		$this->form_validation->set_rules('sistema_ie', '','required|max_length[25]');
		$this->form_validation->set_rules('sistema_telefone_fixo', '','required|max_length[25]');
		$this->form_validation->set_rules('sistema_telefone_movel', '','required|max_length[25]');
		$this->form_validation->set_rules('sistema_email', 'E-mail','required|valid_email|max_length[100]');
		$this->form_validation->set_rules('sistema_site_url', 'URL do site','required|valid_url|max_length[100]');
		$this->form_validation->set_rules('sistema_cep', 'CEP','required|exact_length[8]');
		$this->form_validation->set_rules('sistema_endereco', 'Endereço', 'required|max_length[145]');
		$this->form_validation->set_rules('sistema_numero', 'Número', 'max_length[25]');
		$this->form_validation->set_rules('sistema_cidade', 'Cidade', 'required|max_length[45]');
		$this->form_validation->set_rules('sistema_estado', 'Estado', 'required|exact_length[2]');
		$this->form_validation->set_rules('sistema_txt_ordem_servico', 'Sobre', 'max_length[500]');

		if($this->form_validation->run()) {

			/*
				[sistema_id] => 1
				[sistema_razao_social] => Clean Car Inc
				[sistema_nome_fantasia] => Clean Car
				[sistema_cnpj] => 02.029.882/0001-43
				[sistema_ie] => 
				[sistema_telefone_fixo] => 11964482964
				[sistema_telefone_movel] => 
				[sistema_email] => cleancar@contato.com
				[sistema_site_url] => http://localhost/cleancar/
				[sistema_cep] => 02969100
				[sistema_endereco] => Rua Arnaldo Alvernaz Nunes, 54
				[sistema_numero] => 
				[sistema_cidade] => São Paulo
				[sistema_estado] => SP
				[sistema_txt_ordem_servico] => Texto Clean Car
				[sistema_data_alteracao] => 2021-06-20 16:22:40
			*/

			$data = elements(

				array(
					
					'sistema_razao_social',
					'sistema_nome_fantasia',
					'sistema_cnpj',
					'sistema_ie',
					'sistema_telefone_fixo',
					'sistema_telefone_movel',
					'sistema_email',
					'sistema_site_url',
					'sistema_cep',
					'sistema_endereco',
					'sistema_numero',
					'sistema_cidade',
					'sistema_estado',
					'sistema_txt_ordem_servico'

				), $this->input->post()
				
			);

			// camada de proteção para caso de injeção em html, em casos de inserts ou updates
			$data = html_escape($data);

			$this->core_model->update('sistema', $data, array('sistema_id' => 1));

			redirect('sistema');
			
		} else {

			// erro de validacao

			$this->load->view('layout/header', $data);
			$this->load->view('sistema/index');
			$this->load->view('layout/footer');
		}
		
	}

}
