<?php
    session_start();
    require('function.php');
    auth();
    if(!isset($_SESSION['userid'])){
        $userid = -1;
    }
    else{
        $userid = $_SESSION['userid'];
        $username = searchNameUser($userid);
    }

    if(isset($_POST['submit'])){
        update($_POST,$userid);
    }
    $countCart = countData("checkout",$userid);
    $countWish = countData("wishlist",$userid);
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
    <link rel="stylesheet" href="./css/profiles.css">

    <script src="./js/slide.js" async></script>
    <title>Profile | ECommerceStore</title>
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

        <div class="ProfilePage">
            <h3 id="title">Profile</h3> 
            <br>
            <div class="ProfilePage-user">
                <form action="" method="POST" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="gambarLama" value="<?= $username["imgprofile"]; ?>">
                    <ul id="form-profile-personal">
                        <li>
                            <img src="./img/<?=$username["imgprofile"] ?>" alt="" id="img_profile">
                            <input type="file" name="gambar" id="gambar" title=" ">
                            <p id="file_desc">
                                Max File: maximum 3.000.000 bytes (3 Megabytes). Ekstension file : .JPG .JPEG .PNG
                            </p>
                        </li>
                    </ul>
                    <ul id="form-profile-data">
                        <li>
                            <h3>Change Profile</h3>
                        </li>
                        <li>
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" required autocomplete="off" placeholder="Type your first name" value="<?=$username['firstname']?>">
                        </li>
                        <li>
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" required autocomplete="off" placeholder="Type your last name" value="<?=$username['lastname']?>">
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="email" name="email" required autocomplete="off" placeholder="Type your email" value="<?=$username['email']?>">
                        </li>
                        <li>
                            <label for="dob">Date Of Birth</label>
                            <input type="date" name="dob" autocomplete="off" placeholder="Type your DOB" value="<?=$username['dateofbirth']?>">
                        </li>
                        <li>
                            <label for="phonenumber">Phone Number</label>
                            <input type="number" name="phonenumber"  autocomplete="off" placeholder="Type your phonenumber" value="<?=$username['phonenumber']?>">
                        </li>
                        <li>
                            <label for="address">Address</label>
                            <input type="text" name="address"  autocomplete="off" placeholder="Type your address" value="<?=$username['address']?>">
                        </li>
                        <li>
                            <label for="kota">City</label>
                            <input type="text" name="kota"  autocomplete="off" placeholder="Type your city" value="<?=$username['Kota']?>">
                        </li>
                        <li>
                            <label for="rt">RT/RW</label>
                            <input type="text" name="rt"  autocomplete="off" placeholder="Type your RT" value="<?=$username['RT']?>">
                        </li>
                        <li>
                            <label for="kodepost">Code Post</label>
                            <input type="text" name="kodepost"  autocomplete="off" placeholder="Type your Code Post" value="<?=$username['KodePost']?>">
                        </li>
                        <li id='btn_submit_form'>
                            <button type="submit" name="submit" id='btn_submit_form_profile'>Update Profile</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <div>
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
       
</body>
</html>