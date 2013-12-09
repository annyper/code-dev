<?php 

/**
* 
*/
class Test extends CI_Controller
{

    //protected $ipCDE;
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        session_start();

        $this->load->helper('url');

        $this->load->model('test/config_model');
        $this->load->model('test/test_model');

        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

	}

	function index()
    {
        //echo "string";
        //echo "<h1>hola mundo<h1>";
        $data['title'] = 'Inicio';
        $data['lasd'] = 'Lasd';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/footer', $data);        
    }

    // alpha
    function cde($oficina)
    {
        $data['title'] = 'Inicio';
        $data['lasd'] = 'Lasd';

        //$data['oficina'] = str_replace("-", " ", $oficina);
        $data['oficina'] = $oficina;

        $data['ip_info'] = $this->config_model->getIP($oficina);
        //

        echo $data['ip_info']['SER_SDSTRSERVIDOR'];
        $data['ipCifrada'] = $this->encrypt->encode($data['ip_info']['SER_SDSTRSERVIDOR']);
        
        $data['ipCifrada'] = str_replace("/", "-", $data['ipCifrada']);
        $data['ipCifrada'] = str_replace("+", "_", $data['ipCifrada']);
        $data['ipCifrada'] = str_replace("=", "á", $data['ipCifrada']);
        //echo "<pre>"; print_r($data); echo "</pre>";

        $this->load->view('templates/header', $data);
        
        $this->load->view('test/index', $data);

        $this->load->view('templates/footer', $data); 
    }


// ------------------AJAX ---------------------------------------
    function cargarModalTurnoAjax($terminal, $idTurno, $ipCifrada)
    {
        if ($this->input->is_ajax_request()) {
            
            $ipCifrada = urldecode($ipCifrada);
            $ipCifrada = str_replace("-", "/", $ipCifrada);
            $ipCifrada = str_replace("_", "+", $ipCifrada);
            $ipCifrada = str_replace("á", "=", $ipCifrada);

            $ip = $this->encrypt->decode($ipCifrada);

            $this->test_model->inicializar($ip);
            
            $terminal = str_replace("-", " ", $terminal);
            $col['colas'] = $this->test_model->getColas($terminal);
            $col['servicios'] = $this->test_model->getServicios($idTurno);

            $this->load->view('test/turno_detalles',$col);

            //echo "<pre>"; print_r($col); echo "</pre>";
        }
    }

    function renderRacsTiempoReal($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {
            
            $ipCifrada = urldecode($ipCifrada);
            $ipCifrada = str_replace("-", "/", $ipCifrada);
            $ipCifrada = str_replace("_", "+", $ipCifrada);
            $ipCifrada = str_replace("á", "=", $ipCifrada);

            $ip = $this->encrypt->decode($ipCifrada);
            //echo $ip;
            $this->test_model->inicializar($ip);
            
            $oficina = str_replace("-", " ", $oficina);
            //echo($oficina);
            $data['row'] = $this->test_model->getRacsTiempoReal($oficina);
            //echo "<pre>"; print_r($data['row']); echo "</pre>";

            $this->chartEstadoAsesores($oficina, $ipCifrada);

            $this->load->view('test/racsTiempoReal', $data);
        //}
    }

    function renderClientesEsperaTiempoReal($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {

            $ipCifrada = urldecode($ipCifrada);
            $ipCifrada = str_replace("-", "/", $ipCifrada);
            $ipCifrada = str_replace("_", "+", $ipCifrada);
            $ipCifrada = str_replace("á", "=", $ipCifrada);

            $ip = $this->encrypt->decode($ipCifrada);
            $this->test_model->inicializar($ip);

            $data['clientesEspera'] = $this->test_model->getClientesEsperaTiempoReal();

            $this->chartCientesEspera($oficina, $ipCifrada);

            $this->load->view('test/ClientesEsperaTiempoReal', $data);
        //}
    }

    function renderSinTurno($ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {

            $ipCifrada = urldecode($ipCifrada);
            $ipCifrada = str_replace("-", "/", $ipCifrada);
            $ipCifrada = str_replace("_", "+", $ipCifrada);
            $ipCifrada = str_replace("á", "=", $ipCifrada);

            $ip = $this->encrypt->decode($ipCifrada);

            $this->test_model->inicializar($ip);
            //$this->test_model->inicializar('10.74.28.242');

            $datetimeInicio = date('Y-m-d') . ' 08:00:00';
            $data['sinturno'] = $this->test_model->getSinTurnoHistorico($datetimeInicio, date('Y-m-d H:i:s'));
            //echo "<pre>"; print_r($data['sinturno']); echo "</pre>";
            $this->load->view('test/sin_turno', $data);
        //}
    }

    function renderSinTurnoTiempoReal($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {

            $this->inicializarModeloYdecodificarIP($ipCifrada);

            //echo $ip;

            $oficina = str_replace("-", " ", $oficina);

            $data['sinturnoTiempoReal'] = $this->test_model->getLaborTiempoReal($oficina, 'Sin turno');
            $this->load->view('test/sin_turnoTiempoReal', $data);
        //}
    }

    function chartCientesEspera($oficina, $ipCifrada)
    {
        if ($this->input->is_ajax_request()) {
            
            $this->inicializarModeloYdecodificarIP($ipCifrada);

            $oficina = str_replace("-", " ", $oficina);
            
            $data['series'] = $this->test_model->getChartClientesEspera($oficina);
            //$data['series']
            foreach ($data['series'] as $key => $value) {

                if ($value['ESPERANDO'] == 0) {

                    unset($data['series'][$key]['ESPERANDO']);
                }else{

                    $data['series'][$key]['ESPERANDO'] = array(0 => $value['ESPERANDO']);
                }
                
            }
            //echo "<pre>"; print_r(array('data' => 4)); echo "</pre>";
            //echo json_encode(array('data' => array(0 => 4)));
            $data['series'][0]['name'] = 'Siendo atendidos';
            $data['series'][1]['name'] = '[0, 15)';
            $data['series'][2]['name'] = '[15,30)';
            $data['series'][3]['name'] = '[30,45)';
            $data['series'][4]['name'] = '[45,60)';
            $data['series'][5]['name'] = 'Mas de 60';

            $data['series'][0]['color'] = 'rgb(62,86,166)';
            $data['series'][1]['color'] = 'rgb(67,183,96)';
            $data['series'][2]['color'] = 'rgb(255,194,14)';
            $data['series'][3]['color'] = 'rgb(246,133,30)';
            $data['series'][4]['color'] = 'rgb(112,48,160)';
            $data['series'][5]['color'] = 'rgb(240,65,50)';

            $data['series'] = array_reverse($data['series']);
            //echo "<pre>"; print_r($data['series']); echo "</pre>";
            $dataJSON['jsonCodificado'] = json_encode($data['series']);
            
            $dataJSON['jsonCodificado'] = str_replace("ESPERANDO", "data", $dataJSON['jsonCodificado']);
            //echo $dataJSON['jsonCodificado'];
            $this->load->view('test/charts/chartCientesEsperaView', $dataJSON);
            //echo "<pre>"; print_r($data); echo "</pre>";

        }
    }

    function chartEstadoAsesores($oficina, $ipCifrada)
    {
        $this->inicializarModeloYdecodificarIP($ipCifrada);

        $oficina = str_replace("-", " ", $oficina);

        $data['series'] = $this->test_model->getChartEstadoAsesores($oficina);

        foreach ($data['series'] as $key => $value) {
            $data['series'][$key]['data'] = array(0 => $value['']);
            unset($data['series'][$key]['']);
        }

        //echo "<pre>"; print_r($data['series']); echo "</pre>";

        $dataJSON['jsonCodificado'] = json_encode($data['series']);

        $dataJSON['jsonCodificado'] = str_replace("LABOR", "name", $dataJSON['jsonCodificado']);
        //echo "<pre>"; echo $dataJSON['jsonCodificado']; echo "</pre>";

        $this->load->view('test/charts/chartEstadoAsesoresView', $dataJSON);
    }

    protected function inicializarModeloYdecodificarIP($ipCifrada)
    {
        $ipCifrada = urldecode($ipCifrada);
        $ipCifrada = str_replace("-", "/", $ipCifrada);
        $ipCifrada = str_replace("_", "+", $ipCifrada);
        $ipCifrada = str_replace("á", "=", $ipCifrada);
        $ip = $this->encrypt->decode($ipCifrada);
        $this->test_model->inicializar($ip);
    }





}

 ?>