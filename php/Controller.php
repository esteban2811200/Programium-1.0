<?php

/**
 * Clase controller
 * By Cesar Chab 11/05/2020
 * Contact: cesarchabuluac@gmail.com
 */
class Controller
{
    //Atributos privados
    private static $instancia;
    private $dbh;

    /**
     *En el constructor de la clase realizamos la conexion a la base de datos,
     */
    private function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=programium', 'root', '');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    /**
     * Function to register user to course
     * @param {$name}
     * @param {$last_name}
     * @param {$email}
     * @param {$country}
     * @param {$province}
     * @param {$city}
     * @param {$birth_date}
     * @param {$password}
     * @param {$ocupation}
     */
    public function register ($name, $last_name, $email, $country, $province, $city, $birth_date, $password, $ocupation) {
        $query = $this->dbh->prepare('INSERT INTO user (name, username, password, role, last_name, country, province, city, ocupation, birth_date)
        VALUES (:name, :username, :password, :role, :last_name, :country, :province, :city, :ocupation, :birth_date)');
        $query->execute(array(
           ':name' => $name,
           ':username' => $email,
           ':password' => sha1(md5($password)),
           ':role' => 'Estudiante', //Default sera estudiante
           ':last_name' => $last_name,
           ':country' => $country,
           ':province' => $province,
           ':city' => $city,
           ':ocupation' => $ocupation,
           ':birth_date' => (isset($birth_date) && !empty($birth_date)) ? $birth_date : null
        ));
        $query = $query->rowCount();
        return $query;
    }


}
