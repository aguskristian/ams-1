<?php
class Docs_model extends CI_Model
{
	
# constructor	
	function __construct()
	{
        parent::__construct();
    }

	# docs upload
	function save_docs($docs_date_in, $docs_reg_no, $docs_type,$docs_no,$docs_date,$docs_from,$docs_to,$docs_copy,$docs_subject,$docs_remarks, $docs_update_by)
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
		'docs_remarks'	=>	 $docs_remarks,	 	 	 	 	 	 	
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
	function update_docs_position($dp_docs_id, $dp_position, $dp_status, $dp_date_in, $dp_date_out, $dp_update_by)
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
	
	# get manager nipp
	function get_manager_nipp($cabang, $unit)
	{
		$this->db->where('ui_cabang', $cabang);
		$this->db->where('ui_unit', $unit);
		$this->db->where('ui_jabatan', 'manager');
		$query = $this->db->get('user_identity'); 
		return $query->result();
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
		');
		$query = $this->db->query($query);
		return $query->result();		
	}
	
	# get doc by id
	function get_doc_by_id($docs_id)
	{
		$query_docs_view =('
		SELECT * FROM docs
		LEFT JOIN docs_files 
		ON docs_files.df_docs_id = docs.docs_id 
		LEFT JOIN docs_flow 
		ON docs_flow.df_docs_id = docs.docs_id 
		
		WHERE docs_id = \'' . $docs_id . '\'
		');
		$query = $this->db->query($query_docs_view);
		return $query->result();
	}
	
	function docs_position($docs_id)
	{
		$this->db->where('dp_docs_id', $docs_id);
		$this->db->join('user_identity', 'user_identity.ui_nipp = docs_position.dp_position');
		$query_position = $this->db->get('docs_position'); 
		return $query_position->result();
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