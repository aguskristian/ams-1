<?php
class User_model extends CI_Model
{
	
# constructor ------------------------------------------------------------------------------	
	function __construct()
	{
        parent::__construct();
    }
# constructor ------------------------------------------------------------------------------

# save data on user identity table -------------------------------------
	function save_user($nama, $nipp, $hp, $full_email, $cabang, $unit, $jabatan)
	{
		$data = array(
		'ui_nama' => $nama,
		'ui_hp' => $hp,
		'ui_nipp' => $nipp,
		'ui_email' => $full_email,
		'ui_cabang' => $cabang,
		'ui_unit' => $unit,
		'ui_jabatan' => $jabatan,
		'ui_app_level' => 'user',
		'ui_app_role' => '0000000000000',
		'ui_verification' => 'n',
		'ui_ver_date' => '0000-00-00 00:00:00',
		'ui_approval' => 'n',
		'ui_approval_by' => '',
		'ui_approval_on' => '0000-00-00 00:00:00',
		);
		
		$this->db->insert('user_identity', $data);
	}
# save data on user identity table -------------------------------------


# check user on user indetity table ------------------------------------
	function check_reg_email($email)
	{
		$query = $this->db->get_where('user_identity', array('ui_email' => $email), 1, 0);
		return $query->result();	
	}
# check user on user indetity table ------------------------------------


# del previous unverify data on user identity table -------------------		
/*	function del_dup_prev_user_unver_data($full_email)
	{
		$this->db->delete('user_identity', array('ui_email' => $full_email)); 
	}*/
# del previous unverify data on user identity table -------------------


# get all stn available  ----------------------------------------------		
	function get_station()
	{
		$data = array();
		$this->db->from('user_station');
		$station = $this->db->get();
		
		foreach($station->result() as $row)
		   {
			  $data[0] = '-- select station --';
			  $data[$row->us_id] = $row->us_name;
		   }
	   return $data;	
 
	}
# get all stn available  ----------------------------------------------	

# get unit  available  ----------------------------------------------		
	function get_unit()
	{
		$data = array();
		$this->db->from('user_unit');
		$this->db->where('uu_us_id',$station);
		$unit = $this->db->get();
		
		foreach($unit->result() as $row)
		   {
			  $data[0] = '-- select station first --';
			  $data[$row->us_id] = $row->us_name;
		   }
	   return $data;	
 
	}
# get unit  available  ----------------------------------------------


	public function get_child_position($up_parent_id)
	{
	   $data = array();
	   $this->db->from('user_position');
	   $this->db->where('up_parent_id',$up_parent_id);
	   $result = $this->db->get();
	   
	   foreach($result->result() as $row)
	   {
		  $data[$row->up_id] = $row->up_position_name;
	   }
	   return $data;
	}

# get all unit available  ----------------------------------------------		
/*	function get_unit($cabang)
	{
	     $this->db->where('uu_code !=', 'non');
		 $this->db->where('uu_us_id', $cabang);
		 $this->db->order_by('uu_name', 'asc');
		 
		 $query_unit_combo = $this->db->get('user_unit');

		 if ($query_unit_combo->num_rows() > 0 )
		 {
			 return $query_unit_combo->result_array();
		 }
		 else
		 {
			 return array();
		}
	}*/
# get all unit available  ----------------------------------------------	

# get all unit available  ----------------------------------------------		
	function get_sub_unit($unit)
	{
	     
		 $this->db->where('us_uu_id', $unit);
		 $this->db->order_by('us_name', 'asc');
		 
		 $query_sub_unit_combo = $this->db->get('user_sub_unit');

		 if ($query_sub_unit_combo->num_rows() > 0 )
		 {
			 return $query_sub_unit_combo->result_array();
		 }
		 else
		 {
			 return array();
		}
	}
# get all unit available  ----------------------------------------------	


# save data on user verification table ---------------------------------
	function save_verification($full_email, $hp, $pin, $email_link, $type, $request, $expired)
	{
		$data = array(
		
		'uv_email' => $full_email,
		'uv_hp' => $hp,
		'uv_type' => $type,
		'uv_pin' => $pin,
		'uv_link' => $email_link,
		'uv_date' => $request,
		'uv_expired' => $expired,
		);
		
		$this->db->insert('user_verification', $data);
	}
# save data on user verification table ---------------------------------

# do verification --------------------------------------------------------
	function do_verification($email, $pin)
 	{
	   $this -> db -> select('uv_email, uv_pin, uv_link');
	   $this -> db -> from('user_verification');
	   $this -> db -> where('uv_email', $email);
	   $this -> db -> where('uv_pin', $pin);
	   
	   $this -> db -> limit(1);
	
	   $query = $this -> db -> get();

	   if($query -> num_rows() == 1)
	   {
		 # update verification field on user identity table
		 $data = array(
               'ui_verification' => 'y',
               'ui_ver_date' => date("Y-m-d H:i:s"),
            );
		 $this->db->where('ui_email', $email);
		 $this->db->update('user_identity', $data);
		 
		 # remove verification data on verification table
		 $this->db->delete('user_verification', array('uv_email' => $email)); 
		 
		 # autologin verified user
		 $this -> db -> select('ui_id, ui_nama, ui_nipp, ui_hp, ui_email, ui_cabang, ui_unit, ui_jabatan, ui_app_level, ui_app_role, ui_verification, ui_ver_date');
	     $this -> db -> from('user_identity');
	     $this -> db -> where('ui_email', $email);
		 $this -> db -> where('ui_verification', 'y');
	     $this -> db -> where('ui_verification  !=', '0000-00-00 00:00:00');
	     $this -> db -> limit(1);
	     $query = $this -> db -> get();
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
	   
 	}
# do verification --------------------------------------------------------


# del previous data on verification table ------------------------------	
	function del_dup_prev_ver_data($full_email)
	{
		$this->db->delete('user_verification', array('uv_email' => $full_email)); 
	}
# del previous data on verification table ------------------------------		


# del previous unverify data on user identity table -------------------		
	function del_dup_prev_user_unver_data($full_email)
	{
		$this->db->delete('user_identity', array('ui_email' => $full_email)); 
	}
# del previous unverify data on user identity table -------------------

}