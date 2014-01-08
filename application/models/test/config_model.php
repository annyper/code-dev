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

}

 ?>