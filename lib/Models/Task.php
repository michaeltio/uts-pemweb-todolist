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
            return $result;          
        }

        public function insertNewTask($username, $taskTitle, $taskDescription){
            $query = "INSERT INTO tasks(username, title, task_desc, created, isComplete, progress) VALUES (?, ?, ?, NOW(), 0, 'Not Started')";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $username, $taskTitle, $taskDescription);
            $stmt->execute();
        }

        public function updateCheckBox($taskId, $isComplete){
            $query = "UPDATE tasks SET isComplete = ? WHERE id_task = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $isComplete, $taskId);
            $stmt->execute();
        }

        public function deleteList($taskId){
            $query = "DELETE FROM tasks WHERE id_task = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $taskId);
            $stmt->execute();
        }

        public function updateDropDown($selectedValue, $taskId){
            $query = "UPDATE tasks SET progress = ? WHERE id_task = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $selectedValue, $taskId);
            $stmt->execute();
        }

        public function updateList($taskId, $newTitle, $newDescription){
            $query = "UPDATE tasks SET title = ?, task_desc = ? WHERE id_task = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssi", $newTitle, $newDescription, $taskId);
            $stmt->execute();
        }
    
        private function connect() {
            $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->conn);
    
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
        

    
        public function close() {
            $this->conn->close();
        }
    }

?>