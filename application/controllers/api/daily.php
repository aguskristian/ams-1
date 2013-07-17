<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

# CONSTRUTOR ========================================================================================= 
	/*function __construct()
	{
        parent::__construct();
		#$#this->load->helper('html');
        //$this->load->library('PHPExcel/IOFactory');
        //$this->load->library('PHPExcel');
		#$this->load->helper('sigap_pdf');
        $this->load->model('daily/daily_model','', TRUE);
		/*$this->load->model('aircraft/aircraft_model', '', TRUE);
		$this->load->model('airline/airline_model', '', TRUE);*/
    #}
# CONSTRUTOR ========================================================================================= 

class Daily extends REST_Controller
{
	function departure_get()
    {
        if(!$this->get('ds_date_daily'))
        {
        	$this->response(NULL, 400);
        }
		
		# PREPARE DATA
		$ds_stn_code_daily = $this->config->item('station_code');
		$ds_type_daily	= 'departure';	
		$ds_status_options_daily = 'all';
		$ds_airline_daily = 'all';
		$ds_display_options_daily = 10;
		$ds_date_daily = $this->get('ds_date_daily');
		
		$this->load->model('daily/daily_model','', TRUE);
		
		$data = $this->daily_model->get_by_date_active($ds_type_daily, $ds_stn_code_daily, $ds_date_daily, $ds_display_options_daily);
		
		$this->response($data, 200); // 200 being the HTTP response code
		
    }
	
	function arrival_get()
    {
        if(!$this->get('ds_date_daily'))
        {
        	$this->response(NULL, 400);
        }
		
		# PREPARE DATA
		$ds_stn_code_daily = $this->config->item('station_code');
		$ds_type_daily	= 'arrival';	
		$ds_status_options_daily = 'all';
		$ds_airline_daily = 'all';
		$ds_display_options_daily = 10;
		$ds_date_daily = $this->get('ds_date_daily');
		
		$this->load->model('daily/daily_model','', TRUE);
		
		$data = $this->daily_model->get_by_date_active($ds_type_daily, $ds_stn_code_daily, $ds_date_daily, $ds_display_options_daily);
		
		$this->response($data, 200); // 200 being the HTTP response code
		
    }
    
    
}