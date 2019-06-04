<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <script src="jquery-3.4.1.js" type="text/javascript"></script>
        <title> Write Message </title>
    </head>
    <body>
        <div class="row">
            <div clss="col1">
                <?php
                    session_start();
                    require("db/users.php");
                    $objUser = new users;
                    $users = $objUser->getAllUsers();
                    
                ?>
                <table class="table">
                    <thead>
                        <tr>

                            <td>
                                <?php
                                    foreach ($_SESSION['user'] as $key => $user) {
										$userId = $key;
										echo '<input type="hidden" name="userId" id="userId" value="'.$key.'">';
										echo "<div>".$user['name']."</div>";
										echo "<div>".$user['email']."</div>";
									}
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Users</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                //create login status
                                 foreach($users as $key => $user) {
                                    echo "<tr><td>" .$user['name']."</td></tr>";
                                    
                                }
                            ?>
                    </tbody>
                </table>
            </div>
            <div clss="col2">
                <div id="messages">
                    <table id="chats">
                        <thead>
                            <tr>
                                <th><strong>Chat Room</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr><td><div>From</div></td></tr>
                                <tr><td>Message</td><td halign="right" valign="top">Message time</td></tr>

                        </tbody>
                    </table>
                </div>
                <form method="post" action="">
                    <div>
                        <textarea id="msg" name="msg" placeholder="Enter Message"></textarea>
                    </div>
                    <div>
                        <input type="button" value="Send" id="send" name="send">

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