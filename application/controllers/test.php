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
        
        $datetimeInicio = date('Y-m-d') . ' 08:00:00';
        $data['sinturno'] = $this->test_model->getSinTurnoHistorico($datetimeInicio, date('Y-m-d H:i:s'));
        
        $this->load->view('test/index', $data);

        $this->load->view('templates/footer', $data);        
    }

    // alpha
    function asesores($id_asesores)
    {

    }

    function cargarModalTurnoAjax($terminal, $idTurno)
    {
        if ($this->input->is_ajax_request()) {
            
            $terminal = str_replace("-", " ", $terminal);
            $col['colas'] = $this->test_model->getColas($terminal);
            $col['servicios'] = $this->test_model->getServicios($idTurno);

            $this->load->view('test/turno_detalles',$col);

            //echo "<pre>"; print_r($col); echo "</pre>";
        }
    }

    function renderRacsTiempoReal()
    {
        if ($this->input->is_ajax_request()) {

            $data['row'] = $this->test_model->getRacsTiempoReal();
            $this->load->view('test/racsTiempoReal', $data);
        }
    }

    function renderSinTurno()
    {
        if ($this->input->is_ajax_request()) {

            $datetimeInicio = date('Y-m-d') . ' 08:00:00';
            $data['sinturno'] = $this->test_model->getSinTurnoHistorico($datetimeInicio, date('Y-m-d H:i:s'));
            $this->load->view('test/sin_turno', $data);
        }
    }

    function cargarModalColaAjax()
    {
        if ($this->input->is_ajax_request()) {

            echo "Hola Mundo! jajajaj";
        }
    }

    function cargarModalColaAjax2()
    {
        if ($this->input->is_ajax_request()) {

            echo "Hola Mundo2!";
        }
    }
}

 ?>