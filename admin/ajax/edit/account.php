<?php
    require '../../../database_connect.php';

    
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $nama = mysqli_real_escape_string($con, $_POST['nama']);
        $jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
        $nik = mysqli_real_escape_string($con, $_POST['nik']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $telp = mysqli_real_escape_string($con, $_POST['telp']);


        $query = mysqli_query($con, "UPDATE personal_data SET nama='$nama',jenis_kelamin='$jenis_kelamin',nik='$nik',email='$email',no_telp='$telp' WHERE id='$id'");

        if($query)
        {
            echo "success";
        }
?>