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
    $hottestProduct = query("SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where p.id between 1 and 3");
    $latestProduct = query("SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where p.id between 1 and 5");
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
    <link rel="stylesheet" href="./css/owlcarouselmin.css">
    <link rel="stylesheet" href="./css/owlcarousel.defaultmin.css">

    <script src="./js/home.js" async></script>
    <script src="./js/slide.js" async></script>
    <script src="./js/carousel.js" async></script>
    <title>Home | ECommerceStore</title>
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
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

        <div class="slider">
            <div class="slides">
              <!--radio buttons start-->
              <input type="radio" name="radio-btn" id="radio1">
              <input type="radio" name="radio-btn" id="radio2">
              <input type="radio" name="radio-btn" id="radio3">
              <input type="radio" name="radio-btn" id="radio4">
              <input type="radio" name="radio-btn" id="radio5">
              <!--radio buttons end-->
              
              <div class="slide first">
                  <a href="productperbrand.php?idbrand=Apple"><img src="./img/iklanES1.png" alt="event1"></a>
              </div>
              <div class="slide">
                  <a href=""><img src="./img/game2.jpg" alt="event2"></a> 
              </div>
              <div class="slide">
                  <a href=""><img src="./img/game3.jpg" alt="event3"></a>
              </div>
              <div class="slide">
                  <a href=""><img src="./img/game4.jpg" alt="event4"></a>
              </div>
              <div class="slide">
                  <a href=""> <img src="./img/game5.jpg" alt="event5"></a>
              </div>
    
              <!--automatic navigation start-->
              <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                    <div class="auto-btn5"></div>
              </div>
              <!--automatic navigation end-->
            </div>
    
            <!--manual navigation start-->
            <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                    <label for="radio5" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
        </div>


    <div class="description">
        <div class="main-description">
            <div class="img">
                <img src="./img/people.png" alt="">
            </div>
            <div class="imgdescription">
                 <h1>The best Ecommerce Phone in the world!</h1> 
                 <h4>For detail information, you can click this button</h4> 
                 <a href="aboutus.php"><button>Next</button></a>         
            </div>
        </div>
    </div> 
    <!--hottest products  -->
        <div class="hottest">
            <h3 id="title">Hottest Products</h3>
            <br>
            <div class="miniContainer">
                <div class="rows">              
                    <?php foreach($hottestProduct as $row): ?>
                        <a href="productPage.php?id=<?=$row['id'];?>">
                            <div class="row">
                                    <img src="./img/<?=$row['img'];?>" id="phone" alt="">
                                    <h5><?=$row['name'].' '.$row['color'];?></h5>
                                    <p><?='Rp. '.$row['price'].',-'?></p>
                                    
                                    <div class="stars">
                                        <?php for($i=1; $i<=$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor;?>
                                        <?php if($row['stars']<5):
                                        for($i=1; $i<=5-$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" id="ifstar" aria-hidden="true"></i>
                                        <?php endfor; endif;?>
                                    </div>

                                    <p><?='Rating: '.$row['stars'].'/5'?></p>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>  
    <!--hottest products  -->
    <!--latest products  -->
        <div class="latest">
            <h3 id="title">Latest Products</h3>
            <br>
            <div class="miniContainer">
                <div class="rows">
                    <?php foreach($latestProduct as $row): ?>
                        <a href="productPage.php?id=<?=$row['id'];?>">
                            <div class="row">
                                <img src="./img/<?=$row['img'];?>" id="phone" alt="">
                                <h5><?=$row['name'].' '.$row['color'];?></h5>
                                <p><?='Rp. '.$row['price'].',-'?></p>

                                <div class="stars">
                                        <?php for($i=1; $i<=$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor;?>
                                        <?php if($row['stars']<5):
                                        for($i=1; $i<=5-$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" id="ifstar" aria-hidden="true"></i>
                                        <?php endfor; endif;?>
                                </div>

                                <p><?='Rating: '.$row['stars'].'/5'?></p>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    <!--latest products  -->
        <div class="description2">
            <h3 id="title">Why Must Buy From Us?</h3>
            <div class="miniContainer2">
                <div class="rows">
                    <div class="row">
                        <img src="./img/click.png" alt="">
                        <p>Easy Transaction</p>
                    </div>
                    <div class="row">
                        <img src="./img/high-quality.png" alt="">
                        <p>Best Quality</p>
                    </div>
                    <div class="row">
                        <img src="./img/shipped.png" alt="">
                        <p>Send to all region</p>
                    </div>
                    <div class="row">
                        <img src="./img/guarantee.png" alt="">
                        <p>Guarantee</p>
                    </div>
                    <div class="row">
                        <img src="./img/trust.png" alt="">
                        <p>Trusted</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- container logo  -->

        <div class="ourproduct">
            <h3 id="title">Our Best Products</h3>
            <div class="miniContainer3">
                <div class="rows">
                    <div class="row">
                        <img src="./img/apple-logo.png" alt="">
                        <p>Apple</p>
                    </div>
                    <div class="row">
                        <img src="./img/samsung.png" alt="">
                        <p>Samsung</p>
                    </div>
                    <div class="row">
                        <img src="./img/xiaomi.png" alt="">
                        <p>Xiaomi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- container logo  -->

        <div class="latest">
            <h3 id="title">Popular Products</h3>
            <br>
            <div class="miniContainer">
                <div class="rows">
                    <?php foreach($latestProduct as $row): ?>
                        <a href="productPage.php?id=<?=$row['id'];?>">
                            <div class="row">
                                <img src="./img/<?=$row['img'];?>" id="phone" alt="">
                                <h5><?=$row['name'].' '.$row['color'];?></h5>
                                <p><?='Rp. '.$row['price'].',-'?></p>

                                <div class="stars">
                                        <?php for($i=1; $i<=$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor;?>
                                        <?php if($row['stars']<5):
                                        for($i=1; $i<=5-$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" id="ifstar" aria-hidden="true"></i>
                                        <?php endfor; endif;?>
                                </div>

                                <p><?='Rating: '.$row['stars'].'/5'?></p>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

        <h3 id="title">Recents Products</h3>
        <br>

        <div class="owl-carousel">
                <?php foreach($latestProduct as $row): ?>
                    <a href="productPage.php?id=<?=$row['id'];?>">
                        <div class="carousel-row">
                            <img src="./img/<?=$row['img'];?>" id="phone" alt="">
                            <h5><?=$row['name'].' '.$row['color'];?></h5>
                            <p><?='Rp. '.$row['price'].',-'?></p>

                                <div class="stars">
                                        <?php for($i=1; $i<=$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor;?>

                                <?php if($row['stars']<5):
                                for($i=1; $i<=5-$row['stars'] ;$i++): ?>
                                    <i class="fa fa-star" id="ifstar" aria-hidden="true"></i>
                                <?php endfor; endif;?>

                                </div>
                            <p><?='Rating: '.$row['stars'].'/5'?></p>
                        </div>
                    </a>
                <?php endforeach;?>
                <?php foreach($latestProduct as $row): ?>
                    <a href="productPage.php?id=<?=$row['id'];?>">
                        <div class="carousel-row">
                            <img src="./img/<?=$row['img'];?>" id="phone" alt="">
                            <h5><?=$row['name'].' '.$row['color'];?></h5>
                            <p><?='Rp. '.$row['price'].',-'?></p>

                                <div class="stars">
                                        <?php for($i=1; $i<=$row['stars'] ;$i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor;?>

                                <?php if($row['stars']<5):
                                for($i=1; $i<=5-$row['stars'] ;$i++): ?>
                                    <i class="fa fa-star" id="ifstar" aria-hidden="true"></i>
                                <?php endfor; endif;?>

                                </div>
                            <p><?='Rating: '.$row['stars'].'/5'?></p>
                        </div>
                    </a>
                <?php endforeach;?>
        </div>
        <br>

        <div class="interested">
            <div class="text4">
                <h3>Interested?</h3>
            </div>

            <div class="text5">
                <p>Click this button to login and happy shopping!</p>
            </div>

            <div class="reserve">
                <ul>
                    <li><a href="login.php">Login</a></li>
                </ul>
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