<?php
    session_start();
    require '../function.php';
    
    if(!isset($_SESSION['userid'])){
        $userid = -1;
    }
    else{
        $userid = $_SESSION['userid'];
    }
    $keyword = $_GET['idproduct'];
    $items = query("SELECT p.price,p.name,p.color, c.quantity, p.img,c.idproduct FROM checkout c JOIN products p ON c.idproduct = p.id WHERE iduser= $userid");
    delete($userid,$keyword);
?>

<?php foreach($items as $item):?>
                        <tr>                    
                                    <td><p><?=$i.'.'?></p></td>
                                    <td><p><?=$item['name'].' '.$item['color']?></p></td>
                                    <td><img src="./img/<?=$item['img']?>" alt="item" id="imageCheckOut"></td>
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