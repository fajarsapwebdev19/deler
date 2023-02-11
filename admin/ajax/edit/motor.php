<?php
    require '../../../database_connect.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $nama_motor = mysqli_real_escape_string($con, $_POST['nama_motor']);
    $tahun = mysqli_real_escape_string($con, $_POST['tahun']);
    $kondisi = mysqli_real_escape_string($con, $_POST['kondisi']);
    $harga = mysqli_real_escape_string($con, $_POST['harga']);
    $stok = mysqli_real_escape_string($con, $_POST['stok']);
    
    if(empty($_FILES['foto_motor']['name']))
    {
        $ubah = mysqli_query($con, "UPDATE motor SET id_merk='$brand', nama_motor='$nama_motor', tahun='$tahun', kondisi='$kondisi', harga='$harga', stok='$stok' WHERE id='$id'");

        if($ubah)
        {
            echo "success";
        }
    }
    else{
        $foto_motor = $_FILES['foto_motor']['name'];
        $tmp = $_FILES['foto_motor']['tmp_name'];
        $size = $_FILES['foto_motor']['size'];
        $ex = pathinfo($foto_motor, PATHINFO_EXTENSION);
        $extension = array('jpg','jpeg','png');

        if($size > 3000000)
        {
            echo "maxsize";
        }
        else
        {
            if(!in_array($ex,$extension))
            {
                echo "extensionnotallowed";
            }
            else
            {
                $rename = mt_rand().'---'.$foto_motor;
                $dir = "../../../img/motor/".$rename;

                // hapus file lama
                $sql = mysqli_query($con, "SELECT foto FROM motor WHERE id='$id'");
                $m = mysqli_fetch_object($sql);

                if(file_exists("../../../img/motor/".$m->foto))
                {
                    unlink("../../../img/motor/".$m->foto);
                }

                $ubah = mysqli_query($con, "UPDATE motor SET id_merk='$brand', nama_motor='$nama_motor', tahun='$tahun', kondisi='$kondisi', harga='$harga', stok='$stok', foto='$rename' WHERE id='$id'");

                if($ubah)
                {
                    move_uploaded_file($tmp, $dir);
                    echo "success";
                }
            }
        }
    }
?>