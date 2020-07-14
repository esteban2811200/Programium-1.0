<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class websco_secure extends CI_Controller
{
  public $data = '' ;

	public function __construct()
	{
		parent :: __construct();
		date_default_timezone_set('America/Mexico_City');

    $user = $this->session->userdata('login');
		if($user == FALSE || !$this->_has_access())
		{
			redirect('login');
		}

}

  private function _has_access()
  {
    return TRUE;
    echo '<b>Class:</b>'.$this->router->fetch_class().'<br>';
    echo '<b>Method:</b>'.$this->router->fetch_method().'<br>';
    echo '<b>Directory:</b>'.$this->router->fetch_directory().'<br>';

  }
}
