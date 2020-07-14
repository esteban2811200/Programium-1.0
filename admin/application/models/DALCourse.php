<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'models/connection.php');
use Illuminate\Database\Eloquent\Model as Eloquent;

class DALCourse extends Eloquent{
    #nombre de la tabla
    protected $table = "course";
    public $timestamps = false;    
}