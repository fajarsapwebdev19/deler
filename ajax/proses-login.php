<?php
    session_start();
    require '../database_connect.php';

    

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        if(empty($username & $password))
        {
            echo "kosong";
        }else{
            
            // cari data username dari table user
            $query = mysqli_query($con, "SELECT * FROM user WHERE username='$username'");

            $cek = mysqli_num_rows($query);

            if($cek > 0)
            {
                $data = mysqli_fetch_object($query);

                if(password_verify($password, password_hash($data->password, PASSWORD_DEFAULT)))
                {
                    // cek apakah user sudah melakukan verifikasi email atau belum
                    if($data->status_akun == "Tidak Aktif")
                    {
                        echo "noactive";
                    }else{
                        
                        $username = $data->username;
                        $token = mt_rand().''.rand().date('dmY');
                        $on_status = mysqli_query($con, "UPDATE user SET token='$token', on_status='Online' WHERE username='$username'");

                        $_SESSION['username'] = $data->username;
                        $_SESSION['role_id'] = $data->role_id;
                        $_SESSION['token'] = $data->token;

                        $role = $_SESSION['role_id'];
                        if($role == 1)
                        {
                            $_SESSION['username'] = $data->username;
                            $_SESSION['token'] = $data->token;
                            echo "validadmin";
                        }
                        else if($role == 2)
                        {
                            $_SESSION['username'] = $data->username;
                            $_SESSION['token'] = $data->token;
                            echo "validuser";
                        }
                    }
                }
                else
                {
                    echo "passinvalid";
                }
            }else{
                echo "unameinvalid";
            }
        }
    }

    // sleep(2);
?>