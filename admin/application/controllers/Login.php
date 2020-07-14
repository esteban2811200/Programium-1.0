<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('security');
		$this->load->model('DALUsers');
	}

	public function index()
	{
		$this->data['title'] = "Login";
		$result = array();
		#form_validation
		$this->form_validation->set_rules('email', 'Correo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login_view', $this->data);
		} else {

			#get form input
			$email = $this->input->post('email');
			$password = sha1(md5($this->input->post('password')));
			$result = DALUsers::Auth($email);
			if ($result) {
				if (!$result->status) {
					$result = json_encode(array(
						"estatus" => false,
						"message" => "Cuenta no permitida para el acceso al portal",
						"type" => "warning",
						"date" => date('Y-m-d H:i:s'),
						"data" => array()
					));
					log_message('error', $result);
					echo $result;
					exit();
				} else {
					if ($password === $result->password) {
						$sess_data = array(
							'login' => TRUE,
							'id' => $result->id,
							'name' => $result->name,
							'username' => $result->username,
							'role' => $result->role,
							'avatar' => $result->avatar
						);
						$this->session->set_userdata($sess_data);
						$result = json_encode(array(
							"estatus" => true,
							"message" => "Acceso al portal",
							"type" => "info",
							"date" => date('Y-m-d H:i:s'),
							"data" => $sess_data
						));
						log_message('info', $result);
						echo $result;
						exit();						
					} else {												
						$result = json_encode(array(
							"estatus" => false,
							"message" => "Usuario o Contraseña invalido",
							"type" => "warning",
							"date" => date('Y-m-d H:i:s'),
							"data" => array()
						));
						log_message('error', $result);
						echo $result;
						exit();
					}
				}
			} else {
				$result = json_encode(array(
					"estatus" => false,
					"message" => "Usuario o Contraseña invalido",
					"type" => "warning",
					"date" => date('Y-m-d H:i:s'),
					"data" => array()
				));
				log_message('error', $result);
				echo $result;
				exit();
			}
		}
	}
}
