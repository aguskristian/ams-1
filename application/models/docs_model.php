<?php
class Docs_model extends CI_Model
{
	
# constructor	
	function __construct()
	{
        parent::__construct();
    }

	# docs upload
	function save_docs($docs_date_in, $docs_reg_no, $docs_type,$docs_no,$docs_date,$docs_from,$docs_to,$docs_copy,$docs_subject,$docs_description, $docs_update_by)
	{
		$data = array(
		'docs_date_in'	=>	 $docs_date_in,
		'docs_reg_no'	=>	 $docs_reg_no,
		'docs_type'		=>	 $docs_type,	 	 	 	 	 	 	
		'docs_no'		=>	 $docs_no,
		'docs_date' 	=> 	 $docs_date,	 	 	 	 	 	 	
		'docs_to'		=>	 $docs_to,	 	 	 	 	 	 	
		'docs_from'		=>	 $docs_from,	 	 	 	 	 	 	
		'docs_copy'		=>   $docs_copy,		 	 	 	 	 	 	
		'docs_subject'	=>	 $docs_subject,	 	 	 	 	 	 	
		'docs_description'	=>	 $docs_description,	 	 	 	 	 	 	
		'docs_update_by' =>  $docs_update_by,
		);
		$this->db->insert('docs', $data);
		return $this->db->insert_id();
	}
	
	# docs upload
	function save_file($df_docs_id, $df_user_name, $df_real_name, $df_file_path, $df_system_name, $df_ext, $df_size, $df_type, $df_owner, $df_update_by)
	{
		$data = array(
		'df_docs_id'	=>	 $df_docs_id,	
		'df_user_name'	=>	 $df_user_name,	 	 	 	 	 	 	
		'df_real_name'	=>	 $df_real_name,
		'df_file_path' => $df_file_path,	 	 	 	 	 	 	
		'df_system_name'	=>	 $df_system_name,	 	 	 	 	 	 	
		'df_ext'	=>	 $df_ext,	 	 	 	 	 	 	
		'df_size'	=> $df_size,		 	 	 	 	 	 	
		'df_type'	=>	 $df_type,	 	 	 	 	 	 	
		'df_owner'	=>	 $df_owner,	 	 	 	 	 	 	
		'df_update_by' => $df_update_by,
		);
		$this->db->insert('docs_files', $data);
		#return $this->db->insert_id();
	}
	
	# update docs position
	function set_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_in, $dp_date_out, $dp_update_by)
	{
		$data = array(
		'dp_docs_id' => $dp_docs_id,
		'dp_position' => $dp_position,
		'dp_status' => $dp_status,
		'dp_date_in' => $dp_date_in,
		'dp_date_out' => $dp_date_out,
		'dp_update_by' => $dp_update_by,
		);
		$this->db->insert('docs_position', $data);
		
		 
	}
	
	# update docs position
	function update_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_out, $dp_update_by)
	{
		$data = array(
		'dp_status' => $dp_status,
		'dp_date_out' => $dp_date_out,
		'dp_update_by' => $dp_update_by,
		);
		#$this->db->insert('docs_position', $data);
		
		$this->db->where('dp_docs_id', $dp_docs_id);
		$this->db->where('dp_position', $dp_position);
		$this->db->where('dp_status', 'open');
		$this->db->where('dp_date_out', '0000-00-00 00:00:00');
		$this->db->update('docs_position', $data); 
	}
	
	# update docs flow
	function update_docs_flow($df_docs_id, $df_flow, $df_from, $df_to, $df_subject, $df_description, $df_update_by)
	{
		$data = array(
		'df_docs_id' => $df_docs_id,
		'df_flow' => $df_flow,
		'df_from' => $df_from,
		'df_to' => $df_to,
		'df_subject' => $df_subject,
		'df_description' => $df_description,
		'df_update_by' => $df_update_by,
		);
		$this->db->insert('docs_flow', $data);
		
	}
	
	
	
	# get my statistic open status
	function stat_my_open($nipp)
	{
		$query = ('
		SELECT COUNT(DISTINCT dp_docs_id) as open FROM docs_position 
		WHERE dp_status= \'open\' 
		AND dp_position = \'' . $nipp . '\'
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# get my statistic progress status
	function stat_my_progress($nipp)
	{
		$query = ('
		SELECT COUNT(DISTINCT dp_docs_id) as progress FROM docs_position 
		WHERE dp_status= \'progress\' 
		AND dp_position = \'' . $nipp . '\'
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# get my statistic completed status
	function stat_my_completed($nipp)
	{
		$query = ('
		SELECT COUNT(DISTINCT dp_docs_id) as completed FROM docs_position 
		WHERE dp_status= \'completed\' 
		AND dp_position = \'' . $nipp . '\'
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# get my statistic closed status
	function stat_my_closed($nipp)
	{
		$query = ('
		SELECT COUNT(DISTINCT dp_docs_id) as closed FROM docs_position 
		WHERE dp_status= \'closed\' 
		AND dp_position = \'' . $nipp . '\'
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# list open document
	function docs_open($nipp)
	{
		$query = ('
		SELECT * from docs_position
		LEFT JOIN docs
		ON docs.docs_id = docs_position.dp_docs_id
		LEFT JOIN docs_flow
		ON docs_flow.df_docs_id = docs_position.dp_docs_id
		WHERE docs_position.dp_position = \'' . $nipp . '\'
		AND docs_position.dp_status = \'open\'
		GROUP BY docs.docs_id
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# list progress document
	function docs_progress($nipp)
	{
		$query = ('
		SELECT * from docs_position
		LEFT JOIN docs
		ON docs.docs_id = docs_position.dp_docs_id
		LEFT JOIN docs_flow
		ON docs_flow.df_docs_id = docs_position.dp_docs_id
		WHERE docs_position.dp_position = \'' . $nipp . '\'
		AND docs_position.dp_status = \'progress\'
		GROUP BY docs.docs_id
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# list open Completed
	function docs_completed($nipp)
	{
		$query = ('
		SELECT * from docs_position
		LEFT JOIN docs
		ON docs.docs_id = docs_position.dp_docs_id
		LEFT JOIN docs_flow
		ON docs_flow.df_docs_id = docs_position.dp_docs_id
		WHERE docs_position.dp_position = \'' . $nipp . '\'
		AND docs_position.dp_status = \'completed\'
		GROUP BY docs.docs_id
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# list open document
	function docs_closed($nipp)
	{
		$query = ('
		SELECT * from docs_position
		LEFT JOIN docs
		ON docs.docs_id = docs_position.dp_docs_id
		LEFT JOIN docs_flow
		ON docs_flow.df_docs_id = docs_position.dp_docs_id
		WHERE docs_position.dp_position = \'' . $nipp . '\'
		AND docs_position.dp_status = \'closed\'
		GROUP BY docs.docs_id
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# get doc by id
	function get_doc_by_id($docs_id)
	{
		$query_docs_view =('
		SELECT * FROM docs
		WHERE docs_id = \'' . $docs_id . '\'
		');
		$query = $this->db->query($query_docs_view);
		return $query->result();
	}
	
	# get files by id
	function get_files_by_id($docs_id)
	{
		$query_docs_view =('
		SELECT * FROM docs
		LEFT JOIN docs_files 
		ON docs_files.df_docs_id = docs.docs_id 
				
		WHERE docs_id = \'' . $docs_id . '\'
		');
		$query = $this->db->query($query_docs_view);
		return $query->result();
	}
	
	
	function get_flow_by_id($docs_id)
	{
		$query_flow =('
			SELECT docs_flow.*, user_from.ui_nama as from_user, user_to.ui_nama as to_user
			FROM docs_flow
			LEFT JOIN ( select * from user_identity ) as user_from on docs_flow.df_from = user_from.ui_nipp
			LEFT JOIN ( select * from user_identity ) as user_to on docs_flow.df_to = user_to.ui_nipp
					
			WHERE df_docs_id = \'' . $docs_id . '\'
		');
		$query_flow = $this->db->query($query_flow);
		return $query_flow->result();

		
	}
	
	function docs_position($docs_id)
	{
		$this->db->where('dp_docs_id', $docs_id);
		$this->db->join('user_identity', 'user_identity.ui_nipp = docs_position.dp_position');
		$this->db->order_by("dp_id", "asc"); 
		$query_position = $this->db->get('docs_position'); 
		return $query_position->result();
	}
	
	function docs_discussion($docs_id)
	{
		$this->db->where('dd_docs_id', $docs_id);
		$this->db->join('user_identity', 'user_identity.ui_nipp = docs_discussion.dd_nipp');
		$this->db->order_by("dd_id", "asc"); 
		$query_discussion = $this->db->get('docs_discussion'); 
		return $query_discussion->result();
	}
	
	function add_docs_discussion($dd_docs_id, $dd_subject, $dd_message, $nipp)
	{
		$data = array(
		'dd_docs_id' => $dd_docs_id,
		'dd_subject' => $dd_subject,
		'dd_message' => $dd_message,
		'dd_nipp' => $nipp,
		'dd_update_by' => $nipp,
		);
		$this->db->insert('docs_discussion', $data);
		
	}
	
	# get manager nipp
	function get_manager_nipp($nipp, $ui_function)
	{
		$query =('
		SELECT * FROM user_identity
		WHERE ui_function LIKE \'' . substr($ui_function, 0, 4) . '____09\'
		AND ui_nipp <> \'' . $nipp . '\'
		');
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	
	# get upline
	function get_upline($nipp, $ui_function)
	{
		
		if(substr($ui_function, 8, 2) == '12') # staff find upline
		{
			if(substr($ui_function, 6, 2) == '01') # staff no team find ass man
			{
				$query =('
				SELECT * FROM user_identity
				WHERE ui_function LIKE \'' . substr($ui_function, 0, 8) . '10\'
				');
			}
			else  # staff with tema find supv
			{
				$query =('
				SELECT * FROM user_identity
				WHERE ui_function LIKE \'' . substr($ui_function, 0, 8) . '11\'
				');
			}
		}
		elseif(substr($ui_function, 8, 2) == '11') # spv find assman
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__10\'
			');
		}
		elseif(substr($ui_function, 8, 2) == '10') # assman find mgr
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 4) . '____09\'
			');
		}
		elseif(substr($ui_function, 8, 2) == '09') # mgr find gm
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 2) . '______06\'
			');
		}
		
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	# get colleagues
	function get_colleagues($nipp, $ui_function)
	{
		
		if(substr($ui_function, 8, 2) == '12') # staff find staff
		{
				$query =('
				SELECT * FROM user_identity
				WHERE ui_function LIKE \'' . $ui_function . '\'
				AND ui_nipp <> \'' . $nipp . '\'
				');
		}
		elseif(substr($ui_function, 8, 2) == '11') # supervisor find supervisor
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__11\'
			AND ui_nipp <> \'' . $nipp . '\'
			');
		}
		elseif(substr($ui_function, 8, 2) == '10') # assman find ass assman
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 4) . '____10\'
			AND ui_nipp <> \'' . $nipp . '\'
			');
		}
		elseif(substr($ui_function, 8, 2) == '09') # mgr find mgr
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 2) . '______09\'
			AND ui_nipp <> \'' . $nipp . '\'
			');
		}
		
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	# get downline
	function get_downline($nipp, $ui_function)
	{
		
		if(substr($ui_function, 8, 2) == '12') # staff non team
		{
			if(substr($ui_function, 6, 2) == '01')
			{
				$query =('
				SELECT * FROM user_identity
				WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__16\'
				');
			}
			else
			{
				$query =('
				SELECT * FROM user_identity
				WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__16\'
				');
			}
		}
		elseif(substr($ui_function, 8, 2) == '11') # supervisor
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__12\'
			');
		}
		elseif(substr($ui_function, 8, 2) == '10') # assman
		{
			if(substr($ui_function, 6, 2) == '01')
			{
				$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__12\'
			');
			}
			else
			{
				$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 6) . '__11\'
			');			}
			
			
		}
		elseif(substr($ui_function, 8, 2) == '09') # manager
		{
			$query =('
			SELECT * FROM user_identity
			WHERE ui_function LIKE \'' . substr($ui_function, 0, 2) . '______10\'
			');
		}
		
		$query = $this->db->query($query);
		return $query->result();
	}
	
// =====================================================================================	
	
	# category by group
	function total_category_file_by_group_ext($cabang, $unit, $nama, $email)
		{
			$query =('
				SELECT *, COUNT(docs_category_id) AS `category_total` FROM (`docs`) 
				LEFT JOIN docs_category 
				ON docs_category.dc_id = docs.docs_category_id
				WHERE docs_category.dc_uu_code <> \'mc\'
				GROUP BY `docs_category_id`
				ORDER BY count(docs_category_id) DESC
				LIMIT 10
				');
				
			$query = $this->db->query($query);
			return $query->result();
			
		}
	function total_category_file_by_group_int($cabang, $unit, $nama, $email)
		{
				$query =('
				SELECT *, COUNT(docs_category_id) AS `category_total` FROM (`docs`) 
				LEFT JOIN docs_category 
				ON docs_category.dc_id = docs.docs_category_id
				WHERE docs_category.dc_uu_code <> \'all\'
				GROUP BY `docs_category_id`
				ORDER BY count(docs_category_id) DESC
				LIMIT 10
				');
			
			$query = $this->db->query($query);
			return $query->result();
		}
		
# total category for pagination
	function total_category_file($category, $cabang, $unit, $nama, $email)
	{
		$query_category_total =('
		SELECT *, COUNT(docs_category_id) AS `category_total` FROM (`docs`)
		LEFT JOIN docs_category 
		ON docs_category.dc_id = docs.docs_category_id 
		WHERE `docs_category_id` = \'' . $category . '\'
		');
		$query_category_total = $this->db->query($query_category_total);
		return $query_category_total->result();
	}
	
# category file list for pagination
	function category_file($category, $limit, $offset, $cabang, $unit, $nama, $email)
	{
		$query_category_file =('
		SELECT * FROM docs 
		LEFT JOIN docs_category 
		ON docs_category.dc_id = docs.docs_category_id
		WHERE docs_category_id = \'' . $category . '\'
		');
		$query_category_file = $this->db->query($query_category_file);
		return $query_category_file->result();
	}

# category for combo	
	function get_all_category_for_combo($cabang, $unit)
	{
		$query_category_for_combo =('
		SELECT * FROM `docs_category` 
		WHERE `dc_uc_code` = \'' . $cabang . '\'
		AND `dc_uu_code` = \'' . $unit . '\'
		OR `dc_uu_code` = \'all\'
		');
		$query_category_for_combo = $this->db->query($query_category_for_combo);
		return $query_category_for_combo->result();
	}

# category name	
	function get_category_name($category)
	{
		return $this->db->get_where('docs_category', array('dc_id' => $category));
	}



	

# delete doc
	function del_doc($docs_id)
	{
		$this->db->delete('docs', array('docs_id' => $docs_id)); 
	}


# get all category file
	function get_all_category_file()
	{
		$this->db->order_by('dc_uc_code', 'asc');
		$this->db->order_by('dc_uu_code', 'asc');
		$query_get_all_category_file = $this->db->get('docs_category');
		return $query_get_all_category_file->result();
	}

	# total category
	function total_manage_category()
	{
		$this->db->from('docs_category');
		return $this->db->count_all_results();
	}
	

}