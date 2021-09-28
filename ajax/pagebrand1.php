<?php

    require '../function.php';
    $keyword = $_GET['keyword'];
    $items= searchbrand1($keyword);
?>

<?php foreach($items as $row): ?>
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