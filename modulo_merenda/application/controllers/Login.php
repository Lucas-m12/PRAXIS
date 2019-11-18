<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
       parent::__construct();
 
   }

	public function autenticarUsuario() {
    
    $this->load->model('login_model', 'login');
        
    $this->load->library('form_validation');
    $this->form_validation->set_rules('login', 'Usuário', 'required', array('required' => 'Você deve preencher o %s.'));
    $this->form_validation->set_rules('password', 'Senha', 'required', array('required' => 'Você deve preencher a %s.'));


    if ($this->form_validation->run() == FALSE) {
           $erros = array('mensagens' => validation_errors());
           $this->load->view('login-view', $erros);
    } else {
           $login = $this->input->post('login');
           $senha = $this->input->post('password');
           $status = 1; 
           $sql = $this->login->verificaUsuario($login, $status);

           if($sql){
            $loginUsuario = $sql->DS_LOGIN_USUARIO;
            $hash = $sql->DS_SENHA_USUARIO;
            $idUsuario = $sql->ID_USUARIO;
            $idUnidade = $sql->ID_UNIDADE;

            $this->login->salvaLogin($idUnidade, $idUsuario);

              if(password_verify($senha, $hash)){
                //carrega array de dados do usuario para criar sessões
                $dataUser = array(
                'ID_USUARIO'  => $sql->ID_USUARIO,
                'ID_UNIDADE'  => $sql->ID_UNIDADE,
                'ID_NIVEL_ACESSO' => $sql->ID_NIVEL_ACESSO,
                'ID_PROFISSIONAL' => $sql->ID_PROFISSIONAL,
                'ALTERA_SENHA' => $sql->ALTERA_SENHA,
                'select' => $sql->CK_SELECT,
                'insert' => $sql->CK_INSERT,
                'CK_UPDATE' => $sql->CK_UPDATE,
                'CK_DELETE' => $sql->CK_DELETE,
                'CK_FILE' => $sql->CK_FILE,
                'logado' => TRUE
                );

                $this->session->set_userdata($dataUser);

                //carrega array de dados do usuario e unidade para criar sessões
                $stmt = $this->login->dadosUsuario($idUsuario);
                $dataProf = array(
                'momeProfissional'  => $stmt->NOME_PROFISSIONAL,
                'idProfissional'  => $stmt->ID_PROFISSIONAL,
                'inepEscola' => $stmt->INEP_ESCOLA,
                'nomeEscola' => $stmt->NOME_ESCOLA,
                'dataAcesso' => date("d/m/Y H:i:s", strtotime($stmt->DATA_ACESSO))
                
                );
                
                //cria sessão
                $this->session->set_userdata($dataProf);

                redirect('inicio');
          
              }else{
                  $this->session->set_flashdata('error','Senha inválida!');
                  redirect('login');
              }
             
           }else{
              $this->session->set_flashdata('error','Login inválido!');
              redirect('login');
           }
           

    }


	}


 






}
