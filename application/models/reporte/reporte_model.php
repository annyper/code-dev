<?php 


/**
* 
*/
class Reporte_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->infococ = $this->load->database('bd_cded_cde_pda1',TRUE);
	}


    function getListaCDEsRegional($regional)
    {
    	$sql= "SELECT [OFI_PKSTRID] as value, REPLACE([OFI_SDSTRNOMBRE],' /12','') as name
            FROM [TIGOCENTRAL].[dbo].[DG45_OFICINAS]";
        //if($regional!="0"){
        	$sql=$sql." WHERE [OFI_SDSTRREGION] = '".$regional."' ORDER BY [OFI_SDSTRNOMBRE]";
        //}
      $query = $this->db->query($sql);

      if ($query) {      
            return $query->result_array();
      }
  	}

	function getkpiCDE($cde,$fechaini,$fechafin)
    {
    	$sql= "SELECT Region, COD_POS codpos, REPLACE([CDE],' /12','') cde,
				NivelServicio ns,Percepcion ps, ASASeg asa, AHTSeg aht,
				TotalTurnosAtendidos visitasAten, Puntuales visitasAtenPun,
				TotalturnosAbandonados aba, AbandonadosPuntuales abaPunt,
        Entre15_30,Entre30_45,Entre45_60,Mayor60,
				TotalTurnos visitasTotal
				 FROM [dbo].[ACUMULADO_FECHAS] (
				   '".date_format($fechaini,"Y-m-d H:i:s")."'
				  ,'".date_format($fechafin,"Y-m-d H:i:s")."') WHERE COD_POS = '$cde'";
        
      $query = $this->db->query($sql);

      if ($query) {      
            return $query->result_array();
      }
     
  	}

  	function getkpiRegional($regional,$fechaini,$fechafin)
    {
    	$sql= "SELECT Region, 
				NivelServicio ns,Percepcion ps, ASASeg asa, AHTSeg aht,
				TotalTurnosAtendidos visitasAten, Puntuales visitasAtenPun,
				TotalturnosAbandonados aba, AbandonadosPuntuales abaPunt,
        Entre15_30,Entre30_45,Entre45_60,Mayor60,
				TotalTurnos visitasTotal
				 FROM [dbo].[ACUMULADO_FECHAS_REGIONAL] (
				   '".date_format($fechaini,"Y-m-d H:i:s")."'
				  ,'".date_format($fechafin,"Y-m-d H:i:s")."') WHERE Region = '$regional'";
        
      $query = $this->db->query($sql);

      if ($query) {      
            return $query->result_array();
      }
     
  	}

  	function getkpiPais($fechaini,$fechafin)
    {
    	$sql= "SELECT Regional pais, 
				NivelServicio ns,Percepcion ps, ASASeg asa, AHTSeg aht,
				TotalTurnosAtendidos visitasAten, Puntuales visitasAtenPun,
				TotalturnosAbandonados aba, AbandonadosPuntuales abaPunt,
        Entre15_30,Entre30_45,Entre45_60,Mayor60,
				TotalTurnos visitasTotal
				 FROM [dbo].[ACUMULADO_FECHAS_PAIS] (
				   '".date_format($fechaini,"Y-m-d H:i:s")."'
				  ,'".date_format($fechafin,"Y-m-d H:i:s")."')";
        
      $query = $this->db->query($sql);

      if ($query) {      
            return $query->result_array();
      }
     
  	}

    function mes_nom($mes){
    if($mes=='01'){return 'ENERO';}
    elseif($mes=='02'){return 'FEBRERO';}
    elseif($mes=='03'){return 'MARZO';}
    elseif($mes=='04'){return 'ABRIL';}
    elseif($mes=='05'){return 'MAYO';}
    elseif($mes=='06'){return 'JUNIO';}
    elseif($mes=='07'){return 'JULIO';}
    elseif($mes=='08'){return 'AGOSTO';}
    elseif($mes=='09'){return 'SEPTIEMBRE';}
    elseif($mes=='10'){return 'OCTUBRE';}
    elseif($mes=='11'){return 'NOVIEMBRE';}
    elseif($mes=='12'){return 'DICIEMBRE';}
   } 

    function getCierreMesFechas(){
    $query = $this->infococ->query("SELECT max(periodo) as periodo FROM cocinfo.cierre_mes");
    $periodo = $query->result_array();
      
    $periodo=$periodo[0]['periodo'];
    
    $fecha = new DateTime($periodo.'01');
    $intervalo = new DateInterval('P1M');
    $fecha->sub($intervalo);
    $periodoAnt=$fecha->format('Ym');
    $fecha->sub($intervalo);
    $periodoAnt2=$fecha->format('Ym');
   
    $mes['mes']=$periodo;
    $mes['mesAnt']=$periodoAnt;
    $mes['mesAnt2']=$periodoAnt2;    
    
    return $mes;
    }

    function getCierreMesKpi($mes,$mesAnt,$mesAnt2){      
    $sql="SELECT a.segmento, a.indicador,a.tipo,a.unidad,
      a.meta as metaact,a.valor as valoract,b.meta as metaant,
      b.valor as valorant,c.valor as valorant2
    FROM
    (SELECT segmento,indicador,meta,valor,tipo,unidad 
    FROM cocinfo.cierre_mes where periodo = '$mes'
    order by segmento,indicador) as a left join 
    (SELECT segmento,indicador,meta,valor,tipo, unidad 
    FROM cocinfo.cierre_mes where periodo = '$mesAnt'
    order by segmento,indicador) as b 
    on (a.segmento=b.segmento and a.indicador=b.indicador)
    left join (SELECT segmento,indicador,meta,valor,tipo, unidad 
    FROM cocinfo.cierre_mes where periodo = '$mesAnt2'
    order by segmento,indicador) as c on (a.segmento=c.segmento and a.indicador=c.indicador)";

    $query = $this->infococ->query($sql);
    

    return $query->result_array();
    }

  	
}