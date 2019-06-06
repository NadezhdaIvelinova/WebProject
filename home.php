<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/home.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Home</title>
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
                    <a href="home.php" class="active"><i class="fa fa-fw fa-home"></i> Home</a>
                    <a href="faq.php"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="#lectors"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="#myProfile"><i class="fa fa-fw fa-user"></i> Моят профил</a>
                    <p class="user"><?php echo $name; ?></p>
                    <p class="user"><?php echo $surname; ?></p>                 
                          
        </div>
        <div id="header">
                <img src="image/background.png" width="530px" height="250px">
                <div id="headingText">
                    <h1>Добре дошли в HelpDesk</h1>
                    <h2>Система в помощ на студенти от СУ "Св. Климент Охридски"</h2>
                </div>
        </div>            
        <div class="content">
            <div class="text">
                <h3 id="headerForInfo">Често задавани въпроси</h3>
                <p id="info">Тук може да намерите често задавани въпроси от всякакво ествество - свързани с това как се кандидатства за конкретна специалност, как се влиза в общежитие, какви са изискванията за стипендия и други подобни.</p>
            </div>
            <div class="buttons">
                    <div id="faq">
                            <input type="image" src="image/faq.png" onclick="changeTextToFAQ()"/>
                            <h2 class="descriptions">Често задавани въпроси</h2>
                        </div>
                        <div id="lectors">
                                <input type="image" src="image/lectors.png" onclick="changeTextToLectors()"/>
                                <h2 class="descriptions">Нашите лектори</h2>
                        </div>
                        <div id="write">
                                <input type="image" src="image/write.png" onclick="changeTextToMessage()"/>
                                <h2 class="descriptions">Среща с лектор</h2>
                        </div>
            </div>
           
            
        </div>
               
    </body>
    <script>
        function changeTextToFAQ() {
            document.getElementById("headerForInfo").innerHTML = "Често задавани въпроси"
            document.getElementById("info").innerHTML = "Тук може да намерите често задавани въпроси от всякакво ествество - свързани с това как се кандидатства за конкретна специалност, как се влиза в общежитие, какви са изискванията за стипендия и други подобни."
        }
        function changeTextToLectors() {
            document.getElementById("headerForInfo").innerHTML = "Информация за нашите лектори"
            document.getElementById("info").innerHTML = "Чрез HelpDesk може да намерите информация за лекторите в Софийски университет за това как се казват, какво преподават и какво е приемното им време. На лектори, които са регистрирани в системата може директно да се напише писмо със заяка за среща."
        }
        function changeTextToMessage() {
            document.getElementById("headerForInfo").innerHTML = "Среща с лектор"
            document.getElementById("info").innerHTML = "Чрез HelpDesk може да се уговори среща с лектор, който е регистриран в системата. Може директно да напишете съобщение до лектор, за да се разберете за среща в удобно за него време. Това се съгласува с неговото приемно време или когато лектора пожелае."
        }
    </script>
</html>