<?php
    class questions {
        private $id;
        private $name;
        private $category;
        private $answer;
        public $dbConn;
 
        public function getId() { return $this->id; }
        public function setId($id) { $this->id = $id; }
        public function getName() { return $this->name; }
        public function setName($name) { $this->name = $name; }
        public function getCategory() { return $this->category; }
        public function setCategory($category) { $this->category = $category; }
        public function getAnswer() { return $this->answer; } 
        public function setAnswer($answer) { $this->answer = $answer; }

        public function __construct()
        {
            require_once("DbConnect.php");
            $db = new DbConnect();
            $this->dbConn = $db->connect();
        }

        public function save() {
            $sql = "INSERT INTO `questions`(`id`, `category`, `name`, `answer`) VALUES (null, :category, :name , :answer)";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":category", $this->category);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":answer", $this->answer);

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

        public function getAllApplicationQuestions() {
            $stmt = $this->dbConn->prepare("SELECT `name`, `answer` FROM `questions` WHERE category = 'application'");
            $stmt->execute();
            $appQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $appQuestions;
        }

        public function getAllExamQuestions() {
            $stmt = $this->dbConn->prepare("SELECT `name`, `answer` FROM `questions` WHERE category = 'exams'");
            $stmt->execute();
            $examQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $examQuestions;
        }

        public function getAllSchoolarshipQuestions() {
            $stmt = $this->dbConn->prepare("SELECT `name`, `answer` FROM `questions` WHERE category = 'scholarship'");
            $stmt->execute();
            $schoolarshipQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $schoolarshipQuestions;
        }

        
    }
?>