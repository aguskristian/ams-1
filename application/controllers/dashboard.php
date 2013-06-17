<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * User Controller
	 *
	 */
	
	
	 function __construct()
	{
        parent::__construct();
		
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('user');
			}
   		 }
		
		# load model, library and helper
		$this->load->model('user_model','', TRUE);
    }


	function index()
	{
		$data['title'] = 'Dashboard';
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('ams/dashboard', $data);
		$this->load->view('template/footer');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */