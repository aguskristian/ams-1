<?php
class Docs_model extends CI_Model
{
	
# constructor	
	function __construct()
	{
        parent::__construct();
    }

	# docs upload
	function save_docs($docs_type,$docs_no,$docs_date,$docs_from,$docs_to,$docs_copy,$docs_subject,$docs_remarks)
	{
		$data = array(
		'docs_type'	=>	 $docs_type,	 	 	 	 	 	 	
		'docs_no'	=>	 $docs_no,
		'docs_date' => $docs_date,	 	 	 	 	 	 	
		'docs_to'	=>	 $docs_to,	 	 	 	 	 	 	
		'docs_from'	=>	 $docs_from,	 	 	 	 	 	 	
		'docs_copy'	=> $docs_copy,		 	 	 	 	 	 	
		'docs_subject'	=>	 $docs_subject,	 	 	 	 	 	 	
		'docs_remarks'	=>	 $docs_remarks,	 	 	 	 	 	 	
		'docs_upload_by' => 'admin',
		);
		$this->db->insert('docs', $data);
		return $this->db->insert_id();
	}
	
	# docs upload
	function save_file($docs_id,$docs_user_name, $docs_real_name, $docs_system_name, $docs_ext, $docs_size, $docs_type, $docs_owner,  $docs_upload_by, $file_path)
	{
		$data = array(
		'docs_id'	=>	 $docs_id,	
		'docs_user_name'	=>	 $docs_user_name,	 	 	 	 	 	 	
		'docs_real_name'	=>	 $docs_real_name,
		'docs_system_name' => $docs_system_name,	 	 	 	 	 	 	
		'docs_ext'	=>	 $docs_ext,	 	 	 	 	 	 	
		'docs_size'	=>	 $docs_size,	 	 	 	 	 	 	
		'docs_type'	=> $docs_type,		 	 	 	 	 	 	
		'docs_owner'	=>	 $docs_owner,	 	 	 	 	 	 	
		'docs_file_path'	=>	 $file_path,	 	 	 	 	 	 	
		'docs_upload_by' => 'admin',
		);
		$this->db->insert('docs_files', $data);
		#return $this->db->insert_id();
	}
	
	
	
	
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



# get doc by id
	function get_doc_by_id($docs_id)
	{
		$query_docs_view =('
		SELECT * FROM `docs`
		LEFT JOIN docs_category 
		ON docs_category.dc_id = docs.docs_category_id 
		WHERE `docs_id` = \'' . $docs_id . '\'
		');
		$query_docs_view = $this->db->query($query_docs_view);
		return $query_docs_view->result();
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