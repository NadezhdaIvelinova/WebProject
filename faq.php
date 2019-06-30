<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/faq.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Frequently Asked Questions</title>
    </head>
    <body>
        <?php
                session_start();
                if(!isset($_SESSION['user'])) {
                    header("location: index.html");
                }
                foreach ($_SESSION['user'] as $key => $user) {    
                    $userId = $key;
                    $name = $user['name'];
                    $surname = $user['surname'];
                }  

                require("db/questions.php");
                $objQuestion = new questions;
                $appQuestions = $objQuestion->getAllApplicationQuestions();
                $examQuestions = $objQuestion->getAllExamQuestions();
                $schoolarshipQuestions = $objQuestion->getAllSchoolarshipQuestions();
        ?>
        <div class="navbar">
                    <a href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
                    <a class="active" href="faq.php"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="lectors.php"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="myProfile.php"><i class="fa fa-fw fa-user"></i> Моят профил</a>
                    <a href="logout.php">Изход</a>  
                      
                   
        </div>
        
        <div class="content">
        <p class="user"><?php echo $name; echo " "; echo $surname;?></p>
            <h3>Кандидатстване</h3>
            <div class="application">
                <?php
                    foreach($appQuestions as $appQuestion) {
                        echo "<span>".$appQuestion['name']."</span>";
                        echo "<br>";
                        echo "<p>".$appQuestion['answer']."</p>";                      
                    }
                ?>
            </div>
            <hr>
            <h3>Изпити</h3>
            <div class="exam">
                <?php
                    foreach($examQuestions as $examQuestion) {
                        echo "<span>".$examQuestion['name']."</span>";
                        echo "<br>";
                        echo "<p>".$examQuestion['answer']."</p>";                      
                    }
                ?>
            </div>
            <hr>
            <h3>Стипендии</h3>
            <div class="schoolarship">
                <?php
                    foreach($schoolarshipQuestions as $schoolarshipQuestion) {
                        echo "<span>".$schoolarshipQuestion['name']."</span>";
                        echo "<br>";
                        echo "<p>".$schoolarshipQuestion['answer']."</p>";                      
                    }
                ?>
            </div>
            <hr>
        </div>
    </body>
</html>