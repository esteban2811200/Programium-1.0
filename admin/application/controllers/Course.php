<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Course extends websco_secure
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DALTheme');
        $this->load->model('DALCourse');
        $this->load->model('DALUsers');
    }

    public function index()
    {
        $data['title'] = "Cursos";
        $data['courses'] = DALCourse::join('theme as t', 'course.theme_id', '=', 't.id')
            ->join('user as u', 'course.instructor', '=', 'u.id')
            ->select('course.*', 't.name as theme', 'u.name as teacher', 'u.last_name')
            ->where('u.role', 'Profesor')
            ->get();
        $data['themes'] = DALTheme::where('status', 1)->get();
        $data['docentes'] = DALUsers::where('role', 'Profesor')->where('status', 1)->get();
        $this->load->view('templates/header', $data);
        $this->load->view('course/index', $data);
        $this->load->view('templates/footer');
    }

    public function findCourse()
    {
        $id = $_REQUEST['id'];
        $result = array();
        $course = DALCourse::join('theme as t', 'course.theme_id', '=', 't.id')
            ->join('user as u', 'course.instructor', '=', 'u.id')
            ->select('course.*', 't.name as theme', 'u.name as teacher', 'u.last_name')
            ->where('u.role', 'Profesor')
            ->where('course.id', $id)
            ->first();

        if ($course) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Curso localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($course)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Curso no localizado",
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

    public function addCourse()
    {
        $result = array();
        $course = new DALCourse();
        $course->name = $_REQUEST['name'];
        $course->description = $_REQUEST['description'];
        $course->nivel = $_REQUEST['nivel'];
        $course->instructor = $_REQUEST['teacher'];
        $course->theme_id = $_REQUEST['theme'];

        if ($course->save()) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Curso Guardado",
                "type" => "success",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($course)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => $course->getMessage(),
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

    public function editCourse()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $course =  DALCourse::findOrFail($id);
        $course->name = $_REQUEST['name'];
        $course->description = $_REQUEST['description'];
        $course->nivel = $_REQUEST['nivel'];
        $course->instructor = $_REQUEST['teacher'];
        $course->theme_id = $_REQUEST['theme'];

        if ($course->save()) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Curso Guardado",
                "type" => "success",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($course)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => $course->getMessage(),
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

    public function deleteCourse()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $course = DALCourse::findOrFail($id);
        if ($course) {
            $course->status = 0;
            if ($course->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Curso Desactivado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($course)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $course->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($course)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Curso no localizado",
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

    public function activeCourse()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $course = DALCourse::findOrFail($id);
        if ($course) {
            $course->status = 1;
            if ($course->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Curso Activado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($course)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $course->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($course)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Curso no localizado",
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
    /**
     * End function to course
     */

    /**
     * Functions to theme
     */
    public function theme()
    {
        $data['title'] = "Temas";
        $data['themes'] = DALTheme::all();
        $this->load->view('templates/header', $data);
        $this->load->view('course/theme', $data);
        $this->load->view('templates/footer');
    }

    public function findTheme()
    {
        $id = $_REQUEST['id'];
        $result = array();
        $theme = DALTheme::findOrFail($id)->toJson();
        if ($theme) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Tema localizado",
                "type" => "info",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($theme)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Tema no localizado",
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

    public function addTheme()
    {
        $result = array();
        $theme = new DALTheme();
        $theme->name = $_REQUEST['name'];
        $theme->description = $_REQUEST['description'];

        if ($theme->save()) {
            $result = json_encode(array(
                "estatus" => true,
                "message" => "Tema Guardado",
                "type" => "success",
                "date" => date('Y-m-d H:i:s'),
                "data" => json_decode($theme)
            ));
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => $theme->getMessage(),
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

    public function editTheme()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $theme = DALTheme::findOrFail($id);
        if ($theme) {
            $theme->name = $_REQUEST['name'];
            $theme->description = $_REQUEST['description'];

            if ($theme->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Tema actualizado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($theme)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $theme->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => ""
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Tema no localizado",
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

    public function deleteTheme()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $theme = DALTheme::findOrFail($id);
        if ($theme) {
            $theme->status = 0;
            if ($theme->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Tema Desactivado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($theme)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $theme->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($theme)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Tema no localizado",
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

    public function activeTheme()
    {
        $result = array();
        $id = $_REQUEST['id'];
        $theme = DALTheme::findOrFail($id);
        if ($theme) {
            $theme->status = 1;
            if ($theme->save()) {
                $result = json_encode(array(
                    "estatus" => true,
                    "message" => "Tema Activado",
                    "type" => "success",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($theme)
                ));
            } else {
                $result = json_encode(array(
                    "estatus" => false,
                    "message" => $theme->getMessage(),
                    "type" => "info",
                    "date" => date('Y-m-d H:i:s'),
                    "data" => json_decode($theme)
                ));
            }
        } else {
            $result = json_encode(array(
                "estatus" => false,
                "message" => "Tema no localizado",
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

    /***
     * End function to theme
     */
}
