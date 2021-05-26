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

		// função de insert de dados no db
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

		public function update($tabela = NULL, $data = NULL, $condicao = NULL) {
			if ($tabela && is_array($data));
		}

	}
