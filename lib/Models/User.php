<?php    
    namespace Models;

    class User{
        private $host;
        private $user;
        private $pass;
        private $conn;
        private static $instance;

        public function __construct($host, $user, $pass, $conn) {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->conn = $conn;
    
            $this->connect();
        }

        public static function getInstance($host, $user, $pass, $conn)
        {
            if (null === self::$instance) {
                self::$instance = new self($host, $user, $pass, $conn);
            }
    
            return self::$instance;
        }
    
        private function connect() {
            $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->conn);
    
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
        
        public function insertData($username, $password){
            $this->conn->query("INSERT INTO users(username,password) VALUES ('$username', '$password')");

        }
    
        public function close() {
            $this->conn->close();
         }
    }

?>