<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
       parent::__construct();
       $this->load->model('login_model', 'login');
   }

	
	public function index() {

    $this->session->unset_userdata('logado');
		$sql= $this->login->listaEmpresa();

		if($sql){
            $dataEmpresa = array(
                'id_empresa'  => $sql->ID_EMPRESA,
                'empresa'  => $sql->DS_EMPRESA,
                'cnpj' => $sql->CNPJ,
                'secretaria' => $sql->SECRETARIA_EDUCACAO,
                'sistema' => $sql->NOME_SISTEMA
            );

            $this->session->set_userdata($dataEmpresa);
        }

		$this->load->view('login-view');

	}


	public function inicio(){
    if($this->session->userdata('logado')){}else {redirect('login');}
		$data['page']  = 'inicio-view';
		$this->load->view('template/main-view', $data);
	}

  public function logoff(){
    $this->session->sess_destroy();
    redirect('login');
  }
	


}
