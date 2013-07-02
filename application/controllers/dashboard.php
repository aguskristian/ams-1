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
    			redirect('user/login');
			}
   		 }
		
		# load model, library and helper
		$this->load->model('docs_model','', TRUE);
    }


	function index()
	{
		# get data from session
		$session_data = $this->session->userdata('logged_in');
		  
		# data
		$nama = $session_data['ui_nama'];
		$data['nama'] = $nama;
		
		$nipp = $session_data['ui_nipp'];
		$data['nipp'] = $nipp;
		  
		$email = $session_data['ui_email'];
		$data['email'] = $email;
		  
		$cabang = $session_data['ui_cabang'];
		$data['cabang'] = $cabang;
		  
		$unit = $session_data['ui_unit'];
		$data['unit'] = $unit;
		  
		$data['error'] ='';
		  
		$data['title'] = 'Dashboard';
		
		# statistic
		$data['query_open'] 		= $this->docs_model->stat_my_open($nipp);
		$data['query_progress'] 	= $this->docs_model->stat_my_progress($nipp);
		$data['query_completed'] 	= $this->docs_model->stat_my_completed($nipp);
		$data['query_closed'] 		= $this->docs_model->stat_my_closed($nipp);
		
		# open list pagination
		$config = array();
		$config['base_url'] = site_url() . '/dashboard/';
		$config['per_page'] = 10; 
		$config["uri_segment"] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
		$offset = $page;
		
		$data['total_open'] = $this->docs_model->stat_my_open($nipp);
		foreach($data['total_open'] as $stat):$total_rows = $stat->open;endforeach;
		$config['total_rows'] = $total_rows;
		
		$this->pagination->initialize($config);
		
		# call model
		$data['list_open'] = $this->docs_model->docs_open($nipp);
		$data['link'] = $this->pagination->create_links();
		# open list pagination
		
		
		# progress list pagination
		$config = array();
		$config['base_url'] = site_url() . '/dashboard/';
		$config['per_page'] = 10; 
		$config["uri_segment"] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
		$offset = $page;
		
		$data['total_progress'] = $this->docs_model->stat_my_progress($nipp);
		foreach($data['total_progress'] as $stat):$total_rows = $stat->progress;endforeach;
		$config['total_rows'] = $total_rows;
		
		$this->pagination->initialize($config);
		
		# call model
		$data['list_progress'] = $this->docs_model->docs_progress($nipp);
		$data['link'] = $this->pagination->create_links();
		# progress list pagination
		
		# progress list pagination
		$config = array();
		$config['base_url'] = site_url() . '/dashboard/';
		$config['per_page'] = 10; 
		$config["uri_segment"] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
		$offset = $page;
		
		$data['total_completed'] = $this->docs_model->stat_my_completed($nipp);
		foreach($data['total_completed'] as $stat):$total_rows = $stat->completed;endforeach;
		$config['total_rows'] = $total_rows;
		
		$this->pagination->initialize($config);
		
		# call model
		$data['list_completed'] = $this->docs_model->docs_open($nipp);
		$data['link'] = $this->pagination->create_links();
		# progress list pagination
		
		# progress list pagination
		$config = array();
		$config['base_url'] = site_url() . '/dashboard/';
		$config['per_page'] = 10; 
		$config["uri_segment"] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
		$offset = $page;
		
		$data['total_closed'] = $this->docs_model->stat_my_closed($nipp);
		foreach($data['total_closed'] as $stat):$total_rows = $stat->closed;endforeach;
		$config['total_rows'] = $total_rows;
		
		$this->pagination->initialize($config);
		
		# call model
		$data['list_closed'] = $this->docs_model->docs_open($nipp);
		$data['link'] = $this->pagination->create_links();
		# progress list pagination
		
		
		print_r($data);
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/breadcumb');
		$this->load->view('ams/dashboard', $data);
		$this->load->view('template/footer');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */