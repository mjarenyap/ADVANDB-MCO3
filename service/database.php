<?php
    class MySqlDatabase {
        protected static $connection;

        public function connect() {    
            if (!isset(self::$connection)) {
                $path = realpath($_SERVER["DOCUMENT_ROOT"] . '/../config.ini');
                $config = parse_ini_file($path); 
                self::$connection = new mysqli("p:" . $config['host'], $config['user'], $config['password']);
            }

            if (self::$connection === false) {
                return false;
            }

            return self::$connection;
        }

        // public function execute($query, $columns, $values) {
        //     $connection = $this->connect();
        //     $statement = prepare($query);
        //     $result = $statement->execute();

        //     return $result;
        // }

        public function query($query) {
            $connection = $this->connect();
            $result = $connection->query($query);

            return $result;
        }

        public function select($query) {
            $rows = array();
            $result = $this->query($query);
            if ($result === false) {
                return false;
            }
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }

        public function close() {
            mysqli_close($this::$connection);
        }

        public function error() {
            $connection = $this->connect();

            return $connection->error;
        }

        public function quote($value) {
            $connection = $this->connect();

            return "'" . $connection->real_escape_string($value) . "'";
        }
    }
?>