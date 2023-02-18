<?php
    require '../../database_connect.php';

    $pembayaran_ke = mysqli_real_escape_string($con, $_POST['pembayaran_ke']);
    $id_transaksi = mysqli_real_escape_string($con, $_POST['id_transaksi']);
    $pembayaran = mysqli_real_escape_string($con, $_POST['pembayaran']);

    if($pembayaran == "Tunai")
    {
        $date = date('Y-m-d');
        $bayar = mysqli_query($con, "UPDATE pembayaran_tenor SET tanggal_bayar='$date', pembayaran='Tunai' WHERE pembayaran_ke='$pembayaran_ke' AND id_transaksi='$id_transaksi'");

        if($bayar)
        {
            echo "berhasil";
        }
    }
    else if($pembayaran == "Transfer")
    {
        if(empty($_FILES['bukti']['name']))
        {
            echo "null";
        }else{
            $bukti = rand().date('dmYHiS').mt_rand(0,9999).''.$_FILES['bukti']['name'];
            $tmp = $_FILES['bukti']['tmp_name'];
            $size = $_FILES['bukti']['size'];
            $ex = pathinfo($bukti, PATHINFO_EXTENSION);
            $extension = array("jpg","jpeg","png");

            if($size > 2000000)
            {
                echo "maxsize";
            }else{
                if(!in_array($ex, $extension))
                {
                    echo "extensionnotallow";
                }else{
                    $date = date('Y-m-d');
                    $bayar = mysqli_query($con, "UPDATE pembayaran_tenor SET tanggal_bayar='$date', pembayaran='Transfer' WHERE pembayaran_ke='$pembayaran_ke' AND id_transaksi='$id_transaksi'");

                    $dir = "../../img/bukti_transfer/".$bukti;

                    $bayar .= mysqli_query($con, "INSERT INTO bukti_transfer_tenor (id,id_transaksi,pembayaran_ke,bukti,status) VALUES (NULL, '$id_transaksi', '$pembayaran_ke','$bukti','Antrian')");

                    if($bayar)
                    {
                        move_uploaded_file($tmp, $dir);
                        echo "berhasil";
                    }
                }
            }
        }
    }
?>