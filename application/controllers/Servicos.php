<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Servicos extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        // se nao estiver logado ele redireciona para tela de login
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }

    public function index(){
        $data = array(

            'titulo' => 'Serviços cadastrados',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),

            // pelo core model que pegamos as tabelas do banco de dados
            'servicos' => $this->core_model->get_all('servicos'), // recupera todos os servicos
        );
        

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

	public function edit($servico_id = NULL, $data = NULL) {

		if(!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {

			$this->session->set_flashdata('error', 'Serviço não encontrado');
			redirect('servicos');

		} else {

			$this->form_validation->set_rules('servico_nome', '', 'trim|required|max_length[145]|callback_check_servico_nome');
			$this->form_validation->set_rules('servico_preco', '', 'trim|required');
			$this->form_validation->set_rules('servico_descricao', '', 'trim|max_length[700]');

			if($this->form_validation->run()) {

				$data = elements(
					array(
						'servico_nome',
						'servico_preco',
						'servico_descricao',
						'servico_ativo'
					), $this->input->post()
				);

				// remover dados com potenciais de ibjeção maliciosa
				$data = html_escape($data); 
				
				$this->core_model->update('servicos' ,$data, array('servico_id' => $servico_id));

				redirect('servicos');
				
			} else {


				// erro de validacao

				$data = array(

					'titulo' => 'Atualizar serviço',
		
					'scripts' => array(
						'vendor/mask/jquery.mask.min.js',
						'vendor/mask/app.js'
					),
					'servico' => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id ))
				);
	
				// echo '<pre>';
				// print_r($data['servico']);
				// exit();
				
				$this->load->view('layout/header', $data);
				$this->load->view('servicos/edit');
				$this->load->view('layout/footer');	
			}
			
		}
		
	}

	public function add() {

		$this->form_validation->set_rules('servico_nome', '', 'trim|required|max_length[145]|is_unique[servicos.servico_nome]');
		$this->form_validation->set_rules('servico_preco', '', 'trim|required');
		$this->form_validation->set_rules('servico_descricao', '', 'trim|required|max_length[700]');

		if($this->form_validation->run()) {

			$data = elements(
				array(
					'servico_nome',
					'servico_preco',
					'servico_descricao',
					'servico_ativo'
				), $this->input->post()
			);

			// remover dados com potenciais de ibjeção maliciosa
			$data = html_escape($data); 
			
			$this->core_model->insert('servicos' ,$data);

			redirect('servicos');
			
		} else {


			// erro de validacao

			$data = array(

				'titulo' => 'Cadastrar serviço',
	
				'scripts' => array(
					'vendor/mask/jquery.mask.min.js',
					'vendor/mask/app.js'
				),
			);
			
			$this->load->view('layout/header', $data);
			$this->load->view('servicos/add');
			$this->load->view('layout/footer');	
		}
		
	}

	// função para checar se vai ser editado o mesmo nome para o serviço
	public function check_servico_nome($servico_nome) {

		$servico_id = $this->input->post('servico_id');

		// se o servico_nome == servico onde o servico_id for diferente do servico_id return false
		if ($this->core_model->get_by_id('servicos', array('servico_nome' => $servico_nome, 'servico_id !=' => $servico_id ))) {
			
			$this->form_validation->set_message('check_servico_nome', 'Esse serviço já existe');

			return FALSE;
		} else {

			return TRUE;
		}
		
	}

	public function del($servico_id = NULL) {

		if(!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {

			$this->session->set_flashdata('error', 'Serviço não encontrado');
			redirect('servicos');
		
		} else {

			$this->core_model->delete('servicos', array('servico_id' => $servico_id));
			redirect('servicos');
		}
		
	}
}
