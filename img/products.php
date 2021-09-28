<?php
    session_start();
    require('function.php');

    if(!isset($_SESSION['userid'])){
        $userid = -1;
    }
    else{
        $userid = $_SESSION['userid'];
    }
    //id tiap user untuk diakses
    if(isset($_POST['login'])){
        header("Location: login.php");
        exit();
    }
    $hottestProduct = query("SELECT *FROM products where id between 1 and 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/index.css">
    <script src="./js/home.js" async></script>
    <script src="./js/slide.js" async></script>
    <title>Home</title>
</head>
<body>
    <div class="container">
        <nav>
            <!-- nav1 -->
    
            <div class="nav1">

                <ul id="nav_1">
                    <img src="./img/logoEcommerce.png" alt="logo">
                </ul>
                <ul id="nav_2">
                    <form action=""> 
                    <input type="text" id="keyword" name="searchbar" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </ul>
                <ul id="nav_3">
                    <li><a href="checkout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    <li><a href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a></a></li>
                </ul>
                <ul id="nav_4">
                    <li class='active'>
                        <?php 
                            if(isset($_SESSION["username"])){ 
                                auth();
                                echo '<a href="logout.php" id="logoutbtn">Logout</a></li>';
                            }
                            elseif(!isset($_SESSION["username"])){
                                echo '<a href="login.php" id="loginbtn" >Login</a></li>';
                            }
                        ?>
                    </li>
                </ul>

            </div>

            <!-- nav2 -->
            <div class="nav2">
                 <ul>
                    <li><a href="">Home</a></li>
                    <li class="sub-menu-parent" tab-index="0">
                        <a href="#">Products</a>
                        <ul class="sub-menu">
                            <li><a href="#">Iphone</a></li>
                            <li><a href="#">Samsung</a></li>
                            <li><a href="#">Xiaomi</a></li>
                        </ul>
                    </li>
                    <li><a href="">About Us</a></li>
                </ul>
            </div>

            <div class="topnav">
                <a href="#home" class="active">ECommerceStore</a>
                    <div id="myLinks">
                        <form action="" method="POST"> 
                            <input type="text" id="keyword" name="searchbar" placeholder="Search.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                            <a href="#news"><i class="fa fa-fw fa-home"></i>Home</a>
                            <a href="#contact"><i class="fa fa-cart-plus" aria-hidden="true"></i>Products</a>
                            <a href="#about"><i class="fa fa-users" aria-hidden="true"></i>About Us</a>
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>Check Out</a>
                            <a href=""><i class="fa fa-heart" aria-hidden="true"></i>Wish List</a>

                            <li class='active' style="list-style-type: none;">
                            <?php 
                                if(isset($_SESSION["username"])){ 
                                    auth();
                                    echo '<a href="logout.php" id="logoutbtn"><i class="fa fa-fw fa-times"></i> Logout</a></li>';
                                }
                                elseif(!isset($_SESSION["username"])){
                                    echo '<a href="login.php" id="loginbtn" ><i class="fa fa-fw fa-user"></i> Login</a></li>';
                                }
                            ?>
                            </li>

                    </div>
                    <!-- icon toggle -->
                <a href="#" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
                    <!-- icon toggle -->
            </div>

        </nav>

    
      </div>


</body>
</html>