<?php 


/**
* 
*/
class Config_model extends CI_model
{
	protected $BDCentral;

	function __construct()
	{
		parent::__construct();
		$this->BDCentral = $this->load->database('default',true);
	}


	function getIP($oficina)
    {
    	//$BDCentral = $this->load->database();
        //echo $oficina;
    	$oficina = str_replace("-", " ", $oficina);
    	$oficina = "%" . $oficina;
    	    	
    	$query = $this->BDCentral->query("SELECT *
  			FROM [TIGOCENTRAL].[dbo].[DG45_SERVIDORES_REP]
  			where [SER_SDSTRDESCRIPCION] like '$oficina'");
    	//echo "<pre>"; print_r($query->row_array()); echo "</pre>";
    	return $query->row_array();
    }

}

 ?>