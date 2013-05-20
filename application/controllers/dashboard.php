<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * User Controller
	 *
	 */
	
	
	 function __construct()
	{
        parent::__construct();
		
		/*if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('index', 'request_verification', 'verification_pin', 'verification_link');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('login');
			}
   		 }*/
		
		# load model, library and helper
		$this->load->model('user_model','', TRUE);
    }


	function index()
	{
		echo 'dashboard';
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */