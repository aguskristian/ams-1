<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_station extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
		$this->load->model( 'user_model' );
    }
	
	function select_unit ( $station )
	{
		$units = $this->user_model->get_unit( $station );
		
		if ( $units ) foreach ( $units as $unit ) {
			echo '<option value="'.$unit->uu_id.'">'.ucfirst( $unit->uu_name ).'</option>';
		}
	}
	
	function select_subunit ( $unit )
	{
		$subunits = $this->user_model->get_subunit( $unit );
		
		if ( $subunits ) foreach ( $subunits as $subunit ) {
			echo '<option value="'.$subunit->usu_id.'">'.ucfirst( $subunit->usu_name ).'</option>';
		}
	}
	
	/* incoming
	function select_jabatan ( $subunit )
	{
		$jabatans = $this->station_model->get_jabatan( $subunit );
		
		if ( $jabatans ) foreach ( $jabatans as $jabatan ) {
			echo '<option value="'.$jabatan->id.'">'.ucfirst( $jabatan->name ).'</option>';
		}
	} */

	
}

/* End of file ajax_station.php */
/* Location: ./application/controllers/ajax_station.php */