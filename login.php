<?php
    session_start();
    require('function.php');
    
    if(isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        //ambil username berdasarkan id
        $result = mysqli_query($connect,"SELECT username FROM users WHERE id = '$id' ");
        $row = mysqli_fetch_assoc($result);
        if($key == hash('sha256',$row['username']) ){
            $_SESSION['username'] = true;

        }
    }

    if(isset($_SESSION["username"])) {//cek jika session tidak memiliki isi
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container-login">
        <div class="images">
            <img src="./img/login_img1.jpg" alt="login_img">
        </div>
        <div class="login">
            <h1>Login</h1>
            <form action="" method="POST">
                <ul>
                    <li id="label-input">
                        <label for="username">Username</label>
                        <input type="text" name="username" required autocomplete="off" placeholder="Type your username">
                    </li>
                    <li id="label-input">
                        <label for="password">Password</label>
                        <input type="password" name="password" required autocomplete="off" placeholder="Type your password">
                    </li>
                    <li id="label">
                        <label for="rememberme">Remember me</label>
                        <input type="checkbox" name="rememberme">
                    </li>
                    <li>
                        <button type="submit" name="login">Login</button>
                    </li>
                </ul>
            </form>
            <a href="register.php">Sign in?</a>
            <br>
            <p id="desc">If you don't have account, you should register first</p>
            <div id="error"></div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['login'])){
        if(login($_POST) == 1){
        $_SESSION['username'] = true;
        $userid = searchID($_POST);
        $_SESSION['userid'] = $userid['id'];
        //cek remember me
        if(isset($_POST['remember'])){
            //buat cookie
            $id = searchID($_POST);
            setcookie('id',$id,time()+31536000);
            setcookie('key',hash('sha256',$_POST['username']) , time()+31536000);
        }

        header("Location: index.php");
        exit();

        }
        else{
            echo "
                <script>
                let error = document.getElementById('error');
                displayError('username/password salah');
                setTimeout('hideError()',3000);
            
                function displayError(msg){
                error.style.visibility = 'visible';
                error.innerHTML = msg;
                }
            
                function hideError(){
                error.style.visibility = 'hidden';
                }
                
                </script>
                ";
        }
    }
?>