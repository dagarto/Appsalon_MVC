<?php 

namespace Model;

class Usuario extends ActiveRecord {

    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
       $this->id =  $args['id'] ?? null;
       $this->nombre =  $args['nombre'] ?? '';
       $this->apellido =  $args['apellido'] ?? '';
       $this->email =  $args['email'] ?? '';
       $this->password =  $args['password'] ?? '';
       $this->telefono =  $args['telefono'] ?? '';
       $this->admin =  $args['admin'] ?? '0';
       $this->confirmado =  $args['confirmado'] ?? '0';
       $this->token =  $args['token'] ?? '';
    }

    //Mensajes de validacion para la creacion de cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }
        //Passwor debe tener al menos 6 caracteres
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }


        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Correo es Oligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Oligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    public function existeUsuario() {
        //Lee los datos que se tienen en memoria
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        //Se realiza la consulta
        $resultado = self::$db->query($query);

        //Si ua existe se agrega la alerta de error
        if($resultado->num_rows) {
            self::$alertas['error'][] = "El Usuario Ya esta Registrado";
        }

        return $resultado;
    }

    //Hashea el password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Crear un token de validación
    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndControlador( $password ) {
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password IncorrectO o tu Cuenta no ha Sido Confirmada';
        } else {
            return true;
        }
    }

}