<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Racas_model extends CI_Model {

   
   	//No padrão do CI
    public function getRacas($id = null){
		
		if($id){
		  $this->db->where('ID_COR', $id);
		}
		$this->db->order_by("ID_COR", 'desc');
		$query = $this->db->get('COR_RACA');
  	    return $query->result();
	}

    //Com consulta no código
	public function getRacas2(){
		$stmt = $this->db->query('SELECT * FROM COR_RACA WHERE ID_COR = 2');
  	    return $stmt->result();
	}

}
