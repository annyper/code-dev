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
		$query = $this->db->query("SELECT UPPER(NOMBRE) NOMBRE, LABOR, ROUND(TIEMPO,2) TIEMPO, TURNO_ACTUAL TURNO, ATENDIDOS, ROUND(AHT,2) AHT_min, TERMINAL, TER_PKSTRID
			FROM [dbo].[RACs] ('TIGO CENTRO MEDELLIN') AS qua
			JOIN [dbo].[DG45_TERMINALES] AS pua
			ON qua.TERMINAL = pua.[TER_SDSTRNOMBRE]
			ORDER BY LABOR DESC, AHT DESC");

		return $query->result_array();
	}

	function getServicios($terminal){
		$query = $this->db->query("SELECT [TRA_FKSTRTIPOCLIENTE] ,[TRA_FKSTRSERVICIO]
			  ,[SER_SDSTRNOMBRE]
		      ,[TRA_FKSTRSUBSERVICIO]
			  ,[SUB_SDSTRNOMBRE]
		      ,[TRA_SDINTSECUENCIA],[TRA_FKSTRUSUARIORECEPTOR]
		      ,[TRA_FKSTRHARDWARERECEPTOR]
		      ,[TRA_SDINTESTADO]
		      ,[TRA_SDSTROBSERVACIONES]
		      ,[TRA_FKSTRSELECTOR]
		      ,[TRA_FKUNICOLA]
		      ,q.[LOG_SDSTRUSUARIO]
		      ,q.[LOG_SDDATMODIFICACION]
		      ,q.[TRA_SDINTNUMEROTRANS]
		  FROM [DIGITURNO13].[dbo].[DG45_TRANSACCIONES] AS q
		  JOIN [DIGITURNO13].[dbo].[DG45_SERVICIOS] AS p
		  ON q.[TRA_FKSTRSERVICIO] = p.[SER_PKSTRID]

		  LEFT JOIN [DIGITURNO13].[dbo].[DG45_SUBSERVICIOS] AS t
		  ON q.[TRA_FKSTRSUBSERVICIO] = t.[SUB_PKSTRID]
		   WHERE [TRA_FKSTRHARDWARERECEPTOR] = '$terminal'");

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

	function getSinTurnoHistorico($datetimeInicio, $datetimeFin)
	{
		$query = $this->db->query("SELECT fecha, username, nombre, ISNULL(SUM(CAST(TIEMPO AS FLOAT)),0) as tiempo_Sin_Turno, sucursal, regional
				FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
				WHERE LABOR = 'SIN TURNO' AND CARGO = 'Asesor'
				GROUP BY fecha, username, NOMBRE, sucursal, regional
				ORDER BY tiempo_Sin_Turno DESC");
		return $query->result_array();
	}
}

 ?>