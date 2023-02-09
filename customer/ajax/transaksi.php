<?php
    require '../../database_connect.php';

    $pembelian = mysqli_real_escape_string($con, $_POST['pembelian']);
    $id_motor = mysqli_real_escape_string($con, $_POST['id_motor']);
    // ambil data motor untuk pengurangan stok
    $query = mysqli_query($con, "SELECT * FROM motor WHERE id='$id_motor'");
    $motor = mysqli_fetch_object($query);

    if($pembelian == "Cash")
    {
        $id_user = mysqli_real_escape_string($con, $_POST['id_user']);
        $id_motor = mysqli_real_escape_string($con, $_POST['id_motor']);
        $payment_method = mysqli_real_escape_string($con, $_POST['payment_method']);

        if($payment_method == "Tunai")
        {
            $stok = $motor->stok;
            $pengurangan = $stok - 1;
            $tanggal_beli = date('Y-m-d H:i:s');

            $get = mysqli_query($con, "SELECT max(id) AS id_transaksi FROM transaksi_cash");
            $tid = mysqli_fetch_object($get);

            $idt = $tid->id_transaksi + 1;
            
            $bayar = mysqli_query($con, "INSERT INTO transaksi_cash (id,id_user,id_motor,tanggal_pembelian,pembayaran,status) VALUES ('$idt', '$id_user', '$id_motor', '$tanggal_beli', 'Tunai', NULL)");

            $bayar .= mysqli_query($con, "UPDATE motor SET stok='$pengurangan' WHERE id='$id_motor'");

            if($bayar)
            {
                echo "success";
            }
        }
        else if($payment_method == "Transfer")
        {
            $bukti = mt_rand().'__'.$_FILES['bukti']['name'];
            $tmp = $_FILES['bukti']['tmp_name'];
            $size = $_FILES['bukti']['size'];
            $ex = pathinfo($bukti, PATHINFO_EXTENSION);
            $extension = array('jpg', 'jpeg', 'png');

            if(empty($_FILES['bukti']['name']))
            {
                echo "null";
            }
            else
            {
                if($size > 3000000)
                {
                    echo "maxsize";
                }
                else
                {
                    if(!in_array($ex, $extension))
                    {
                        echo "extensionnotallowed";
                    }
                    else
                    {
                        $dir = "../../img/bukti_transfer/".$bukti;

                        move_uploaded_file($tmp, $dir);

                        // get value id by table transaksi
                        $get = mysqli_query($con, "SELECT max(id) AS id_transaksi FROM transaksi_cash");
                        $tid = mysqli_fetch_object($get);

                        $idt = $tid->id_transaksi + 1;

                        // pengurangan stok motor
                        $stok = $motor->stok;
                        $pengurangan = $stok - 1;
                        $tanggal_beli = date('Y-m-d H:i:s');

                        // add transaksi_cash
                        $bayar = mysqli_query($con, "INSERT INTO transaksi_cash (id,id_user,id_motor,tanggal_pembelian,pembayaran,status) VALUES ('$idt', '$id_user', '$id_motor', '$tanggal_beli', 'Transfer', NULL)");

                        $bayar .= mysqli_query($con, "UPDATE motor SET stok='$pengurangan' WHERE id='$id_motor'");
                        
                        
                        $jumlah_bayar = $motor->harga;

                        $time = date('Y-m-d H:i:s');

                        // add bukti transfer to table bukti_transfer_cash
                        $bayar .= mysqli_query($con, "INSERT INTO bukti_transfer_cash (id,id_transaksi,jumlah_bayar,keterangan, status_verifikasi, time_payment, bukti) VALUES (NULL, '$idt', '$jumlah_bayar', 'Pembayaran Motor Cash', 'Antrian', '$time', '$bukti')");

                        if($bayar)
                        {
                            echo "success";
                        }
                    }
                }
            }
        }
    }
    else if($pembelian == "Kredit")
    {
        $id_user = mysqli_real_escape_string($con, $_POST['id_user']);
        $id_motor = mysqli_real_escape_string($con, $_POST['id_motor']);
        $uang_muka = mysqli_real_escape_string($con, $_POST['uang_muka']);
        $tenor = mysqli_real_escape_string($con, $_POST['tenor']);
        $payment_method = mysqli_real_escape_string($con, $_POST['payment_method']);

        if($payment_method == "Tunai")
        {
            // ambil id transaksi kredit
            $id_transaksi = mysqli_query($con, "SELECT max(id) AS id_transaksi FROM transaksi_kredit");
            $tkredit = mysqli_fetch_object($id_transaksi);
            $idt = $tkredit->id_transaksi + 1;
            $date = date('Y-m-d H:i:s');

            // tambah data transaksi kredit
            $bayar = mysqli_query($con, "INSERT INTO transaksi_kredit (id,id_user,id_motor,uang_muka,tenor,uang_tenor,tanggal_beli,pembayaran,status,status_lunas) VALUE ('$idt', '$id_user', '$id_motor', '$uang_muka', '$tenor', NULL, '$date', 'Tunai', 'Antrian', 'Belum')");
            
            $stok = $motor->stok;
            $pengurangan = $stok - 1;

            $id_motor = mysqli_real_escape_string($con, $_POST['id_motor']);

            $bayar .= mysqli_query($con, "UPDATE motor SET stok='$pengurangan' WHERE id='$id_motor'");

            if($bayar)
            {
                echo "success";
            }
        }
        else if($payment_method == "Transfer")
        {
            $bukti = mt_rand().'___'.$_FILES['bukti']['name'];
            $tmp = $_FILES['bukti']['tmp_name'];
            $size = $_FILES['bukti']['size'];
            $ex = pathinfo($bukti, PATHINFO_EXTENSION);
            $extension = array('jpg','jpeg','png');

            if(empty($_FILES['bukti']['name']))
            {
                echo "null";
            }
            else
            {
                if($size > 3000000)
                {
                    echo "maxsize";
                }
                else
                {
                    if(!in_array($ex, $extension))
                    {
                        echo "extensionnotallowed";
                    }
                    else
                    {
                        $dir = "../../img/bukti_transfer/".$bukti;

                        // ambil id transaksi kredit
                        $id_transaksi = mysqli_query($con, "SELECT max(id) AS id_transaksi FROM transaksi_kredit");
                        $tkredit = mysqli_fetch_object($id_transaksi);
                        $idt = $tkredit->id_transaksi + 1;
                        $date = date('Y-m-d H:i:s');

                        // tambah data transaksi kredit
                        $bayar = mysqli_query($con, "INSERT INTO transaksi_kredit (id,id_user,id_motor,uang_muka,tenor,uang_tenor,tanggal_beli,pembayaran,status,status_lunas) VALUE ('$idt', '$id_user', '$id_motor', '$uang_muka', '$tenor', NULL, '$date', 'Transfer', 'Antrian', 'Belum')");

                        // tambah data bukti_transfer_kredit
                        $bayar .= mysqli_query($con, "INSERT INTO bukti_transfer_kredit (id,id_transaksi,jumlah_bayar,keterangan,status_verifikasi,time_payment,bukti) VALUES (NULL, '$idt', '$uang_muka', 'Bayar Uang Muka', 'Antrian', '$date', '$bukti')");
                        
                        $stok = $motor->stok;
                        $pengurangan = $stok - 1;

                        $id_motor = mysqli_real_escape_string($con, $_POST['id_motor']);

                        $bayar .= mysqli_query($con, "UPDATE motor SET stok='$pengurangan' WHERE id='$id_motor'");

                        if($bayar)
                        {
                            move_uploaded_file($tmp, $dir);
                            echo "success";
                        }
                    }
                }
            }
        }
    }
?>