<?php

	defined('BASEPATH') or exit('Ação não permitida');

	class Core_model extends CI_Model {

		// função que vai recuperar todos os dados da tabela que será passada
		public function get_all($tabela = NULL, $condicao = NULL) {

			if($tabela) {
				
				if(is_array($condicao)) {

					$this->db->where($condicao);
					
				}

				return $this->db->get($tabela)->result();

			} else {
				return FALSE;
			}

		}

		// função que vai recuperar somente um dado da tabela que será passada
		public function get_by_id($tabela = NULL, $condicao = NULL) {

			if($tabela && is_array($condicao)) {

				$this->db->where($condicao);
				$this->db->limit(1);

				return $this->db->get($tabela)->row();

			} else {

				return FALSE;

			}
			
		} 

		// função que vai inserir os dados na tabela
		public function insert($tabela = NULL. $data = NULL, $get_last_id = NULL) {

			if ($tabela && is_array($data)) {

				$this->db->insert($tabela, $data);

				if ($get_last_id) {

					// função do codeignter para recuperar o ultimo id que foi inserido 
					$this->session->set_userdata('last_id', $this->db->insert_id());
					
				}

				// condicao para saber se salvou ou nao os dados
				if ($this->db->affected_rows() > 0) {

					$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
					
				} else {

					$this->session->set_flashdata('error', 'Erro ao salvar dados');
					
				}
				
			} else {

			}

		}

		// função que vai atualizar os dados da tabela
		public function update($tabela = NULL, $data = NULL, $condicao = NULL) {
			if ($tabela && is_array($data) && is_array($condicao)) {

				if ($this->db->update($tabela, $data, $condicao)) {
					$this->session->set_flashdata('sucesso', 'Dados atualizado com sucesso');
				} else {
					$this->session->set_flashdata('error', 'Erro ao atualizar os dados');
				}

			} else {

				return FALSE;
				
			}
		}

		// função que vai deletar os dados da tabela
		public function delete($tabela = NULL, $data = NULL) {

			$this->db->db_debug = FALSE;

			if ($tabela && is_array($condicao)) {

				// instrução para nao deixar deletar arquivos em outra tabela 
				$status = $this->db->delete($tabela, $condicao);

				$error = $this->db->error();

				if (!$status) {

					foreach ($error as $code) {

						if ($code == 1451) {

							$this->session->set_flashdata('error', 'Esse registro não pode ser excluído pois está sendo utilizado em outra tabela')

						}
						
					}
					
				} else {
					$this->session->set_flashdata('sucesso', 'Registro excluído com sucesso')
				}

				$this->db->db_debug = TRUE;
				
			} else {

				return FALSE;
				
			}
			
		}
		
	}
