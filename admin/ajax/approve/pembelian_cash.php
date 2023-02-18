<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pembayaran = mysqli_real_escape_string($con, $_POST['pembayaran']);
    $status = mysqli_real_escape_string($con, $_POST['status']);


    if($pembayaran == "Tunai")
    {
        if($status == "Terima")
        {
            $terima = mysqli_query($con, "UPDATE transaksi_cash SET status='Paid' WHERE id='$id'");

            if($terima)
            {
                echo "success";
            }
        }
        else if($status == "Tolak")
        {
            $tolak = mysqli_query($con, "UPDATE transaksi_cash SET status='Unpaid' WHERE id='$id'");

            $q = mysqli_query($con, "SELECT * FROM transaksi_cash WHERE id='$id'");
            $tc = mysqli_fetch_object($q);

            $idm = $tc->id_motor;

            $mtr = mysqli_query($con, "SELECT stok FROM motor WHERE id='$idm'");
            $m = mysqli_fetch_object($mtr);

            $stok = $m->stok + 1;

            $tolak .= mysqli_query($con, "UPDATE motor SET stok='$stok' WHERE id='$idm'");

            if($tolak)
            {
                echo "success";
            }
        }
    }
    else if($pembayaran == "Transfer")
    {
        if($status == "Terima")
        {
            $terima = mysqli_query($con, "UPDATE transaksi_cash SET status='Paid' WHERE id='$id'");
            $terima .= mysqli_query($con, "UPDATE bukti_transfer_cash SET status_verifikasi='Terima' WHERE id_transaksi='$id'");

            if($terima)
            {
                echo "success";
            }
        }
        else if($status == "Tolak")
        {
            $tolak = mysqli_query($con, "UPDATE transaksi_cash SET status='Unpaid' WHERE id='$id'");
            $tolak .= mysqli_query($con, "UPDATE bukti_transfer_cash SET status_verifikasi='Tolak' WHERE id_transaksi='$id'");

            $q = mysqli_query($con, "SELECT * FROM transaksi_cash WHERE id='$id'");
            $tc = mysqli_fetch_object($q);

            $idm = $tc->id_motor;

            $mtr = mysqli_query($con, "SELECT stok FROM motor WHERE id='$idm'");
            $m = mysqli_fetch_object($mtr);

            $stok = $m->stok + 1;

            $tolak .= mysqli_query($con, "UPDATE motor SET stok='$stok' WHERE id='$idm'");

            $tolak .= mysqli_query($con, "DELETE FROM bukti_transfer_cash WHERE id_transaksi='$id'");

            

            if($tolak)
            {
                echo "success";
            }
        }
    }
?>