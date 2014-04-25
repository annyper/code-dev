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

	function getHorario()
	{
		$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.horario_view");

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
					WHERE Tipo = 'Tienda Propia') AS PAPA
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

    	$query = $this->db->query("SELECT Cod_Pos, Regional, Tienda, Identificacion, Nombre, Apellido, 
    		Movil_1, `Movil 2` as Movil_2, Correo FROM bd_cded_cde_pda.tiendas as tiend
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
}

 ?>