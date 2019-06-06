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
                foreach ($_SESSION['user'] as $key => $user) {    
                    $userId = $key;
                    $name = $user['name'];
                    $surname = $user['surname'];
                }   
        ?>
        <div class="navbar">
                    <a href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
                    <a class="active" href="faq.php"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="#lectors"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="#myProfile"><i class="fa fa-fw fa-user"></i> Моят профил</a>
                    <p class="user"><?php echo $name; ?></p>
                    <p class="user"><?php echo $surname; ?></p>       
                   
        </div>
        <div class="content">
            <h3>Въпроси свързани с кандидатстване</h3>
            <hr>
            <div class="questions" id="quest1">
                <h3 class="headerQuestions">Какви са условията за кандидатстване?</h3>
            </div>
        </div>
    </body>
</html>