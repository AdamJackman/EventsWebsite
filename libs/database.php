<?php

require('constants.php');
require('helpers.php');
require('Functions.php');

class Database {

    //Database variables
    private $host   = DB_HOST;
    private $dbname = DB_NAME;
    private $user   = DB_USER;
    private $pass   = DB_PASS;

    //variables to create connection to database
    private $link;
    private $error;

    //holds queries, binds, executions
    private $db;

    public function __construct() {
        try {
            $this->link = new PDO('pgsql:host=' . $this->host . ';' . 'dbname=' . $this->dbname, $this->user, $this->pass);
            /*
            // Create a new connection
            $this->link = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname,
                            $this->user,
                            $this->pass,
                            array(
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_PERSISTENT => false,
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4'
                            )
                        );
                        */
        }
        catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
            die();
        }
    }

    //prepares statement
    public function query($query) {
        $this->db = $this->link->prepare($query);
    }

    //finds type of input and binds values
    public function bind($param, $value, $type = null) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->db->bindValue($param, $value, $type);
    }

    //executes command
    public function execute($data = null) {
        if($data ==  null) {
            $this->db->execute();
        } else if (is_array($data)) {
            $this->db->execute($data);
        } else {
            $this->db->execute(array($data));
        }
    }

    //return all results as an object
    public function fetchAll($params = null) {
        $this->execute($params);
        return $this->db->fetchAll(PDO::FETCH_ASSOC);
    }

    //return one as an object
    public function fetchOne($params = null) {
        $this->execute($params);
        return $this->db->fetch(PDO::FETCH_ASSOC);
    }

    //return number of rows
    public function rowCount() {
        return $this->db->rowCount();
    }

    //return last inputed row
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

}


?>