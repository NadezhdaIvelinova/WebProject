<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/signup.css" rel="stylesheet">
        <script src="jquery-3.4.1.js" type="text/javascript"></script>
		<title> Sign up </title>
    </head>
    <body>
        <?php
            // define variables and set to empty values
            $nameErr = $emailErr = $surnameErr = $passwordErr = $passwordRepeatErr = "";
            $name = $email = $surname = $password = $passwordRepeat = "";
            
            if(isset($_POST["signup"])) {
                require("db/users.php");
                $objUser = new users;
                //validate the input
                //validate the email
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
                else {
                    $objUser->setEmail($_POST['email']);
                    $name = test_input($_POST["name"]);
                    //validate the name
                    if(preg_match("/^[\p{Cyrillic}]+$/u", $name)) {
                        $objUser->setName($_POST['name']);
                        $surname = test_input($_POST["surname"]);
                        //validate the surname
                        if(preg_match("/^[\p{Cyrillic}]+$/u", $surname)) {
                            $objUser->setSurname($_POST['surname']);
                            $objUser->setUsername($_POST['username']);

                            //validate the password
                            $password = test_input($_POST["password"]);
                            if(strlen($password) < 10) {
                                $passwordErr = "The password must be at least 10 characters long";
                            } else {
                                //hash the password
                                $hash = password_hash($password, PASSWORD_DEFAULT);
                                $objUser->setPassword($hash);

                                //validate the confirm password field
                                $passwordRepeat = test_input($_POST["passwordRepeat"]);
                                if($password == $passwordRepeat) {
                                    $value = $_POST['type'];
                                    if($value == 'student') {
                                        $objUser->setType(0);
                                    }
                                    else {
                                        $objUser->setType(1);
                                    }
                                    $objUser->setLastLogin(date('Y-m-d h:i:s'));
                                    $userData = $objUser->getUserByEmail();
                                    
                                    if(is_array($userData) && count($userData)>0) {
                                        echo "User already registered in the system";
                                    } else {             
                                        if($objUser->save()) {
                                            echo "User Registred..";
                                            header("location: welcome.html");
                                        } else {
                                            echo "Failed..";
                                        }
                                    }
                                } else {
                                    $passwordRepeatErr = "The two passwords are not the same";
                                }                                
                            } 
                        } else {
                            $surnameErr = "The surname field must contain only cyrilic letters";
                        }   
                    } else {
                        $nameErr = "The name filed must contain only cyrilic letters";
                    }                    
                }                
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

        ?>
        <form id="signupForm" action="" method="post" role="form">
            <div class="container">
                    <h1>Регистрация</h1>
                    <p>Моля попълнете тази форма, за да създадете акаунт.</p>
                    <hr>
                    <label ><b>Email*</b></label>
                    <div class="error"> <?php echo $emailErr;?></div>
                    <input type="text" placeholder="Въведете email" name="email" required>  
                    <label ><b>Име*</b></label>
                    <div class="error"> <?php echo $nameErr;?></div>
                    <input type="text" placeholder="Въведете име" name="name" required>
                    <label><b>Фамилия*</b></label>
                    <div class="error"> <?php echo $surnameErr;?></div>
                    <input type="text" placeholder="Въведете фамилия" name="surname" required>
                    <label ><b>Потребителско име*</b></label>
                    <input type="text" placeholder="Въведете потребителско име" name="username" required>
                    <label ><b>Парола*</b></label>
                    <div class="error"> <?php echo $passwordErr;?></div>
                    <input type="password" placeholder="Въведете парола" name="password" required>
                    <label ><b>Повторете паролата*</b></label>
                    <div class="error"> <?php echo $passwordRepeatErr;?></div>
                    <input type="password" placeholder="Повтори парола" name="passwordRepeat" required>
                    <p>Моля изберете тип участие в системата</p>
                    <input type="radio" name="type" value="student"> Студент
                    <input type="radio" name="type" value="lector"> Преподавател

                    <p>Със създаването на акаунт се съгласявате с нашите <a href="#">Terms & Privacy</a>.</p>
                    <div class="clearfix">
                            <button type="submit" class="signupBtn" name="signup">Регистрация</button>
                        <button type="button" class="cancelBtn"  onclick="resetForm()">Отмяна</button>                       
                    </div>
            </div>            
        </form>
        <script>
            function resetForm() {
                document.getElementById("signupForm").reset();
            }            
        </script>
    </body>
</html>