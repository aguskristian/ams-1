<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Administration Management System.
	 * ver 1.0.0
	 *
	 * user controller
	 *
	 * url : http://ams.gapura.co.id/
	 * developer : www.studiokami.com
	 * phone : 0361 853 2400
	 * email : support@studiokami.com
	 */
	
	
# constuction ------------------------------	
	 function __construct()
	{
        parent::__construct();
		
		# load model, library and helper
		$this->load->model('user_model','', TRUE);
		
		# user restriction
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('index', 'login', 'do_login', 'verification', 'pin_verification', 'do_pin_verification', 'registration', 'do_registration', 'select_unit');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('user/login');
			}
   		 }
    }
# constuction ------------------------------	

#SESSION------------------------------------

  


# index ------------------------------------	 
	public function index()
	{
		$data['breadcumb'] = '<li class="active">Document</li>';
		$data['title'] = 'ATTENDACE';
		$this->load->view ('template/header');
		$this->load->view ('template/sidebar');
		$this->load->view('template/breadcumb', $data);
		$this->load->view ('attendance/dashboard');
		$this->load->view ('template/footer');
	}
# index ------------------------------------	

# IN ------------------------------------
	public function in(){
		
		$session_data = $this->session->userdata('logged_in');
		$ui_nipp = $session_data['ui_nipp'];
		 
		$data['breadcumb'] = '<li class="active">Document</li>';
		$data['title'] = 'MASUK';
		
		$this->load->view ('template/header');
		$this->load->view ('template/sidebar');
		$this->load->view('template/breadcumb', $data);
		$this->load->view ('attendance/in');
		$this->load->view ('template/footer');
		
			}
# in ------------------------------------

# OUT ------------------------------------		
public function out(){
		//echo 'in';
		$data['breadcumb'] = '<li class="active">Document</li>';
		$data['title'] = 'KELUAR';
		
		$this->load->view ('template/header');
		$this->load->view ('template/sidebar');
		$this->load->view('template/breadcumb', $data);
		$this->load->view ('attendance/out');
		
		$this->load->view ('template/footer');
		
		}
# OUT ------------------------------------	
	
public function dashboard(){
		//echo 'in';
		$data['breadcumb'] = '<li class="active">Document</li>';
		$data['title'] = 'KELUAR';
		
		$this->load->view ('template/header');
		$this->load->view ('template/sidebar');
		$this->load->view('template/breadcumb', $data);
		$this->load->view ('attendance/out');
		
		$this->load->view ('template/footer');
		
		}
}
/* End of file user.php */
/* Location: ./application/controllers/user.php */