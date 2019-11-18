<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
       parent::__construct();
       $this->load->library('parser');
   }

	
	public function index()
	{
		$this->load->view('autenticacao/view-login');
	}

	public function listaRaca($id)
	{
        $this->load->model('racas_model', 'obj_raca');
        $data['racas'] = $this->obj_raca->getRacas($id);
		$this->load->view('dados-view', $data);
		
	}


	public function data_submitted() {
        //exemplo de parse (envio de dados para view com array)
        $data1 = array(
        'blog_title' => 'My Blog Title',
        'blog_heading' => 'My Blog Heading'
		);
		$this->parser->parse('main-view', $data1); 


		//exemplo de envio de dados via post
		$data = array(
		'user_name' => $this->input->post('email'),
		'user_email_id' => $this->input->post('password')
		);
  
		$valor = $this->input->post('email');
        
        //exemplo de mensagem em flasch, chamando a rota home 
        $this->session->set_flashdata('error_msg', 'Email inválido!');
		redirect('home');

	}	








}
