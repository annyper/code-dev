<?php 

/**
* 
*/
class Gtr extends CI_Controller
{

    //protected $ipCDE;
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        //session_start();
        //error_reporting(0);
        $this->load->helper('url');

        $this->load->model('gtr/config_model');
        $this->load->model('gtr/test_model');
        $this->load->model('consolidados/checkList_model');

        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');

	}

	function index()
    {
        //echo "string";
        //echo "<h1>hola mundo<h1>";
        $data['title'] = 'GTR';
        $data['lasd'] = 'COC';
        $data['nav'] = 'gtr';

        //$data['Esp'] = $this->config_model->GTREspera();
        //$data['row'] = $this->config_model->getRacsTiempoReal('tigo centro medellin');
        //$data['cliEsp'] = $this->config_model->getClientesEspera('5000435');

        
        //echo "<pre>"; print_r($data); echo "</pre>";
        $this->load->view('templates/header', $data);
          
        $this->load->view('gtr/main/index.php', $data);

        $this->load->view('templates/footer', $data); 
    }

    function tiendasEspera($regional = null){

        $data['Esp'] = $this->config_model->GTREspera($regional);
        //echo "<pre>"; print_r($data); echo "</pre>";
        $this->load->view('gtr/main/tiendasEspera.php',  $data);
    }


    function tiendaBusqueda($CDE = null){
        $CDE = str_replace("-", " ", $CDE);
        $data['Esp'] = $this->config_model->GTREsperaCDE($CDE);
        //echo "<pre>"; print_r($data); echo "</pre>";
        $this->load->view('gtr/main/tiendasEspera.php',  $data);
    }

    function cde($oficina = null)
    {
        if ($oficina == null) {
            redirect('/gtr', 'refresh');
        }
        //$this->output->cache(60);
        $this->benchmark->mark('inicio');
        $data['title'] = str_replace("-", " ", $oficina) . " GTR";
        $data['lasd'] = 'COC';
        $data['nav'] = 'gtr';

        //$data['oficina'] = str_replace("-", " ", $oficina);
        $data['oficina'] = $oficina;

        //$data['ip_info'] = $this->checkList_model->getIP($oficina);
        $data['ip_info'] = $this->config_model->getIP($oficina);
        $data['listaCDEs'] = $this->checkList_model->getListaNombresCDEs();
        //echo "<pre>"; print_r($data['ip_info']); echo "</pre>";

        if (isset($data['ip_info']) && !empty($data['ip_info'])) {

            //echo "<pre>"; print_r($data['ip_info']); echo "</pre>";

        //  //echo $data['ip_info']['SER_SDSTRSERVIDOR'];
            $data['ipCifrada'] = $this->encrypt->encode($data['ip_info']['SER_SDSTRSERVIDOR']);
            
            $data['ipCifrada'] = str_replace("/", "-", $data['ipCifrada']);
            $data['ipCifrada'] = str_replace("+", "_", $data['ipCifrada']);
            $data['ipCifrada'] = str_replace("=", "", $data['ipCifrada']);

            //echo " " . $data['ipCifrada'] . " ";
            //echo "<pre>"; print_r($data); echo "</pre>";

            $this->load->view('templates/header', $data);
            $this->load->view('gtr/includes/sidebarGTR', $data);
            $this->load->view('gtr/includes/endSidebar', $data);
            $this->load->view('gtr/index', $data);
            
            $this->load->view('templates/footer', $data);
        }else {
            $this->load->view('templates/header', $data);
            $this->load->view('error/error404');
            $this->load->view('templates/footer', $data);
        }
         //$this->chartActividadAsesores($oficina, $data['ipCifrada']);

        $this->benchmark->mark('fin');
    }

    function dashboardEncabezado($ipCifrada)
    {
        $ipCifrada = str_replace("-", "/", $ipCifrada);
        $ipCifrada = str_replace("_", "+", $ipCifrada);
        $ipCifrada = str_replace("á", "=", $ipCifrada);

        $ip = $this->encrypt->decode($ipCifrada);
        $this->test_model->inicializar($ip);

        $data['gtr'] = $this->test_model->getGTR();

        $this->load->view('gtr/paneles/dashboardEncabezado',$data);
        //echo "<pre>"; print_r($data['gtr']); echo "</pre>";

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

            $this->load->view('gtr/turno_detalles',$col);

            //echo "<pre>"; print_r($col); echo "</pre>";
        //}
    }

    function renderRacsTiempoReal2($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {
            
            $ipCifradaChart = $ipCifrada;
            $ipCifrada = str_replace("-", "/", $ipCifrada);
            $ipCifrada = str_replace("_", "+", $ipCifrada);
            $ipCifrada = str_replace("á", "=", $ipCifrada);

            $ip = $this->encrypt->decode($ipCifrada);
            //echo $ip;
            $this->test_model->inicializar($ip);
            
            $oficina = str_replace("-", " ", $oficina);
            //echo($oficina);

            $contador = 0;
            $data['row'] = $this->test_model->getRacsTiempoReal($oficina);

            while ( $contador <= 2 && !is_array($data['row'])) {
                $contador = $contador + 1;

                $data['row'] = $this->test_model->getRacsTiempoReal($oficina);
            }
            
            if (is_array($data['row'])) {
                
                $this->chartEstadoAsesores2($oficina, $ipCifradaChart);

                $this->load->view('gtr/racsTiempoReal', $data);
            }
            
        //}
    }

    function renderRacsTiempoReal($oficina, $ipCifrada = null)
    {
        //if ($this->input->is_ajax_request()) {
            
        
            $oficina = trim(str_replace("-", " ", $oficina));
            //echo($oficina);

            $data['row'] = $this->config_model->getRacsTiempoReal($oficina);

          
            if (is_array($data['row'])) {
                
                //echo "<pre>"; print_r($data['row']); echo "</pre>";
                $this->chartEstadoAsesores($oficina, $ipCifrada);

                $this->load->view('gtr/racsTiempoReal', $data);
            }
            
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

            //$developer = $this->test_model->developer();
            //echo "<pre>"; print_r($data); echo "</pre>";

            $this->chartCientesEspera($oficina, $ipCifrada);

            $this->load->view('gtr/ClientesEsperaTiempoReal', $data);
        //}
    }


    function renderClientesEsperaTiempoReal2($cde, $ipCifrada = null)
    {
        //if ($this->input->is_ajax_request()) {
            $cde = trim(str_replace("-", " ", $cde));

            $data['clientesEspera'] = $this->config_model->getClientesEspera($cde);

            //echo "<pre>"; print_r($data); echo "</pre>";

            //$this->chartCientesEspera($cde, $ipCifrada);

            $this->load->view('gtr/ClientesEsperaTiempoReal', $data);
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
            
            $data['total'] = 0;
            foreach ($data['sinturno'] as $key => $value) {
                $data['total'] = $data['total'] + $value['tiempo_Sin_Turno'];
            } 
            //echo "<pre>"; print_r($data['sinturno']); echo "</pre>";
            $this->load->view('gtr/sin_turno', $data);
        //}
    }

    function renderSinTurnoTiempoReal($oficina, $ipCifrada)
    {
        //if ($this->input->is_ajax_request()) {

            $this->inicializarModeloYdecodificarIP($ipCifrada);

            //echo $ip;

            $oficina = str_replace("-", " ", $oficina);

            $data['sinturnoTiempoReal'] = $this->test_model->getLaborTiempoReal($oficina, 'Sin turno');
            $this->load->view('gtr/sin_turnoTiempoReal', $data);
        //}
    }

    function renderAlmuerzoHistorico($ipCifrada)
    {
            $this->inicializarModeloYdecodificarIP($ipCifrada);
            $datetimeInicio = date('Y-m-d') . ' 06:00:00';

            $data['Historico'] = $this->test_model->getActividadHistorico($datetimeInicio, date('Y-m-d H:i:s'), 'Almuerzo', 3600);
            $data['color'] = "#B98C48";

            // $data['total'] = 0;
            // foreach ($data['Historico'] as $key => $value) {
            //     $data['total'] = $data['total'] + $value['tiempo_Labor']-3600;
            // } 
            $this->load->view('gtr/historico', $data);

            //echo "<pre>"; print_r($data['AlmuerzoHistorico']); echo "</pre>";
    }

    function renderBanohistorico($ipCifrada)
    {
        $this->inicializarModeloYdecodificarIP($ipCifrada);
        $datetimeInicio = date('Y-m-d') . ' 06:00:00';

        $data['Historico'] = $this->test_model->getActividadHistorico($datetimeInicio, date('Y-m-d H:i:s'), 'Baño', 0);
        $data['color'] = "#3970B4";
        //echo "<pre>"; print_r($data['BanoHistorico']); echo "</pre>";

        $data['total'] = 0;
        foreach ($data['Historico'] as $key => $value) {
            $data['total'] = $data['total'] + $value['tiempo_Labor'];
        } 
        $this->load->view('gtr/historico', $data);
        //$this->load->view('gtr/bano-no-justificado', $data);
    }

    function renderLaborAdministrativaHistorico($ipCifrada)
    {
        $this->inicializarModeloYdecodificarIP($ipCifrada);
        $datetimeInicio = date('Y-m-d') . ' 06:00:00';

        $data['Historico'] = $this->test_model->getActividadHistorico($datetimeInicio, date('Y-m-d H:i:s'), 'Labor Administrativa', 900);
        $data['color'] = "#3970B4";

        $data['total'] = 0;
        foreach ($data['Historico'] as $key => $value) {
            $data['total'] = $data['total'] + $value['tiempo_Labor'];
        } 

        $this->load->view('gtr/historico', $data);
        //$this->load->view('gtr/Labor-Administrativa-historico', $data);
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
            $this->load->view('gtr/charts/chartCientesEsperaView', $dataJSON);
            //echo "<pre>"; print_r($data); echo "</pre>";

        //}
    }

    function chartEstadoAsesores($oficina, $ipCifrada = NULL)
    {

        $oficina = str_replace("-", " ", $oficina);

        $contador = 0;
        $data['series'] = $this->config_model->getChartEstadoAsesores($oficina);

        while ( $contador <= 2 && !is_array($data['series'])) {
            $contador = $contador + 1;

            $data['series'] = $this->test_model->getChartEstadoAsesores($oficina);
        }

        //echo "<pre>"; print_r($data['series']); echo "</pre>";

        if (is_array($data['series'])) {

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

            $this->load->view('gtr/charts/chartEstadoAsesoresView', $dataJSON);
        }
    }

    function chartEstadoAsesores2($oficina, $ipCifrada)
    {
        $this->inicializarModeloYdecodificarIP($ipCifrada);

        $oficina = str_replace("-", " ", $oficina);

        $contador = 0;
        $data['series'] = $this->test_model->getChartEstadoAsesores($oficina);

        while ( $contador <= 2 && !is_array($data['series'])) {
            $contador = $contador + 1;

            $data['series'] = $this->test_model->getChartEstadoAsesores($oficina);
        }

        //echo "<pre>"; print_r($data['series']); echo "</pre>";

        if (is_array($data['series'])) {

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

            $this->load->view('gtr/charts/chartEstadoAsesoresView', $dataJSON);

        }
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

    protected function mensajesValidacion()
    {
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El campo %s no es un Email valido');
    }

    function chartActividadAsesores($ipCifrada)
    {
         //'10.74.28.242';
        //$this->test_model->inicializar($ip);

        $datetimeInicio = date('Y-m-d') . ' 08:00:00';
        $datetimeFin = date('Y-m-d H:i:s');

        $this->inicializarModeloYdecodificarIP($ipCifrada);

        $this->chartActividadAsesoresFecha($datetimeInicio, $datetimeFin);
    
    }

    function chartActividadAsesoresForm($ipCifrada)
    {
        $this->form_validation->set_rules('fechaActividadAsesor', 'Fecha actividad del asesor', 'trim|required|xss_clean|htmlspecialchars');

        if ($this->form_validation->run()) {

            //echo "hola mundo";

            $this->inicializarModeloYdecodificarIP($ipCifrada);

            $fechaConsultada = $this->input->post('fechaActividadAsesor');

            $datetimeInicio = $fechaConsultada . ' 08:00:00';
            $datetimeFin = $fechaConsultada . ' 21:00:00';
            //echo $datetimeFin . " ";
            //echo $datetimeInicio . " " . $datetimeFin;
            $this->chartActividadAsesoresFecha($datetimeInicio, $datetimeFin);

        }
    }

    protected function chartActividadAsesoresFecha($datetimeInicio, $datetimeFin)
    {
        //----------- Consulta a la BD-------------------------------------------------------------------------------
        $data['series'] = $this->test_model->getActividadAsesoresPorDia($datetimeInicio, $datetimeFin);
        //----------------------------------------------------------------------------------------------------------
        //echo "<pre>"; print_r($data['series']); echo "</pre>";

        if (isset($data['series']) && !empty($data['series'])) {
            
        
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
                    $data['series'][$key]['color'] = "rgb(187, 146, 21)";//

                } elseif ($value['labor'] == "Break") {
                    $data['series'][$key]['color'] = "rgb(223, 237, 58)";

                } elseif ($value['labor'] == "Paso a Primera Línea") {
                    $data['series'][$key]['color'] = "rgb(255, 202, 40)";

                } elseif ($value['labor'] == "Labor Administrativa") {
                    $data['series'][$key]['color'] = "rgb(244, 121, 10)";//

                } elseif ($value['labor'] == "Sin turno") {
                   $data['series'][$key]['color'] = "rgb(202, 29, 15)";//

                } elseif ($value['labor'] == "Llamando") {
                   $data['series'][$key]['color'] = "rgb(164, 213, 58)";//

                } elseif ($value['labor'] == "Almuerzo") {
                   $data['series'][$key]['color'] = "rgb(137, 59, 195)";//
                }
            }


            //$data['series'] = count($data['series']) - 1;
            $data['milisegundos'] = 0;

            // tiempo MAX en microsegundos
            $datePart = explode(" ", $datetimeFin);
            //echo $datePart[0];

            if ($datePart[0] == date('Y-m-d')) {

                $pieces = explode(":", date('H:i:s'));
                //echo " entró al dia de hoy";
            } else {
                $pieces = explode(":", $datePart[1]);
                //echo " entró en la fecha correcta";
            }
            
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

                        $barraOut['tiempo'][0] = $value['segundos_inicio']*1000;
                        $data['asesores'][$asesor0][$index] = $barraOut;
                    }

                } else {
                    // se coloca la barra out 
                    $barraOut['tiempo'][0] = $data['series'][$key-1]['segundos_inicio']*1000;
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
                $jsonString = str_replace("Paso a Primera Línea", "Orientador", $jsonString);
                $data['dataJSON'][$key]['CadenaJson'] = $jsonString;

                $data['dataJSON'][$key]['out'][0] = $value[count($value)-1]['tiempo'][0];
            }

            
            $this->load->view('gtr/charts/chartsActividadAsesores', $data);
        }else {
            echo "Lo sentimos, aún no hay datos.";
        }
    }

    function renderEstadisticas($oficina, $ipCifrada)
    {
        $oficina = str_replace("-", " ", $oficina);

        $this->inicializarModeloYdecodificarIP($ipCifrada);
        
        $data['kpisNS'] = $this->test_model->getChartNSlinea($oficina);
        $data['kpisPS'] = $this->test_model->getChartPercepcionlinea($oficina);

        foreach ($data['kpisNS'] as $key => $value) {
            $data['seriesNS'][$key] = round($value['NS'] * 100, 1);
            $data['seriesNS_HORA'][$key] = round($value['NS_HORA'] * 100, 1);
            $data['xAxisNS'][$key] = $value['HORA'];
        }

        foreach ($data['kpisPS'] as $key => $value) {
            $data['seriesPS'][$key] = round($value['PS'] * 100, 1);
            $data['seriesPS_HORA'][$key] = round($value['PS_HORA'] * 100, 1);
            $data['xAxisPS'][$key] = $value['HORA'];
        }

        //$this->load->view('gtr/chartLineasKpis', $data);

        //echo "<pre>"; print_r($data); echo "</pre>";

        $this->load->view('gtr/charts/chartsNS_PS', $data);
    }

    function renderVisitasHoy($oficina, $ipCifrada)
    {
        $oficina = str_replace("-", " ", $oficina);

        $this->inicializarModeloYdecodificarIP($ipCifrada);

        $datetimeInicio = date('Y-m-d') . ' 08:00:00';
        $datetimeFin = date('Y-m-d H:i:s');

        $data['vistasAtendidos'] = $this->test_model->getChartVisitas($datetimeInicio, $datetimeFin);
        $data['VisitasAcumulado'][0] = 0;
        
        foreach ($data['vistasAtendidos'] as $key => $value) {

            $data['Visitas'][$key] = $value['TotalTurnos'];
            
            $data['Puntuales'][$key] = $value['TotalturnosAtendidos'] - $value['Entre15_30'] - $value['Entre30_45'] - $value['Entre45_60'] - $value['Mayor60'];
            $data['xAxisVisitas'][$key] = $value['HORA'];

            if ($key == 0) {
               $data['VisitasAcumulado'][$key] = $value['TotalTurnos'];
            }else{
                $data['VisitasAcumulado'][$key] = $data['VisitasAcumulado'][$key - 1] + $value['TotalTurnos'];
            }
        }
        $this->load->view('gtr/charts/chartVisitas', $data);
        //echo "<pre>"; print_r($data['VisitasAcumulado'] ); echo "</pre>";
    }

    function renderInfoCDE($Cod_pos)
    {
        $data['tienda_admin'] = $this->checkList_model->getInfoCDE($Cod_pos);
        $data['coor'] = $this->checkList_model->getInfoCDEcoor($Cod_pos);

        //echo "<pre>"; print_r($data); echo "</pre>";
        $this->load->view('gtr/main/infocde', $data);
    }

    function insertInfoCde()
    {
        $this->form_validation->set_rules('Cod_Pos', 'Código Pos del CDE', 'trim|required|xss_clean|htmlspecialchars');

        if ($this->form_validation->run()) {
    
                $Cod_Pos = $this->checkList_model->setCDE();
                //echo $Cod_Pos;
                redirect('/gtr/editInfoCDE/' . $this->input->post('Cod_Pos'), 'refresh');

        }else{
                redirect('/gtr/editInfoCDE/', 'refresh');
        }
    }

    function editInfoCDE($Cod_pos = null)
    {


        $data['title'] = 'GTR';
        $data['lasd'] = 'COC';
        $data['nav'] = 'Edición CDE';

        if ($Cod_pos == null) {
            $this->load->view('templates/header-hourPicker', $data);
            $this->load->view('gtr/main/insertInfoCde', $data);
            $this->load->view('templates/footer', $data);
            return;
        }
        //$this->form_validation->set_rules('rut_institucion', 'Rut de la institucion', 'trim|required|max_length[11]|xss_clean|htmlspecialchars');
        //$this->form_validation->set_rules('nombre_institucion', 'Nombre de la institucion', 'trim|required|xss_clean|htmlspecialchars');
        //$this->form_validation->set_rules('rector_institucion', 'Nombre del rector', 'trim|required|xss_clean|htmlspecialchars');

            if ($this->form_validation->run()) {
                $data['alerta'] = $this->admin_model->setInstitucion();

                if ($data['alerta'] == 0) {
                    $data['mensaje'] = "Formulario guardado satisfactoriamente";
                    $data['clase'] = 'alert-success';
                    $this->load->view('templates/alerta', $data);
                }
                elseif ($data['alerta'] == 1) {
                    $data['mensaje'] = "Institucion ya existe";
                    $data['clase'] = 'alert-danger';
                    $this->load->view('templates/alerta', $data);
                }
            }
            else
            {
                $data['mensaje'] = validation_errors();
                $data['Cod_pos'] = $Cod_pos;
                $data['tienda_admin'] = $this->checkList_model->getInfoCDE($Cod_pos);
                $data['coor'] = $this->checkList_model->getInfoCDEcoor($Cod_pos);
                $data['horario'] = $this->checkList_model->getHorario($Cod_pos);

                //echo "<pre>"; print_r($data); echo "</pre>";
                $data['oficina'] = $data['tienda_admin']['Tienda'];

                $this->load->view('templates/header-hourPicker', $data);
                $this->load->view('gtr/main/editInfoCde', $data);
                $this->load->view('templates/footer', $data);
                
                //$data['clase'] = 'alert-danger';
                //$this->load->view('templates/alerta', $data);
            }
    
    }
    function sethorarioController($Cod_Pos, $Dia, $nombreColumna){
        $data['alerta'] = $this->checkList_model->setHorario($Cod_Pos, $Dia, $nombreColumna);
            
            if ($data['alerta'] == 1) {
                $data['mensaje'] = "Horario guardado satisfactoriamente";
                $data['clase'] = 'alert-success';
                $this->load->view('templates/includes/alerta', $data);
            }
            elseif ($data['alerta'] == 0) {
                $data['mensaje'] = "Error, sorry :P";
                $data['clase'] = 'alert-danger';
                $this->load->view('templates/includes/alerta', $data);
            }
        //echo $data;
    }

    function DataCDE($dataform, $Cod_pos, $aux = null){
        if ($dataform == 'dataCDE') {

            $data['alerta'] = $this->checkList_model->updateDataCDE($Cod_pos);

        }elseif ($dataform == 'dataCoor') {

            $data['alerta'] = $this->checkList_model->updateDataCoor($Cod_pos, $aux);

        }elseif ($dataform == 'dataAdmin') {
            
            $data['alerta'] = $this->checkList_model->updateDataAdmin($Cod_pos, $aux);
        }

        if ($data['alerta'] == 1) {
            $data['mensaje'] = "Guardado satisfactoriamente";
            $data['clase'] = 'alert-success';
            $this->load->view('templates/includes/alerta', $data);
        }
        elseif ($data['alerta'] == 0) {
            $data['mensaje'] = "Error, sorry :P";
            $data['clase'] = 'alert-danger';
            $this->load->view('templates/includes/alerta', $data);
        }
        
    }

    function inserDAtaCDE($Cod_pos){

        $this->form_validation->set_rules('identificacion', 'Identificacion asesor', 'trim|required|xss_clean|htmlspecialchars');

        if ($this->form_validation->run()) {
    
                $this->checkList_model->setCoor($Cod_pos);

                redirect('/gtr/editInfoCDE/' . $Cod_pos, 'refresh');

        }else{
                redirect('/gtr/editInfoCDE/' . $Cod_pos, 'refresh');
        }
    }

    function deleteCoor($id)
    {
        if ($this->input->is_ajax_request()) {
            
            $this->checkList_model->deleteCoor($id);
            $data['mensaje'] = "Coordinador eliminado";
            $data['clase'] = 'alert-danger';
            $this->load->view('templates/includes/alerta', $data);
        }
    }

}

 ?>