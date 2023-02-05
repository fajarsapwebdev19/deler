<?php
    require '../../../database_connect.php';

    if(empty($_FILES['logo']['name']))
    {
        echo "picturenull";
    }else{
        $name_merk = mysqli_real_escape_string($con, $_POST['name']);
        $logo = $_FILES['logo']['name'];
        $tmp_logo = $_FILES['logo']['tmp_name'];
        $size = $_FILES['logo']['size'];
        $ex = pathinfo($logo, PATHINFO_EXTENSION);
        $extension = array('jpg', 'jpeg', 'png');

        // validation in size file
        // max 2 MB
        if($size > 2000000)
        {
            echo "sizemax";
        }
        else
        {
            // validation in extension file
            // allowed jpg,jpeg,png
            if(!in_array($ex, $extension))
            {
                echo "extensinotallowed";
            }
            else
            {
                // save file
                $dir = "../../../img/logo/".$logo;
                move_uploaded_file($tmp_logo, $dir);

                // add data in table merk
                $tambah = mysqli_query($con, "INSERT INTO merk (id,merk_name,logo) VALUES (NULL, '$name_merk', '$logo')");

                if($tambah)
                {
                    echo "success";
                }
            }
        }
    }
?>