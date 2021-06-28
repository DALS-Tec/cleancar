<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Marcas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // se nao estiver logado ele redireciona para tela de login
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }

    public function index(){
        $data = array(

            'titulo' => 'Marcas cadastrados',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),

            // pelo core model que pegamos as tabelas do banco de dados
            'marcas' => $this->core_model->get_all('marcas'), // recupera todos os marcas
        );
        

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');
    }

	public function add() {

		$this->form_validation->set_rules('marca_nome', '', 'trim|required|min_length[1]|max_length[45]|is_unique[marcas.marca_nome]');

		if($this->form_validation->run()) {

			$data = elements(
				array(
					'marca_nome',
					'marca_ativa'
				), $this->input->post()
			);

			// remover dados com potenciais de ibjeção maliciosa
			$data = html_escape($data); 
			
			$this->core_model->insert('marcas' ,$data);

			redirect('marcas');
			
		} else {


			// erro de validacao

			$data = array(

				'titulo' => 'Cadastrar marca',
	
				'scripts' => array(
					'vendor/mask/jquery.mask.min.js',
					'vendor/mask/app.js'
				),
			);
			
			$this->load->view('layout/header', $data);
			$this->load->view('marcas/add');
			$this->load->view('layout/footer');	
		}
		
	}
	
	public function edit($marca_id = NULL, $data = NULL) {

		if(!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {

			$this->session->set_flashdata('error', 'Marca não encontrado');
			redirect('marcas');

		} else {

			$this->form_validation->set_rules('marca_nome', '', 'trim|required|min_length[1]|max_length[45]|callback_check_marca_nome');

			if($this->form_validation->run()) {

				$marca_ativa = $this->input->post('marca_ativa');
				if($this->db->table_exists('produtos')) {

					if($marca_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_marca_id' => $marca_id, 'produto_ativo' => 1))){
						
						$this->session->set_flashdata('info', 'Essa marca não pode ser desativada pois está sendo utilizada em "Produtos"');
						redirect('marcas');

					}
					
				}

				$data = elements(
					array(
						'marca_nome',
						'marca_ativa'
					), $this->input->post()
				);

				// remover dados com potenciais de ibjeção maliciosa
				$data = html_escape($data); 
				
				$this->core_model->update('marcas' ,$data, array('marca_id' => $marca_id));

				redirect('marcas');
				
			} else {


				// erro de validacao

				$data = array(

					'titulo' => 'Atualizar marca',
		
					'scripts' => array(
						'vendor/mask/jquery.mask.min.js',
						'vendor/mask/app.js'
					),
					'marca' => $this->core_model->get_by_id('marcas', array('marca_id' => $marca_id ))
				);
	
				// echo '<pre>';
				// print_r($data['marca']);
				// exit();
				
				$this->load->view('layout/header', $data);
				$this->load->view('marcas/edit');
				$this->load->view('layout/footer');	
			}
			
		}
		
	}

	public function check_marca_nome($marca_nome) {

		$marca_id = $this->input->post('marca_id');

		// se o marca_nome == marca onde o marca_id for diferente do marca_id return false
		if ($this->core_model->get_by_id('marcas', array('marca_nome' => $marca_nome, 'marca_id !=' => $marca_id ))) {
			
			$this->form_validation->set_message('check_marca_nome', 'Essa marca já existe');

			return FALSE;
		} else {

			return TRUE;
		}
		
	}

	public function del($marca_id = NULL) {

		if(!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {

			$this->session->set_flashdata('error', 'Marca não encontrado');
			redirect('marcas');
		
		} else {

			$this->core_model->delete('marcas', array('marca_id' => $marca_id));
			redirect('marcas');
		}
		
	}
}
