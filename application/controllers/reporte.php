<?php 

/**
* 
*/
class Reporte extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        //session_start();
        //error_reporting(0);
        $this->load->helper('url');

        $this->load->model('reporte/reporte_model');
		 
        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);


        $this->load->library('form_validation');
        $this->load->helper('form');
	}

	function index()
    {
        
        $data['title'] = 'REPORTE KPI';
        $data['lasd'] = 'COC';
        $data['nav'] = 'kpiFechas';
                
        //echo "<pre>"; print_r($data); echo "</pre>";
        $this->load->view('templates/headerReporte', $data);
          
        $this->load->view('reporte/main/menu', $data);
        
        $this->load->view('templates/footer', $data);

    }

    
    function cierreMes()
    {   		
        $data['title'] = 'REPORTE - Cierre Mes';
        $data['lasd'] = 'COC';
        $data['nav'] = 'kpiCierreMes';        

		$periodos = $this->reporte_model->getCierreMesFechas();
		//echo "<pre>"; print_r($periodos); echo "</pre>";

		$info['kpi'] = $this->reporte_model->getCierreMesKpi($periodos['mes'],$periodos['mesAnt'],$periodos['mesAnt2']);
        $info['periodo'] = $periodos;

		//echo "<pre>"; print_r($info); echo "</pre>";

        $this->load->view('templates/headerReporte', $data);
        $this->load->view('reporte/cierre_mes/reporte', $info);
        $this->load->view('templates/footer', $data);
    }

    

    function renderCentralCDELst($region)
    {        
		$data['todo'] = true;
        $data['list'] = $this->reporte_model->getListaCDEsRegional($region);        
        
        //echo "<pre>"; print_r($data); echo "</pre>";
        $this->load->view('templates/optionList', $data);          
    }


    function renderPanelesKPI($region,$cde,$periodo,$fechas)
    {
    	$fechalst = explode("_", $fechas);
		$i=0;

		switch ($periodo) {
		    case 0:
		    	if($cde == 0){
		    		if($region == 0){
		    			foreach ($fechalst as $key => $fecha){
							$data[$i]['fecha'] = new DateTime($fecha);
							$fechafin = new DateTime($fecha);
							$fechafin->add(new DateInterval('P1D'));
				    		$data[$i]['kpi'] = $this->reporte_model->getkpiPais($data[$i]['fecha'],$fechafin);
				    		$i=$i+1;
				    	}	
		    		}else{
			    		foreach ($fechalst as $key => $fecha){
							$data[$i]['fecha'] = new DateTime($fecha);
							$fechafin = new DateTime($fecha);
							$fechafin->add(new DateInterval('P1D'));
				    		$data[$i]['kpi'] = $this->reporte_model->getkpiRegional($region,$data[$i]['fecha'],$fechafin);
				    		$i=$i+1;
				    	}		    			
		    		}
		    	}else{		    		
					foreach ($fechalst as $key => $fecha){
						$data[$i]['fecha'] = new DateTime($fecha);
						$fechafin = new DateTime($fecha);
						$fechafin->add(new DateInterval('P1D'));
			    		$data[$i]['kpi'] = $this->reporte_model->getkpiCDE($cde,$data[$i]['fecha'],$fechafin);
			    		$i=$i+1;
			    	}
			    }
		    	$todo['list'] = $data;

		        $todo['formatoFecha'] = '%b%d';
		        break;
		    case 1:
		    	if($cde == 0){
		    		if($region == 0){
		    			foreach ($fechalst as $key => $fecha){
							$data[$i]['fecha'] = new DateTime(substr($fecha, 0, 7)."-01");
							$fechafin = new DateTime(substr($fecha, 0, 7)."-01");
							$fechafin->add(new DateInterval('P1M'));
				    		$data[$i]['kpi'] = $this->reporte_model->getkpiPais($data[$i]['fecha'],$fechafin);
				    		$i=$i+1;
				    	}	
		    		}else{
			    		foreach ($fechalst as $key => $fecha){
							$data[$i]['fecha'] = new DateTime(substr($fecha, 0, 7)."-01");
							$fechafin = new DateTime(substr($fecha, 0, 7)."-01");
							$fechafin->add(new DateInterval('P1M'));
				    		$data[$i]['kpi'] = $this->reporte_model->getkpiRegional($region,$data[$i]['fecha'],$fechafin);
				    		$i=$i+1;
				    	}		    			
		    		}
		    	}else{		    		
					foreach ($fechalst as $key => $fecha){
						$data[$i]['fecha'] = new DateTime(substr($fecha, 0, 7)."-01");
						$fechafin = new DateTime(substr($fecha, 0, 7)."-01");
						$fechafin->add(new DateInterval('P1M'));
			    		$data[$i]['kpi'] = $this->reporte_model->getkpiCDE($cde,$data[$i]['fecha'],$fechafin);
			    		$i=$i+1;
			    	}
			    }
		    	$todo['list'] = $data;
		        $todo['formatoFecha'] = '%B';
		        break;
		    case 2:
		        $todo['formatoFecha'] = '%Y';
		        break;
		    default:
		    	$todo['formatoFecha'] = '%b%d';
		        break;
		}

		$todo['region'] = $region;
		$todo['cde'] = $cde;
    	
		//echo "<pre>"; print_r($todo); echo "</pre>";
		$this->load->view('reporte/main/paneles', $todo);
  	}

}


?>