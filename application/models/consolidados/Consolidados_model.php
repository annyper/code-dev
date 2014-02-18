<?php 

/**
* 
*/
class Consolidados_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database('centromedellin');
	}

	function getDisponiblesNoJustificados($datetimeInicio, $datetimeFin)
	{
		$quer = "SELECT fecha_hora AS fecha_asesor, Hora_Solicitud, nombre, labor, TiempoAsesorInicial, TiempoAsesorFinal, TiempoCliInicial, TiempoCliFinal, tiempoDif,
		            CASE WHEN  TiempoCliInicial > TiempoAsesorInicial THEN TiempoCliInicial - TiempoAsesorInicial ELSE 0 END AS Tci, CASE WHEN  TiempoCliFinal > TiempoAsesorFinal
		                    THEN TiempoAsesorFinal - TiempoAsesorInicial ELSE TiempoCliFinal - TiempoAsesorInicial
		                END AS Tcf
		         FROM (
		            SELECT * FROM (
		                SELECT USERNAME, UPPER(nombre) nombre, fecha_hora, 
		                    DATEDIFF(second, '00:00:00.00', hora) TiempoAsesorInicial,
		                    (DATEDIFF(second, '00:00:00.00', hora) + tiempo) TiempoAsesorFinal,
		                    tiempo as tiempoDif, labor, hora AS HoraAct, sucursal
		                    FROM [dbo].[Funcion_Actividad_Fecha] ('$datetimeInicio','$datetimeFin')
		                    WHERE TIEMPO > 0 AND NOMBRE != 'SELECTOR' AND CARGO = 'Asesor'
		                    AND LABOR NOT IN ('Ocupado', 'Llamando', 'Paso a Primera Línea', 'Configuración de dispositivos', 'Cancelación')
		                    AND TIEMPO > 10
		            ) ACTIVIDAD_ASESOR
		            JOIN (
		            SELECT
		                DG45_OFICINAS.OFI_SDSTRREGION AS Regional, 
		                DG45_SALAS.SAL_FKSTROFICINA AS Codigo_POS, 
		                DG45_HISTURNOS.HISTUR_SDSTRTURNO AS Numero_Turno, 
		                CONVERT(CHAR(12), DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD, 114) AS Hora,
		                DATEDIFF(second, '00:00:00.00', CAST(DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD AS TIME)) TiempoCliInicial, 
		                DATEDIFF(second, '00:00:00.00', CAST(DG45_HISTRANSACCIONES.HISTRA_SDDATHORALLAMADO AS TIME)) TiempoCliFinal, 

		                DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD AS Hora_Solicitud,
		                DG45_HISTRANSACCIONES.HISTRA_SDDATHORALLAMADO AS Hora_Llamado, 
		                CASE WHEN DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 1 OR
		                        DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 3 OR DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 7
		                   THEN convert (float, DATEDIFF(S, DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD,DG45_HISTRANSACCIONES.HISTRA_SDDATHORALLAMADO))/60 END AS Espera_Min, 
		                CASE WHEN DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 1 OR
		                        DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 3 
		                   THEN convert (float, DATEDIFF(S, DG45_HISTRANSACCIONES.HISTRA_SDDATHORALLAMADO,DG45_HISTRANSACCIONES.HISTRA_SDDATHORALLEGADA))/60 ELSE 0 END AS Llamado_Min, 
		                CASE WHEN DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 1 OR
		                        DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 3 
		                   THEN convert (float, DATEDIFF(S, DG45_HISTRANSACCIONES.HISTRA_SDDATHORALLEGADA,DG45_HISTRANSACCIONES.HISTRA_SDDATHORAFINALIZACION))/60 ELSE 0 END AS Atencion_Min, 
		                CASE WHEN DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 1 OR
		                          DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO = 3 
		                   THEN convert (float, DATEDIFF(S, DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD,DG45_HISTRANSACCIONES.HISTRA_SDDATHORAFINALIZACION))/60 ELSE 0 END AS Total_Min, 
		                --DG45_HISTRANSACCIONES.HISTRA_FKSTRUSUARIORECEPTOR AS USUARIO,
		                --UPPER(DG45_USUARIOS.USU_SDSTRNOMBRE) AS NOMBRE_USU,
		                CASE DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO 
		                   WHEN 0 THEN 'ESPERA' WHEN 1 THEN 'CONTEO' WHEN 2 THEN 'LLAMANDO' WHEN 3 THEN 'FINALIZADO' WHEN 4 THEN 'OCUPADO' WHEN 5 THEN 'CANCELADO' 
		                   WHEN 6 THEN 'DISTRAIDO' WHEN 7 THEN 'ABANDONADO' WHEN 8 THEN 'TRANSFERENCIA' WHEN 9 THEN 'ERROR' END AS ESTADO
		            FROM
		                DG45_HISTRANSACCIONES FULL OUTER JOIN
		                DG45_HISTURNOS ON HISTUR_PKUNIGUID = DG45_HISTRANSACCIONES.HISTRA_FKUNITURNO FULL OUTER JOIN
		                DG45_SALAS ON DG45_SALAS.SAL_PKSTRID = DG45_HISTRANSACCIONES.HISTRA_FKSTRSALA FULL OUTER JOIN
		                DG45_OFICINAS ON DG45_OFICINAS.OFI_PKSTRID = DG45_SALAS.SAL_FKSTROFICINA FULL OUTER JOIN
		                DG45_AREAS ON DG45_AREAS.ARE_PKSTRID = DG45_HISTRANSACCIONES.HISTRA_FKSTRAREA FULL OUTER JOIN
		                DG45_TIPOSCLIENTE ON DG45_TIPOSCLIENTE.TCL_PKSTRID = DG45_HISTRANSACCIONES.HISTRA_FKSTRTIPOCLIENTE FULL OUTER JOIN
		                DG45_SERVICIOS ON DG45_SERVICIOS.SER_PKSTRID = DG45_HISTRANSACCIONES.HISTRA_FKSTRSERVICIO FULL OUTER JOIN
		                DG45_SUBSERVICIOS ON DG45_SUBSERVICIOS.SUB_PKSTRID = DG45_HISTRANSACCIONES.HISTRA_FKSTRSUBSERVICIO FULL OUTER JOIN
		                DG45_COLAS ON DG45_COLAS.COL_PKUNICODIGO = DG45_HISTRANSACCIONES.HISTRA_FKUNICOLA FULL OUTER JOIN
		                DG45_USUARIOS ON DG45_USUARIOS.USU_PKSTRID = DG45_HISTRANSACCIONES.HISTRA_FKSTRUSUARIORECEPTOR
		            WHERE
		                DG45_HISTRANSACCIONES.HISTRA_FKUNITURNO=DG45_HISTURNOS.HISTUR_PKUNIGUID AND
		                 DG45_HISTRANSACCIONES.HISTRA_SDINTSECUENCIA = 1 AND
		                (DG45_HISTRANSACCIONES.HISTRA_SDINTESTADO IN (1, 3, 7)) AND 
		                (DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD >= CONVERT(DATETIME, '$datetimeInicio', 102)) AND 
		                (DG45_HISTRANSACCIONES.HISTRA_SDDATHORASOLICITUD <= CONVERT(DATETIME, '$datetimeFin', 102))
		            ) AS TURNOS

		            ON ACTIVIDAD_ASESOR.TiempoAsesorFinal > TURNOS.TiempoCliInicial AND ACTIVIDAD_ASESOR.TiempoAsesorInicial < TURNOS.TiempoCliFinal
		            --WHERE TiempoAsesorInicial < 32336 AND TiempoAsesorInicial > 28747
		            WHERE Espera_Min > 0
		        ) XOXO
		        ORDER BY fecha_asesor, Tci";

		$query = $this->db->query($quer);

		if (!$query) {

			$query = 0;
		}
		else
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
	}


}

?>