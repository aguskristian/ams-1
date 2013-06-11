<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incoming extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Administration Management System.
	 * ver 1.0.0
	 *
	 * incoming controller
	 *
	 * url : http://ams.gapura.co.id/
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
		redirect('docs/category');
	}
	
	public function add()
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
		  
		  $cabang = $session_data['ui_cabang'];
		  $data['cabang'] = $cabang;
		  
		  $data['error'] ='';
		  
		  # get variable for docs category
		  #$data['query_category_for_combo'] = $this->docs_model->get_all_category_for_combo($cabang, $unit);
		
		 # redirect to upload form
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('ams/add', $data);
		$this->load->view('template/footer');
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
		  
		  $cabang = $session_data['ui_cabang'];
		  $data['cabang'] = $cabang;
		  
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
		  
		  $cabang = $session_data['ui_cabang'];
		  $data['cabang'] = $cabang;
		  
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