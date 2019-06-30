<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/myProfile.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>My profile</title>
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
        ?>
        <div class="navbar">
                    <a href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
                    <a href="faq.php"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="lectors.php"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a class="active" href="myProfile.php"><i class="fa fa-fw fa-user"></i> Моят профил</a>
                    <a href="logout.php">Изход</a>  
                      
                   
        </div>
        
        <div class="content">
            <img src="image/myImage.jpg" width="300px" height="300px">
            <div class="info">
                <?php
                foreach ($_SESSION['user'] as $key => $user) {                       
                        echo "<h3>"."<strong>Име и фамилия: </strong>".$user['name']." ".$user['surname']."</h3>";
                        echo "<h3>"."<strong>Email: </strong>".$user['email']."</h3>";
                        echo "<h3>"."<strong>Потребителско име: </strong>".$user['username']."</h3>";
                        if($user['type'] == 0) {
                            $type = "студент";
                        }
                        else {
                            $type = "лектор";
                        }
                        echo "<h3>"."<strong>Тип участие: </strong>".$type."</h3>";
                    }      
                ?>
            </div>
        </div>
    </body>
</html>