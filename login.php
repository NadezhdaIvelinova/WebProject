<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/login.css" rel="stylesheet">
        <script src="jquery-3.4.1.js" type="text/javascript"></script>
		<title> Log in </title>
    </head>
    <body>
        <?php
            if(isset($_POST['login'])) {
				session_start();
				require("db/users.php");
				$objUser = new users;
				$objUser->setEmail($_POST['email']);
				$objUser->setPassword($_POST['password']);
                 $objUser->setLastLogin(date('Y-m-d h:i:s'));
			 	$userData = $objUser->getUserByEmail();
			 	if(is_array($userData) && count($userData)>0) {
			 		$objUser->setId($userData['id']);
			 		if($objUser->updateLoginStatus()) {
			 			echo "User login..";
			 			$_SESSION['user'][$userData['id']] = $userData;
			 			header("location: message.php");
			 		} else {
			 			echo "Failed to login.";
			 		}
			 	} else {
				 	echo "Invalid information.";
				 }
            }
            
            
        ?>
        <form id="loginForm"action="" role="form" method="post">
            <div class="container">
                    <h1>Вход</h1>
                    
                    <hr>
                   
                    <label ><b>Email</b></label>
                    <input type="text" placeholder="Въведете потребителско име" name="email" required>
                    <label for="password"><b>Парола</b></label>
                    <input type="password" placeholder="Въведете парола" name="password" required>

                    <div class="clearfix">
                            <button type="submit" class="signupBtn" name="login">Вход</button>
                        <button type="button" class="cancelBtn" onclick="resetForm()">Отмяна</button>                       
                    </div>
            </div>            
        </form>
        <script>
            function resetForm() {
                document.getElementById("loginForm").reset();
            }            
        </script>
    </body>
</html>