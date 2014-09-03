<?php 

/**
* 
*/
class Staff extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        //session_start();
        //error_reporting(0);
        $this->load->helper('url');

        $this->load->model('gtr/config_model');
        $this->load->model('staff/staff_model');
        //$this->load->model('gtr/test_model');
        $this->load->model('consolidados/checkList_model');

        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');
	}

	function index(){

		$this->load->view('staff/index');
	}

	function u($codPos, $date = null){

		$ip = $this->config_model->getIPbyPos($codPos); //***************
		$this->staff_model->inicializar($ip);
		//echo $ip;
		$data = $this->staff_model->getPronostico2($date);
		//echo "<pre>"; print_r($data); echo "</pre>";
		echo $data;
	}

	function getListaCodPos($regional = ''){

		$data = $this->staff_model->getListaCodPos($regional);
		echo $data;
		
	}

	// function getDatosApertura(){
	// 	$data = $this->checkList_model->getDatosApertura();

	// 	echo $data;
	// }

	
}

 ?>