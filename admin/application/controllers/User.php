<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class User extends websco_secure
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('DALUsers');
    }

    public function index()
    {
        $data['title'] = "Usuarios";
        $data['users'] = DALUsers::all();
        $this->load->view('templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function findUser()
    {
        $id = $_REQUEST['id'];
        $result = array();
        $user = DALUsers::find($id)->toJson();
        if ($user) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Usuario localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($user)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Usuario no localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => ""
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
    }

    public function add()
    {
        $result = array();
        $user = new DALUsers();
        $user->name = $_REQUEST['name'];
        $user->username = $_REQUEST['email'];
        $user->last_name = $_REQUEST['last_name'];
        $user->role = $_REQUEST['role'];
        $user->country = $_REQUEST['country'];
        $user->province = $_REQUEST['country'];
        $user->city = $_REQUEST['country'];
        $user->ocupation = $_REQUEST['country'];
        $user->password = sha1(md5($_REQUEST['password']));
        if (!empty($_REQUEST['birth_date'])) {
            $user->birth_date = $_REQUEST['birth_date'];
        }
        if ($user->save()) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Usuario Guardado",
                "type" => "success",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($user)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => $user->getMessage(),
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => ""
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
    }

    public function edit()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $user = DALUsers::findOrFail($id);
        if ($user) {
            $user->name = $_REQUEST['name'];
            $user->username = $_REQUEST['email'];
            $user->last_name = $_REQUEST['last_name'];
            $user->role = $_REQUEST['role'];
            $user->country = $_REQUEST['country'];
            $user->province = $_REQUEST['country'];
            $user->city = $_REQUEST['country'];
            $user->ocupation = $_REQUEST['country'];

            if (!empty($_REQUEST['password'])) {
                $user->password = sha1(md5($_REQUEST['password']));
            }

            if (!empty($_REQUEST['birth_date'])) {
                $user->birth_date = $_REQUEST['birth_date'];
            }

            if ($user->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Usuario actualizado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($user)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $user->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => ""
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Usuario no localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => ""
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
    }

    public function delete()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $user = DALUsers::findOrFail($id);
        if ($user) {
            $user->status = 0;
            if ($user->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Usuario Desactivado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($user)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $user->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($user)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Usuario no localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => ""
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
    }

    public function active()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $user = DALUsers::findOrFail($id);
        if ($user) {
            $user->status = 1;
            if ($user->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Usuario Activado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($user)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $user->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($user)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Usuario no localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => ""
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
    }
}
