<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link href="css/addQuestion.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Add Question</title>
    </head>
    <body>  
         <?php
            session_start();
            if(!isset($_SESSION['user'])) {
                header("location: index.html");
            }
            if(isset($_POST["add"])) {
                require("db/questions.php");
                $objQuestion = new questions;
                $objQuestion->setCategory($_POST["category"]);
                $objQuestion->setName($_POST["name"]);
                $objQuestion->setAnswer($_POST["answer"]);
                if($objQuestion->save()) {
                    echo "Question added";    
                }
                else {
                    echo "Failed..";
                }
            }
        ?>     
       
        <form id="signupForm" action="" method="post" role="form">
            <div class="container">
                    <h1>Добавяне на въпрос</h1>
                    <p>Моля, добавете въпрос като попълните категория, заглавие и отговор</p>
                    <hr>
                    <label ><b>Категория</b></label>
                    <select name="category">
                        <option value="application">Кандидатстване</option>
                        <option value="exams">Изпити</option>
                        <option value="scholarship">Стипендии</option>
                    </select>
                                       
                    <label ><b>Име на въпроса</b></label>                   
                    <input type="text" placeholder="Въведете име на въпроса" name="name" required>

                    <label><b>Отговор на въпроса</b></label>    
                    <textarea name="answer" rows="10" placeholder="Въведете отговор на въпроса" required></textarea>                    
                    <div class="clearfix">
                        <button type="submit" class="signupBtn" name="add">Добавяне</button>
                        <button type="button" class="cancelBtn"  onclick="resetForm()">Отмяна</button> 
                        <a id="logout" name="logout" href="logout.php">Изход                   
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