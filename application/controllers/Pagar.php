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
        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
            $this->session->set_flashdata('error', 'Conta não encontrada');
            redirect('pagar');
        } else {

            $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
            $this->form_validation->set_rules('conta_pagar_data_vencimento', '', 'required');
            $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
            $this->form_validation->set_rules('conta_pagar_obs', 'Observações', 'max_length[100]');

            if ($this->form_validation->run()) {
                $data = elements(
                    array(
                            'conta_pagar_fornecedor_id',
                            'conta_pagar_data_vencimento',
                            'conta_pagar_valor',
                            'conta_pagar_status',
                            'conta_pagar_obs',
                        ),
                    $this->input->post()
                );
                    

                $conta_pagar_status = $this->input->post('conta_pagar_status');

                if ($conta_pagar_status == 1) {
                    $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
                }
                    
                $data = html_escape($data);

                $this->core_model->update('contas_pagar', $data, array('conta_pagar_id' => $conta_pagar_id));

                redirect('pagar');
            } else {

                    //erro de validacao

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

	public function add() {
        
		$this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
		$this->form_validation->set_rules('conta_pagar_data_vencimento', '', 'required');
		$this->form_validation->set_rules('conta_pagar_valor', '', 'required');
		$this->form_validation->set_rules('conta_pagar_obs', 'Observações', 'max_length[100]');

		if ($this->form_validation->run()) {
			$data = elements(
				array(
						'conta_pagar_fornecedor_id',
						'conta_pagar_data_vencimento',
						'conta_pagar_valor',
						'conta_pagar_status',
						'conta_pagar_obs',
					),
				$this->input->post()
			);
				

			$conta_pagar_status = $this->input->post('conta_pagar_status');

			if ($conta_pagar_status == 1) {
				$data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
			}
				
			$data = html_escape($data);

			$this->core_model->insert('contas_pagar', $data);

			redirect('pagar');
		} else {

				//erro de validacao

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
					'fornecedores' => $this->core_model->get_all('fornecedores'),
			);
		
		
			$this->load->view('layout/header', $data);
			$this->load->view('pagar/add');
			$this->load->view('layout/footer');
		}
    }
		
	
}
