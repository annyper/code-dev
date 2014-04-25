<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
		date_default_timezone_set('America/Bogota');
		echo date('Y-m-d H:i:s') . ' ';

		$pieces = explode(":", date('H:i:s'));
		echo '</br>' . ($pieces[0]*3600 + $pieces[1]*60 + $pieces[2]);
		//echo '</br>' . microtime(true);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */