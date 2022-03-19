<?php


class DB
{
    public $conn = null;
    protected $username = "root";
    protected $password = "";
    protected $database = "php_exel";
    protected $localhost = "localhost";

    function __construct(){
        $this->conn = new mysqli($this->localhost,$this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            echo $this->conn->connect_error;
        }
    }
    function getData($query){
        $result = $this->conn->query("select * from users");
        if ($result){
            return $result;
        }
        else{
            echo $this->conn->error;die();
        }
    }
}