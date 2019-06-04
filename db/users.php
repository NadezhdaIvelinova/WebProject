<?php
    class users {
        private $id;
        private $email;
        private $name;
        private $surname;
        private $username;
        private $password;
        public $dbConn;

        function setId($id) { $this->id = $id; }
        function getId() { return $this->id; }
        function setEmail($email) { $this->email = $email; }
        function getEmail() { return $this->email; }
        function setName($name) { $this->name = $name; }
        function getName() { return $this->name; }
        function setSurname($surname) { $this->surname = $surname; }
        function getSurname() { return $this->surname; }
        function setUsername($username) { $this->username = $username; }
        function getUsername() { return $this->username; }
        function setPassword($password) { $this->password = $password; }
        function getPassword() { return $this->password; }

        public function __construct() 
        {
            require_once("DbConnect.php");
            $db = new DbConnect();
            $this->dbConn = $db->connect();
        }

        public function save() {
            $sql = "INSERT INTO `registeredUser`(`id`, `email`, `name`, `surname`, `username`, `password`) VALUES (null,:email,:name,:surname,:username,:password)";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);

            try {
                if($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch(Exception $exception) {
                echo $exception->getMessage();
            }
        }

        //user registered in the system - cannot use the same email, can login
        public function getUserByEmail() {
            $stmt = $this->dbConn->prepare('SELECT * FROM registeredUser WHERE email = :email');
            $stmt->bindParam(':email', $this->email);
            try {
                if($stmt->execute()) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
            return $user;
        }

        public function getUserById() {
            $stmt = $this->dbConn->prepare('SELECT * FROM registeredUser WHERE id = :id');
			$stmt->bindParam(':id', $this->id);
			try {
				if($stmt->execute()) {
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			return $user;
        }

        public function getAllUsers() {
            $stmt = $this->dbConn->prepare("SELECT * FROM registeredUser");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
    }
?>