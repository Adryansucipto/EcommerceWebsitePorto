<?php
    session_start();
    require('function.php');

    if(!isset($_SESSION['userid'])){
        $userid = -1;
    }
    else{
        $userid = $_SESSION['userid'];
        $username = searchNameUser($userid);
    }
    //id tiap user untuk diakses
    if(isset($_POST['login'])){
        header("Location: login.php");
        exit();
    }
    $countCart = countData("checkout",$userid);
    $countWish = countData("wishlist",$userid);
    $hottestProduct = query("SELECT *FROM products where id between 1 and 3");
    $latestProduct = query("SELECT *FROM products where id between 1 and 5");
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
    <link rel="stylesheet" href="./css/navfooters.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/aboutuss.css">

    <script src="./js/slide.js" async></script>
    <title>About Us | ECommerceStore</title>
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
                        <h1>BEST ECOMMERCE STORE</h1>
                    </ul>
                    <ul id="nav_3">
        
                        <li class='active' style="display: flex; flex-direction: row;">
                            <?php 
                                if(isset($_SESSION["username"])){ 
                                    auth();
                                    echo '<a href="checkout.php" id="countedItems"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>';
                                    if($countCart['count']>0){
                                        echo '<span id="qty1">';
                                        echo $countCart['count'];
                                        echo '</span>';
                                    }
                                    echo '</li>';
                                }
                                elseif(!isset($_SESSION["username"])){
                                    echo '<a href="checkout.php" id="countedItems"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>';
                                    echo '</li>';
                                }
                            ?>
                        </li>
                    
                        <li class='active' style="display: flex; flex-direction: row;">
                            <?php 
                                if(isset($_SESSION["username"])){ 
                                    auth();
                                    echo '<a href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a></a>';
                         
                                    if($countWish['count']>0){
                                        echo '<span id="qty">';
                                        echo $countWish['count'];
                                        echo '</span>';
                                    }
                                  
                                    echo '</li>';
                                }
                                elseif(!isset($_SESSION["username"])){
                                    echo '<a href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a></a>';
                                    echo '</li>';
                                }
                            ?>
                        </li>

                        <li class='active'>
                            <?php 
                                if(isset($_SESSION["username"])){ 
                                    auth();
                                    echo '<a href="profile.php" id="profilebtn"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
                                    echo 'Hello, '.$username['firstname'];
                                }
                                elseif(!isset($_SESSION["username"])){
                                    echo '</li>';
                                }
                            ?>
                        </li>
                    </ul>
                    <ul id="nav_4">
                    <li class='active'>
                                    <?php 
                                        if(isset($_SESSION["username"])){ 
                                            auth();
                                            echo '<a href="logout.php" id="logoutbtn">Logout<img src="./img/logout.png" alt="icon" style="width: 20px;"></a></li>';
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
                        <li><a href="index.php">Home</a></li>
                        <li class="sub-menu-parent" tab-index="0">
                            <a href="product.php">Products</a>
                            <ul class="sub-menu">
                                <li><a href="productperbrand.php?idbrand=Apple">Apple</a></li>
                                <li><a href="productperbrand.php?idbrand=Samsung">Samsung</a></li>
                                <li><a href="productperbrand.php?idbrand=Xiaomi">Xiaomi</a></li>
                            </ul>
                        </li>
                        <li><a href="aboutus.php">About Us</a></li>
                    </ul>
                </div>

                <div class="topnav">
                    <a href="#home" class="active">ECommerceStore</a>
                        <div id="myLinks">
                                <a href="wishlist.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                                <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
                                <a href="product.php"><i class="fa fa-cart-plus" aria-hidden="true"></i> Products</a>
                                <a href="aboutus.php"><i class="fa fa-users" aria-hidden="true"></i> About Us</a>
                                
                                <li class='active' style="list-style-type: none;">
                                    <?php 
                                       if(isset($_SESSION["username"])){ 
                                        auth();
                                        echo '<a href="checkout.php" id="countedItems"><i class="fa fa-shopping-cart" aria-hidden="true"></i> CheckOut</a>';
         
                                            if($countCart['count']>0){
                                                echo '<span id="qty1">';
                                                echo $countCart['count'];
                                                echo '</span>';
                                            }
                                       
                                        }
                                        elseif(!isset($_SESSION["username"])){
                                            echo '<a href="checkout.php" id="countedItems"><i class="fa fa-shopping-cart" aria-hidden="true"></i> CheckOut</a>';
                                
                                        }
                                    ?>
                                </li>
                    
                                <li class='active' style=" list-style-type: none;">
                                    <?php 
                                        if(isset($_SESSION["username"])){ 
                                            auth();
                                            echo '<a href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i> Wishlist</a>';
                                            if($countWish['count']>0){
                                                echo '<span id="qty">';
                                                echo $countWish['count'];
                                                echo '</span>';
                                            }
                                        }
                                        elseif(!isset($_SESSION["username"])){
                                            echo '<a href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i> Wishlist</a>';
                                       
                                        }
                                    ?>
                                </li>

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

        <div class="aboutusPage">
            <h3 id="title">About Us</h3>
            <div class="aboutusdesc">
                <img src="./img/logoEcommerce.png" alt="" id="logoAboutus">
                <h1 id="textstyle">ECommerceStore is an ecommerce store which <span class='special-word'>sell phones from best brand</span></h1>
                <p id="paragraph"><span class='special-word'>ECommerceStore</span> sells phone from Apple, Samsung, and Xiaomi</p>
                
                <div class="history">
                    <img src="./img/history.png" alt="" id="imghistory">
                    <div class="historydetail">
                        <h1 id="style">History About ECommerceStore</h1>
                        <p id="paragraph">ECommerceStore start since 2019 before pandemic Corona Virus.
                        This store start from mini store but since pandemic never ends, we start to make something different and sell it in online store.
                        Our first name store was "OfflineStore", so we change the name and our new name is <span class='special-word'>ECommerceStore</span></p>
                    </div>
                </div>

                <div class="descCreated">
                     <div class="descCreateddetail">
                        <h1 id="style">Adryan Sucipto</h1>
                        <p id="paragraph">Adryan Sucipto is student who from Padang and study in <a href="https://binus.ac.id/" target="_blank" id="special_link">Bina Nusantara University.</a> Adryan born in Padang and has one sister.
                        Adryan start his carrer from this website and want to help people make a businness can be explore in online way.</p>
                       <br>
                        <p id="paragraph">For futher information, you can follow this account:</p>
                        <a href="https://www.instagram.com/adryansucipto/" target="_blank" >Instagram <img src="./img/instagram (1).png" alt="logo" id="logo"></a>
                        <a href="https://www.facebook.com/hosea.sucipto/" target="_blank" >Facebook <img src="./img/fbLogo.png" alt="logo" id="logo"></a>
                        <a href="https://www.linkedin.com/in/adryan-sucipto-17683b171/" target="_blank" >LinkedIn <img src="./img/linkedin.png" alt="logo" id="logo"></a>
                    </div>
                     <img src="./img/613f89180dc26.jpg" alt="profile" id="imgprofile">
                </div> 

                <div class="ExpoCreated">
                     <div class="descCreateddetail">
                        <h1 id="style">Our Exhibition</h1>
                        <div class="expopages">
                            <div class="expopage">
                                    <img src="./img/iklan1hover.jpg" alt="expo">
                                    <div class="expopagedesc">
                                        <h1 id="style2">Our First Exhibition in Jakarta 2020</h1>
                                        <p id="paragraph">This is our first exhibition at Poolman Central. In this exhibition we want to show our collection and we give best price to people in this exhibition.</p>
                                    </div>
                            </div>
                            <div class="expopage">
                                    <div class="expopagedesc">
                                        <h1 id="style2">Our Second Exhibition in Bandung 2020</h1>
                                        <p id="paragraph">This is our second exhibition at Bandung. The theme of our exhibition are 'Secret Phones!'.</p>
                                    </div>
                                    <img src="./img/login_img1.jpg" alt="expo">
                            </div>
                            <div class="expopage">
                                    <img src="./img/exhi3.jpg" alt="expo">
                                    <div class="expopagedesc">
                                        <h1 id="style2">Our Latest Exhibition in Bandung 2020</h1>
                                        <p id="paragraph">This is our Latest exhibition at Poolman Central. In this exhibition we want to show our collection and we give secret collection.</p>
                                    </div>
                            </div>
                        </div>
                     </div>
                </div> 
            </div>
        </div>

        <div class="footer">
            <div class="footer1">
                <div class="logo">
                    <img src="./img/logo2.png" alt="icon" id="logoFooter"> 
                </div>
                <div class="contents">
                    <div class="content1">
                        <a href="https://wa.me/628116680414" style="border: none;" target="_blank">Contact us - Help Center(+62 8116680414)</a>
                        <a href="aboutus.php">About Us</a>
                        <a href="product.php">Products</a>
                    </div>

                    <div class="content2">
                        <div class="text">
                            <h2>Follow Us</h2>
                            <p>You can follow us to get the latest information</p>
                        </div>

                        <div class="logo">
                            <div class="card">
                                <a href="https://www.facebook.com/"><img src="./img/fb.png" alt="fb"></a>
                                <a href="https://www.facebook.com/">Facebook</a>
                            </div>
                            <div class="card">
                                <a href="https://www.instagram.com/"><img src="./img/ig.png" alt="ig"></a>
                                <a href="https://www.instagram.com/">Instagram</a>
                            </div>
                            <div class="card">
                                <a href="https://twitter.com/"><img src="./img/twitter.png" alt="twitter"></a>
                                <a href="https://twitter.com/">Twitter</a>
                            </div>
                        </div>
                    </div>

                    <div class="content3">
                        <h3>ECommerceStore by Adryan Sucipto</h3>
                        <p>Jl Palmerah No.15, Jakarta Barat, Indonesia</p>
                        <p>Jakarta 14350 Indonesia</p>
                        <p>PhoneNumber - 01234567891</p>
                    </div>

                </div>
            </div>

            <div class="footer2">
                <p>Copyright &copy; 2021 - ECommerceStore All Rights Reserved</p>
            </div>
        </div>
        

    </div>

</body>
</html>