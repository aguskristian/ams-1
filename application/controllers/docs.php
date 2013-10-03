<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docs extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Online Document System.
	 * ver 1.0.0
	 *
	 * docs controller
	 *
	 * url : http://192.168.1.150/ods/
	 * developer : www.studiokami.com
	 * phone : 0361 853 2400
	 * email : support@studiokami.com
	 */
	 
	 function __construct()
	{
        parent::__construct();
		$this->load->model('docs_model','', TRUE);
		
		# restrict all function access after log in
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('user/login');
        }
    }
	
	public function index()
	{
		redirect('dashboard');
	}
	
	public function add()
	{
		# get data from login session
		$session_data = $this->session->userdata('logged_in');
		
		$nama = $session_data['ui_nama'];
		$data['nama'] = $nama;
		
		$nipp = $session_data['ui_nipp'];
		$data['nipp'] = $nipp;
		
		$email = $session_data['ui_email'];
		$data['email'] = $email;
		
		# set error message  
		$data['error'] ='';
		
		# title
		$data['title'] = 'INPUT SURAT MASUK';
		
		# breadcumb
		$data['breadcumb'] = '<li class="active">Document</li>';
		  
		# get variable for docs category
		#$data['query'] = $this->docs_model->get_all_category_for_combo($cabang, $unit);
		
		# redirect to upload form
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/breadcumb');
		$this->load->view('ams/add', $data);
		$this->load->view('template/footer');
	}
	
	public function add_nota_dinas()
	{
		# get data from login session
		$session_data = $this->session->userdata('logged_in');
		
		$nama = $session_data['ui_nama'];
		$data['nama'] = $nama;
		
		$ui_function = $session_data['ui_function'];
		$data['ui_function'] = $ui_function;
		
		$ui_function = $session_data['ui_function'];
		$data['ui_function'] = $ui_function;
		
		$nipp = $session_data['ui_nipp'];
		$data['nipp'] = $nipp;
		
		$email = $session_data['ui_email'];
		$data['email'] = $email;
			
		# set error message  
		$data['error'] ='';
		
		# title
		$data['title'] = 'INPUT SURAT MASUK';
		
		# breadcumb
		$data['breadcumb'] = '<li class="active">Document</li>';
		  
		# get variable for docs category
		#$data['query'] = $this->docs_model->get_all_category_for_combo($cabang, $unit);
		
		
		$data['query'] = $this->docs_model->get_manager_nipp($nipp, $ui_function);
		# redirect to upload form
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/breadcumb');
		$this->load->view('ams/add_nota_dinas', $data);
		$this->load->view('template/footer');
	}

	public function add_memo()
	{
		
		
		# get data from login session
		$session_data = $this->session->userdata('logged_in');
		
		$nama = $session_data['ui_nama'];
		$data['nama'] = $nama;
		
		$nipp = $session_data['ui_nipp'];
		$data['nipp'] = $nipp;
		
		$email = $session_data['ui_email'];
		$data['email'] = $email;
		
		# set error message  
		$data['error'] ='';
		
		# title
		$data['title'] = 'INPUT SURAT MASUK';
		
		# breadcumb
		$data['breadcumb'] = '<li class="active">Document</li>';
		  
		# get variable for docs category
		#$data['query'] = $this->docs_model->get_all_category_for_combo($cabang, $unit);
		
		#$data ['query'] = $this->docs_model->get($ui_function);
		# redirect to upload form
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/breadcumb');
		$this->load->view('ams/add_memo', $data);
		$this->load->view('template/footer');
	}
	
	function save()
	{
		# get data from login session
		$session_data = $this->session->userdata('logged_in');
		
		$nama = $session_data['ui_nama'];
		$data['nama'] = $nama;
		
		$nipp = $session_data['ui_nipp'];
		$data['nipp'] = $nipp;
		
		$email = $session_data['ui_email'];
		$data['email'] = $email;
		
		$ui_function = $session_data['ui_function'];
		$data['ui_function'] = $ui_function;
		
		/*$cabang = $session_data['ui_cabang'];
		$data['cabang'] = $cabang;
		
		$unit = $session_data['ui_unit'];
		$data['unit'] = $unit;*/
		
		# set error message  
		$data['error'] ='';
		
		# get data from form
		$docs_date_in 	= mdate("%Y-%m-%d %H:%i:%s", strtotime($this->input->post('docs_date_in')));
		$docs_reg_no 	= $this->input->post('docs_reg_no');
		$docs_type 		= $this->input->post('docs_type');
		$docs_no 		= $this->input->post('docs_no');
		$docs_date 		= mdate("%Y-%m-%d", strtotime($this->input->post('docs_date')));
		$docs_to 		= $this->input->post('docs_to');
		$docs_from 		= $this->input->post('docs_from');
		$docs_copy 		= $this->input->post('docs_copy');
		$docs_subject 	= $this->input->post('docs_subject');
		$docs_description 	= $this->input->post('docs_description');
		$docs_update_by = $nipp;
		
		# do form validation ( next )
		
		# do save data
		$docs_id = $this->docs_model->save_docs($docs_date_in, $docs_reg_no, $docs_type,$docs_no,$docs_date,$docs_from,$docs_to,$docs_copy,$docs_subject,$docs_description, $docs_update_by);
		
		# set upload config
		#$config['upload_path'] = './assets/uploads/files/';
		$config['upload_path'] = './wp-uploads/';
		$config['allowed_types'] = 'pdf|gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pps|ppsx';
		$config['max_size']	= '99999';
		$config['max_width']  = '99999';
		$config['max_height']  = '99999';
	
		# call upload lib
		$this->load->library('upload', $config);
				
		# check is there any file to upload	
		if ($this->upload->do_upload('file'))
		{
			# file to upload = true
			$upload_data = $this->upload->data();
			
			# GET REAL DATA FOR DB
			$df_docs_id 	= $docs_id;
			$df_user_name 	= $this->input->post('docs_no');
			#$df_real_name	= $this->encrypt->encode($upload_data['file_name'], 'eman_elif');
			$df_real_name	= $this->security->sanitize_filename($upload_data['file_name']);
			$df_file_path 	= $upload_data['file_path'];
			#$df_system_name	= $this->encrypt->encode(date("YmdHis"), 'siHdmY');	
			$df_system_name	= date("YmdHis");	
			#$df_ext			= $this->encrypt->encode($upload_data['file_ext'], 'txe_elif');
			$df_ext			= $upload_data['file_ext'];	  	 	 	 	 	 	
			$df_size		= $upload_data['file_size'];	 	 	 	 	 	 	
			$df_type		= $this->input->post('docs_type');	 	 	 	 	 	 	
			$df_owner		= $this->input->post('docs_from');
			$df_update_by 	= $nipp;
			$system_file_name = date("YmdHis");	
			
			# call model
			$this->docs_model->save_file($df_docs_id, $df_user_name, $df_real_name, $df_file_path, $df_system_name, $df_ext, $df_size, $df_type, $df_owner, $df_update_by);
			
			# rename file after upload and remove ext
			rename($upload_data['full_path'], $upload_data['file_path'] . $system_file_name . '-' . $df_real_name);
		}
		
		# get manager nipp
		$query = $this->docs_model->get_manager_nipp($nipp, $ui_function);
		foreach($query as $manager) :
			$manager_nipp = $manager->ui_nipp;	
		endforeach;
		
		# update own docs_position
		$dp_docs_id = $docs_id;
		$dp_position = $nipp;
		$dp_status = 'completed';
		$dp_date_in = $docs_date_in;
		$dp_date_out = date('Y-m-d H:i:s');
		$dp_update_by = $nipp;
		
		$this->docs_model->set_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_in, $dp_date_out, $dp_update_by);
		
		# update docs_flow
		$df_docs_id = $docs_id;
		$df_flow = 'report';
		$df_from = $nipp;
		$df_to = $manager_nipp;
		$df_subject = 'penerimaan dokumen ' . $docs_no;
		$df_description = 'penerimaan dokumen ' . $docs_no . ' dari pihak lain';
		$df_update_by = $nipp;
		
		$this->docs_model->update_docs_flow($df_docs_id, $df_flow, $df_from, $df_to, $df_subject, $df_description, $df_update_by);
		
		
		
		# update target docs_position to manager
		$dp_docs_id = $docs_id;
		$dp_position = $manager_nipp;
		$dp_status = 'open';
		$dp_date_in = date('Y-m-d H:i:s');
		$dp_date_out = '0000-00-00 00:00:00';
		$dp_update_by = $nipp;
		
		$this->docs_model->set_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_in, $dp_date_out, $dp_update_by);
		
		redirect('dashboard');
	}

	public function details()
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
		
		$ui_function = $session_data['ui_function'];
		$data['ui_function'] = $ui_function;
		  
		/*$cabang = $session_data['ui_cabang'];
		$data['cabang'] = $cabang;
		  
		$unit = $session_data['ui_unit'];
		$data['unit'] = $unit;
		
		*/
		  
		$data['error'] ='';
		  
		$data['title'] = 'Details Document';
		
		$data['breadcumb'] = '<li class="active">Detail</li>';
		
		# get data from form
		$docs_id = $this->uri->segment(3, 0);
		$data['query_docs'] = $this->docs_model->get_doc_by_id($docs_id);
		$data['query_files'] = $this->docs_model->get_files_by_id($docs_id);
		$data['query_flow'] = $this->docs_model->get_flow_by_id($docs_id);
		$data['query_position'] = $this->docs_model->docs_position($docs_id);
		$data['query_discussion'] = $this->docs_model->docs_discussion($docs_id);
		
		# get upline, colleagues and downline data
		$data['query_upline'] = $this->docs_model->get_upline($nipp, $ui_function);
		$data['query_colleagues'] = $this->docs_model->get_colleagues($nipp, $ui_function);
		$data['query_downline'] = $this->docs_model->get_downline($nipp, $ui_function);
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/breadcumb');
		$this->load->view('ams/details', $data);
		$this->load->view('template/footer');
	}
	
	public function add_discussion()
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
		  
		/*$cabang = $session_data['ui_cabang'];
		$data['cabang'] = $cabang;
		  
		$unit = $session_data['ui_unit'];
		$data['unit'] = $unit;
		
		$ui_function = $session_data['ui_function'];
		$data['ui_function'] = $ui_function;*/
		  
		$data['error'] ='';
		  
		$data['title'] = 'Details Document';
		
		$data['breadcumb'] = '<li class="active">Detail</li>';
		
		$dd_docs_id = $this->input->post('docs_id');
		$dd_subject = $this->input->post('subject');
		$dd_message = $this->input->post('message');
		$this->docs_model->add_docs_discussion($dd_docs_id, $dd_subject, $dd_message, $nipp);
		
		redirect('docs/details/' . $dd_docs_id );
	}

	public function document_action()
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
		  
		/*$cabang = $session_data['ui_cabang'];
		$data['cabang'] = $cabang;
		  
		$unit = $session_data['ui_unit'];
		$data['unit'] = $unit;*/
		
		# get data from form
		$docs_id = $this->input->post('docs_id');
		$docs_action = $this->input->post('docs_action');
		$nipp_target = $this->input->post('' . $docs_action . '');
		$docs_subject = $this->input->post('docs_subject');
		$docs_description = $this->input->post('docs_description');
		
		
		# update own docs_position
		$dp_docs_id = $docs_id;
		$dp_position = $nipp;
		$dp_status = 'completed';
		$dp_date_out = date('Y-m-d H:i:s');
		$dp_update_by = $nipp;
		
		$this->docs_model->update_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_out, $dp_update_by);
		
		# update docs_flow
		$df_docs_id = $docs_id;
		$df_flow = $docs_action;
		$df_from = $nipp;
		$df_to = $nipp_target;
		$df_subject = $docs_subject;
		$df_description = $docs_description;
		$df_update_by = $nipp;
		
		$this->docs_model->update_docs_flow($df_docs_id, $df_flow, $df_from, $df_to, $df_subject, $df_description, $df_update_by);
		
		
		
		# update target docs_position to manager
		$dp_docs_id = $docs_id;
		$dp_position = $nipp_target;
		$dp_status = 'open';
		$dp_date_in = date('Y-m-d H:i:s');
		$dp_date_out = '0000-00-00 00:00:00';
		$dp_update_by = $nipp;
		
		$this->docs_model->set_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_in, $dp_date_out, $dp_update_by);
		
		
		# set upload config
		#$config['upload_path'] = './assets/uploads/files/';
		$config['upload_path'] = './wp-uploads/';
		$config['allowed_types'] = 'pdf|gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pps|ppsx';
		$config['max_size']	= '99999';
		$config['max_width']  = '99999';
		$config['max_height']  = '99999';
	
		# call upload lib
		$this->load->library('upload', $config);
				
		# check is there any file to upload	
		if ($this->upload->do_upload('file'))
		{
			# file to upload = true
			$upload_data = $this->upload->data();
			
			# GET REAL DATA FOR DB
			$df_docs_id 	= $docs_id;
			$df_user_name 	= $docs_subject;
			#$df_real_name	= $this->encrypt->encode($upload_data['file_name'], 'eman_elif');
			$df_real_name	= $this->security->sanitize_filename($upload_data['file_name']);
			$df_file_path 	= $upload_data['file_path'];
			#$df_system_name	= $this->encrypt->encode(date("YmdHis"), 'siHdmY');	
			$df_system_name	= date("YmdHis");	
			#$df_ext			= $this->encrypt->encode($upload_data['file_ext'], 'txe_elif');
			$df_ext			= $upload_data['file_ext'];	  	 	 	 	 	 	
			$df_size		= $upload_data['file_size'];	 	 	 	 	 	 	
			$df_type		= $docs_action;	 	 	 	 	 	 	
			$df_owner		= $nipp;
			$df_update_by 	= $nipp;
			$system_file_name = date("YmdHis");	
			
			# call model
			$this->docs_model->save_file($df_docs_id, $df_user_name, $df_real_name, $df_file_path, $df_system_name, $df_ext, $df_size, $df_type, $df_owner, $df_update_by);
			
			# rename file after upload and remove ext
			rename($upload_data['full_path'], $upload_data['file_path'] . $system_file_name . '-' . $df_real_name);
		}
		
		
		redirect('dashboard');
	}


	
	public function category()
	{
		# get data from session
		  $session_data = $this->session->userdata('logged_in');
		  
		  # nama from session
		  $nama = $session_data['ui_nama'];
		  $data['nama'] = $nama;
		  
		  $unit = $session_data['ui_unit'];
		  $data['unit'] = $unit;
		  
		  $email = $session_data['ui_email'];
		  $data['email'] = $email;
		  
		/*  $cabang = $session_data['ui_cabang'];
		  $data['cabang'] = $cabang;*/
		  
		  # total file by category
		  $data['query_category_group_ext'] = $this->docs_model->total_category_file_by_group_ext($cabang, $unit, $nama, $email);
		  $data['query_category_group_int'] = $this->docs_model->total_category_file_by_group_int($cabang, $unit, $nama, $email);	
		
		  # file list
		  $category = strtolower($this->uri->segment(3, 1));
		  
		  # get file category name
		  $data['category_name'] = $this->docs_model->get_category_name($category);
		  
		  # pagination
		  $config = array();
          $config['base_url'] = site_url() . '/docs/category/' . $category . '/';
		  $config['per_page'] = 10; 
		  $config["uri_segment"] = 4;
		  $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		  $limit = $config["per_page"];
		  $offset = $page;
		  
		  # call model
		  $data['query_category_total'] = $this->docs_model->total_category_file($category, $cabang, $unit, $nama, $email);
          
		  # extract from model for total owner
		  foreach ($data['query_category_total'] as $row_category) : 
		  {
			  $category_name = $row_category->dc_category;
			  $category_total = $row_category->category_total;
		  }
		  endforeach; 
		  
		  $config['total_rows'] = $category_total;
		  $data['name'] = $category_name;
          $data['total'] = $category_total;
          
          $this->pagination->initialize($config);
		  
		  # call model
		  $data['query_category_file'] = $this->docs_model->category_file($category, $limit, $offset, $cabang, $unit, $nama, $email);
		  
          $data['link'] = $this->pagination->create_links();
		  $data['title'] = $category;
		  
		  # call view
		  $this->load->view('template/header_view');
		  $this->load->view('template/navigation_view', $data);
		  $this->load->view('template/sidebar_view');
		  $this->load->view('docs/docs_category_view', $data);
		  $this->load->view('template/footer_view');
	}
	
	public function upload_form()
	{
		  # get data from session
		  $session_data = $this->session->userdata('logged_in');
		  
		  # data
		  $nama = $session_data['ui_nama'];
		  $data['nama'] = $nama;
		  
		  $unit = $session_data['ui_unit'];
		  $data['unit'] = $unit;
		  
		  $email = $session_data['ui_email'];
		  $data['email'] = $email;
		  
		/*  $cabang = $session_data['ui_cabang'];
		  $data['cabang'] = $cabang;*/
		  
		  $data['error'] ='';
		  
		  # get variable for docs category
		  $data['query_category_for_combo'] = $this->docs_model->get_all_category_for_combo($cabang, $unit);
		
		 # redirect to upload form
		 $this->load->view('template/header_view');
		 $this->load->view('template/navigation_view', $data);
		 $this->load->view('template/sidebar_view');
		 $this->load->view('docs/docs_file_upload_view', $data);
		 $this->load->view('template/footer_view');
	}
	
	function do_upload()
	{
		  # login succces then get data from session
		  $session_data = $this->session->userdata('logged_in');
		  
		  $nama = $session_data['ui_nama'];
		  $data['nama'] = $nama;
		  
		  $unit = $session_data['ui_unit'];
		  $data['unit'] = $unit;
		  
		  $email = $session_data['ui_email'];
		  $data['email'] = $email;
		  
		/*  $cabang = $session_data['ui_cabang'];
		  $data['cabang'] = $cabang;*/
		  
		  $config['upload_path'] = './files/';
		  $config['allowed_types'] = 'pdf|gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pps|ppsx';
		  $config['max_size']	= '99999';
		  $config['max_width']  = '99999';
		  $config['max_height']  = '99999';
		
		  $this->load->library('upload', $config);
				
				
		
				if ( ! $this->upload->do_upload('file'))
				{
					# get variable for docs category
		  			$data['query_category_for_combo'] = $this->docs_model->get_all_category_for_combo($cabang, $unit);
					
					# set error message
					$data['error'] = $this->upload->display_errors();
					
					$this->load->view('template/header_view');
					$this->load->view('template/navigation_view');
					$this->load->view('template/sidebar_view');
					$this->load->view('docs/docs_file_upload_view', $data);
					$this->load->view('template/footer_view');
				}
				else
				{
					# DO UPLOAD
					$upload_data = $this->upload->data();
					
					# GET REAL DATA FOR DB
					$docs_user_name = $this->input->post('filename');
					$docs_real_name	= $this->encrypt->encode($upload_data['file_name'], 'eman_elif');
					$docs_system_name	= $this->encrypt->encode(date("YmdHis"), 'siHdmY');	
					$system_file_name = date("YmdHis");		 	 	 	 	 	 	
					$docs_ext	= $this->encrypt->encode($upload_data['file_ext'], 'txe_elif');	 	 	 	 	 	 	
					$docs_size	= $upload_data['file_size'];	 	 	 	 	 	 	
					$docs_category	= $this->input->post('category');	 	 	 	 	 	 	
					$docs_owner	= $this->input->post('fileowner');
					$docs_upload_by = $email;
					$file_path = $upload_data['file_path'];
					
					# call model
					$this->docs_model->upload_file($docs_user_name, $docs_real_name, $docs_system_name, $docs_ext, $docs_size, $docs_category, $docs_owner,  $docs_upload_by, $file_path);
					
					# rename file after upload and remove ext
					rename($upload_data['full_path'], $upload_data['file_path'] . $system_file_name);
					
					# call view
					redirect('dashboard');
				}
	}
	
	public function file_view()
	{
		# get docs id from url
		$docs_id = $this->uri->segment(3, 0);
		
		# anticipate null segment
		if ($docs_id == 0)
		{
			redirect('dashboard');
		}
		
		# call model
		$data['query_docs_view'] = $this->docs_model->get_doc_by_id($docs_id);
		
		# call view
		$this->load->view('template/header_view');
		$this->load->view('template/navigation_view');
		$this->load->view('template/sidebar_view');
		$this->load->view('docs/docs_file_view', $data);
		$this->load->view('template/footer_view');
	}
	
	public function file_download()
	{
			# get data
			$path = $this->input->post('file_path');
			$data['data_file_path'] = $path;
			
			$name = $this->input->post('file_name');
			$data['data_file_name'] = $name;
			
			# do download
			  if(is_file($path))
			  {
				# count downloader
				
				
				# required for IE
				if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }
			
				# get the file mime type using the file extension
				$mime = get_mime_by_extension($path);
			
				# Build the headers to push out the file properly.
				header('Pragma: public');     // required
				header('Expires: 0');         // no cache
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
				header('Cache-Control: private',false);
				header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
				header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($path)); // provide file size
				header('Connection: close');
				readfile($path); // push it out
				exit();
				
			  }
	}
	
	public function file_direct_download()
	{
		# get file id form url
		$docs_id = $this->uri->segment(3, 0);
		
		# anticipate null segment
		if ($docs_id == 0)
		{
			redirect('dashboard');
		}
		
		# call model
		$query_docs_view = $this->docs_model->get_doc_by_id($docs_id);
		
		# process query result
		foreach($query_docs_view as $row_docs)
		{ 
			$docs_id = $row_docs->docs_id;
			$docs_real_name = $this->encrypt->decode($row_docs->docs_real_name, 'eman_elif');
			$docs_system_name = $this->encrypt->decode($row_docs->docs_system_name, 'siHdmY');
			$docs_ext = $this->encrypt->decode($row_docs->docs_ext, 'txe_elif');
			$docs_file_path = $row_docs->docs_file_path;
			copy($docs_file_path . $docs_system_name, $docs_file_path . 'terminal/' . $docs_real_name);
			$filepath = $docs_file_path . 'terminal/' . $docs_real_name;
			
			# get data
			$name = $this->encrypt->decode($row_docs->docs_real_name, 'eman_elif');
			$data['data_file_name'] = $name;
			
			$path = $row_docs->docs_file_path . 'terminal/' . $docs_real_name;
			$data['data_file_path'] = $path;
			
			# do download
			  if(is_file($path))
			  {
				# count downloader
				
				
				# required for IE
				if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }
			
				# get the file mime type using the file extension
				$mime = get_mime_by_extension($path);
			
				# Build the headers to push out the file properly.
				header('Pragma: public');     // required
				header('Expires: 0');         // no cache
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
				header('Cache-Control: private',false);
				header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
				header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($path)); // provide file size
				header('Connection: close');
				readfile($path); // push it out
				exit();
				
			  }
		}
		
										
	}
	
	public function file_edit()
	{
		echo 'this feature still under development';
	}
	
	public function file_delete()
	{
		$docs_id = $this->uri->segment(3, 0);
		
		# delete file
		$query = $this->docs_model->get_doc_by_id($docs_id);
		foreach ( $query as $row )
		{
			$docs_system_name = $this->encrypt->decode($row->docs_system_name, 'siHdmY');
			unlink('./files/'. $docs_system_name);
		}
		
		# delete db
		$query = $this->docs_model->del_doc($docs_id);
		
		redirect('dashboard');
	}
	
	public function search()
	{
		redirect('dashboard');
	}
	
	public function manage_category()
	{
		 $session_data = $this->session->userdata('logged_in');
		 if($this->session->userdata('ui_app_level') == 'admin' )
	    {
		
		 
		 # pagination
		  $config = array();
		  $config['base_url'] = site_url() . '/docs/manage_category/';
		  $config['per_page'] = 10; 
		  $config["uri_segment"] = 3;
		  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  $limit = $config["per_page"];
		  $offset = $page;
		  
		  $data['total_manage_category'] = $this->docs_model->total_manage_category();
		  
		  $config['total_rows'] = $data['total_manage_category'];
		  $data['total'] = $data['total_manage_category'];
		  
		  $this->pagination->initialize($config);
		  
		  # call model
		  $data['query_get_all_category_file'] = $this->docs_model->get_all_category_file();
		  
		  $data['link'] = $this->pagination->create_links();
		
		  # call view
		  $this->load->view('template/header_view');
		  $this->load->view('template/navigation_view');
		  $this->load->view('template/sidebar_view');
		  $this->load->view('docs/docs_manage_category_view', $data);
		  $this->load->view('template/footer_view');
		
		  }
	      else
	      {
		 		# redirect to dashboard for non admin
		  		redirect('dashboard');
	      }
	}

	
}

/* End of file docs.php */
/* Location: ./application/controllers/docs.php */