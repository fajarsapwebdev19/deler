<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    // cari foto lama
    $sql = mysqli_query($con, "SELECT * FROM merk WHERE id='$id'");
    $foto_lama = mysqli_fetch_object($sql);

    if(file_exists("../../../img/logo/".$foto_lama->logo))
    {
        unlink("../../../img/logo/".$foto_lama->logo);
    }

    $hapus = mysqli_query($con, "DELETE FROM merk WHERE id='$id'");
    $hapus .= mysqli_query($con, "ALTER TABLE merk AUTO_INCREMENT=1");
?>