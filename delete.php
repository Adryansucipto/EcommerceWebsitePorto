<?php
    session_start();
    require 'function.php';

    if(!isset($_SESSION['userid'])){
        $userid = -1;
    }
    else{
        $userid = $_SESSION['userid'];
    }
    $idbarang = $_GET["id"];
    if(delete($userid,$idbarang)>0){
        echo "
            <script>
            document.location.href = 'checkout.php';
            </script>";
    }
    else{
        echo "
            <script>
            document.location.href = 'checkout.php';
            </script>";
    }
?>