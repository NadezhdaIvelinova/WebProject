<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
		<link href="css/signup.css" rel="stylesheet">
		<title> Sign up </title>
    </head>
    <body>
        <?php
            if(isset($_POST['submit'])) {
                session_start();
                require("db/users.php");
                $objUser = new users;
                $objUser->setEmail($_POST['email']);
                $objUser->setName($_POST['name']);
                $objUser->setSurname($_POST['surname']);
                $objUser->setUsername($_POST['username']);
                $objUser->setPassword($_POST['password']);
                $userData = $objUser->getUserByEmail();

                if(is_array($userData) && count($userData)>0) {
                    echo "User already register in the system";
                    
                }
                else {
                    if($objUser->save()) {
                        $lastId = $objUser->getId();
                        $objUser->setId($lastId);
                       $_SESSION['user'][$lastId] = [ 
                           'id' => $objUser->getId(),                           
                           'email'=> $objUser->getEmail(), 
                           'name' => $objUser->getName(), 
                           'surname'=>$objUser->getSurname(), 
                           'username'=> $objUser->getUsername(), 
                           'password'=> $objUser->getPassword()
                       ];
                        echo "User Registered";
                        header("location: write.php");
                    } else {
                        echo "Failed";
                    }
                }
            }
        ?>
        <form id="signupForm" method="POST" role="form" action="">
            <div class="container">
                    <h1>Регистрация</h1>
                    <p>Моля попълнете тази форма, за да създадете акаунт.</p>
                    <hr>
                    <label ><b>Email*</b></label>
                    <input type="text" placeholder="Въведете email" name="email" required>
                    <label ><b>Име*</b></label>
                    <input type="text" placeholder="Въведете име" name="name" required>
                    <label><b>Фамилия*</b></label>
                    <input type="text" placeholder="Въведете фамилия" name="surname" required>
                    <label ><b>Потребителско име*</b></label>
                    <input type="text" placeholder="Въведете потребителско име" name="username" required>
                    <label ><b>Парола*</b></label>
                    <input type="password" placeholder="Въведете парола" name="password" required>
                    <label ><b>Повторете паролата*</b></label>
                    <input type="password" placeholder="Повтори парола" name="passwordRepeat" required>
                    <p>Моля изберете тип участие в системата</p>
                    <input type="radio" name="type" value="student"> Студент
                    <input type="radio" name="type" value="lector"> Преподавател

                    <p>Със създаването на акаунт се съгласявате с нашите <a href="#">Terms & Privacy</a>.</p>
                    <div class="clearfix">
                            <button name="submit" type="submit" class="signupBtn">Регистрация</button>
                        <button type="button" class="cancelBtn"  onclick="resetForm()">Отмяна</button>                       
                    </div>
            </div>            
        </form>
        
       
    </body>
    <script>
            function resetForm() {
                document.getElementById("signupForm").reset();
            }            
        </script>
</html>