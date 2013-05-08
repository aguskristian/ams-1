<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * User Controller
	 *
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function registration()
	{
		$this->load->view('template/header');
		$this->load->view('user/registration');
		$this->load->view('template/footer');
	}
	
	public function login()
	{
		$this->load->view('template/header');
		$this->load->view('user/login');
		$this->load->view('template/footer');
	}
	
	public function pin_verification()
	{
		$this->load->view('template/header');
		$this->load->view('user/verification');
		$this->load->view('template/footer');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */