<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pembayaran_ke = mysqli_real_escape_string($con, $_POST['pembayaran_ke']);
    $payment = mysqli_real_escape_string($con, $_POST['payment']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    if($status == "Terima")
    {
        if($payment == "Tunai")
        {
            $acc = mysqli_query($con, "UPDATE pembayaran_tenor SET status_bayar='Sudah' WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");

            if($acc)
            {
                echo "oke";
            }
        }
        else if($payment == "Transfer")
        {
            $acc = mysqli_query($con, "UPDATE pembayaran_tenor SET status_bayar='Sudah' WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");
            $acc .= mysqli_query($con, "UPDATE bukti_transfer_tenor SET status='Terima' WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");

            if($acc)
            {
                echo "oke";
            }
        }
    }
    else if($status == "Tolak")
    {
        if($payment == "Tunai")
        {
            $rej = mysqli_query($con, "UPDATE pembayaran_tenor SET pembayaran='', tanggal_bayar='' WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");

            if($rej)
            {
                echo "oke";
            }
        }
        else if($payment == "Transfer")
        {
            $rej = mysqli_query($con, "UPDATE pembayaran_tenor SET pembayaran='', tanggal_bayar='' WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");
            
            $rej .= mysqli_query($con, "DELETE FROM bukti_transfer_tenor WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");
            $rej .= mysqli_query($con, "ALTER TABLE bukti_transfer_tenor AUTO_INCREMENT=1");

            $sql = mysqli_query($con, "SELECT bukti FROM bukti_transfer_tenor WHERE id_transaksi='$id' AND pembayaran_ke='$pembayaran_ke'");
            $b = mysqli_fetch_object($sql);

            if(file_exists("../../../img/bukti_transfer/".$b->bukti))
            {
                unlink("../../../img/bukti_transfer/".$b->bukti);
            }


            if($rej)
            {
                echo "oke";
            }
        }
    }
?>