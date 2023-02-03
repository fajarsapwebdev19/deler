<?php
    require '../../../database_connect.php';

    $id_user = mysqli_real_escape_string($con, $_POST['id_user']);
    $method = mysqli_real_escape_string($con, $_POST['method']);

    if($method == "nonactive")
    {
        $sql = mysqli_query($con, "UPDATE user SET status_akun='Tidak Aktif' WHERE id_user='$id_user'");
    }
    else if($method == "active")
    {
        $sql = mysqli_query($con, "UPDATE user SET status_akun='Aktif' WHERE id_user='$id_user'");
    }
    else{
        echo "not";
    }

    if($sql)
    {
        echo "oke";
    }
?>