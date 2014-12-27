<?php 


/**
* 
*/
class gtrSMS_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->database('gtr');
	}

		/**
	I N S E R T
	*/
	function getClienteIds($cel){
		
	}

		/**
	I N S E R T
	*/
	function setClienteSMS(){
		//$data = $this->input->post();

		$llamada = file_get_contents('php://input');
		//echo "<pre>"; print_r(json_decode($data, TRUE)); echo "</pre>";

		$data = json_decode($llamada, true);
		//echo "<pre>";print_r($data);echo "<pre>";

		$query = $this->db->insert('cliente', $data);
		if ($query) {
			echo true;
		}else{
			echo false;
		}
	}

	function deleteClienteSMS($id){
		$query = "DELETE FROM gtr.cliente where CELULAR = '$id'";
		$this->db->query($query);
		if ($query) {
			echo true;
		}else{
			echo false;
		}
		
	}

	function updateClienteSMS($id){
		$llamada = file_get_contents('php://input');
		$data = json_decode($llamada, true);
		
		$this->db->where('ID', $id);
		$query = $this->db->update('cliente', $data); 

		if ($query) {
			echo true;
		}else{
			echo false;
		}
	}
}

 ?>