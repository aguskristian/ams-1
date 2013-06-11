<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
	
	
	 function __construct()
	{
        parent::__construct();
		
		# load model, library and helper
		$this->load->model('user_model','', TRUE);
		
		# user restriction
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('index', 'login', 'do_login', 'pin_verification', 'do_pin_verification');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('user/login');
			}
   		 }
    }
	 
	public function index()
	{
		redirect('user/login');
	}
	
	
# login ------------------------------------
	public function login()
	{
		$data['message']='';
		$this->load->view('template/header');
		$this->load->view('user/login', $data);
		$this->load->view('template/footer');
	}
	
	public function do_login()
	{
		# get email data from form		
		$email = $this->input->post('email');	
		
		#validate data
		$this->form_validation->set_rules('email', 'email', 'required|xss_clean|valid_email');
		$this->form_validation->set_message('email', 'Email yang anda masukan salah !!!');

		if ($this->form_validation->run() == FALSE)
		{
			# send mesg to view
			$data['message']='error';
			
			# validation false, force user to re-login
			$this->load->view('template/header');
			$this->load->view('user/login', $data);
			$this->load->view('template/footer');
		}
		else
		{
			# check email on database 
			$result = $this->user_model->check_reg_email($email);
			
			if($result)
			{
					# if email found on database
					foreach($result as $row)
					{
						 $nama = $row->ui_nama; 
						 $nipp = $row->ui_nipp; 
						 $hp = $row->ui_hp; 
						 $email = $row->ui_email; 
						 $cabang = $row->ui_cabang; 
						 $unit = $row->ui_unit; 
						 $jabatan = $row->ui_jabatan; 
						 $app_level = $row->ui_app_level; 
						 $app_role = $row->ui_app_role; 
						 $verification = $row->ui_verification; 
						 $ver_date = $row->ui_ver_date;
					}
			 	
					# split data to get username only		
					#$email_result = explode("@", $email);
					#$user_email  = $email_result[0];
				    #$full_email = $email;
					
					# encrypt username before send to view as ads_code
					#$email = $this->encrypt->encode($user_email, 'liame');
					#$data['ads_code'] = $email;
					$data['email'] = $email;
					
					# call models to delete previous verification duplicate data
					$this->user_model->del_dup_prev_ver_data($email);
					
					# create random pin
					$this->load->helper('pin');
					$pin = get_pin();
					$email_link = $email . '+' . $pin ;
					
					# encrypt email link to send via email
					$email_link = base64_encode($email_link);
					$email_link = urlencode($email_link);
					
					# set request date & expired date
					$request = mdate("%Y-%m-%d %H:%i:%s", time());
					$expired = mdate("%Y-%m-%d %H:%i:%s", time()+3600);
					
					# set verification type
					$type = 'login';
					
					# call models to save new pin and verification link
					$this->user_model->save_verification($email, $hp, $pin, $email_link, $request, $expired, $type);
					
					# send pin and link via sendemail
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					# send pin and link via sendemail
					
					# send pin and link via smtp
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'ssl://smtp.googlemail.com';
					$config['smtp_port'] = 465;
					$config['smtp_user'] = 'admin@gapura.co.id';
					$config['smtp_pass'] = 'gapura2013';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					# send pin and link via smtp
					
					$this->email->from('admin@gapura.co.id', 'Team Sigap');
					$this->email->to($email); 
					$this->email->subject('PT Gapura Angkasa Online Document System Registration Verification');
					$this->email->message('
					
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>Untitled Document</title>
					</head>
					
					<body>
					<p>Your verification code : ' . $pin . '</p>
					<p>or</p>
					<p>Please click link below to verify your request :</p>
					<p>{unwrap}' . anchor("login/verification_link/" . $email_link, 'http://ods.gapura.co.id/login/verification_link/' . $email_link) . '{/unwrap}</p>
					<p>Thank you</p>
					<p>Best regards</p>
					<p>SIGAP Team</p>
					<p>&nbsp;</p>
					</body>
					</html>
					
					');
					$this->email->send();
					
					# show link for develope mode only, please disable on run mode
					echo $email . ' - ' . $pin . ' - ' . $email_link;
					
					# call views
					$data['message'] = 'masukan kode verifikasi yang anda terima di inbox email.';
					$this->load->view('template/header');
					$this->load->view('user/verification', $data);
					$this->load->view('template/footer');
					
			}
			else
			{
				# send mesg to view
				$data['message']='silahkan melakukan registrasi';
				
			
				# not register user redirect to register page
				redirect('user/registration/', $data);
			}
		}
	}
# login ------------------------------------


# verification ------------------------------	
	public function pin_verification()
	{
		$this->load->view('template/header');
		$this->load->view('user/verification');
		$this->load->view('template/footer');
	}
	
	public function do_pin_verification()
	{
		# get data
		$email = $this->input->post('email');
		$pin = $this->input->post('kode');
		
		# later : check previous verification request and delete it
		
		# call model
		$result = $this->user_model->do_verification($email, $pin);
		
		# check pin to verify
		if($result)
		   {
			 # if pin sucess prepare session
			 $sess_array = array();
			 foreach($result as $row)
			 {
			   $sess_array = array(
			     'ui_id' => $row->ui_id,
				 'ui_nama' => $row->ui_nama, 
				 'ui_nipp' => $row->ui_nipp, 
				 'ui_hp' => $row->ui_hp, 
				 'ui_email' => $row->ui_email, 
				 'ui_cabang' => $row->ui_cabang, 
				 'ui_unit' => $row->ui_unit, 
				 'ui_jabatan' => $row->ui_jabatan, 
				 'ui_app_level' => $row->ui_app_level, 
				 'ui_app_role' => $row->ui_app_role, 
				 'ui_verification' => $row->ui_verification, 
				 'ui_ver_date' => $row->ui_ver_date
			   );
			   # set session for auto login
			   $this->session->set_userdata('logged_in', $sess_array);
			 }
			 # redirect to dashboard after logged in
			 redirect('dashboard');
			 return TRUE;
		   }
		   else
		   {
			 # verification pin fail, force to try again
			 $data['ads_code'] = $this->input->post('ads_code');
			 $data['success_message'] = 'link yang anda klik salah, masukan kode verifikasi yang anda terima di inbox email.';
			 $this->load->view('template/header');
			 $this->load->view('user/verification', $data);
			 $this->load->view('template/footer');
			 return FALSE;
		   }
		
		
		
		$this->load->view('template/header');
		$this->load->view('user/dashboard');
		$this->load->view('template/footer');
	}
# verification ------------------------------


# registration -----------------------------
	public function registration()
	{
		# send mesg to view
		$data['message']='silahkan melakukan registrasi, bila anda tidak memiliki email perusahaan, silahkan mendaftar melalui supervisor on duty';
				
		$this->load->view('template/header');
		$this->load->view('user/registration', $data);
		$this->load->view('template/footer');
	
	}
	
	public function do_registration()
	{
		# scenario :
		# get data from register form
		# do data validation
		# do save data to db
		# send pin or url verification via email
		# do inline verification
		
		# get data from register form
		$nama = $this->input->post('nama');
		$nipp = $this->input->post('nipp');
		$hp = $this->input->post('hp');
		$email = $this->input->post('email');
		$cabang = $this->input->post('cabang');
		$unit = $this->input->post('unit');
		$jabatan = $this->input->post('jabatan');
		
		# do validation rules
		$this->form_validation->set_rules('email', 'email', 'trim|required|min_length[3]|alpha_dash|xss_clean');
		$this->form_validation->set_rules('hp', 'hp', 'trim|required|min_length[3]|numeric|xss_clean');
		$this->form_validation->set_rules('nipp', 'nipp', 'trim|required|min_length[3]|numeric|xss_clean');
		
		if ($this->input->post('submit')) 
			{
				if ($this->form_validation->run() == FALSE)
				{
					# send mesg to view
					$data['message']='error';
					
					# validation false, force user to re-login
					$this->load->view('template/header');
					$this->load->view('user/login', $data);
					$this->load->view('template/footer');				
				}
				else
				{
					# prepare data
					$user_email = $email;
				    $full_email = $email . '@gapura.co.id';
					
					# encrypt data before save and send to view as ads_code
					$email = $this->encrypt->encode($user_email, 'liame');
					$data['ads_code'] = $email;
					
					# call models to delete previous verification duplicate data
					$this->user_model->del_dup_prev_ver_data($full_email);
					
					# call models to delete unverify duplicate user data on user identity table
					$this->user_model->del_dup_prev_user_unver_data($full_email);
					
					# call models to save data
					$this->user_model->save_user($nama, $nipp, $hp, $full_email, $cabang, $unit, $jabatan);
					
					# create random pin
					$this->load->helper('pin');
					$pin = get_pin();
					$email_link = $full_email . '+' . $pin ;
					
					# encrypt email link to send via email
					$email_link = base64_encode($email_link);
					$email_link = urlencode($email_link);
					
					# call models to save data
					$this->user_model->save_verification($full_email, $hp, $pin, $email_link);
					
					# send pin and link via email
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					
					$this->email->from('admin@gapura.co.id', 'Team Sigap');
					$this->email->to($full_email); 
					$this->email->subject('PT Gapura Angkasa Registration Verification System');
					$this->email->message('
					
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>Untitled Document</title>
					</head>
					
					<body>
					<p>Your verification code : ' . $pin . '</p>
					<p>or</p>
					<p>Please click link below to verify your request :</p>
					<p>{unwrap}' . anchor("login/verification_link/" . $email_link, 'http://ams.gapura.co.id/user/verification_link/' . $email_link) . '{/unwrap}</p>
					<p>Thank you</p>
					<p>Best regards</p>
					<p>SIGAP Team</p>
					<p>&nbsp;</p>
					</body>
					</html>
					
					');
					$this->email->send();
		
					# call views
					$data['success_message'] = 'masukan kode verifikasi yang anda terima di inbox email.';
					$this->load->view('template/header');
					$this->load->view('user/verification', $data);
					$this->load->view('template/footer');
				}
			}
			
	}
# registration -----------------------------


	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */