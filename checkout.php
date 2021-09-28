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
    //id tiap user untuk diakses
    $latestProduct = query("SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where p.id between 1 and 5");
    $totalprice = totalprice("SELECT SUM(sq1.price) as price,SUM(sq1.quantity) as quantity FROM (SELECT SUM(p.price*c.quantity) as price,p.name,p.color, SUM(c.quantity) as quantity, p.img,c.idproduct FROM checkout c JOIN products p ON c.idproduct = p.id WHERE iduser= $userid GROUP BY p.price,p.name,p.color, p.img,c.idproduct) as sq1");
    // $items = query("SELECT SUM(p.price*c.quantity) as price,p.name,p.color, SUM(c.quantity) as quantity, p.img,c.idproduct FROM checkout c JOIN products p ON c.idproduct = p.id WHERE iduser= $userid GROUP BY p.price,p.name,p.color, p.img,c.idproduct");
    $items = query("SELECT p.price,p.name,p.color, c.quantity, p.img,c.idproduct FROM checkout c JOIN products p ON c.idproduct = p.id WHERE iduser= $userid");
    $countCart = countData("checkout",$userid);
    $countWish = countData("wishlist",$userid);
    if(isset($_POST['submitCheckOut'])){
        //isinya ada total harga dan $item dari seluruh cekOut
        processreport($userid,$_POST,$items);
    }
    if(isset($_POST['submitquantity'])){
        //cara kotor
        ubahqty($_POST,$userid);
    }
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
    <link rel="stylesheet" href="./css/checkout.css">

    <script src="./js/slide.js" async></script>
    <title>Cart | ECommerceStore</title>
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

        <div class="checkOutPage">
            <h3 id="title">CheckOut Products</h3> 
            <br>

            <?php if ($items!=NULL):?>
                <table id="tableCheckOut">
                 <!-- jika item wishlist ada -->
                    <tr>
                        <td>No</td>
                        <td>NameProduct</td>
                        <td>Image</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td id="actions">Action</td>
                    </tr>
                   <?php $i=1?>
                   <div class="content">
                    <?php foreach($items as $item):?>
                        <tr>                    
                                    <td><p><?=$i.'.'?></p></td>
                                    <td><a href="productPage.php?id=<?=$item['idproduct']?>" style="text-decoration: none; color: black;"><?=$item['name'].' '.$item['color']?></a></td>
                                    <td>
                                        <a href="productPage.php?id=<?=$item['idproduct']?>" style="text-decoration: none; color: black;"> 
                                            <img src="./img/<?=$item['img']?>" alt="item" id="imageCheckOut"> 
                                        </a>
                                    </td>
                                    <td><p><?='Rp. '.$item['price'].',-'?></p></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="idbarang" id="quantity" class="quantity" value="<?=$item['idproduct']?>">
                                            <input type="number" name="quantity" id="quantity" class="quantity" value="<?=$item['quantity']?>" min="1" max="99" style="width: 40px;">
                                            <button type="submitwish" name="submitquantity" id="submitwish">OK</button>
                                        </form>
                                    </td>
                                    <td id="delete"><a id="deletebtn" href="delete.php?id=<?=$item['idproduct']?>" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>  

                        </tr>
                        
                        <?php $i++?>
                        <?php endforeach;?> 
                   </div>

                    <tr id="totalPrice">
                        <td>Total Price:</td>
                        <td><h3><?='Rp. '.$totalprice["price"].',-'?></h3></td>
                    </tr>
                
                </table>       
            <?php endif;?>
            <!-- jika item wishlist tidak ada -->
            <?php if($items==NULL):?>
                <div class="noproducts">
                    <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/60adc47d.jpg" alt="noProducts" id="iconempty">
                    <p id="items">Your Cart is Empty <i class="fa fa-fw fa-times"></i></p>
                    <p id="paragraph">Make your dreams come true now!</p>
                    <a href="<?=$brand['link_website']?>" target="_blank" id="btn_shopnow">Shop Now</a> 
                </div>
            <?php endif; ?>             
            <br>
        </div>
        <br>
        <div class="process">
            <div class="checkquantityandprice">
                <div class="title-quantity">
                    <h4>Shopping summary</h4>
                    <?php if($totalprice['price'] != NULL):?>
                        <p>Total Price (Items) : (<?=$totalprice['quantity']?>)</p>
                        <p><?='Rp. '.$totalprice['price'].',-'?></p>
                    <?php endif;?>
                    <?php if($totalprice['price'] == NULL):?>
                        <p>Total Price (Item) : (-)</p>
                        <p>-</p>
                    <?php endif;?>
                </div>
                <div class="title-price">
                    <h4>Grand Total</h4>
                    <?php if($totalprice['price'] != NULL):?>
                        <p><?='Rp. '.$totalprice['price'].',-'?></p>
                    <?php endif;?>
                    <?php if($totalprice['price'] == NULL):?>
                        <p>-</p>
                    <?php endif;?>
                </div>
            </div>
            <form action="" method="POST" id="formcheckout">
                <label for="submitcheckOut"><h3>CheckOut all Items?</h3></label>
                <input type="hidden" name="totalquantity" value="<?=$totalprice['quantity']?>">
                <input type="hidden" name="totalprice" value="<?=$totalprice['price']?>">
                <button type="submit" name="submitCheckOut" id="checkoutbtn">CheckOut</button>
            </form>
        </div>
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
    <script src="js/quantity.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/delete.js"></script>
</html>