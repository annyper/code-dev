<?php 

/**
* 
*/
class Regional extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        $this->load->helper('url');

        $this->load->model('gtr/config_model');
        $this->load->model('gtr/test_model');

        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');
	}

	function pie($regional)
    {
        $regional = strtoupper($regional);
        $data['title'] = $regional . " GTR";
        $data['lasd'] = 'COC';

        //$data['acumuladoDia'] = $this->config_model->getAcumuladoDia($regional);

        $this->load->view('templates/header', $data);
        
        //echo "<pre>"; print_r($data); echo "</pre>";
        
        $this->load->view('regional/pie', $data);

        $this->load->view('templates/footer', $data); 
    }
}


 ?>