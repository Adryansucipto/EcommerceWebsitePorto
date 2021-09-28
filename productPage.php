<?php
    session_start();
    require 'function.php';
    $id = $_GET["id"];
    $items= searchPage($id);
    // echo $id;

    if(!isset($_SESSION['userid'])){
        $userid = -1;
    }
    else{
        $userid = $_SESSION['userid'];
        $username = searchNameUser($userid);
    }
    //id tiap user untuk diakses
    if(isset($_POST['submitcart'])){
        auth();
        if(isset($_SESSION['userid'])){
            tambahcheckout($_POST,$userid,$id);
        } 
    }

    if(isset($_POST['submitwish'])){
        auth();
        if(isset($_SESSION['userid'])){
            tambahwishlist($_POST,$userid,$id);
        }
    }
    $countCart = countData("checkout",$userid);
    $countWish = countData("wishlist",$userid);
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
    <link rel="stylesheet" href="./css/ProductPages.css">

    <script src="./js/slide.js" async></script>
    <title><?=$items['name'].' - '.$items['color']?> | ECommerceStore</title>
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

                <div class="topnav">
                    <a href="#home" class="active">ECommerceStore</a>
                        <div id="myLinks">
                                <a href="wishlist.php"><i class="fa fa-user" aria-hidden="true"></i>Profile</a>
                                <a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
                                <a href="product.php"><i class="fa fa-cart-plus" aria-hidden="true"></i>Products</a>
                                <a href="aboutus.php"><i class="fa fa-users" aria-hidden="true"></i>About Us</a>
                                <a href="checkout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Check Out</a>
                                <a href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i>Wish List</a>

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

        <div class="product">
            <h3 id="title">Popular Products</h3>
            <div class="product-page">
                <div class="imgpage">
                      <img src="img/<?=$items['img']?>" alt="imgproduct">              
                </div>
                <div class="formpage">
                    <div class="descriptionform">
                         <h2><?=$items['name'].' - '.$items['color']?></h2>      
                         <br>
                         <h1><?='Rp. '.$items['price'].',-'?></h1>
                         <br>
                         <p>Color: <?=$items['color']?> </p>
                         <br>
                         <p>Brand: <?=$items['brand']?> </p>
                         <br>
                         <p>Ratings:</p>
                         <div class="stars">
                                        <?php for($i=1; $i<=$items['stars'] ;$i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor;?>
                                        <?php if($items['stars']<5):
                                        for($i=1; $i<=5-$items['stars'] ;$i++): ?>
                                            <i class="fa fa-star" id="ifstar" aria-hidden="true"></i>
                                        <?php endfor; endif;?>
                        </div>
                        <br>
                        <h3>Description</h3>
                        <p><?=$items['description']?></p>
                        <br>
                        <h3>Spesification</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum quis explicabo vel ipsam dolorum non quibusdam quaerat illo? Accusantium nobis explicabo temporibus animi modi, omnis ipsam dignissimos! Necessitatibus, molestiae nihil?</p>
                    </div>
                    <br>
                    <div class="descriptionformpage">
                            <h3 style="text-align: center;">Product Reserve</h3>
                        <br>
                            <div class="counter">
                                <button class="btn" name='btn'  onclick="handleCounterMin()"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                <label for="quantity">Quantity</label>      
                                <button class="btn" name='btn' onclick="handleCounterPlus()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        <br>
                            <form action="" method="POST">
                                <ul>
                                    <li>
                                        <input type="text" name="quantity" id="quantity" class="quantity" value="1" min="1">
                                    </li>
                                    <li>
                                        <label for="namecart">Add to Cart</label>
                                        <button type="submitcart" name="submitcart" id="submitcart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                    </li>
                                    <li>
                                        <label for="submitwish">Add to WishList</label>
                                        <button type="submitwish" name="submitwish" id="submitwish"><i class="fa fa-heart" aria-hidden="true"></i></button>
                                    </li>
                                </ul>
                            </form>
                        
                    </div>  
                </div>
            </div>
        </div>
        <!--latest products  -->
        <div class="latest">
                <h3 id="title">Recommended Products</h3>
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
    <script src="js/quantity.js"></script>
</body>
</html>