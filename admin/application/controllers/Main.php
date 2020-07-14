<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Main extends websco_secure
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('DALUsers');
    }

    public function index()
    {
        $data['title'] = "Bienvenido";

        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = "Perfil";
        $change_password = false;
        if ($this->input->post()) {
            $user = DALUsers::findOrFail($this->session->userdata('id'));
            if ($user) {
                $user->name = $this->input->post('inputName');
                $user->username = $this->input->post('inputEmail');
                $user->role = $this->input->post('inputRole');

                if ($this->input->post('inputPassword')) {
                    $user->password = sha1(md5($this->input->post('inputPassword')));
                    $change_password = true;
                }

                if ($_FILES['inputAvatar']['size'] > 0) {
                    upload_delete($this->session->userdata('avatar'));
                    $url_profile = generateDir("./uploads/profiles/" . url_title($user->id, 'dash', true));
                    $user->avatar = $url_profile .'/'. upload('inputAvatar', $url_profile);
                }
                if ($user->save()) {
                    $data = array(
                        'login' => '',
                        'name' => '', 
                        'username' => '',
                        'role' => '',
                        'avatar' => ''
                    );
                    $this->session->unset_userdata($data);

                    $result = json_encode(array(
                        "estatus" => true,
                        "message" => "Perfil actualizado",
                        "type" => "info",
                        "date" => date('Y-m-d H:i:s'),
                        "data" => $user,
                        "change_password" => $change_password
                    ));
                    $sess_data = array(
                        'login' => TRUE,
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'role' => $user->role,
                        'avatar' => $user->avatar
                    );
                    $this->session->set_userdata($sess_data);
                    log_message('info', $result);
                    echo $result;
                    exit();
                } else {
                    $result = json_encode(array(
                        "estatus" => false,
                        "message" => "Error generado",
                        "type" => "error",
                        "date" => date('Y-m-d H:i:s'),
                        "data" => array()
                    ));
                    log_message('error', $result);
                    echo $result;
                    exit();
                }
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => "El perfil del usuario no existe",
                    "type" => "error",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => array()
                ));
                log_message('error', $result);
                echo $result;
                exit();
            }
        } else {

            $this->load->view('templates/header', $data);
            $this->load->view('profile/index', $data);
            $this->load->view('templates/footer');
        }
    }

    #Destruimos las sesiones y salimos del sistema
    public function logout()
    {
        $data = array(
            'login' => '',
            'name' => '',
            'username' => '',
            'role' => '',
            'avatar' => ''
        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}
