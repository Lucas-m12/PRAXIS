<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

   
 
    public function verificaUsuario($login=null, $status){
       
		  $this->db
		  ->select('ID_USUARIO, ID_UNIDADE, DS_LOGIN_USUARIO, DS_SENHA_USUARIO, ID_NIVEL_ACESSO,
		   ID_PROFISSIONAL, ALTERA_SENHA, CK_SELECT, CK_INSERT, CK_UPDATE, CK_DELETE, CK_FILE
		  	')
		  ->from('USUARIO_ADMINISTRATIVO')
		  ->where('DS_LOGIN_USUARIO', $login)
		  ->where('STATUS', $status);
		
		   $sql = $this->db->get();
          
		   if($sql->num_rows()>0){
		   	 return $sql->row();
		   }else{
		   	 return NULL;
		   }
         
	}


	
    public function listaEmpresa(){
       
		  $this->db
		  ->select('ID_EMPRESA, DS_EMPRESA, CNPJ, SECRETARIA_EDUCACAO, NOME_SISTEMA, NOME_UF, STATUS
		  	')
		  ->from('EMPRESA');
		  
		   $sql = $this->db->get();
          
		   if($sql->num_rows()>0){
		   	 return $sql->row();
		   }else{
		   	 return NULL;
		   }
	}


	public function salvaLogin($idUnidade, $idUsuario){
        
       	$dados = array(
				'ID_UNIDADE' => $idUnidade,
				'ID_USUARIO' => $idUsuario,
				'DS_ACAO' => 'LOGIN',
				'DATA_ACESSO' => date('Y-m-d H:i:s'),
				'IP_ACESSO' => getenv("REMOTE_ADDR")
				);
		
		$this->db->insert('AUDITOR_ACESSOS', $dados);
  	   
	}

	public function dadosUsuario($idUsuario){
       
		$sql = $this->db->query("SELECT u.ID_NIVEL_ACESSO, u.ID_PROFISSIONAL, p.NOME_PROFISSIONAL, e.INEP_ESCOLA, e.NOME_ESCOLA, a.DATA_ACESSO FROM USUARIO_ADMINISTRATIVO u INNER JOIN UNIDADE_ENSINO_00 e ON u.ID_UNIDADE = e.ID_ESCOLA INNER JOIN PROFISSIONAL_30 p ON u.ID_PROFISSIONAL = p.ID_PROFISSIONAL INNER JOIN AUDITOR_ACESSOS a ON u.ID_USUARIO = a.ID_USUARIO WHERE u.ID_USUARIO = '".$idUsuario."' ORDER BY a.ID_AUDITORIA DESC LIMIT 1 ");
		
		return $sql->row();  
           
	}

 
	


 




 

}
