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

	function getRacsTiempoReal()
	{
		$query = $this->db->query("SELECT UPPER(NOMBRE) NOMBRE, LABOR, ROUND(TIEMPO,2) TIEMPO, TURNO_ACTUAL TURNO, ATENDIDOS, ROUND(AHT,2) AHT_min, TERMINAL
			FROM [dbo].[RACs] ('TIGO CENTRO MEDELLIN')
			ORDER BY LABOR DESC, AHT DESC");

		return $query->result_array();
	}

	function getColas($terminal)
	{
		$query = $this->db->query("SELECT [COL_SDSTRNOMBRE],[TER_SDSTRNOMBRE],[TERATI_SDINTVALORPRIORIDAD]
			      ,e.[LOG_SDSTRUSUARIO]
			      ,e.[LOG_SDDATMODIFICACION]
			  FROM [DIGITURNO13].[dbo].[DG45_TERMINAL_ATIENDE] AS e
			  JOIN [DIGITURNO13].[dbo].[DG45_COLAS] AS p
			  ON e.[TERATI_FKUNICOLA] = p.[COL_PKUNICODIGO]
			    
			  JOIN [DIGITURNO13].[dbo].[DG45_TERMINALES] AS s
			  ON e.[TERATI_FKSTRTERMINAL] = s.[TER_PKSTRID]
			  where REPLACE([TER_SDSTRNOMBRE],' ','') = REPLACE('$terminal',' ','')
			  ORDER BY [TER_SDSTRNOMBRE]");

		return $query->result_array();
	}
}

 ?>