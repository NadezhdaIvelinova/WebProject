<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/message.css" rel="stylesheet">
        <script src="jquery-3.4.1.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Write message</title>
    </head>
    <body>
        <?php
            session_start();
            if(!isset($_SESSION['user'])) {
                header("location: index.html");
            }
            require("db/users.php");
            //require("db/chatrooms.php");

           // $objChatroom = new chatrooms;
            //$chatrooms   = $objChatroom->getAllChatRooms();

            $objUser = new users;
            $users   = $objUser->getAllUsers();
        ?>
        <div class="navbar">
                    <a href="home.php" ><i class="fa fa-fw fa-home"></i> Home</a>
                    <a href="faq.php"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="#lectors"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php" class="active"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="#myProfile"><i class="fa fa-fw fa-user"></i> Моят профил</a>     
                 
        </div>
       
        <div class="content">
            <div class="sideInfo">
                <div class="userInfo">
                    <img src="image/user.png" width="86px" height="89px">
                    <div class="sessionNames">
                        <?php
                            
                           foreach ($_SESSION['user'] as $key => $user) {    
                            $userId = $key;
                                echo '<input type="hidden" name="userId" id="userId" value="'.$key.'">';
                                echo "<h3>".$user['name']."</h3>";
                                echo "<h3>".$user['surname']."</h3";
                            }                        
                        ?>                       
                    </div>

                </div>
                <div class="users">
                    <h2 id="users">Потребители</h2>
                    <table>
                        <?php
                                //make that ony for lectors   
                              foreach ($users as $key => $user) {                                   
                                if(!isset($_SESSION['user'][$user['id']])) {   
                                        
                                            echo "<tr><td>".$user['name']."</td>";
                                            echo "<td>".$user['lastLogin']."</td></tr>";
                                                                                                                                                        
                                   }
                               }
                        ?>
                    </table>
                </div>
            </div>
            <div class="messages">
                <table id="chats" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Chat Room</th>
                        </tr>
                    </thead>
                    <tbody>
                                
                    </tbody>
                </table>
                <form method="post" action="">
                        <div >
                            <textarea  id="msg" name="msg" placeholder="Enter Message"></textarea>
                        </div>
                        <div>
                            <input type="button" value="Изпрати" id="send" name="send">
                            <input type="button" value="Изход" id="logout" name="logout">
                        </div>
                </form>
            </div>
        
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            var conn = new WebSocket('ws://localhost:8080');
            conn.onopen = function(e) {
                console.log("Connection established!");
            };
            conn.onmessage = function(e) {
                console.log(e.data);
            };

            $("#send").click(function() {
                var userId = $('#userId').val();
                var msg = $("#msg").val();
                var data = {
                    userId: userId, 
                    msg: msg
                };
                conn.send(JSON.stringify(data));
            })
        })
    </script>
</html>