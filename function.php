<?php
    $connect = mysqli_connect('localhost','root','','ecommercewebsite');

    function query($query){
        global $connect;
        $result = mysqli_query($connect,$query);
        $rows= [];
        while($row = mysqli_fetch_assoc($result)){
            $row['price'] = number_format($row['price'],0,",",".");
            $rows[] = $row;
        }
        return $rows;
    }

    function login($data){
        global $connect;
        $username = $data['username'];
        $password = $data['password'];
        $result = mysqli_query($connect,"SELECT * FROM users WHERE username = '$username' ");

        if(mysqli_num_rows($result) == 1){
            //cekpassword
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password,$row['password']) ){
                return 1;
            }
            else{
                return 0;
            }
        }
    }

    function register($data){
        global $connect;
        $username = strtolower(htmlspecialchars($data['username']));
        $password = mysqli_real_escape_string($connect,$data['password']);
        $password2 = mysqli_real_escape_string($connect,$data['password2']);
        $firstname = strtolower(htmlspecialchars($data['firstname']));
        $lastname = strtolower(htmlspecialchars($data['lastname']));
        $email = strtolower(htmlspecialchars($data['email']));
        $cekUsername = mysqli_query($connect,"SELECT username FROM user WHERE username = '$username'; ");
        if(mysqli_fetch_assoc($cekUsername)){
            return false;
        }
        if($password != $password2){
            return false;
        }
        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        mysqli_query($connect,"INSERT INTO user VALUES('','$username','$firstname','$lastname','$email','$password'); ");
        $sqlrowaffected = mysqli_affected_rows($connect);
        return $sqlrowaffected;
    }

    function auth(){
        // session_start();
        if(!isset($_SESSION["username"])) {//cek jika session tidak memiliki isi
            header("Location: login.php");
            exit();
        }
    }

    function searchID($data){
        global $connect;
        $username = $data['username'];
        $result = mysqli_query($connect,"SELECT id FROM users WHERE username = '$username' ");
        $id = mysqli_fetch_assoc($result);
        return $id;
    }

    function searchPage($id){
        global $connect;
        $result = mysqli_query($connect,"SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where p.id = $id");
        $rows = mysqli_fetch_assoc($result);
        $rows['price'] = number_format($rows['price'],0,",",".");
        return $rows;
    }
    
    function searchPagebyBrand($id){
        global $connect;
        $result = mysqli_query($connect,"SELECT *FROM brandproduct WHERE name LIKE '$id' ");
        $rows = mysqli_fetch_assoc($result);
        return $rows;
    }

    // function tambahcheckout($data,$userid,$idbarang){
    //     global $connect;
    //     $iduser = $userid;
    //     $productid = $idbarang;
    //     $quantity = $data['quantity'];
    //     $query = "INSERT INTO checkout VALUES($iduser,$productid,$quantity)";
    //     mysqli_query($connect,$query);
    //     $sqlrows = mysqli_affected_rows($connect);
        
    //     if($sqlrows > 0){
    //         // checkCheckOut($userid,$idbarang);
    //         header("Location: index.php");
    //         exit();
    //     }
    //     else{
    //         header("Location: productPage.php");
    //         exit();
    //     }
        
    // }
    
    function tambahcheckout($data,$userid,$idbarang){
        global $connect;
        $iduser = $userid;
        $productid = $idbarang;
        $quantity = $data['quantity'];
        $return = searchCheckOutQTY($iduser,$productid);
        if($return == 1){
            $query = "UPDATE checkout SET quantity = quantity + $quantity WHERE iduser = $userid AND idproduct = $idbarang";
        }
        else if($return == 0){
            $query = "INSERT INTO checkout VALUES($userid,$idbarang,$quantity)";
        }
        mysqli_query($connect,$query);
        $sqlrows = mysqli_affected_rows($connect);
        
        if($sqlrows > 0){
            header("Location: index.php");
            exit();
        }
        else{
            header("Location: productPage.php");
            exit();
        }
    }

    function searchCheckOutQTY($userid,$idbarang){
        global $connect;
        $query = "SELECT *FROM checkout WHERE iduser = $userid AND idproduct = $idbarang";
        $result = mysqli_query($connect,$query);
        $row = mysqli_fetch_assoc($result);
        $returnvalue = -1;
        if($row['iduser'] == $userid && $row['idproduct'] == $idbarang){
            $returnvalue = 1;
        }
        else if($row['iduser'] != $userid && $row['idproduct'] !=$idbarang){
            $returnvalue = 0;
        }
        return $returnvalue;
    }

    function tambahwishlist($data,$userid,$idbarang){
        global $connect;
        $iduser = $userid;
        $productid = $idbarang;
        $quantity = $data['quantity'];
        $return = searchWislistQTY($iduser,$productid);
        if($return == 1){
            $query = "UPDATE wishlist SET quantity = quantity + $quantity WHERE iduser = $userid AND idproduct = $idbarang";
        }
        else if($return == 0){
            $query = "INSERT INTO wishlist VALUES($userid,$idbarang,$quantity)";
        }
        mysqli_query($connect,$query);
        $sqlrows = mysqli_affected_rows($connect);
        
        if($sqlrows > 0){
            header("Location: index.php");
            exit();
        }
        else{
            header("Location: productPage.php");
            exit();
        }
    }
    
    function searchWislistQTY($userid,$idbarang){
        global $connect;
        $query = "SELECT *FROM wishlist WHERE iduser = $userid AND idproduct = $idbarang";
        $result = mysqli_query($connect,$query);
        $row = mysqli_fetch_assoc($result);
        $returnvalue = -1;
        if($row['iduser'] == $userid && $row['idproduct'] == $idbarang){
            $returnvalue = 1;
        }
        else if($row['iduser'] != $userid && $row['idproduct'] !=$idbarang){
            $returnvalue = 0;
        }
        return $returnvalue;
    }

    function search($keyword){
        $query = "SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where p.name LIKE '%$keyword%' OR p.price LIKE '%$keyword%'  OR p.color LIKE '%$keyword%' OR bp.name = '%$keyword%'";
        return query($query);
    }

    function searchbrand1($keyword){
        $query = "SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where (p.name LIKE '%$keyword%' OR p.price LIKE '%$keyword%'  OR p.color LIKE '%$keyword%') AND (bp.name LIKE 'Apple')";
        return query($query);
    }
    
    function searchbrand2($keyword){
        $query = "SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where (p.name LIKE '%$keyword%' OR p.price LIKE '%$keyword%'  OR p.color LIKE '%$keyword%') AND (bp.name LIKE 'Samsung')";
        return query($query);
    }

    function searchbrand3($keyword){
        $query = "SELECT p.id,p.name,p.price,bp.name as brand,p.stars,p.img,p.description,p.color FROM products p JOIN brandproduct bp ON p.brand = bp.id where (p.name LIKE '%$keyword%' OR p.price LIKE '%$keyword%'  OR p.color LIKE '%$keyword%') AND (bp.name LIKE 'Xiaomi')";
        return query($query);
    }
    
    function totalprice($query){
        global $connect;
        $result = mysqli_query($connect,$query);
        $rows = mysqli_fetch_assoc($result);
        $rows['price'] = number_format($rows['price'],0,",",".");
        return $rows;
    }

    function delete($iduser,$idbarang){
        global $connect;
        mysqli_query($connect,"DELETE FROM checkout WHERE iduser = $iduser AND idproduct = $idbarang");
        $sqlrowaffected = mysqli_affected_rows($connect);
        return $sqlrowaffected;
    }

    function deleteaftersent($iduser,$idbarang){
        global $connect;
        mysqli_query($connect,"DELETE FROM wishlist WHERE iduser = $iduser AND idproduct = $idbarang");
        $sqlrowaffected = mysqli_affected_rows($connect);
        return $sqlrowaffected;
    }

    function processreport($userid,$data,$dataproduct){
        global $connect;
    }

    function searchNameUser($iduser){
        global $connect;
        $query  = "SELECT * FROM users WHERE id = $iduser";
        $result = mysqli_query($connect,$query);
        $rows = mysqli_fetch_assoc($result);
        return $rows;
    }


    function upload(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        //cek apakah tidak ada gambar yang diupload
        if( $error == 4){
            echo "
            <script>
            alert('Pilih Gambar terlebih dahulu');
            </script>";
            return false;
        }
        $ektensiGambarValid = ['jpg','jpeg','png'];
        $ektensiGambar= explode('.',$namaFile);
        $ektensiGambar= strtolower(end($ektensiGambar));
        
        //cek ektensiFile Valid
        if(!in_array($ektensiGambar,$ektensiGambarValid) ){
            echo "<script>
            alert('Not Images!');
            window.location.href='profile.php';
            </script>";
            exit;      
        }
        if($ukuranFile > 30000000){
            echo "<script>
            alert('File Size more then Capacity!');
            window.location.href='profile.php';
            </script>";
            exit;      
        }
        //generateNamagambar baru
        $namaFilebaru = uniqid();
        $namaFilebaru .= '.';
        $namaFilebaru .= $ektensiGambar;

        //masukin file ke storage
        move_uploaded_file($tmpName,'img/'. $namaFilebaru);
        return $namaFilebaru;
    }

    function update($data,$userid){
        global $connect;
        $firstname= htmlspecialchars($data['firstname']);
        $lastname= htmlspecialchars($data['lastname']);
        $email= htmlspecialchars($data['email']);
        $dob= htmlspecialchars($data['dob']);
        $phonenumber= htmlspecialchars($data['phonenumber']);
        $kota= htmlspecialchars($data['kota']);
        $rt= htmlspecialchars($data['rt']);
        $kodepost= htmlspecialchars($data['kodepost']);
        // $address = htmlspecialchars( cekAddress($data['address'],$rt,$kota,$kodepost) );
        $address = htmlspecialchars( $data['address']);
        $gambarLama= htmlspecialchars($data['gambarLama']);
        
        if($firstname == null || $lastname == null || $email == null){
            header("Location: profile.php");
            exit();
        }
        elseif($dob == null){
            $dob = ' ';
        }
        elseif($phonenumber == null){
            $phonenumber = ' ';
        }
        elseif($address == null){
            $address = ' ';
        }
        else{
            if($_FILES['gambar']['error'] == 4){
                $gambar = $gambarLama;
            }
            else{
                $gambar = upload();
                if($gambar == NULL){
                    $gambar = $gambarLama;
                }
            }
            //cek data berhasil ditambahkan atau tidak
            $query = "UPDATE users SET firstname = '$firstname',lastname = '$lastname',email='$email',imgprofile = '$gambar',dateofbirth = '$dob', phonenumber = '$phonenumber', address = '$address', Kota = '$kota', RT = '$rt', KodePost = '$kodepost'  WHERE id= $userid";
            mysqli_query($connect,$query);
            $sqlrowaffected = mysqli_affected_rows($connect);
            // return $sqlrowaffected;
            if($sqlrowaffected > 0){
                echo "<script>
                        alert('berhasil!');
                        window.location.href='profile.php';
                    </script>";
                exit();
            }
            else{
                echo "<script>
                window.location.href='profile.php';
                </script>";
                exit();
            }
        }
    }
    // Jalan Gurun Dalam no 1, RT01/05, Kota Padang, 25118
    // function cekAddress($address,$rt,$kota,$kodepost){
    //     $cekaddress = explode(',',$address);
    //     $currentAddress = $address;
    //     $currentAddress .= ', RT';
    //     $currentAddress .= $rt;
    //     $currentAddress .= ', Kota ';
    //     $currentAddress .= $kota;
    //     $currentAddress .= ', ';
    //     $currentAddress .= $kodepost;
    //     if(end($cekaddress) != $kodepost){
    //         // return $address;
    //         $currentAddress = $cekaddress[0];
    //         $currentAddress .= ', RT';
    //         $currentAddress = $cekaddress[1];
    //         $currentAddress .= ', Kota ';
    //         $currentAddress .= $cekaddress[2];
    //         $currentAddress .= ', ';
    //         $currentAddress .= $kodepost;
    //         return $currentAddress;
    //     }
    //     if($cekaddress[2] != $kota){
    //     //     $address .= ', ';
    //     //     $address .= $kodepost;
    //     //     return $address;
    //     // 
    //         $currentAddress = $cekaddress[0];
    //         $currentAddress .= ', RT';
    //         $currentAddress = $cekaddress[1];
    //         $currentAddress .= ', Kota ';
    //         $currentAddress .= $kota;
    //         $currentAddress .= ', ';
    //         $currentAddress .= $cekaddress[3];
    //         return $currentAddress;
    //     }
    //     if($cekaddress[1] != $rt){
    //         // $address .= ', Kota ';
    //         // $address .= $kota;
    //         // return $address;
    //         $currentAddress = $cekaddress[0];
    //         $currentAddress .= ', RT';
    //         $currentAddress = $rt;
    //         $currentAddress .= ', Kota ';
    //         $currentAddress .= $cekaddress[2];
    //         $currentAddress .= ', ';
    //         $currentAddress .= $cekaddress[3];
    //         return $currentAddress;
    //     }
    //     if($cekaddress[0] != $address){
    //         // $address .= ', RT';
    //         // $address .= $rt;
    //         // return $address;
    //         $currentAddress = $address;
    //         $currentAddress .= ', RT';
    //         $currentAddress = $cekaddress[1];
    //         $currentAddress .= ', Kota ';
    //         $currentAddress .= $cekaddress[2];
    //         $currentAddress .= ', ';
    //         $currentAddress .= $cekaddress[3];
    //         return $currentAddress;
    //     }
    // }



    function sendtocheckout($data,$userid){


        global $connect;
        $iduser = $userid;
        $productid = $data['idproduct'];
        $quantity = $data['quantity'];
        $return = searchCheckOutQTY($iduser,$productid);
        if($return == 1){
            $query = "UPDATE checkout SET quantity = quantity + $quantity WHERE iduser = $userid AND idproduct =$productid";
        }
        else if($return == 0){
            $query = "INSERT INTO checkout VALUES($userid,$productid,$quantity)";
        }
        deleteaftersent($userid,$productid);
        mysqli_query($connect,$query);
        $sqlrows = mysqli_affected_rows($connect);
        
        if($sqlrows > 0){
            // checkCheckOut($userid,$idbarang);
            header("Location: index.php");
            exit();
        }
        else{
            header("Location: productPage.php");
            exit();
        }
    }

    function ubahqty($data,$userid){
        global $connect;
        $ubahdata = $data['quantity'];
        $idproduct = $data['idbarang'];
        $query = "UPDATE checkout SET quantity = $ubahdata WHERE iduser = $userid AND idproduct = $idproduct";
        mysqli_query($connect,$query);
        $sqlrowaffected = mysqli_affected_rows($connect);
        // return $sqlrowaffected;
        if($sqlrowaffected > 0){
            echo "<script>
                    alert('berhasil!');
                    window.location.href='checkout.php';
                </script>";
            exit();
        }
        else{
            echo "<script>
            window.location.href='checkout.php';
            </script>";
            exit();
        }
    }

    function countData($table,$userid){
        global $connect;
        $result = mysqli_query($connect,"SELECT COUNT(*) as count FROM $table WHERE iduser = $userid");
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
?>