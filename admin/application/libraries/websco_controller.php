<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class websco_controller extends CI_Controller
{
	public function __construct()
	{
		parent :: __construct();
		date_default_timezone_set('America/Mexico_City');
		//$this->load->library('myacl');
	}
}
