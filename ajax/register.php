<?php
    require '../database_connect.php';

    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
    $nik = mysqli_real_escape_string($con, $_POST['nik']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $telp = mysqli_real_escape_string($con, $_POST['telp']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if(empty($nama & $jenis_kelamin & $nik & $alamat & $telp & $username & $password))
    {
        echo "kosong";
    }
    else{
        $getidpersonal = mysqli_query($con, "SELECT max(id) AS id_personal FROM personal_data");
        $idp = mysqli_fetch_object($getidpersonal);
        $idpersonal = $idp->id_personal + 1;

        // cek nik duplicate
        $n = mysqli_query($con, "SELECT nik FROM personal_data WHERE nik='$nik'");
        $cek_nik = mysqli_num_rows($n);

        if($cek_nik > 0)
        {
            echo "nikduplicate";
        }else{
            // cek nik duplicate
            $t = mysqli_query($con, "SELECT no_telp FROM personal_data WHERE no_telp='$telp'");
            $cek_telp = mysqli_num_rows($t);

            if($cek_telp > 0)
            {
                echo "telpduplicat";
            }else{
                $u = mysqli_query($con, "SELECT username FROM user WHERE username='$username'");
                $cek_user = mysqli_num_rows($u);

                if($cek_user > 0)
                {
                    echo "usernameduplicat";
                }else{
                    // create account user
                    $date = date('Y-m-d');
                    $create = mysqli_query($con, "INSERT INTO  personal_data (id,nama,jenis_kelamin,nik,alamat,no_telp,create_date,modified_date) VALUES ('$idpersonal', '$nama', '$jenis_kelamin', '$nik', '$alamat', '$telp', '$date', NULL)");
                    $create .= mysqli_query($con, "INSERT INTO user (id_user,personal_id,role_id,username,password,status_akun,token,on_status) VALUES (NULL,'$idpersonal', '2', '$username', '$password', 'Tidak Aktif', NULL,NULL)");
                }
            }
        }
    }
?>