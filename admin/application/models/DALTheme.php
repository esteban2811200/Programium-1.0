<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'models/connection.php');
use Illuminate\Database\Eloquent\Model as Eloquent;

class DALTheme extends Eloquent{
    #nombre de la tabla
    protected $table = "theme";
    public $timestamps = false;    
}