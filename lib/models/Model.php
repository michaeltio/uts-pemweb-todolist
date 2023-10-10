<?php
class Model{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;


    //untuk konek ke database waktu model baru dibuat
    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    
        $this->connect(); 
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    //untuk panggil select
    public function executeSelectQuery($sql) {
        $result = $this->conn->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function executeNonQuery($sql) {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function close() {
        $this->conn->close();
    }
}