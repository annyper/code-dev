<?php 

/**
* 
*/
class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        $this->load->helper('url');
        error_reporting(0);

        $this->load->model('gtr/test_model');
        $this->load->model('consolidados/checkList_model');

        $this->load->model('consolidados/Consolidados_model');
       
        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');

	}


	function index($oficina = 0)
    {
        
    }
    function acumulado($ip = null){
        try {
            if (isset($ip)) {
                $this->test_model->inicializar($ip);
                echo $this->test_model->acumulado();
            }   
            
        } catch (Exception $e) {
            echo $e->errorMessage();
        }
     
    }

    function disponiblesNoJustificados(){

        $data['title'] = 'Analytics';
        $data['lasd'] = 'COC';
        $data['nav'] = 'analytics';

        $data['data'] = $this->Consolidados_model->getDisponiblesNoJustificados('2014-01-15 00:00:00', '2014-01-15 23:59:59');

        $this->load->view('templates/header', $data);
        echo "<pre>"; print_r($data['data']); echo "</pre>";
        $this->load->view('templates/footer', $data);

    }


}

 ?>