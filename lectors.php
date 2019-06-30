<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/lectors.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Lectors</title>
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
                    <a class="active"  href="lectors.php"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="myProfile.php"><i class="fa fa-fw fa-user"></i> Моят профил</a>
                    <a href="logout.php">Изход</a>  
                      
                   
        </div>
        
        <div class="content">
        <p class="user"><?php echo $name; echo " "; echo $surname;?></p>
            <div class="lectors">
            
            <div class="lector">
                <div class="imgAndBtn">
                    <img src="image/lector.png" width="100px" height="104px">
                    <button id="write">Съобщение</button>
                </div>
                <div class="text">
                    <h2>доц, д-р Милен Петров</h2>
                    <h3><strong>катедра:</strong> Софтуерни технологии</h3>
                    <h3><strong>кабинет:</strong> ФМИ-402</h3>
                    <h3><strong>приемно време:</strong> сряда от 13:30 до 14:15 след уговорка по имейл</h3>
                </div>
                <div class="imgAndBtn">
                    <img src="image/lector.png" width="100px" height="104px">
                    <button id="write">Съобщение</button>
                </div>
                
                <div class="text">
                    <h2>доц, д-р Преслава Иванова</h2>
                    <h3><strong>катедра:</strong> Математически анализ</h3>
                    <h3><strong>кабинет:</strong> ФМИ-533</h3>
                    <h3><strong>приемно време:</strong> сряда от 09:00 до 10:00</h3>
                </div>
                
            </div>
           
            </div>      
        </div>
    </body>
</html>