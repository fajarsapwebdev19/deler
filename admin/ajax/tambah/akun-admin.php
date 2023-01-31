<?php
    require '../../../database_connect.php';

    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($con, @$_POST['jenis_kelamin']);
    $nik = mysqli_real_escape_string($con, $_POST['nik']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $no_telp = mysqli_real_escape_string($con, $_POST['telp']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if(empty($nama & $jenis_kelamin & $nik & $email & $no_telp & $username & $password ))
    {
        echo "valueinvalid";
    }else{
        $date = date('Y-m-d');
        $tambah = mysqli_query($con, "INSERT INTO personal_data VALUES (NULL, '$nama', '$jenis_kelamin', '$nik', '$email', '$no_telp', '$date', NULL)");

        // get data in create personal data
        $sql = mysqli_query($con, "SELECT id,nama FROM personal_data WHERE nama = '$nama'");

        $data = mysqli_fetch_object($sql);

        $id_personal = $data->id;

        $tambah .= mysqli_query($con, "INSERT INTO user VALUES(NULL, '$id_personal', 1, '$username', '$password', 'Belum', 'Tidak Aktif', NULL, NULL, NULL)");

        if($tambah)
        {
            echo "valid";
        }
    }

?>