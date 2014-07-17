<?php 


/**
* 
*/
class Hvc_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->database('bd_cded_cde_pda1');
	}

	function getHorario($cod_pos = null)
	{
		if ($cod_pos == null) {
			$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.horario_view");
		}else{
			$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.horario_view
				where Cod_pos = '$cod_pos'");
		}
		

		return $query->result_array();

	}

	function get_hvc($celular){
		
		if (!is_numeric($celular)) {
			echo "no es un numero";
		}else {
			$query = $this->db->query("SELECT CLASIFICACION FROM bd_cded_cde_pda.hvc WHERE MSISDN = '$celular'");
			if ($query) {
				$resultado = $query->row_array();
				
				if (count($resultado) == 0) {
					$resultado["STATUS"] = 0;
				}else{
					$resultado["STATUS"] = 1;
				}
				$resultado_final = json_encode($resultado, JSON_UNESCAPED_UNICODE);
				return $resultado_final;
			}
		}

	}

	

	function getIP($oficina)
    {
    	//$BDCentral = $this->load->database();
        //echo $oficina;
    	$oficina = str_replace("-", " ", $oficina);
    	$oficina = "%" . $oficina;
    	    	
    	$query = $this->db->query("SELECT * FROM bd_cded_cde_pda.dg45_servidores_rep
  			where SER_SDSTRDESCRIPCION like '$oficina'");
    	//echo "<pre>"; print_r($query->row_array()); echo "</pre>";
        if (!$query) {
            $query = 0;
            //echo "se generó una mala consulta";
        }
        else
        {
            return $query->row_array();
        }
    }

}

 ?>