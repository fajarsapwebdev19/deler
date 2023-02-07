<?php
    require '../../../database_connect.php';

    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $nama_motor = mysqli_real_escape_string($con, $_POST['nama_motor']);
    $tahun = mysqli_real_escape_string($con, $_POST['tahun']);
    $kondisi = mysqli_real_escape_string($con, $_POST['kondisi']);
    $harga = mysqli_real_escape_string($con, $_POST['harga']);
    $stok = mysqli_real_escape_string($con, $_POST['stok']);
    $foto_motor = rand().'___'.$_FILES['foto_motor']['name'];
    $tmp_name = $_FILES['foto_motor']['tmp_name'];
    $size = $_FILES['foto_motor']['size'];
    $ex = pathinfo($foto_motor, PATHINFO_EXTENSION);
    $extension = array('png', 'jpg', 'jpeg');

    if(empty($_FILES['foto_motor']['name']))
    {
        echo "imagenull";
    }else{
        if($size > 2000000)
        {
            echo "sizemax";
        }else{
            if(!in_array($ex, $extension))
            {
                echo "notallowextension";
            }else{
                // upload file to storage
                $dir = "../../../img/motor/".$foto_motor;
                move_uploaded_file($tmp_name, $dir);

                $tambah = mysqli_query($con, "INSERT INTO motor (id,id_merk,nama_motor,tahun,kondisi,harga,stok,foto) VALUES (NULL, '$brand', '$nama_motor', '$tahun', '$kondisi', '$harga', '$stok', '$foto_motor')");

                echo "success";
            }
        }
    }




    
?>