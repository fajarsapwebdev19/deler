<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $uang_tenor = mysqli_real_escape_string($con, $_POST['uang_tenor']);
    $payment = mysqli_real_escape_string($con, $_POST['payment']);
    $tenor = mysqli_real_escape_string($con, $_POST['tenor']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // verifikasi pembayaran tunai
    if($payment == "Tunai")
    {
        if($status == "Terima")
        {
            $no=1;
            for($i=0; $i<$tenor; $i++)
            {
                $pembelian = $no++;
                $verif = mysqli_query($con, "INSERT INTO pembayaran_tenor (id, id_transaksi, tenor, uang_tenor, pembayaran_ke,pembayaraan, tanggal_bayar, status_bayar) VALUES (NULL,'$id', '$tenor', '$uang_tenor', '$pembelian',NULL, NULL, 'Belum')");
            }

            $verif .= mysqli_query($con, "UPDATE transaksi_kredit SET uang_tenor='$uang_tenor', status='Terima' WHERE id='$id'");

            if($verif)
            {
                echo "success";
            }
        }
        else if($status == "Tolak")
        {
            $verif = mysqli_query($con, "UPDATE transaksi_kredit SET status='Tolak' WHERE id='$id'");

            if($verif)
            {
                echo "success";
            }
        }
    }
    else if($payment == "Transfer")
    {
        if($status == "Terima")
        {
            $no=1;
            for($i=0; $i<$tenor; $i++)
            {
                $pembelian = $no++;
                $verif = mysqli_query($con, "INSERT INTO pembayaran_tenor (id, id_transaksi, tenor, uang_tenor, pembayaran_ke, pembayaran, tanggal_bayar, status_bayar) VALUES (NULL,'$id', '$tenor', '$uang_tenor', '$pembelian', NULL,NULL, 'Belum')");
            }

            $verif .= mysqli_query($con, "UPDATE transaksi_kredit SET uang_tenor='$uang_tenor', status='Terima' WHERE id='$id'");

            $verif .= mysqli_query($con, "UPDATE bukti_transfer_kredit SET status_verifikasi='Terima' WHERE id_transaksi='$id'");

            $q = mysqli_query($con, "SELECT * FROM transaksi_kredit WHERE id='$id'");
            $tc = mysqli_fetch_object($q);

            $idm = $tc->id_motor;

            $mtr = mysqli_query($con, "SELECT stok FROM motor WHERE id='$idm'");
            $m = mysqli_fetch_object($mtr);

            $stok = $m->stok + 1;

            $verif .= mysqli_query($con, "UPDATE motor SET stok='$stok' WHERE id='$idm'");

            if($verif)
            {
                echo "success";
            }
        }
        else if($status == "Tolak")
        {
            $verif = mysqli_query($con, "UPDATE transaksi_kredit SET status='Tolak' WHERE id='$id'");

            $verif .= mysqli_query($con, "UPDATE bukti_transfer_kredit SET status_verifikasi='Tolak' WHERE id_transaksi='$id'");

            $q = mysqli_query($con, "SELECT * FROM transaksi_kredit WHERE id='$id'");
            $tc = mysqli_fetch_object($q);

            $idm = $tc->id_motor;

            $mtr = mysqli_query($con, "SELECT stok FROM motor WHERE id='$idm'");
            $m = mysqli_fetch_object($mtr);

            $stok = $m->stok + 1;

            $verif .= mysqli_query($con, "UPDATE motor SET stok='$stok' WHERE id='$idm'");

            $btc = mysqli_query($con, "SELECT bukti FROM bukti_transfer_kredit WHERE id_transaksi='$id'");

            $btcs = mysqli_fetch_object($btc);

            if(file_exists("../../../img/bukti_transfer/".$btcs->bukti))
            {
                unlink("../../../img/bukti_transfer/".$btcs->bukti);
            }

            $verif .= mysqli_query($con, "DELETE FROM bukti_transfer_kredit WHERE id_transaksi='$id'");

            $verif .= mysqli_query($con, "ALTER TABLE transaksi_kredit AUTO_INCREMENT=1");

            if($verif)
            {
                echo "success";
            }
        }
    }
?>