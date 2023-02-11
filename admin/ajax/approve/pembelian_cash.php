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

            if($tolak)
            {
                echo "success";
            }
        }
    }
?>