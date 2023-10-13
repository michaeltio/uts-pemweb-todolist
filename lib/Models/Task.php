<?php
    class Task{
        private $host;
        private $user;
        private $pass;
        private $conn;
        public function __construct($host, $user, $pass, $conn) {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->conn = $conn;
    
            $this->connect();
        }
    
        private function connect() {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->conn);
    
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
    
        public function query($sql) {
            $result = $this->conn->query($sql);
    
            if (!$result) {
                die("Query failed: " . $this->conn->error);
            }
    
            return $result;
        }
    
        public function close() {
            $this->conn->close();
        }
    }

?>