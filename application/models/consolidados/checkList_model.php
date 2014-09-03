<?php 


/**
* 
*/
class CheckList_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database('bd_cded_cde_pda1');
	}

	function getHorario($cod_pos = null)
	{
		if ($cod_pos == null) {
			$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.horario_view");
		}else{
			$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.horario_view
				where Cod_pos = '$cod_pos'");
		}
		

		return $query->result_array();

	}

	function getCheckListDeApertura($datetimeInicio, $datetimeFin, $filtro = null)
	{

		$query = $this->db->query("SELECT REGIONAL, TIENDA,  SUM(check_list = 0) Impuntual, SUM(check_list = 1) Puntual, SUM(check_list = 2) No_abre,   
			(SUM(check_list = 1)/SUM(check_list != 2))*100 Puntualidad
			FROM (
				SELECT fechaa, DiaNum, Cod_pos, Dia, Apertura1, Cierre1, fecha_sis, regional, Tienda, ph_ase_total, ph_ase_segturno,
				case when Apertura1 = 'null' or Apertura1 is NULL THEN 2
				WHEN CAST(fecha_sis as time) > CAST(ADDTIME(Apertura1, '00:31:00') as time) THEN 0
				WHEN fecha_sis IS NULL THEN 0
				WHEN CAST(fecha_sis as time) <= CAST(ADDTIME(Apertura1, '00:31:00') as time) THEN 1
				END AS Check_list
				FROM(
					SELECT * FROM (
						SELECT cast(fecha_sis as DATE) fechaa,
						CASE WHEN CAST(fecha_sis AS DATE) IN ('2013-12-25', '2013-12-08', '2013-11-11', '2013-11-04', '2013-10-14', '2013-08-19', '2013-08-07', '2013-07-20', '2013-07-01', '2013-06-10', '2013-06-03', '2013-05-13', '2013-05-01', '2013-03-29', '2013-03-28', '2013-03-25', '2013-01-07', '2013-01-01','2014-01-01','2014-01-06','2014-03-24','2014-04-17','2014-04-18','2014-05-01','2014-06-02','2014-06-23','2014-06-30','2014-06-30','2014-07-20','2014-08-07','2014-08-18','2014-10-13','2014-11-03','2014-11-17','2014-12-08','2014-12-25')
						THEN 7 ELSE date_format(cast(fecha_sis as DATE), '%w') END AS diaA
						FROM cocinfo.u_dmsapertura
						WHERE cast(fecha_sis as DATE)             >= '$datetimeInicio'
						AND cast(fecha_sis as DATE)               <= '$datetimeFin'
						AND info_canal                             = 'Tiendas Propias'
						GROUP BY FECHAa) AS HOLA
JOIN (
	SELECT *, CASE WHEN Dia = 'Domingo' then 0 WHEN Dia = 'Lunes' then 1 WHEN Dia = 'Martes' then 2 WHEN Dia = 'Miercoles' then 3 WHEN Dia = 'Jueves' then 4 WHEN Dia = 'Viernes' then 5 WHEN Dia = 'Sabado' then 6 WHEN Dia = 'Festivos' then 7
	end as DiaNum
	FROM bd_cded_cde_pda.horario_view
	WHERE Tipo in ('Tienda Propia', 'corporativo')) AS PAPA
ON HOLA.diaA = PAPA.DiaNum
order by Tienda, fechaa) ANITA

LEFT JOIN (

	SELECT * FROM
	(SELECT * FROM
		(SELECT  id, fecha_sis, CAST(fecha_sis AS DATE) AS fecha_apertura, usuario_id, usuario, info_regional, info_cde, ph_ase_total, ph_ase_segturno , info_canal
			FROM cocinfo.u_dmsapertura
			WHERE cast(fecha_sis as DATE)             >= '$datetimeInicio'
			AND cast(fecha_sis as DATE)               <= '$datetimeFin'
			AND info_canal                             = 'Tiendas Propias'
			) THOR
JOIN
(SELECT FECHA,
	id2
	FROM
	(SELECT id as id2, CAST(fecha_sis AS DATE) fecha, fecha_sis, fecha_apertura, usuario_id, usuario, info_regional, info_cde, ph_ase_total, ph_ase_segturno , info_canal
		FROM cocinfo.u_dmsapertura
		WHERE cast(fecha_sis as DATE)             >= '$datetimeInicio'
		AND cast(fecha_sis as DATE)               <= '$datetimeFin'
		AND info_canal                             = 'Tiendas Propias'
		ORDER BY fecha_sis DESC
		) MAMA
GROUP BY FECHA,
info_cde
) ODIN
ON THOR.id = ODIN.id2
) TAB
) AS COC
ON ANITA.FECHAa = COC.FECHA_APERTURA AND ANITA.TIENDA = COC.INFO_CDE
ORDER BY fechaa ) AS CONSULTA_CKECK
$filtro
GROUP BY REGIONAL, TIENDA
ORDER BY REGIONAL, PUNTUALIDAD DESC");

return $query->result_array();

}

function getCheckListPorCDE($datetimeInicio, $datetimeFin, $CDE)
{
	$query = $this->db->query("	SELECT fechaa, Dia, Apertura1, cast(fecha_sis as time) hora_ingreso, regional, Tienda,
		case when Apertura1 = 'null' or Apertura1 is NULL THEN 'No abre'
		WHEN CAST(fecha_sis as time) > CAST(ADDTIME(Apertura1, '00:31:00') as time) THEN 'Impuntual'
		WHEN fecha_sis IS NULL THEN 'No montó checklist'
		WHEN CAST(fecha_sis as time) <= CAST(ADDTIME(Apertura1, '00:31:00') as time) THEN 'Puntual'
		END AS Check_list
		FROM(
			SELECT * FROM (
				SELECT cast(fecha_sis as DATE) fechaa,
				CASE WHEN CAST(fecha_sis AS DATE) IN ('2013-12-25', '2013-12-08', '2013-11-11', '2013-11-04', '2013-10-14', '2013-08-19', '2013-08-07', '2013-07-20', '2013-07-01', '2013-06-10', '2013-06-03', '2013-05-13', '2013-05-01', '2013-03-29', '2013-03-28', '2013-03-25', '2013-01-07', '2013-01-01','2014-01-01','2014-01-06','2014-03-24','2014-04-17','2014-04-18','2014-05-01','2014-06-02','2014-06-23','2014-06-30','2014-06-30','2014-07-20','2014-08-07','2014-08-18','2014-10-13','2014-11-03','2014-11-17','2014-12-08','2014-12-25')
				THEN 7 ELSE date_format(fecha_apertura, '%w') END AS diaA
				FROM cocinfo.u_dmsapertura
				WHERE cast(fecha_sis as DATE)             >= '$datetimeInicio'
				AND cast(fecha_sis as DATE)               <= '$datetimeFin'
				AND info_canal                             = 'Tiendas Propias'
				GROUP BY FECHAa) AS HOLA
JOIN (
	SELECT *, CASE WHEN Dia = 'Domingo' then 0 WHEN Dia = 'Lunes' then 1 WHEN Dia = 'Martes' then 2 WHEN Dia = 'Miercoles' then 3 WHEN Dia = 'Jueves' then 4 WHEN Dia = 'Viernes' then 5 WHEN Dia = 'Sabado' then 6 WHEN Dia = 'Festivos' then 7
	end as DiaNum
	FROM bd_cded_cde_pda.horario_view
	WHERE Tipo in ('Tienda Propia', 'corporativo')) AS PAPA
ON HOLA.diaA = PAPA.DiaNum
order by Tienda, fechaa) ANITA

LEFT JOIN (

	SELECT * FROM
	(SELECT * FROM
		(SELECT  id, fecha_sis, CAST(fecha_sis AS DATE) AS fecha_apertura, usuario_id, usuario, info_regional, info_cde, ph_ase_total, ph_ase_segturno , info_canal
			FROM cocinfo.u_dmsapertura
			WHERE cast(fecha_sis as DATE)             >= '$datetimeInicio'
			AND cast(fecha_sis as DATE)               <= '$datetimeFin'
			AND info_canal                             = 'Tiendas Propias'
			) THOR
JOIN
(SELECT FECHA,
	id2
	FROM
	(SELECT id as id2, CAST(fecha_sis AS DATE) fecha, fecha_sis, fecha_apertura, usuario_id, usuario, info_regional, info_cde, ph_ase_total, ph_ase_segturno , info_canal
		FROM cocinfo.u_dmsapertura
		WHERE cast(fecha_sis as DATE)             >= '$datetimeInicio'
		AND cast(fecha_sis as DATE)               <= '$datetimeFin'
		AND info_canal                             = 'Tiendas Propias'
		ORDER BY fecha_sis DESC
		) MAMA
GROUP BY FECHA,
info_cde
) ODIN
ON THOR.id = ODIN.id2
) TAB
) AS COC
ON ANITA.FECHAa = COC.FECHA_APERTURA AND ANITA.TIENDA = COC.INFO_CDE
where Tienda = '$CDE'
ORDER BY fechaa");

return $query->result_array();
}

function getIP($oficina)
{
		//$BDCentral = $this->load->database();
		//echo $oficina;
	$oficina = str_replace("-", " ", $oficina);
	$oficina = "%" . $oficina;

	$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.dg45_servidores_rep
		where SER_SDSTRDESCRIPCION like '$oficina'");
		//echo "<pre>"; print_r($query->row_array()); echo "</pre>";
	if (!$query) {
		$query = 0;
			//echo "se generó una mala consulta";
	}
	else
	{
		return $query->row_array();
	}
}

function getListaNombresCDEs()
{
	$query = $this->db->query("SELECT SER_SDSTRDESCRIPCION as cde FROM bd_cded_cde_pda.dg45_servidores_rep");

	if (!$query) {
		$query = 0;
			//echo "se generó una mala consulta";
	}
	else
	{
		return $query->result_array();
	}
}

function getInfoCDE($Cod_pos){

	$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.tiendas as tiend
		join  bd_cded_cde_pda.administradores as admin
		on admin.Tiendas_cod_pos = tiend.Cod_Pos
		join bd_cded_cde_pda.horarios as hor
		on hor.Tiendas_cod_pos = tiend.Cod_Pos
		where Cod_Pos = '$Cod_pos'
		and Dia = 'lunes'");

	if (!$query) {
		$query = 0;
			//echo "se generó una mala consulta";
	}
	else
	{
		return $query->row_array();
	}
}

function getInfoCDEcoor($Cod_pos){

	$query = $this->db->query("SELECT id, Cod_Pos, Regional, Tienda, Identificacion, Nombre, Apellido, 
		Movil_1, Movil_2 as Movil_2, Correo FROM bd_cded_cde_pda.tiendas as tiend
		join  bd_cded_cde_pda.coordinadores_db as coor
		on coor.Tiendas_cod_pos = tiend.Cod_Pos
		where Cod_Pos = '$Cod_pos'");

	if (!$query) {
		$query = 0;
			//echo "se generó una mala consulta";
	}
	else
	{
		return $query->result_array();
	}
}


function get_hvc($celular){

	$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.hvc WHERE MSISDN = '$celular'");
	if ($query) {
		$resultado = json_encode($query->row_array(), JSON_UNESCAPED_UNICODE);
		return $resultado;

	}
}

function getDatosApertura(){
	$string = "SELECT * FROM ( 
			SELECT Cod_Pos, Tienda FROM bd_cded_cde_pda.tiendas) as tie
	join (SELECT u_dmsapertura.id,
		u_dmsapertura.fecha_sis,
		u_dmsapertura.usuario,
		u_dmsapertura.info_regional,
		u_dmsapertura.info_cde,
		u_dmsapertura.info_observaciones,
		u_dmsapertura.ph_contratado,
		u_dmsapertura.ph_ase_total,
		u_dmsapertura.ph_ase_segturno,
		u_dmsapertura.ph_ase_incapacitados,
		u_dmsapertura.ph_ase_compensando,
		u_dmsapertura.ph_ase_ausente,
		u_dmsapertura.ph_ase_vacaciones,
		u_dmsapertura.ph_prestado,
		u_dmsapertura.ph_vacioLab
		FROM cocinfo.u_dmsapertura
		where info_canal != 'Tiendas Dealers'
		and info_regional = 'costa'
		AND cast(fecha_sis as date)  = '2014-08-08') as aper
	on tie.Tienda = aper.info_cde
	order by fecha_sis";

	$query = $this->db->query($string);
	if ($query) {
		return json_encode($query->result_array(), JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	}
}

function actividadWorstOffenderModel(){

	$fechaInicial = $this->input->get('fechaInicial') . ' 08:00:00';
	$fechaFinal = $this->input->get('fechaFinal') . ' 22:00:00';

	if ($fechaInicial and $fechaFinal) {
		$query = $this->db->query("SELECT * FROM (
			SELECT fecha, UPPER(nombre) nombre, labor, ISNULL(SUM(tiempo),0) as tiempo_Labor, cargo, sucursal, regional
				FROM [dbo].[Actividad_por_hora] ('$fechaInicial','$fechaFinal')
				WHERE NOMBRE != 'SELECTOR' -- AND LABOR = 'Disponible'
				GROUP BY fecha, nombre, labor, cargo, sucursal, regional		
		) AS hello
		ORDER BY LABOR, tiempo_Labor DESC");
	
		if ($query) {
			$resultado = json_encode($query->row_array(), JSON_UNESCAPED_UNICODE);
			return $resultado;

		}
	}
}



	/**
	U P D A T E S
*/
	function setHorario($Cod_Pos, $Dia, $nombreColumna)
	{
		$hora = $this->input->post('hora-text');
		$string = "UPDATE  bd_cded_cde_pda.horarios 
		SET $nombreColumna = '$hora'
		where Tiendas_Cod_Pos = '$Cod_Pos' and Dia = '$Dia'";
		
		$query = $this->db->query($string);
		if ($query) {
			return 1;
		}else{
			return 0;
		}
	}


	function updateDataCDE($Cod_Pos)
	{
		$Cod_Pos2 = $this->input->post('Cod_Pos');
		$Regional = $this->input->post('regional');
		$Ciudad = $this->input->post('ciudad');
		$Tipo = $this->input->post('tipo');
		$Version = $this->input->post('version');
		$ClasificacionCDE = $this->input->post('clasificacion');
		$Direccion = $this->input->post('direccion');

		$string = "UPDATE  bd_cded_cde_pda.tiendas 
		SET Cod_Pos = '$Cod_Pos2', Regional = '$Regional', Ciudad = '$Ciudad', Tipo = '$Tipo', 
		Version = '$Version', ClasificacionCDE = '$ClasificacionCDE', Direccion = '$Direccion'
		where Cod_Pos = '$Cod_Pos2'";

		//$this->db->where('Cod_Pos', $Cod_Pos);
		//$query = $this->db->update('tiendas', $data, array('Cod_Pos' => $Cod_Pos ));
		$query = $this->db->query($string);

		if ($query) {
			return 1;
		}else{
			return 0;
		}
	}

	function updateDataCoor($Cod_Pos, $Identificacion)
	{
		$nombre = $this->input->post('nombreCor');
		$apellido = $this->input->post('ApellidoCor');
		$identificacion = $this->input->post('identificacion');
		$Movil_1 = $this->input->post('CelCor');
		$Movil_2 = $this->input->post('CelCor2');
		$correo = $this->input->post('emailCor');

		$id = $this->input->post('id');

			//$Cod_Pos2 = $this->input->post('clasificacion');

		$string = "UPDATE  bd_cded_cde_pda.coordinadores_db 
		SET Nombre = '$nombre', Apellido = '$apellido', Identificacion = '$identificacion', 
		Movil_1 = '$Movil_1', Movil_2 = '$Movil_2', Correo = '$correo'
		where id = '$id'";

		//$this->db->where('Cod_Pos', $Cod_Pos);
		//$query = $this->db->update('tiendas', $data, array('Cod_Pos' => $Cod_Pos ));
		$query = $this->db->query($string);

		if ($query) {
			return 1;
		}else{
			return 0;
		}
	}

	function updateDataAdmin($Cod_Pos)
	{
		$nombre = $this->input->post('nombreAdmin');
		$apellido = $this->input->post('apellidoAdmin');
		$identificacion = $this->input->post('identificacionAdmin');
		$Movil_1 = $this->input->post('CelAdmin');
			//$Movil_2 = $this->input->post('tipo');
		$correo = $this->input->post('emailAdmin');
			//$Cod_Pos2 = $this->input->post('clasificacion');

		$string = "UPDATE  bd_cded_cde_pda.administradores 
		SET Nombre = '$nombre', Apellido = '$apellido', Identificacion = '$identificacion', 
		Movil_1 = '$Movil_1', Correo = '$correo'
		where Tiendas_Cod_Pos = '$Cod_Pos'";

		//$this->db->where('Cod_Pos', $Cod_Pos);
		//$query = $this->db->update('tiendas', $data, array('Cod_Pos' => $Cod_Pos ));
		$query = $this->db->query($string);

		if ($query) {
			return 1;
		}else{
			return 0;
		}
	}
	/**
	I N S E R T
	*/
	function setCoor($Cod_Pos){

		$data = array(
			'Tiendas_Cod_Pos' =>  $Cod_Pos,
			'Identificacion' => $this->input->post('identificacion') ,
			'Nombre' => $this->input->post('nombreCor') ,
			'Apellido' => $this->input->post('ApellidoCor'),
			'Movil_1' => $this->input->post('CelCor'),
			'Movil_2' => $this->input->post('CelCor2'),
			'Correo' => $this->input->post('emailCor')
			);
		//echo "<pre>"; print_r($data); echo "</pre>";

		$this->db->insert('coordinadores_db', $data); 
	}

	function setCDE(){

		$dataCDE = array(
			'Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Tienda' => $this->input->post('nombreTienda'),
			'Regional' => $this->input->post('regional') ,
			'Ciudad' => $this->input->post('ciudad') ,
			'Tipo' => $this->input->post('tipo'),
			'Version' => $this->input->post('version'),
			'ClasificacionCDE' => $this->input->post('clasificacion'),
			'Direccion' => $this->input->post('direccion')              
			);
		$dataAdmin = array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Identificacion' => $this->input->post('identificacionAdmin') ,
			'Nombre' => $this->input->post('nombreAdmin') ,
			'Apellido' => $this->input->post('apellidoAdmin'),
			'Movil_1' => $this->input->post('CelAdmin'),
			'Movil_2' => $this->input->post('CelAdmin2'),
			'Correo' => $this->input->post('emailAdmin')
			);
		$dataCoor = array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Identificacion' => $this->input->post('identificacionCoor') ,
			'Nombre' => $this->input->post('nombreCoor') ,
			'Apellido' => $this->input->post('apellidoCoor'),
			'Movil_1' => $this->input->post('CelCoor'),
			'Movil_2' => $this->input->post('CelAdmin2'),
			'Correo' => $this->input->post('CelCoor2')
			);
		$dataHorario = array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Lunes',
			'Horario' => $this->input->post('horario')
			);

		$dataRestoHorario = array(
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Martes'
			),
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Miercoles'
			),
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Jueves'
			),
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Viernes'
			),
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Sabado'
			),
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Domingo'
			),
		array(
			'Tiendas_Cod_Pos' => $this->input->post('Cod_Pos') ,
			'Dia' => 'Festivos'
			),
		);

		$this->db->insert('tiendas', $dataCDE); 
		$this->db->insert('administradores', $dataAdmin);
		$this->db->insert('coordinadores_db', $dataCoor);
		$this->db->insert('horarios', $dataHorario);
		$this->db->insert_batch('horarios', $dataRestoHorario);


		return $dataCDE['Cod_Pos'];
	}

	/**
	D E L E T E S
	*/
	function deleteCoor($id)
	{
		$query = "DELETE FROM bd_cded_cde_pda.coordinadores_db
		where id = '$id'";
		$this->db->query($query);
	}
}

?>