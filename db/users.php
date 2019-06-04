<?php
    class users {
        private $id;
        private $email;
        private $name;
        private $surname;
        private $username;
        private $password;
        private $type;
        private $lastLogin;
        public $dbConn;

        public function setId($id) { $this->id = $id;}        
        public function getId() { return $this->id;}
        public function getEmail() { return $this->email;}
        public function setEmail($email) { $this->email = $email;}
        public function getName() { return $this->name;}
        public function setName($name) { $this->name = $name;}
        public function getSurname() { return $this->surname;}
        public function setSurname($surname) { $this->surname = $surname;}
        public function getUsername() { return $this->username;}
        public function setUsername($username) { $this->username = $username;}
        public function getPassword() { return $this->password;}
        public function setPassword($password) { $this->password = $password;}
        public function getType() { return $this->type;}
        public function setType($type) { $this->type = $type;}
        public function getLastLogin() { return $this->lastLogin;}
        public function setLastLogin($lastLogin) { $this->lastLogin = $lastLogin;}

        public function __construct()
        {
            require_once("DbConnect.php");
            $db = new DbConnect();
            $this->dbConn = $db->connect();
        }

        public function save() {
            $sql = "INSERT INTO `users`(`id`, `email`, `name`, `surname`, `username`, `password`, `type`, `lastLogin`) VALUES (null, :email, :name, :surname, :username, :password, :type, :lastLogin)";
            $stmt = $this->dbConn->prepare($sql);			
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":lastLogin", $this->lastLogin);
            
            try {
				if($stmt->execute()) {
					return true;
				} else {
					return false;
				}
			} catch (Exception $exception) {
                echo $exception->getMessage();
			}
        }

        public function getUserByEmail () {
            $stmt = $this->dbConn->prepare('SELECT * FROM users WHERE email = :email');
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
    }
?>