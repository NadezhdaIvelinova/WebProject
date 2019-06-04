<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/message.css" rel="stylesheet">
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

					//$objChatroom = new chatrooms;
					//$chatrooms   = $objChatroom->getAllChatRooms();

					$objUser = new users;
					$users   = $objUser->getAllUsers();
				?>
        <div class="navbar">
                    <a href="home.html" ><i class="fa fa-fw fa-home"></i> Home</a>
                    <a href="faq.html"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="#lectors"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.html" class="active"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="#myProfile"><i class="fa fa-fw fa-user"></i> Моят профил</a>          
        </div>
                
        <div class="content">
            <div class="sideInfo">
                <div class="userInfo">
                    <img src="image/user.png" width="86px" height="89px">
                    <div class="sessionNames">
                        <strong id="firstName">Nadezhda</strong>
                        <strong id="lastName">Ivanova</strong>
                    </div>

                </div>
                <hr>
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
                        </div>
                </form>
            </div>

        </div>
    </body>
</html>