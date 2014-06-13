<?php 

/**
* 
*/
class Analytics extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        $this->load->helper('url');
        //error_reporting(0);
        $this->load->model('gtr/config_model');
        $this->load->model('gtr/test_model');
        $this->load->model('consolidados/checkList_model');
        $this->load->model('consolidados/Consolidados_model');

        //$this->load->model('consolidados/checkList_model');

        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');

	}


	function index($oficina = 0)
    {
        //echo "string";
        //echo "<h1>hola mundo<h1>";
        $data['title'] = 'Analytics';
        $data['lasd'] = 'COC';
        $data['listaCDEs'] = $this->checkList_model->getListaNombresCDEs();
        $data['nav'] = 'analytics';

        if (is_string($oficina) && $oficina != "0") {

            $data['oficina'] = $oficina;
            $data['ip_info'] = $this->checkList_model->getIP($oficina);

            $data['ipCifrada'] = $this->encrypt->encode($data['ip_info']['SER_SDSTRSERVIDOR']);
            
            $data['ipCifrada'] = str_replace("/", "-", $data['ipCifrada']);
            $data['ipCifrada'] = str_replace("+", "_", $data['ipCifrada']);
            $data['ipCifrada'] = str_replace("=", "", $data['ipCifrada']);

            $this->load->view('templates/header', $data);
            $this->load->view('gtr/includes/sidebarAnalytics', $data);
            $this->load->view('analytics/actividad', $data);
            $this->load->view('gtr/includes/endSidebar', $data); 
            $this->load->view('templates/footer', $data); 

        }elseif (is_string($oficina) && $oficina == "0"){

            $this->load->view('templates/header', $data);
             
            $this->load->view('analytics/index', $data);
    
            $this->load->view('templates/footer', $data); 

        }elseif ($oficina == 0) {
            redirect('analytics/index/0');
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