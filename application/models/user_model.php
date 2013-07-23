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
	function save_user($nama, $nipp, $hp, $full_email, $emergency_password, $function)
	{
		$data = array(
		/*'ui_nama' => $nama,
		'ui_hp' => $hp,
		'ui_nipp' => $nipp,
		'ui_email' => $full_email,
		'ui_level' => $level,
		'ui_function' => $level,
		'ui_verification' => 'n',
		'ui_ver_date' => '0000-00-00 00:00:00',
		'ui_approval' => 'n',
		'ui_approval_by' => '',
		'ui_approval_on' => '0000-00-00 00:00:00',*/
		'ui_nama' => $nama,
		'ui_hp' => $hp,
		'ui_nipp' => $nipp,
		'ui_email' => $full_email,
		'ui_password' => $emergency_password,
		'ui_function' => $function,
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


# get all stn available
	function get_station() 
	{
		 $this->db->order_by('vs_level', 'ASC');
		 return $this->db->get( 'var_station' )->result();
	}

# get unit  available 		
	function get_unit($station)
	{
		$result = $this->db->where('vu_vs_code', $station)->get('var_unit')->result();
		return $result ? $result : false;	}

# get all sub unit available 		
	function get_subunit($unit) 
	{
		$result = $this->db->where( 'vsu_vu_code', $unit )->get( 'var_sub_unit' )->result();
		return $result ? $result : false;
	}

# get all sub unit available 		
	function get_team($subunit) 
	{
		$result = $this->db->where( 'vt_vsu_code', $subunit )->get( 'var_team' )->result();
		return $result ? $result : false;
	}

# get all function available
	function get_function() 
	{
		 $this->db->order_by('vf_level', 'DESC');
		 return $this->db->get( 'var_function' )->result();
		 
	}

# get stn level
	function get_station_level($station) 
	{
		$result = $this->db->where( 'vs_code', $station )->get( 'var_station' )->result();
		return $result ? $result : false;
	}

# get unit level
	function get_unit_level($unit) 
	{
		$result = $this->db->where( 'vu_code', $unit )->get( 'var_unit' )->result();
		return $result ? $result : false;
	}
	
# get sub unit level
	function get_sub_unit_level($sub_unit) 
	{
		$result = $this->db->where( 'vsu_code', $sub_unit )->get( 'var_sub_unit' )->result();
		return $result ? $result : false;
	}

# get team level
	function get_team_level($team) 
	{
		$result = $this->db->where( 'vt_code', $team )->get( 'var_team' )->result();
		return $result ? $result : false;
	}

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
	   $this->db->select('uv_email, uv_pin, uv_link');
	   $this->db->from('user_verification');
	   $this->db->where('uv_email', $email);
	   $this->db->where('uv_pin', $pin);
	   
	   $this->db-> limit(1);
	
	   $query = $this->db->get();

	   if($query->num_rows() == 1)
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
		 $this -> db -> select('*');
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