<?php
    class User extends Model {
        public function __construct($host, $dbname, $username, $password) {
            parent::__construct($host, $dbname, $username, $password);
        }
    }
?>