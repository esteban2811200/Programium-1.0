<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Subject extends websco_secure
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DALSubject');
    }

    public function index()
    {
        $data['title'] = "Asignaturas";
        $data['subjects'] = DALSubject::all();
        $this->load->view('templates/header', $data);
        $this->load->view('subject/index', $data);
        $this->load->view('templates/footer');
    }

    public function findSubject()
    {
        $id = $_REQUEST['id'];
        $result = array();
        $subject = DALSubject::findOrFail($id)->toJson();
        if ($subject) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Asignatura localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($subject)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Asignatura no localizado",
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

    public function add() {
        $result = array();
        $subject = new DALSubject();
        $subject->name = $_REQUEST['name'];
        $subject->description = $_REQUEST['description'];
        
        if ($subject->save()) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Asignatura Guardado",
                "type" => "success",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($subject)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => $subject->getMessage(),
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
        $subject = DALSubject::findOrFail($id);
        if ($subject) {
            $subject->name = $_REQUEST['name'];
            $subject->description = $_REQUEST['description'];
           
            if ($subject->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Asignatura actualizado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($subject)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $subject->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => ""
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Asignatura no localizado",
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
        $subject = DALSubject::findOrFail($id);
        if ($subject) {
            $subject->status = 0;
            if ($subject->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Asignatura Desactivado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($subject)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $subject->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($subject)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Asignatura no localizado",
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
        $subject = DALSubject::findOrFail($id);
        if ($subject) {
            $subject->status = 1;
            if ($subject->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Asignatura Activado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($subject)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $subject->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($subject)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Asignatura no localizado",
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