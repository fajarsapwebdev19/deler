<?php
    require '../../../database_connect.php';

    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($con, @$_POST['jenis_kelamin']);
    $nik = mysqli_real_escape_string($con, $_POST['nik']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $no_telp = mysqli_real_escape_string($con, $_POST['telp']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if(empty($nama & $jenis_kelamin & $nik & $alamat & $no_telp & $username & $password ))
    {
        echo "valueinvalid";
    }else{
        $date = date('Y-m-d');
        
        // get id personal data
        $get = mysqli_query($con, "SELECT max(id) AS id_personal FROM personal_data");
        $idpd = mysqli_fetch_object($get);
        $id_personal = $idpd->id_personal + 1;

        $tambah = mysqli_query($con, "INSERT INTO personal_data (id,nama,jenis_kelamin,nik,alamat,no_telp,create_date,modified_date) VALUES ('$id_personal', '$nama','$jenis_kelamin','$nik','$alamat','$no_telp','$date', NULL)");

        $tambah .= mysqli_query($con, "INSERT INTO user (id_user, personal_id, role_id, username, password, status_akun, token, on_status) VALUES (NULL, '$id_personal', '1', '$username', '$password', 'Aktif', NULL,NULL)");

        if($tambah)
        {
            echo "valid";
        }
    }

?>