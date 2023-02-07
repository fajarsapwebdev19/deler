<?php
    require '../../../database_connect.php';

    if(empty($_FILES['logo']['name']))
    {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name_merk = mysqli_real_escape_string($con, $_POST['merk_name']);
        $ubah = mysqli_query($con, "UPDATE merk SET merk_name='$name_merk' WHERE id='$id'");

        if($ubah)
        {
            echo "success";
        }
    }else{
        $name_merk = mysqli_real_escape_string($con, $_POST['merk_name']);
        $logo = $_FILES['logo']['name'];
        $tmp_logo = $_FILES['logo']['tmp_name'];
        $size = $_FILES['logo']['size'];
        $ex = pathinfo($logo, PATHINFO_EXTENSION);
        $extension = array('jpg','jpeg','png');

        // validation size file
        if($size > 2000000)
        {
            echo "maxsize";
        }else{
           if(!in_array($ex, $extension))
           {
            echo "sizenotallowed";
           }else{
                // cari foto lama
                $id = mysqli_real_escape_string($con, $_POST['id']);

                $sql = mysqli_query($con, "SELECT * FROM merk WHERE id='$id'");
                $foto_lama = mysqli_fetch_object($sql);

                if(file_exists("../../../img/logo/".$foto_lama->logo))
                {
                    unlink("../../../img/logo/".$foto_lama->logo);
                }

                $dir = "../../../img/logo/".$logo;

                move_uploaded_file($tmp_logo, $dir);

                $ubah = mysqli_query($con, "UPDATE merk SET merk_name='$name_merk', logo='$logo' WHERE id='$id'");

                if($ubah)
                {
                    echo "success";
                }
           }
        }

        
    }
?>