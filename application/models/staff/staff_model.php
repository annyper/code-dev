<?php 

/**
* 
*/
class Staff_model extends CI_model
{
	protected $dbCDE;
	
	function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	function inicializar($ipCDE){
		
		//$dsn = 'dbdriver://usuario:contraseña@nombre_host/base_de_datos';
		$dsn = 'sqlsrv://sa:TIGO@' . $ipCDE . '/DIGITURNO13?char_set=utf8&dbcollat=utf8_general_ci&cache_on=true&cachedir=/ruta/al/cache';
		//$this->load->database($dsn);
		$this->dbCDE = $this->load->database($dsn, true);
	}

	function getPronostico($date){

		$string = "SELECT * FROM [dbo].[Nuevo_Pronostico] ('$date')";

		$query = $this->dbCDE->query($string);
		
		if ($query) {
			return $query->result_array();
		}
	}

	function getPronostico2($date){

		$string = "SELECT * FROM [dbo].[Nuevo_Pronostico] ('$date')";

		$query = $this->dbCDE->query($string);
		
		if ($query) {
			return json_encode($query->result_array(), JSON_NUMERIC_CHECK);
		}
	}

	function getListaCodPos($regional = ''){

		if ($regional == '' || $regional == 'Pais') {
			$string = "SELECT * FROM [TIGOCENTRAL].[dbo].[INFORMACION_CDE]
					  WHERE CDE != 'TIGO CENTRALIZADO'";
		}else{
			$string = "SELECT * FROM [TIGOCENTRAL].[dbo].[INFORMACION_CDE]
					  WHERE CDE != 'TIGO CENTRALIZADO' AND REGIONAL = '$regional'";
		}

		$query = $this->db->query($string);
		if ($query) {
			return json_encode($query->result_array(), JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
		}
	}

}

?>