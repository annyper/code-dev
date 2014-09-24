<?php 
/**
* 
*/
class Hvc extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        //session_start();
        error_reporting(0);
        $this->load->helper('url');

        //$this->load->model('gtr/config_model');
        //$this->load->model('gtr/test_model');
        //$this->load->model('consolidados/checkList_model');
        $this->load->model('forCDEs/hvc_model');

        //$this->load->library('encrypt');
        //$this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');
	}
	function index($celular = null){

		if (!is_null($celular)) {

			$data = $this->hvc_model->get_hvc($celular);

			echo $data;

		}else {
			echo "no data";
		}
		
	}
}

 ?>