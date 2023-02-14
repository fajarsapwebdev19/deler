<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $passlama = mysqli_real_escape_string($con, $_POST['passlama']);
    $passbaru = mysqli_real_escape_string($con, $_POST['passbaru']);
    $konpassbaru = mysqli_real_escape_string($con, $_POST['konpassbaru']);

    $sql = mysqli_query($con, "SELECT password FROM user WHERE id_user='$id' AND password='$passlama'");

    $cek = mysqli_num_rows($sql);

    if($cek > 0)
    {
        $ubah = mysqli_query($con, "UPDATE user SET password='$passbaru' WHERE id_user='$id'");

        if($ubah)
        {
            echo "sukses";
        }
    }else{
        echo "passlamainvalid";
    }
?>