<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Teacher extends websco_secure
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $data['title'] = "Docente";
        $this->load->view('templates/header', $data);
        $this->load->view('teacher/index', $data);
        $this->load->view('templates/footer');
    }
}