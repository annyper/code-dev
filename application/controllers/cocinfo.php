<?php 

/**
* 
*/
class Cocinfo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        $this->load->helper('url');
        //error_reporting(0);

        $this->load->model('consolidados/checkList_model');

        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');

	}

	function horariosCDE(){

        $data['data'] = $this->checkList_model->getHorario();
        echo "string";
        echo "<pre>"; print_r($data['data']); echo "</pre>";
    }

    function checkListDeApertura(){

    	$this->form_validation->set_rules('fechaInicioCheck1', 'Fecha inicio', 'trim|required|xss_clean|htmlspecialchars');
    	$this->form_validation->set_rules('fechaInicioCheck2', 'Fecha fin', 'trim|required|xss_clean|htmlspecialchars');

        if ($this->form_validation->run()) {

            $fechaConsultadaInicio = $this->input->post('fechaInicioCheck1');
            $fechaConsultadaFin = $this->input->post('fechaInicioCheck2');

            $data['checkRegional']['Costa'] = $this->input->post('checkCosta');
            $data['checkRegional']['Centro'] = $this->input->post('checkCentro');
            $data['checkRegional']['Noroccidente'] = $this->input->post('checkNoroccidente');
            $data['checkRegional']['Suroccidente'] = $this->input->post('checkSuroccidente');
            $data['checkRegional']['Oriente'] = $this->input->post('checkOriente');

            $filtro = "''"; $contador = null;
            foreach ($data['checkRegional'] as $key => $value) {
            	if (strlen($value) != 0) {
            		$filtro =  $filtro . "," . "'" . $value . "'";
            	}
            	
            	$contador = $contador . $value;
            }
            $filtro . "'";
            $contador;

            if (strlen($contador) == 0) {
				$filtro = null;
			}else{
				$filtro = "WHERE REGIONAL in (" . $filtro . ")";
			}
            $datetimeInicio = $fechaConsultadaInicio;
            $datetimeFin = $fechaConsultadaFin;      

	        $data['data'] = $this->checkList_model->getCheckListDeApertura($datetimeInicio, $datetimeFin, $filtro);
	        
	        $this->load->view('analytics/checklist', $data);
	        
	        //echo "<pre>"; print_r($data['data']); echo "</pre>";

        }

        
    }

}

 ?>