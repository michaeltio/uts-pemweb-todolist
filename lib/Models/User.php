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
    
        public function auth($username, $password) {
            $query = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $username, $password);

            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if($user){
                session_start();
                $_SESSION['username'] = $user['username'];
                return true;
            }
            else{
                return false;
            }

        }
        
        public function insertData($username, $password){
            $query = "INSERT INTO users(username, password) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $username, $password);

            $stmt->execute();
          
        }
    
        public function close() {
            $this->conn->close();
         }
    }

?>