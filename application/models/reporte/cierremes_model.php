<?php 


/**
* 
*/
class Cierremes_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
        $this->infococ = $this->load->database('bd_cded_cde_pda1',TRUE);
       
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

		$anoy=substr($periodo, 0, 4);
		$mes=substr($periodo, -2);
		$anoAnt=substr($periodoAnt, 0, 4);
		$mesAnt=substr($periodoAnt, -2);
		$anoAnt2=substr($periodoAnt2, 0, 4);
		$mesAnt2=substr($periodoAnt2, -2);

		$mes['mes']=mes_nom($mes);
		$mes['mesAnt']=mes_nom($mesAnt);
		$mes['mesAnt2']=mes_nom($mesAnt2);		
		
		return $mes;
    }

	function getCierreMesKpi($mes,$mesAnt,$mesAnt2){			
		$sql="select a.segmento, a.indicador,a.tipo,a.unidad,
			a.meta as metaact,a.valor as valoract,b.meta as metaant,
			b.valor as valorant,c.valor as valorant2
		from
		(SELECT segmento,indicador,meta,valor,tipo,unidad 
		FROM cocinfo.cierre_mes where periodo = '$periodo'
		order by segmento,indicador) as a left join 
		(SELECT segmento,indicador,meta,valor,tipo, unidad 
		FROM cocinfo.cierre_mes where periodo = '$periodoAnt'
		order by segmento,indicador) as b 
		on (a.segmento=b.segmento and a.indicador=b.indicador)
		left join (SELECT segmento,indicador,meta,valor,tipo, unidad 
		FROM cocinfo.cierre_mes where periodo = '$periodoAnt2'
		order by segmento,indicador) as c on (a.segmento=c.segmento and a.indicador=c.indicador)";

		$query = $this->db->query("SELECT max(periodo) as periodo FROM cocinfo.cierre_mes");
		

		return $query->result_array();
    }

  	
}
    
