<?php 

/**
* 
*/
class Test extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();


        $this->load->helper('url');

        $this->load->model('test/test_model');

	}

	function index()
    {
        //echo "string";
        //echo "<h1>hola mundo<h1>";
        $data['title'] = 'Inicio';
        $data['lasd'] = 'Lasd';

        echo "<pre>";
        $this->benchmark->mark('perro');
        print_r($this->test_model->getActividad());
        $this->benchmark->mark('gato');
        echo "</pre>";
        
        $this->load->view('test/index', $data);           
    }

}

 ?>