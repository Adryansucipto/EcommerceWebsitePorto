<?php
    require('function.php');
    if(isset($_POST['submit'])){
        if(register($_POST) > 0){
            header("Location: login.php");
            exit();
        }
        else{
            header("Location: register.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    
    <h1>Register</h1>

    <div class="container-register">
        <div class="images">
            <img src="./img/login_img1.jpg" alt="login_img">
        </div>
        <div class="register">
            <h1>Register</h1>
            <form action="" method="POST">
                <ul>
                    <li id="label-input">
                        <label for="username">Username</label>
                        <input type="text" name="username" required autocomplete="off" placeholder="Type your username">
                    </li>
                    <li id="label-input">
                        <label for="firstname">FirstName</label>
                        <input type="text" name="firstname" required autocomplete="off" placeholder="Type your first name">
                    </li>
                    <li id="label-input">
                        <label for="lastname">LastName</label>
                        <input type="text" name="lastname" required autocomplete="off" placeholder="Type your last name">
                    </li>
                    <li id="label-input">
                        <label for="email">Email</label>
                        <input type="email" name="email" required autocomplete="off" placeholder="Type your email">
                    </li>
                    <li id="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" required autocomplete="off">
                    </li>
                    <li id="label-input">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" required autocomplete="off"> 
                    </li>
                    <li>
                        <button type="submit" name="submit">Submit</button>
                    </li>
                </ul>
            </form>
            </div>
        </div>
    </div>
</body>
</html>