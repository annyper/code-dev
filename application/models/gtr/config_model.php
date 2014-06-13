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
        if (!$query) {
            $query = 0;
            //echo "se generó una mala consulta";
        }
        else
        {
            return $query->row_array();
        }
    }

    function getAcumuladoDia($regional)
    {
        $query = $this->BDCentral->query("SELECT TOP 100 [Region]
              ,[COD_POS],[CDE],[TotalTurnos],[TotalturnosAtendidos],[TotalturnosAbandonados]
              ,[Puntuales]
              ,CASE WHEN [TotalturnosAtendidos] != 0 THEN CAST([TotalturnosAtendidos] AS FLOAT)/CAST([TotalTurnos] AS FLOAT) END AS NS
              ,[Percepcion],[ASASeg],[AHTSeg],[Entre0_5],[Entre5_15]
              ,[Entre15_30],[Entre30_45],[Entre45_60],[Mayor60]
          FROM [TIGOCENTRAL].[dbo].[DIGITURNO_ACUMULADO_DIA]
          WHERE totalturnos != 0 and Region = '$regional'  ORDER by [Percepcion]");

        if (!$query) {
            $query = 0;
            //echo "se generó una mala consulta";
        }
        else
        {
            return $query->result_array();
        }

    }

    function getListaNombresCDEs()
    {
      $query = $this->BDCentral->query("SELECT TOP 1000 [OFI_SDSTRNOMBRE] as cde, [OFI_SDSTRREGION] as regional,[OFI_SDSTRCIUDAD] as ciudad
            FROM [TIGOCENTRAL].[dbo].[DG45_OFICINAS]");

      if (!$query) {
            $query = 0;
            //echo "se generó una mala consulta";
      }
      else
      {
            return $query->result_array();
      }
    }

     function getListaCDEsRegional($regional)
    {
      $query = $this->BDCentral->query("SELECT [OFI_PKSTRID] as codpos, [OFI_SDSTRNOMBRE] as cde, 
            [OFI_SDSTRREGION] as regional,[OFI_SDSTRCIUDAD] as ciudad
            FROM [TIGOCENTRAL].[dbo].[DG45_OFICINAS] WHERE [OFI_SDSTRREGION] = '".$regional."'");

      if (!$query) {
            $query = 0;
            //echo "se generó una mala consulta";
      }
      else
      {
            return $query->result_array();
      }
    }

    
    function getRacsTiempoReal($oficina)
    {
      $quer = "DECLARE @fecha AS DATETIME
              DECLARE @cde AS VARCHAR(50)
              SELECT @CDE = '$oficina' 
              select @fecha = max(fecha_ahora) FROM [TIGOCENTRAL].[dbo].[INFO_RACS]  where cde = @CDE   group by Fecha_ahora

              SELECT *  FROM [TIGOCENTRAL].[dbo].[INFO_RACS]
              where cde = @CDE and Fecha_ahora = @fecha
              ORDER BY LABOR DESC, TIEMPO DESC, AHT_MIN DESC";

      $query = $this->BDCentral->query($quer);

      if (!$query) {

        $query = 0;
      }
      else
      {
        //print_r($query->result_array());
        return $query->result_array();
      }
    }

      function  getChartEstadoAsesores($oficina)
      {
        $query = $this->BDCentral->query("DECLARE @fecha AS DATETIME
                DECLARE @cde AS VARCHAR(50)
                SELECT @CDE = '$oficina'
                select @fecha = max(fecha_ahora) FROM [TIGOCENTRAL].[dbo].[INFO_RACS]  where cde = @CDE   group by Fecha_ahora

                SELECT LABOR, COUNT(1) FROM (
          SELECT *  FROM [TIGOCENTRAL].[dbo].[INFO_RACS]
                where cde = @CDE and Fecha_ahora = @fecha) METIS
          GROUP BY LABOR");

        //return $query->result_array();
        if ($query) {
          
          return $query->result_array();
        }
      }

    function getClientesEspera($CDE)
    {
      $query = $this->BDCentral->query("SELECT *  FROM [TIGOCENTRAL].[dbo].[INFO_CLIENTES_ESPERA] 
            WHERE CDE = '$CDE'");

      if (!$query) {

        $query = 0;
      }
      else
      {
        //print_r($query->result_array());
        return $query->result_array();
      }

    }

    function GTREspera($Regional = NULL)
    {

        if ($Regional != null) {

            $consulta = "SELECT * from (
            SELECT *, cast(fecha_ahora as date) as fecha FROM (  
                          SELECT * FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA] AS TABLA_COMPLETA
                          JOIN (
                          SELECT NOMBRE AS NOMBRE2, max(fecha_ahora) as fecha_max FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA]
                          group by nombre) AS AGRUPADO

                          ON TABLA_COMPLETA.NOMBRE = AGRUPADO.NOMBRE2 AND TABLA_COMPLETA.FECHA_AHORA = AGRUPADO.FECHA_MAX ) AS TABLET
                    WHERE REGIONAL = '$Regional'
                  ) as espera
            left join (SELECT SUBSTRING(SER_SDSTRDESCRIPCION, 5, 200) as CDE, [SER_SDSTRSERVIDOR] as ip
              FROM [TIGOCENTRAL].[dbo].[DG45_SERVIDORES_REP]) as ips
            on espera.nombre = ips.CDE
            ORDER by Regional, cast(fecha_max as date) desc, SL, PS";
            
        }else{

            $consulta = "SELECT * from (
            SELECT *, cast(fecha_ahora as date) as fecha FROM (  
                          SELECT * FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA] AS TABLA_COMPLETA
                          JOIN (
                          SELECT NOMBRE AS NOMBRE2, max(fecha_ahora) as fecha_max FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA]
                          group by nombre) AS AGRUPADO

                          ON TABLA_COMPLETA.NOMBRE = AGRUPADO.NOMBRE2 AND TABLA_COMPLETA.FECHA_AHORA = AGRUPADO.FECHA_MAX ) AS TABLET
                  ) as espera
            left join (SELECT SUBSTRING(SER_SDSTRDESCRIPCION, 5, 200) as CDE, [SER_SDSTRSERVIDOR] as ip
              FROM [TIGOCENTRAL].[dbo].[DG45_SERVIDORES_REP]) as ips
            on espera.nombre = ips.CDE
            ORDER by Regional, cast(fecha_max as date) desc, SL, PS";
        }
        
        $query = $this->BDCentral->query($consulta);

        if ($query) {

          return $query->result_array();
        }

    }

    function GTREsperaCDE($CDE)
    {

        $consulta4 = "SELECT * FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA]
                    WHERE NOMBRE LIKE '%$CDE%'
                    order by Regional, SL, PS";

        $consulta = "SELECT * from (
            SELECT *, cast(fecha_ahora as date) as fecha FROM (  
                          SELECT * FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA] AS TABLA_COMPLETA
                          JOIN (
                          SELECT NOMBRE AS NOMBRE2, max(fecha_ahora) as fecha_max FROM [TIGOCENTRAL].[dbo].[INFO_GTR_ESPERA]
                          group by nombre) AS AGRUPADO

                          ON TABLA_COMPLETA.NOMBRE = AGRUPADO.NOMBRE2 AND TABLA_COMPLETA.FECHA_AHORA = AGRUPADO.FECHA_MAX ) AS TABLET
               WHERE NOMBRE LIKE '%$CDE%'
                  ) as espera
            left join (SELECT SUBSTRING(SER_SDSTRDESCRIPCION, 5, 200) as CDE, [SER_SDSTRSERVIDOR] as ip
              FROM [TIGOCENTRAL].[dbo].[DG45_SERVIDORES_REP]) as ips
            on espera.nombre = ips.CDE
            ORDER by Regional, cast(fecha_max as date) desc, SL, PS";
                
        $query = $this->BDCentral->query($consulta);

        if ($query) {

          return $query->result_array();
        }

    }
}

 ?>