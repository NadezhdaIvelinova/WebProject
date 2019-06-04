<?php
    class DbConnect {

        public function connect() {
            try {
                $conn = new PDO('mysql:host=localhost;dbname=db_helpDeskUsers;charset=utf8', 'root', '');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch(PDOException $exception) {
                echo 'Database Error:' . $exception->getMessage();
            }
        }
    }
?>