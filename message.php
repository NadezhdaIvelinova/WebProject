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
            require("db/chatrooms.php");

            $objChatroom = new chatrooms;
            $chatrooms   = $objChatroom->getAllChatRooms();

            $objUser = new users;
            $users   = $objUser->getAllUsers();
            $lectors = $objUser->getLectors();
            $students = $objUser->getStudents();
        ?>
        <div class="navbar">
                    <a href="home.php" ><i class="fa fa-fw fa-home"></i> Home</a>
                    <a href="faq.php"><i class="fa fa-fw fa-question"></i> Често задавани въпроси</a>
                    <a href="lectors.php"><i class="fa fa-fw fa-graduation-cap"></i> Лектори</a>
                    <a href="message.php" class="active"><i class="fa fa-fw fa-envelope"></i> Напиши съобщение</a>
                    <a href="myProfile.php"><i class="fa fa-fw fa-user"></i> Моят профил</a>
                    <input type="button" id="logout" name="logout" value="Изход">     
                 
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
                    <?php
                        $heading = "Лектори";
                        if($user['type'] != 0) {
                            $heading = "Студенти";
                        }
                        echo "<h2>".$heading."</h2>";
                    ?>
                    <table>
                        <?php
                             if($user['type'] == 0) {
                                foreach ($lectors as $key => $user) {                                   
                                    if(!isset($_SESSION['user'][$user['id']])) {   
                                            
                                                echo "<tr><td>".$user['name']."</td>";
                                                echo "<td>".$user['lastLogin']."</td></tr>";
                                                                                                                                                            
                                       }
                                      
                                   }
                             } else {
                                foreach ($students as $key => $user) {                                   
                                    if(!isset($_SESSION['user'][$user['id']])) {   
                                            
                                                echo "<tr><td>".$user['name']."</td>";
                                                echo "<td>".$user['lastLogin']."</td></tr>";
                                                                                                                                                            
                                       }
                                      
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
					      <th colspan="4" scope="col"><strong>Съобщения</strong></th>
					    </tr>
                    </thead>
                    <tbody>
                        <?php
                           foreach ($chatrooms as $key => $chatroom) {

                            if($userId == $chatroom['userId']) {
                                $from = "Me";
                            } else {
                                $from = $chatroom['name'];
                            }
                            echo '<tr><td valign="top"><div><strong>'.$from.'</strong></div><div>'.$chatroom['msg'].'</div><td align="right" valign="top">'.date("d/m/Y h:i:s A", strtotime($chatroom['created_on'])).'</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <form method="post" action="">
                        <div >
                            <textarea  id="msg" name="msg" placeholder="Въведи съобщение"></textarea>
                        </div>
                        <div>
                            <input type="button" value="Изпрати" id="send" name="send">                            
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
                var data = JSON.parse(e.data);
                var row = '<tr><td valign="top"><div><strong>' + data.from +'</strong></div><div>'+data.msg+'</div><td align="right" valign="top">'+data.dt+'</td></tr>';
		        $('#chats > tbody').prepend(row);
            };

            conn.onclose = function(e) {
                console.log("Connection closed");
            };

            $("#send").click(function() {
                var userId = $('#userId').val();
                var msg = $("#msg").val();
                var data = {
                    userId: userId, 
                    msg: msg
                };
                conn.send(JSON.stringify(data));
                $("#msg").val(""); //clear message when send it
            });

            $("#logout").click(function(){
                $.ajax({
                    url:"action.php",
                    method:"post",
                    data: "userId="+userId+"&action=leave"
                }).done(function(result){
                    conn.close();
                    console.log(result);
                });
                
            })
        })
    </script>
</html>