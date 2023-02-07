<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $sql = mysqli_query($con, "SELECT * FROM motor WHERE id='$id'");
    $data = mysqli_fetch_object($sql);

    if(file_exists("../../../img/motor/".$data->foto))
    {
        unlink("../../../img/motor/".$data->foto);
    }

    $hapus = mysqli_query($con, "DELETE FROM motor WHERE id='$id'");
    $hapus .= mysqli_query($con, "ALTER TABLE motor AUTO_INCREMENT=1");
?>