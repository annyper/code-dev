<?php 


/**
* 
*/
class Test_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->database();
	}

	function getActividad()
	{
		$query = $this->db->query("SELECT TOP 1000 *
  FROM [TIGOCENTRAL].[dbo].[INFORMACION_CDEDIAACTUAL]
  where region = 'noroccidente'
  order by percepcion desc");//SELECT TOP 50 * FROM dbo.DG45_ACTIVIDAD WHERE [ACT_SDSTRDATOS] LIKE '%Automatico por rellamados%'");

		return $query->result_array();

	}

	function getActividad2()
	{
		$query = $this->db->get('dbo.DG45_ACTIVIDAD', 50);

		return $query->result_array();
	}
}

 ?>