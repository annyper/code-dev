<?php 
class Analytics extends CI_Controller
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


    function index()
    {
         $this->load->view('error/error404');
    }
}

 ?>

 ?>