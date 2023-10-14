<?php
    namespace Models;
    class Task{
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

        public function getData($username){
            $query = "SELECT * FROM tasks WHERE username = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display data, for example, print it
                    echo "Title {$row['title']}";
                }
            } else {
                echo "No results found.";
            }


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
    
        public function close() {
            $this->conn->close();
        }
    }

?>