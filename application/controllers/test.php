<?php 

/**
* 
*/
class Test extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

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
        $datetimeInicio = date('Y-m-d') . ' 08:00:00';
        $data['sinturno'] = $this->test_model->getSinTurnoHistorico($datetimeInicio, date('Y-m-d H:i:s'));
        
        $this->load->view('test/index', $data);

        $this->load->view('templates/footer', $data);        
    }

    // alpha
    function asesores($id_asesores)
    {
        $data['title'] = 'Inicio';
        $data['lasd'] = 'Lasd';

        $this->load->view('templates/header', $data);
        
        
        $this->benchmark->mark('perro');
        $data['row'] = $this->test_model->getRacsTiempoReal();
        $this->benchmark->mark('gato');

        
        $this->load->view('test/index', $data);

        $this->load->view('templates/footer', $data); 
    }

    function cargarModalTurnoAjax($terminal, $idTurno)
    {
        if ($this->input->is_ajax_request()) {
            echo "holaaaaaaaaa";
            $terminal = str_replace("-", " ", $terminal);
            $col['colas'] = $this->test_model->getColas($terminal);
            $col['servicios'] = $this->test_model->getServicios($idTurno);

            $this->load->view('test/turno_detalles',$col);

            //echo "<pre>"; print_r($col); echo "</pre>";
        }
    }

    function cargarModalColaAjax()
    {
        if ($this->input->is_ajax_request()) {


        }
    }
}

 ?>