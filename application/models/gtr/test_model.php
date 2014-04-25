<?php 

/**
* 
*/
class Test_model extends CI_model
{
	protected $dbCDE;
	
	function __construct()
	{
		parent::__construct();
	}

	function inicializar($ipCDE)
	{
		//$dsn = 'dbdriver://usuario:contraseña@nombre_host/base_de_datos';
		$dsn = 'sqlsrv://sa:TIGO@' . $ipCDE . '/DIGITURNO13?char_set=utf8&dbcollat=utf8_general_ci&cache_on=true&cachedir=/ruta/al/cache';
		//$this->load->database($dsn);
		$this->dbCDE = $this->load->database($dsn, true);
	}

	function getActividad()
	{
		$query = $this->dbCDE->query("SELECT TOP 1000 *
  		FROM [TIGOCENTRAL].[dbo].[INFORMACION_CDEDIAACTUAL]
  		where region = 'noroccidente'
  		order by percepcion desc");//SELECT TOP 50 * FROM dbo.DG45_ACTIVIDAD WHERE [ACT_SDSTRDATOS] LIKE '%Automatico por rellamados%'");

		return $query->result_array();

	}

	function getRacsTiempoReal($oficina)
	{
		$quer = "SELECT UPPER(NOMBRE) NOMBRE, LABOR, ROUND(TIEMPO,2) TIEMPO, TURNO_ACTUAL TURNO, ATENDIDOS, ROUND(AHT,2) AHT_min, TERMINAL, TER_PKSTRID
			FROM [DIGITURNO13].[dbo].[RACs] ('$oficina') AS qua
			JOIN [DIGITURNO13].[dbo].[DG45_TERMINALES] AS pua
			ON qua.TERMINAL = pua.[TER_SDSTRNOMBRE]
			ORDER BY LABOR DESC, TIEMPO DESC, AHT DESC";

		$query = $this->dbCDE->query($quer);

		if (!$query) {

			$query = 0;
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
			
		//return $query->result_array();
	}

	function getClientesEsperaTiempoReal()
	{
		try {

			$query = $this->dbCDE->query("SELECT * FROM (
				SELECT [TRA_FKSTRTIPOCLIENTE], [TRA_FKUNITURNO], [TRA_FKSTRSERVICIO], [SER_SDSTRNOMBRE] AS NOMBRETRANS
					  ,[TRA_SDINTSECUENCIA], [TRA_SDINTESTADO], [TRA_FKSTRSELECTOR], [TRA_FKUNICOLA] AS IDCOLA
					  ,q.[LOG_SDSTRUSUARIO], q.[LOG_SDDATMODIFICACION], q.[TRA_SDINTNUMEROTRANS]
				  FROM [DIGITURNO13].[dbo].[DG45_TRANSACCIONES] AS q
				  JOIN [DIGITURNO13].[dbo].[DG45_SERVICIOS] AS p
				  ON q.[TRA_FKSTRSERVICIO] = p.[SER_PKSTRID]

				  LEFT JOIN [DIGITURNO13].[dbo].[DG45_SUBSERVICIOS] AS t
				  ON q.[TRA_FKSTRSUBSERVICIO] = t.[SUB_PKSTRID]
				  WHERE [TRA_FKSTRHARDWARERECEPTOR] IS NULL) AS PAM

			JOIN (SELECT [TUR_PKUNIGUID],[TUR_SDSTRTURNO] AS TURNO,[TUR_SDSTRCODCLIENTE] AS NUMEROCLIENTE,[TUR_SDSTRNOMBRECLIENTE] AS NOMBRECLIENTE,[LOG_SDSTRUSUARIO]
				FROM [DIGITURNO13].[dbo].[DG45_TURNOS]) AS j
			ON PAM.[TRA_FKUNITURNO] = j.[TUR_PKUNIGUID]

			JOIN (SELECT [TUR_SDSTRTURNO],[TSA] FROM [DIGITURNO13].[dbo].[INFO_TURNO]) AS TIEMPOS
			ON j.TURNO = TIEMPOS.[TUR_SDSTRTURNO]
			ORDER BY TSA DESC");

			if (!$query) {

				$query = 0;
			}
			else
			{
				//print_r($query->result_array());
				return $query->result_array();
			}

		} catch (Exception $e) {

			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
		
	}

	function getServicios($terminal){
		$query = $this->dbCDE->query("SELECT [TRA_FKSTRTIPOCLIENTE] ,[TRA_FKSTRSERVICIO]
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
		$query = $this->dbCDE->query("SELECT [COL_SDSTRNOMBRE],[TER_SDSTRNOMBRE],[TERATI_SDINTVALORPRIORIDAD]
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

	function getLaborTiempoReal($oficina, $labor)
	{
		$query = $this->dbCDE->query("SELECT UPPER(NOMBRE) NOMBRE, LABOR, ROUND(TIEMPO,2) TIEMPO, TURNO_ACTUAL TURNO, ATENDIDOS, ROUND(AHT,2) AHT_min, TERMINAL, TER_PKSTRID
			FROM [DIGITURNO13].[dbo].[RACs] ('$oficina') AS qua
			JOIN [DIGITURNO13].[dbo].[DG45_TERMINALES] AS pua
			ON qua.TERMINAL = pua.[TER_SDSTRNOMBRE]
			WHERE LABOR = '$labor'
			ORDER BY TIEMPO DESC, AHT DESC");

		return $query->result_array();
	}

	function getSinTurnoHistorico($datetimeInicio, $datetimeFin)
	{
		$query = $this->dbCDE->query("SELECT * FROM (
				SELECT fecha, username, nombre, ISNULL(SUM(CAST(TIEMPO AS FLOAT)),0) as tiempo_Sin_Turno, sucursal, regional
					FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
					WHERE LABOR = 'SIN TURNO' AND CARGO = 'Asesor'
					GROUP BY fecha, username, NOMBRE, sucursal, regional
					) AS ASDASD
					WHERE tiempo_Sin_Turno >= 90
				ORDER BY tiempo_Sin_Turno DESC");

		return $query->result_array();
	}

	function getActividadHistorico($datetimeInicio, $datetimeFin, $labor, $tiempoMinimo = 0)
	{
		$query = $this->dbCDE->query("SELECT * FROM (
				SELECT fecha, username, nombre, ISNULL(SUM(CAST(TIEMPO AS FLOAT)),0) as tiempo_Labor, sucursal, regional
					FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
					WHERE LABOR = '$labor' AND CARGO = 'Asesor'
					GROUP BY fecha, username, NOMBRE, sucursal, regional
					) AS ASDASD
					WHERE tiempo_Labor >= $tiempoMinimo
				ORDER BY tiempo_Labor DESC");

		return $query->result_array();
	}

	function  getChartClientesEspera($oficina)
	{
		try {
			$query = $this->dbCDE->query("SELECT * FROM [dbo].CLIENTES_ESPERA('$oficina')");

			return $query->result_array();
		
		} catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}

	}

	function  getChartEstadoAsesores($oficina)
	{
		$query = $this->dbCDE->query("SELECT LABOR, COUNT(1) FROM dbo.RACs('$oficina') GROUP BY LABOR");

		//return $query->result_array();
		if (!$query) {
			$query = 0;
			//echo "se generó una mala consulta";
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
	}

	function getActividadAsesoresPorDia($datetimeInicio, $datetimeFin)
	{
		$query_inicial = "SELECT nombre, labor, tiempo, DATEDIFF(second, '00:00:00.00', hora) segundos_inicio, fecha_hora
					FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
					WHERE TIEMPO > 0 --AND LABOR != 'Llamando' 
					AND NOMBRE != 'SELECTOR' AND CARGO = 'Asesor'
					ORDER BY nombre, HORA DESC";

		$fa = "SELECT DET.username, nombre, labor, tiempo, DATEDIFF(second, '00:00:00.00', hora) segundos_inicio, tiempo_acu_actividad, fecha_hora
			FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin') AS DET
			JOIN (
				SELECT username , ISNULL(SUM(CAST(TIEMPO AS FLOAT)),0) as tiempo_acu_actividad
				FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
				WHERE CARGO = 'Asesor' and username != 'SELECTOR'
				GROUP BY fecha, username, NOMBRE, labor, sucursal, regional) AS CONS
			ON DET.username = CONS.username
			WHERE TIEMPO > 0 AND NOMBRE != 'SELECTOR' AND CARGO = 'Asesor'";

		$FSF = "SELECT * FROM (
					SELECT username, nombre, labor, tiempo, DATEDIFF(second, '00:00:00.00', hora) segundos_inicio, fecha_hora
					FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
					WHERE TIEMPO > 0 AND NOMBRE != 'SELECTOR' AND CARGO = 'Asesor') AS DET
				JOIN (
					SELECT username2, tiempo_Labor FROM (
					SELECT username AS username2 , ISNULL(SUM(CAST(TIEMPO AS FLOAT)),0) as tiempo_Labor, sucursal, regional
					FROM [dbo].[Funcion_Actividad_Fecha] ('2014-01-15 08:00:00','2014-01-15 22:00:00')
					WHERE CARGO = 'Asesor' and username != 'SELECTOR'
					GROUP BY fecha, username, NOMBRE, labor, sucursal, regional) AS CODNS ) AS CONS
				ON DET.username = CONS.username2";

		$query = $this->dbCDE->query($query_inicial);
		
		if (!$query) {
			$query = 0;
			//echo "se generó una mala consulta";
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
	}

	function getGTR()
	{
		try {

			$query = $this->dbCDE->query("SELECT TOP 1000 NOMBRE, SL, PS, PUNTUALES, ATENDIDOS, VISITAS FROM [DIGITURNO13].[dbo].[GTR]");

			$query2 = $this->dbCDE->query("SELECT ([TUR_SDSTRTURNO]) as esperando, 
	                        DATEDIFF(MINUTE,TRA_SDDATHORASOLICITUD,SYSDATETIME()) AS Tiempo, 
	                        CONVERT(VARCHAR(16), TRA_SDDATHORASOLICITUD,121) as Hora_solicitud
	                        FROM [dbo].[DG45_TRANSACCIONES] TRANS 
	                        JOIN DG45_SALAS SAL ON SAL.SAL_PKSTRID=TRANS.TRA_FKSTRSALA 
	                        JOIN DG45_OFICINAS OFI ON SAL.SAL_FKSTROFICINA=OFI.OFI_PKSTRID 
	                        RIGHT JOIN [dbo].[DG45_TURNOS] TURN 
	                        ON TRANS.[TRA_FKUNITURNO] = TURN.[TUR_PKUNIGUID] 
	                        WHERE [TRA_SDINTESTADO] = 0 
	                        --AND OFI.OFI_SDSTRNOMBRE LIKE '%nombre%' 
	                        order by [TUR_SDSTRTURNO]");
			

			if ($query && $query2) {

				$data = $query->row_array();

				$data2 = $query2->result_array();

				if (count($data) > 0) {

					
					
					$b15_30 = 0; $b30_45 = 0; $b45_60 = 0; $b60 = 0;

					foreach ($data2 as $key => $value) {

						if ($value['Tiempo'] < 15) {
							
						}elseif ($value['Tiempo'] >= 15 && $value['Tiempo'] < 30) {

							$b15_30 = $b15_30 + 1;

						}elseif ($value['Tiempo'] < 45) {

							$b30_45 = $b30_45 + 1;

						}elseif ($value['Tiempo'] < 60) {

							$b45_60 = $b45_60 + 1;
							
						}elseif ($value['Tiempo'] >= 60) {
							
							$b60 = $b60 + 1;
						}
					}

					// echo $b15_30 . " "; echo $b30_45 . " ";echo $b45_60 . " ";echo $b60 . " ";

					$numeradorPercepcionHistorica = (1 - $data['PS'])*$data['ATENDIDOS'];

					$numeradorPercepcionActual = ($b15_30*0.6) + ($b30_45*1.2) + ($b45_60*2.4) + ($b60*4.8);

					$data['PercepcionEsperada'] = 1 - (($numeradorPercepcionHistorica + $numeradorPercepcionActual)/($data['ATENDIDOS'] + count($data2)));

					return $data;
					//echo "<pre>"; print_r($data); echo "</pre>";
				}
			}else{
				$query = 0;
				//throw new Exception('División por cero.');
			} 

		} catch (Exception $e) {
			//echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}

	}

	function getChartNSlinea($oficina)
	{
		$query = $this->dbCDE->query("SELECT * FROM [dbo].[Nivel_Servicio] ('$oficina')");

		if (!$query) {
			$query = 0;
			//echo "se generó una mala consulta";
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
	}

	function getChartPercepcionlinea($oficina)
	{
		$query = $this->dbCDE->query("SELECT * FROM [dbo].[Percepcion_Servicio] ('$oficina')");

		if (!$query) {
			$query = 0;
			//echo "se generó una mala consulta";
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
	}

	function getChartVisitas($datetimeInicio, $datetimeFin)
	{
		$consulta = "SELECT OFI.OFI_SDSTRREGION Region,OFI.OFI_PKSTRID COD_POS, OFI.OFI_SDSTRNOMBRE CDE, HISTRA.HORA,
		                SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO IS NULL THEN 0 ELSE 1 END) TotalTurnos,
		      SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) TotalturnosAtendidos,                   
		       SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO IN (5,7) THEN 1 ELSE 0 END) TotalturnosAbandonados,
		       SUM(CASE WHEN HISTRA.TSA <= 900 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Puntuales,
		       ((SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END)
		             -SUM(CASE WHEN HISTRA.TSA BETWEEN 901 AND 1800 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END)*(0.6)
		             -SUM(CASE WHEN HISTRA.TSA BETWEEN 1801 AND 2700 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END)*(1.2)
		             -SUM(CASE WHEN HISTRA.TSA BETWEEN 2701 AND 3600 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END)*(2.4)
		             -SUM(CASE WHEN HISTRA.TSA > 3600 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END)*(4.8))
		       /(CASE WHEN SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END)=0 THEN 1 ELSE 
		             SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) END)
		       ) Percepcion,
		                AVG(HISTRA.TSA)/60 ASASeg,
		                (SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN HISTRA.THT ELSE 0 END )/60)/
		                               (CASE WHEN SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) = 0 THEN 1 ELSE 
		                               SUM(CASE WHEN HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) END ) AHTSeg,   
		                SUM(CASE WHEN HISTRA.TSA < 301 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Entre0_5,
		                SUM(CASE WHEN HISTRA.TSA BETWEEN 301 AND 900 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Entre5_15,
		                SUM(CASE WHEN HISTRA.TSA BETWEEN 901 AND 1800 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Entre15_30,
		                SUM(CASE WHEN HISTRA.TSA BETWEEN 1801 AND 2700 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Entre30_45,
		                SUM(CASE WHEN HISTRA.TSA BETWEEN 2701 AND 3600 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Entre45_60,
		                SUM(CASE WHEN HISTRA.TSA > 3600 AND HISTRA.HISTRA_SDINTESTADO = 3 THEN 1 ELSE 0 END) Mayor60
		FROM DG45_OFICINAS OFI 
		JOIN DG45_SALAS SAL ON SAL.SAL_FKSTROFICINA=OFI.OFI_PKSTRID
		LEFT OUTER JOIN ( 
		                               SELECT H.HISTRA_FKSTRSALA, MAX(H.HISTRA_SDINTESTADO) HISTRA_SDINTESTADO, 
									   DATEPART(HH, CAST(MIN(H.HISTRA_SDDATHORASOLICITUD) AS TIME)) + (CAST(DATEPART(MI,H.HISTRA_SDDATHORASOLICITUD)/30 AS INT)*0.5) HORA,
		                               SUM(CASE WHEN H.HISTRA_SDINTESTADO = 3 THEN 
		                                               convert (float,DATEDIFF(s, H.HISTRA_SDDATHORALLEGADA,H.HISTRA_SDDATHORAFINALIZACION))
		                                               ELSE 0 END ) THT,
		                               SUM(convert (float,DATEDIFF(s, H.HISTRA_SDDATHORASOLICITUD,H.HISTRA_SDDATHORALLAMADO))) TSA
		                               FROM DG45_HISTRANSACCIONES H       
		                               WHERE H.HISTRA_SDDATHORASOLICITUD BETWEEN CAST('$datetimeInicio' AS DATETIME) AND CAST('$datetimeFin' AS DATETIME) 
		                               AND H.HISTRA_SDINTESTADO IN (3,5,7) 
		                               GROUP BY  H.HISTRA_FKSTRSALA,H.HISTRA_FKUNITURNO,H.HISTRA_SDDATHORASOLICITUD
		                ) HISTRA              
		ON HISTRA.HISTRA_FKSTRSALA = SAL.SAL_PKSTRID 
		GROUP BY OFI.OFI_SDSTRREGION, OFI.OFI_PKSTRID, OFI.OFI_SDSTRNOMBRE, HISTRA.HORA
		ORDER BY CDE ASC, HORA ASC";

		$query = $this->dbCDE->query($consulta);

		if (!$query) {
			$query = 0;
			//echo "se generó una mala consulta";
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
	}

}
					
?>
