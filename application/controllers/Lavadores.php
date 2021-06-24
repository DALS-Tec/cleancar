<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Lavadores extends CI_Controller
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

    public function index()
    {
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
        
		echo '<pre>';
		print_r($data['lavadores']);
		exit();
		
        $this->load->view('layout/header', $data);
        $this->load->view('lavadores/index');
        $this->load->view('layout/footer');
    }
}
