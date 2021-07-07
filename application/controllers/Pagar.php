<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Pagar extends CI_Controller{

    public function __construct(){
        parent::__construct();

        // se nao estiver logado ele redireciona para tela de login
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

		$this->load->model('financeiro_model');
    }

    public function index() {

        $data = array(

            'titulo' => 'Contas a pagar cadastradas',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),

            // pelo core model que pegamos as tabelas do banco de dados
            'contas_pagar' => $this->financeiro_model->get_all_pagar(), // recupera todos os contas_pagar
        );


        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');

    }

	public function edit($conta_pagar_id = NULL) {

		if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {

			$this->session->set_flashdata('error', 'Conta não encontrada');
			redirect('pagar');
			
		} else {

			if($this->form_validation->run()) {

				exit('Validado');
				
			} else {

				// form validation

				$data = array(

					'titulo' => 'Pagar cadastrados',
		
					'styles' => array(
						'vendor/select2/select2.min.css',
					),
		
					'scripts' => array(
						'vendor/select2/select2.min.js',
						'vendor/select2/app.js',
						'vendor/mask/jquery.mask.min.js',
						'vendor/mask/app.js',
					),
		
	
					'conta_pagar' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id)),
					'fornecedores' => $this->core_model->get_all('fornecedores'),
				);
		
		
				$this->load->view('layout/header', $data);
				$this->load->view('pagar/edit');
				$this->load->view('layout/footer');
				
			}

			
		}
		
	}
	
}
