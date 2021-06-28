<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller
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

            'titulo' => 'Categorias cadastrados',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),

            // pelo core model que pegamos as tabelas do banco de dados
            'categorias' => $this->core_model->get_all('categorias'), // recupera todos os categorias
        );
        

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }

	public function add() {

		$this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[1]|max_length[45]|is_unique[categorias.categoria_nome]');

		if($this->form_validation->run()) {

			$data = elements(
				array(
					'categoria_nome',
					'categoria_ativa'
				), $this->input->post()
			);

			// remover dados com potenciais de ibjeção maliciosa
			$data = html_escape($data); 
			
			$this->core_model->insert('categorias' ,$data);

			redirect('categorias');
			
		} else {


			// erro de validacao

			$data = array(

				'titulo' => 'Cadastrar categoria',
	
				'scripts' => array(
					'vendor/mask/jquery.mask.min.js',
					'vendor/mask/app.js'
				),
			);
			
			$this->load->view('layout/header', $data);
			$this->load->view('categorias/add');
			$this->load->view('layout/footer');	
		}
		
	}
	
	public function edit($categoria_id = NULL, $data = NULL) {

		if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){

			$this->session->set_flashdata('error', 'Categoria não encontrado');
			redirect('categorias');

		} else {

			$this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[1]|max_length[45]|callback_check_categoria_nome');

			if($this->form_validation->run()) {

				$categoria_ativa = $this->input->post('categoria_ativa');
				if($this->db->table_exists('produtos')) {

					if($categoria_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_categoria_id' => $categoria_id, 'produto_ativo' => 1))){
						
						$this->session->set_flashdata('info', 'Essa categoria não pode ser desativada pois está sendo utilizada em "Produtos"');
						redirect('categorias');

					}
					
				}

				$data = elements(
					array(
						'categoria_nome',
						'categoria_ativa'
					), $this->input->post()
				);

				// remover dados com potenciais de ibjeção maliciosa
				$data = html_escape($data); 
				
				$this->core_model->update('categorias' ,$data, array('categoria_id' => $categoria_id));

				redirect('categorias');
				
			} else {


				// erro de validacao

				$data = array(

					'titulo' => 'Atualizar categoria',
		
					'scripts' => array(
						'vendor/mask/jquery.mask.min.js',
						'vendor/mask/app.js'
					),
					'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id ))
				);
	
				// echo '<pre>';
				// print_r($data['categoria']);
				// exit();
				
				$this->load->view('layout/header', $data);
				$this->load->view('categorias/edit');
				$this->load->view('layout/footer');	
			}
			
		}
		
	}
	
	public function check_categoria_nome($categoria_nome) {

		$categoria_id = $this->input->post('categoria_id');

		// se o categoria_nome == categoria onde o categoria_id for diferente do categoria_id return false
		if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id ))) {
			
			$this->form_validation->set_message('check_categoria_nome', 'Essa categoria já existe');

			return FALSE;
		} else {

			return TRUE;
		}
		
	}

	public function del($categoria_id = NULL) {

		if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {

			$this->session->set_flashdata('error', 'Categoria não encontrado');
			redirect('categorias');
		
		} else {

			$this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
			redirect('categorias');
		}
		
	}
}
