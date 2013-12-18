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
          
        $this->chartActividadAsesores();     

        $this->load->view('templates/footer', $data); 
    }

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

        //$this->chartActividadAsesores($oficina, $data['ipCifrada']);
    }

// ------------------AJAX ---------------------------------------
    function cargarModalTurnoAjax($terminal, $idTurno, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {
            
            //$ipCifrada = urldecode($ipCifrada);
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
        //}
    }

    function renderRacsTiempoReal($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {
            
            //$ipCifrada = urldecode($ipCifrada);
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

            //$ipCifrada = urldecode($ipCifrada);
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

            //$ipCifrada = urldecode($ipCifrada);
            $ipCifrada = str_replace("-", "/", $ipCifrada);
            $ipCifrada = str_replace("_", "+", $ipCifrada);
            $ipCifrada = str_replace("á", "=", $ipCifrada);

            $ip = $this->encrypt->decode($ipCifrada);

            $this->test_model->inicializar($ip);
            //$this->test_model->inicializar('10.74.28.242');

            $datetimeInicio = date('Y-m-d') . ' 07:00:00';
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

    function renderAlmuerzoHistorico($ipCifrada)
    {
            $this->inicializarModeloYdecodificarIP($ipCifrada);
            $datetimeInicio = date('Y-m-d') . ' 07:00:00';

            $data['AlmuerzoHistorico'] = $this->test_model->getActividadHistorico($datetimeInicio, date('Y-m-d H:i:s'), 'Almuerzo', 3600);
            $this->load->view('test/almuerzo-no-justificado', $data);

            //echo "<pre>"; print_r($data['AlmuerzoHistorico']); echo "</pre>";
    }

    function chartCientesEspera($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {
            
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

        //}
    }

    function chartEstadoAsesores($oficina, $ipCifrada)
    {
        $this->inicializarModeloYdecodificarIP($ipCifrada);

        $oficina = str_replace("-", " ", $oficina);

        $data['series'] = $this->test_model->getChartEstadoAsesores($oficina);

        foreach ($data['series'] as $key => $value) {
            $data['series'][$key]['data'] = array(0 => $value['']);
            unset($data['series'][$key]['']);

            if ($value['LABOR']  == "Disponible") {
                 $data['series'][$key]['color'] = "rgb(67, 183, 96)";//

            } elseif ($value['LABOR'] == "Desconectado") {
                $data['series'][$key]['color'] = "rgb(108, 108, 108)";//

            } elseif ($value['LABOR'] == "Arranque Terminal") {
                $data['series'][$key]['color'] = "rgb(124, 124, 124)";

            } elseif ($value['LABOR'] == "Fin de Jornada") {
                $data['series'][$key]['color'] = "rgb(31, 43, 82)";//

            } elseif ($value['LABOR'] == "Cierre Arranque") {
                $data['series'][$key]['color'] = "rgb(140, 140, 140)";

            } elseif ($value['LABOR'] == "Ocupado") {
                $data['series'][$key]['color'] = "rgb(62, 86, 166)";//

            } elseif ($value['LABOR'] == "Capacitación") {
                $data['series'][$key]['color'] = "rgb(134, 101, 0)";//

            } elseif ($value['LABOR'] == "Baño") {
                $data['series'][$key]['color'] = "rgb(202, 152, 0)";//

            } elseif ($value['LABOR'] == "Break") {
                $data['series'][$key]['color'] = "rgb(223, 237, 58)";

            } elseif ($value['LABOR'] == "Paso Primera Línea") {
                $data['series'][$key]['color'] = "rgb(255, 202, 40)";

            } elseif ($value['LABOR'] == "Labor Administrativa") {
                $data['series'][$key]['color'] = "rgb(244, 121, 10)";//

            } elseif ($value['LABOR'] == "Sin turno") {
               $data['series'][$key]['color'] = "rgb(202, 29, 15)";//

            } elseif ($value['LABOR'] == "Almuerzo") {
               $data['series'][$key]['color'] = "rgb(137, 59, 195)";//

            }elseif ($value['LABOR'] == "Orientador") {
               $data['series'][$key]['color'] = "rgb(45, 200, 255)";//

            } elseif ($value['LABOR'] == "Llamando") {
               $data['series'][$key]['color'] = "rgb(159, 248, 156)";//rgba(159, 248, 156, 0.93)
            }
        }

        //echo "<pre>"; print_r($data['series']); echo "</pre>";

        $dataJSON['jsonCodificado'] = json_encode($data['series']);

        $dataJSON['jsonCodificado'] = str_replace("LABOR", "name", $dataJSON['jsonCodificado']);
        //echo "<pre>"; echo $dataJSON['jsonCodificado']; echo "</pre>";

        $this->load->view('test/charts/chartEstadoAsesoresView', $dataJSON);
    }

    protected function inicializarModeloYdecodificarIP($ipCifrada)
    {
        //$ipCifrada = urldecode($ipCifrada);
        $ipCifrada = str_replace("-", "/", $ipCifrada);
        $ipCifrada = str_replace("_", "+", $ipCifrada);
        $ipCifrada = str_replace("á", "=", $ipCifrada);
        $ip = $this->encrypt->decode($ipCifrada);
        $this->test_model->inicializar($ip);
    }

    function chartActividadAsesores()
    {
        $ip = '10.75.46.34'; //'10.74.28.242';
        $this->test_model->inicializar($ip);

        //$this->inicializarModeloYdecodificarIP($ipCifrada);

    //----------- Consulta a la BD-------------------------------------------------------------------------------
        $datetimeInicio = date('Y-m-d') . ' 08:00:00';

        $data['series'] = $this->test_model->getActividadAsesoresPorDia($datetimeInicio, date('Y-m-d H:i:s'));
    //----------------------------------------------------------------------------------------------------------
        //echo "<pre>"; print_r($data['series']); echo "</pre>";


    //--------------------- Reorganización del Arreglo ---------------------------------------
        // foreach ($data['series'] as $key => $value) {
        //     $data['asesores'][$key] = $value['nombre'];
        // }
        // $data['asesores'] = array_unique($data['asesores']);

        // echo "<pre>"; print_r($data['asesores']); echo "</pre>";
    // ---------------------------------------------------------------------------------------


    // -------------------- ------------------------------------------------------------
        foreach ($data['series'] as $key => $value) {
            $data['series'][$key]['tiempo'] = array(0 => $value['tiempo']*1000);

            if ($value['labor']  == "Disponible") {
                 $data['series'][$key]['color'] = "rgb(67, 183, 96)";//

            } elseif ($value['labor'] == "Desconectado") {
                $data['series'][$key]['color'] = "rgb(108, 108, 108)";//

            } elseif ($value['labor'] == "Arranque Terminal") {
                $data['series'][$key]['color'] = "rgb(124, 124, 124)";

            } elseif ($value['labor'] == "Fin de Jornada") {
                $data['series'][$key]['color'] = "rgb(31, 43, 82)";//

            } elseif ($value['labor'] == "Cierre Arranque") {
                $data['series'][$key]['color'] = "rgb(140, 140, 140)";

            } elseif ($value['labor'] == "Ocupado") {
                $data['series'][$key]['color'] = "rgb(62, 86, 166)";//

            } elseif ($value['labor'] == "Capacitación") {
                $data['series'][$key]['color'] = "rgb(134, 101, 0)";//

            } elseif ($value['labor'] == "Baño") {
                $data['series'][$key]['color'] = "rgb(202, 152, 0)";//

            } elseif ($value['labor'] == "Break") {
                $data['series'][$key]['color'] = "rgb(223, 237, 58)";

            } elseif ($value['labor'] == "Paso Primera Línea") {
                $data['series'][$key]['color'] = "rgb(255, 202, 40)";

            } elseif ($value['labor'] == "Labor Administrativa") {
                $data['series'][$key]['color'] = "rgb(244, 121, 10)";//

            } elseif ($value['labor'] == "Sin turno") {
               $data['series'][$key]['color'] = "rgb(202, 29, 15)";//

            } elseif ($value['labor'] == "Almuerzo") {
               $data['series'][$key]['color'] = "rgb(137, 59, 195)";//
            }
        }


        //$data['series'] = count($data['series']) - 1;
        $data['milisegundos'] = 0;

        // tiempo actual en microsegundos
        $pieces = explode(":", date('H:i:s'));
        $data['max'] = ($pieces[0]*3600 + $pieces[1]*60 + $pieces[2]) * 1000;

  
        $barraOut = array('labor' => 'Out',
                            'tiempo' => array('0' => 0),
                            'color' => 'rgba(255, 255, 255, 0)',
                            'nombre' => 'nn'
                            );

        $asesor0 = $data['series'][0]['nombre'];
        $index = 0;
        foreach ($data['series'] as $key => $value) {
            
            if ($value['nombre'] == $asesor0) {
                
                $data['asesores'][$asesor0][$index] = $value; 
                $index = $index + 1;

                 // se coloca la barra out en caso que sea el final del arreglo
                if ($key == count($data['series']) - 1) {

                    $barraOut['tiempo'][0] = $value['segundos']*1000;
                    $data['asesores'][$asesor0][$index] = $barraOut;
                }

            } else {
                // se coloca la barra out 
                $barraOut['tiempo'][0] = $data['series'][$key-1]['segundos']*1000;
                $data['asesores'][$asesor0][$index] = $barraOut;

                $index = 0;
                $asesor0 = $value['nombre'];
                $data['asesores'][$asesor0][$index] = $value; 
            }
            
        }

        foreach ($data['asesores'] as $key => $value) {
            
            $jsonString = json_encode($value);
            $jsonString = str_replace("labor", "name", $jsonString);
            $jsonString = str_replace("tiempo", "data", $jsonString);
            $data['dataJSON'][$key]['CadenaJson'] = $jsonString;

            $data['dataJSON'][$key]['out'][0] = $value[count($value)-1]['tiempo'][0];
        }

        //echo "<pre>"; print_r($data); echo "</pre>";

        // $data['dataJSON'] = json_encode($data['series']);
        // $data['dataJSON'] = str_replace("labor", "name", $data['dataJSON']);
        // $data['dataJSON'] = str_replace("tiempo", "data", $data['dataJSON']);

        //echo "<pre>"; print_r($actividad); echo "</pre>";
        
        $this->load->view('test/charts/chartsActividadAsesores', $data);
    }

}

 ?>