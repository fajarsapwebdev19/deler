<?php
    require '../../../database_connect.php';

    
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $nama = mysqli_real_escape_string($con, $_POST['nama']);
        $jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
        $nik = mysqli_real_escape_string($con, $_POST['nik']);
        $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
        $telp = mysqli_real_escape_string($con, $_POST['telp']);


        $query = mysqli_query($con, "UPDATE personal_data SET nama='$nama',jenis_kelamin='$jenis_kelamin',nik='$nik',alamat='$alamat',no_telp='$telp' WHERE id='$id'");

        if($query)
        {
            echo "success";
        }
?>