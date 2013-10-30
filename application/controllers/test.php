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

        $this->load->view('templates/header', $data);
        
        
        $this->benchmark->mark('perro');
        $data['row'] = $this->test_model->getRacsTiempoReal();
        $this->benchmark->mark('gato');

        
        $this->load->view('test/index', $data);

        $this->load->view('templates/footer', $data);        
    }

}

 ?>