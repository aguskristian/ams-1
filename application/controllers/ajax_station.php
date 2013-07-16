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
			echo '<option value="'.$unit->vu_code.'">'.ucfirst( $unit->vu_name ).'</option>';
		}
	}
	
	function select_subunit ( $unit )
	{
		$subunits = $this->user_model->get_subunit( $unit );
		
		if ( $subunits ) foreach ( $subunits as $subunit ) {
			echo '<option value="'.$subunit->vsu_code.'">'.ucfirst( $subunit->vsu_name ).'</option>';
		}
	}
	
	function select_team ( $subunit )
	{
		$teams = $this->user_model->get_team( $subunit );
		
		if ( $teams ) foreach ( $teams as $team ) {
			echo '<option value="'.$team->vt_code.'">'.ucfirst( $team->vt_name ).'</option>';
		}
	}

	
}

/* End of file ajax_station.php */
/* Location: ./application/controllers/ajax_station.php */
