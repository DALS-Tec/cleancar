<?php

	defined('BASEPATH') OR exit('Ação não permitida');

	class Usuarios extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			

			// definir se há sessão
		}

		public function index() {

			$data = array(

				'titulo' => 'Usuários cadastrados',

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

		public function add() {
		
			$this->form_validation->set_rules('first_name', '', 'trim|required');
			$this->form_validation->set_rules('last_name', '', 'trim|required');

			$this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]'); // is_unique[tabela.coluna] - verifica se é unico recebendo como parametro o nome da tabela e a coluna 
			$this->form_validation->set_rules('username', '', 'trim|required|is_unique[users.username]');
			$this->form_validation->set_rules('password', 'Senha', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('confirm_password', 'Confirme', 'required|matches[password]');

			// codigo para verificar se o formulário enviado foi validado de forma correta baseado nas regras setadas
			if($this->form_validation->run()) {

				$username = $this->security->xss_clean($this->input->post('username'));
				$password = $this->security->xss_clean($this->input->post('password'));
				$email = $this->security->xss_clean($this->input->post('email'));
				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'username' => $this->input->post('username'),
					'active' => $this->input->post('active'),
				);
				$group = array($this->input->post('perfil_usuario')); // Sets user to admin.

				$additional_data = $this->security->xss_clean($additional_data);

				$group = $this->security->xss_clean($group);
			
				if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
					$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
				} else {
					$this->session->set_flashdata('error', 'Não foi possível salvar os dados');
				}

				redirect('usuarios');

			} else {
				$data = array(
					'titulo' => 'Cadastrar usuário',
				);
				$this->load->view('layout/header', $data);
				$this->load->view('usuarios/add');
				$this->load->view('layout/footer');
			}
			
		}

		public function edit($usuario_id = NULL) {



			if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {

				$this->session->set_flashdata('error', 'Usuário não encontrado');
				redirect('usuarios');


			} else {

				/*	
				[first_name] => Admin
				[last_name] => istrator
				[email] => admin@admin.com
				[username] => administrator
				[active] => 1
				[perfil_usuario] => 1
				[password] => 
				[confirm_password] => 
				[usuario_id] => 1
				*/
				
				$this->form_validation->set_rules('first_name', '', 'trim|required');
				$this->form_validation->set_rules('last_name', '', 'trim|required');
				$this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
				$this->form_validation->set_rules('username', '', 'trim|required|callback_username_check');
				$this->form_validation->set_rules('password', 'Senha', 'min_length[5]|max_length[255]');
				$this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');

				if ($this->form_validation->run()) {

					$data = elements(
						
						array(
							'first_name',
							'last_name',
							'email',
							'username',
							'active',
							'password'
						), $this->input->post()

					);

					$data = $this->security->xss_clean($data);

					// script que foi verificar se foi passado uma nova senha
					$password = $this->input->post('password');

					//
					if (!$password) {

						unset($data['password']);
						
					}

					
					if ($this->ion_auth->update($usuario_id, $data)) {

						$perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();

						$perfil_usuario_post = $this->input->post('perfil_usuario');

						// Se for diferente atualiza o grupo
						if($perfil_usuario_post != $perfil_usuario_db->id) {

							$this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
							$this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);
							
						}
	
						$this->session->set_flashdata('sucesso', 'Dados salvo com sucesso');
						
					} else {
						
						$this->session->set_flashdata('error', 'Erro ao salvar os dados');

					}
					redirect('usuarios');
				} else {
					$data = array(
				
						'titulo' => 'Editar usuário',
		
						'usuario' => $this->ion_auth->user($usuario_id)->row(),
	
						'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row()
					);
	
					// echo '<pre>';
					// print_r($this->input->post());
					// exit();
	
					$this->load->view('layout/header', $data);
					$this->load->view('usuarios/edit');
					$this->load->view('layout/footer');
				}
				
				
			}	
		}

		public function del($usuario_id = NULL) {
			if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
				$this->session->set_flashdata('error', 'Usuário não encontrado');
				redirect('usuarios');
			}

			if ($this->ion_auth->is_admin($usuario_id)) {
				$this->session->set_flashdata('error', 'O Administrador não pode ser excluído');
				redirect('usuarios');
			}

			if ($this->ion_auth->delete_user($usuario_id)) {
				$this->session->set_flashdata('sucesso', 'Usuário excluído com sucesso');
				redirect('usuarios');
			} else {
				$this->session->set_flashdata('error', 'Erro ao excluir o usuário');
				redirect('usuarios');
			}
		}
		public function email_check($email) {

			$usuario_id = $this->input->post('usuario_id');
			
			if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {

				$this->form_validation->set_message('email_check', 'Esse e-mail já existe');

				return FALSE;

			} else {

				return TRUE;

			}			
		}

		public function username_check($username) {

			$usuario_id = $this->input->post('usuario_id');
			
			if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {

				$this->form_validation->set_message('username_check', 'Esse usuário já existe');

				return FALSE;

			} else {
				return TRUE;
			}
			
			
		}

	}
