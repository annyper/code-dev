<?php 

/**
* 
*/
class Sms extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        $this->load->helper('url');
        error_reporting(0);

        $this->load->model('consolidados/gtrSMS_model');


       
        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');

	}

    function getClientesSMS(){
       // $data = $this->checkList_model->getClientesSMS();
        //echo $data;
    }

    function setClienteSMS(){
        
        $this->gtrSMS_model->setClienteSMS();
    }

    function deleteClienteSMS($id){
        $this->gtrSMS_model->deleteClienteSMS($id);
    }

    function updateClienteSMS($id){
        $this->gtrSMS_model->updateClienteSMS($id);
    }

}

 ?>