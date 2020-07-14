<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'models/connection.php');
use Illuminate\Database\Eloquent\Model as Eloquent;

class DALUsers extends Eloquent{
    #nombre de la tabla
    protected $table = "user";
    public $timestamps = false;    

    /**
     * Function to Auth application
     */
    public static function Auth($email) {
        return self::where('username', $email)->first();
    }
}