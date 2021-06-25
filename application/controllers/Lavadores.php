<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Lavadores extends CI_Controller {

    public function __construct(){
        parent::__construct();

        // se nao estiver logado ele redireciona para tela de login
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }

    public function index() {
        $data = array(

            'titulo' => 'Lavadores cadastrados',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),

            // pelo core model que pegamos as tabelas do banco de dados
            'lavadores' => $this->core_model->get_all('lavadores'), // recupera todos os lavadores
        );
        
		// Apenas debug
		// echo '<pre>';
		// print_r($data['lavadores']);
		// exit();
		
        $this->load->view('layout/header', $data);
        $this->load->view('lavadores/index');
        $this->load->view('layout/footer');
    }
	
	public function edit($lavador_id = NULL, $data = NULL) {

		if(!$lavador_id || !$this->core_model->get_by_id('lavadores', array('lavador_id' => $lavador_id))) {

			$this->session->set_flashdata('error', 'lavador não encontrado');
			redirect('lavadores');

		} else {

			$this->form_validation->set_rules('lavador_nome_completo', '', 'trim|required|max_length[200]');
			
			$this->form_validation->set_rules('lavador_cpf', '', 'trim|required|exact_length[14]|callback_valida_cpf');
			$this->form_validation->set_rules('lavador_rg', '', 'trim|max_length[20]|callback_check_lavador_rg');
			$this->form_validation->set_rules('lavador_email', '', 'trim|valid_email|max_length[50]|callback_check_lavador_email');
			$this->form_validation->set_rules('lavador_telefone', '', 'trim|max_length[14]|callback_check_lavador_telefone');
			$this->form_validation->set_rules('lavador_celular', '', 'trim|max_length[15]|callback_check_lavador_celular');

			$this->form_validation->set_rules('lavador_cep', '', 'trim|required|max_length[10]');
			$this->form_validation->set_rules('lavador_endereco', '', 'trim|required|max_length[155]');
			$this->form_validation->set_rules('lavador_endereco', '', 'trim|max_length[155]');
			$this->form_validation->set_rules('lavador_numero_endereco', '', 'trim|max_length[20]');
			$this->form_validation->set_rules('lavador_bairro', '', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('lavador_complemento', '', 'trim|max_length[145]');
			$this->form_validation->set_rules('lavador_cidade', '', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('lavador_estado', '', 'trim|required|exact_length[2]');
			$this->form_validation->set_rules('lavador_obs', '', 'trim|max_length[500]');

			if($this->form_validation->run()) {

				$data = elements(
					array(
						'lavador_codigo',
						'lavador_nome_completo',
						'lavador_cpf',
						'lavador_rg',
						'lavador_email',
						'lavador_telefone',
						'lavador_celular',
						'lavador_cep',
						'lavador_endereco',
						'lavador_numero_endereco',
						'lavador_complemento',
						'lavador_bairro',
						'lavador_cidade',
						'lavador_estado',
						'lavador_ativo',
						'lavador_obs',
					), $this->input->post()
				);

				// formatar a UF para maiuscula ao enviar no banco de dados
				$data['lavador_estado'] = strtoupper($this->input->post('lavador_estado'));

				// remover dados com potenciais de ibjeção maliciosa
				$data = html_escape($data); 
				
				$this->core_model->update('lavadores' ,$data, array('lavador_id' => $lavador_id));

				redirect('lavadores');
				
			} else {


				// erro de validacao

				$data = array(

					'titulo' => 'Atualizar lavador',
		
					'scripts' => array(
						'vendor/mask/jquery.mask.min.js',
						'vendor/mask/app.js'
					),
					'lavador' => $this->core_model->get_by_id('lavadores', array('lavador_id' => $lavador_id ))
				);
	
				// echo '<pre>';
				// print_r($data['lavador']);
				// exit();
				
				$this->load->view('layout/header', $data);
				$this->load->view('lavadores/edit');
				$this->load->view('layout/footer');	
			}
			
			
		}
		
	}

	public function check_lavador_rg($lavador_rg) {

		$lavador_id = $this->input->post('lavador_id');

		if($this->core_model->get_by_id('lavadores', array('lavador_rg' => $lavador_rg, 'lavador_id !=' => $lavador_id))) {

			$this->form_validation->set_message('check_lavador_rg', 'Essa inscrição estadual já existe');
			
			return FALSE;
		} else {

			return TRUE;
		}
		
	}

	public function check_lavador_email($lavador_email) {

		$lavador_id = $this->input->post('lavador_id');

		if($this->core_model->get_by_id('lavadores', array('lavador_email' => $lavador_email, 'lavador_id !=' => $lavador_id))) {

			$this->form_validation->set_message('check_lavador_email', 'Esse e-mail já existe');
			
			return FALSE;
		} else {

			return TRUE;
		}
		
	}

	public function check_lavador_telefone($lavador_telefone) {

		$lavador_id = $this->input->post('lavador_id');

		if($this->core_model->get_by_id('lavadores', array('lavador_telefone' => $lavador_telefone, 'lavador_id !=' => $lavador_id))) {

			$this->form_validation->set_message('check_lavador_telefone', 'Esse telefone já existe');
			
			return FALSE;
		} else {
			return TRUE;
		}	
	}

	public function check_lavador_celular($lavador_celular) {

		$lavador_id = $this->input->post('lavador_id');

		if($this->core_model->get_by_id('lavadores', array('lavador_celular' => $lavador_celular, 'lavador_id !=' => $lavador_id))) {

			$this->form_validation->set_message('check_lavador_celular', 'Esse celular já existe');
			
			return FALSE;
		} else {
			return TRUE;
		}	
	}

	public function valida_cpf($cpf) {

        if ($this->input->post('lavador_id')) {

            $lavador_id = $this->input->post('lavador_id');

            if ($this->core_model->get_by_id('lavadores', array('lavador_id !=' => $lavador_id, 'lavador_cpf' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    //$d += $cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
                    $d += $cpf[$c] * (($t + 1) - $c); // Para PHP com versão > 7.4
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

	public function del($lavador_id = NULL) {

		if(!$lavador_id || !$this->core_model->get_by_id('lavadores', array('lavador_id' => $lavador_id))) {

			$this->session->set_flashdata('error', 'lavador não encontrado');
			redirect('lavadores');
		
		} else {

			$this->core_model->delete('lavadores', array('lavador_id' => $lavador_id));
			redirect('lavadores');
		}
		
	}
	
}
