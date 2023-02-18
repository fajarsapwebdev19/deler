<?php
session_start();
require '../database_connect.php';
if (empty($_SESSION['token'])) {
    $_SESSION['val'] = '<div class="error-message">
            Your Token Invalid !
        </div>';
    header("location: .././");
} else {
    $username = $_SESSION['username'];
    $query = mysqli_query($con, "SELECT * FROM user JOIN personal_data ON user.personal_id = personal_data.id JOIN role ON user.role_id = role.id WHERE user.username='$username'");

    $data_user = mysqli_fetch_object($query);

    if($data_user->role_id != 2)
    {
        ?>
            <script>
                alert("Role Anda Bukan Customer");
                window.location='../admin/';
            </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/ui-form-login/fonts/font-awesome-5/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fw5/css/all.min.css">
    <style>
        .card {
            text-decoration: none;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        body{
            padding-top: 80px;
        }

        #pay-kredit:hover{
            color: #111 !important;
            cursor:pointer;
        }
    </style>
</head>

<body>
    <?php require 'template/navbar.php'; ?>

    <div class="wrap">
    <?php require 'template/page.php'; ?>
    </div>

    <script src="../assets/jquery-3.6.3.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#motor').load('ajax/data/motor.php');

        $('#motor').on('click', '.buy', function(){
            var id = $(this).data('id');

            $.ajax({
                url: 'ajax/transaksi-method.php',
                data: {id:id},
                type: 'post',
                success:function(t)
                {
                    $('#transaction').modal('show');
                    $('#detail').html(t);
                    $('.ajukan').prop("disabled", true);
                }
            });
        });

        $('#detail').on('click', '#cash', function(){
            $('.ajukan').prop("disabled", false);
            $('.um').removeAttr("name");
            $('.tn').removeAttr("name");
            $('#kredit_payment').hide();
            $('#payment').show();
        });

        $('#detail').on('click', '#kredit', function(){
            $('.ajukan').prop("disabled", false);
            $('.um').prop("name", "uang_muka");
            $('.tn').prop("name", "tenor");
            $('#kredit_payment').show();
            $('#payment').show();
        });

        $('#detail').on('click', '.pm:checked', function(){
            var payment = $('.pm:checked').val();

            if(payment == "Transfer")
            {
                $('#transfer_method').show();
                $('.btf').prop("name", "bukti");
            }else{
                $('#transfer_method').hide();
                $('.btf').prop("name", "");
            }
        });

        $('#detail').on('click', '.ajukan', function() 
        {
            var form = $('#detail')[0];
            var data = new FormData(form);
            var pay = $('.pm:checked').val();
            
            if(pay == undefined)
            {
                $('#msg').show();
                $('#msg').html("Silahkan Pilih Pembayaran Terlebih Dahulu");
                $('#msg').addClass("alert alert-danger bg-danger text-white");
                $('#msg').delay(2000).fadeOut();
            }
            else
            {
                $('#msg').hide();

                $.ajax({
                    url: 'ajax/transaksi.php',
                    data: data,
                    type: 'post',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success:function(respond)
                    {
                        if(respond == "success")
                        {
                            $('#message').show();
                            $('#message').html("Berhasil Melakukan Pengajuan !");
                            $('#message').addClass("alert alert-success bg-success text-white");
                            $('#motor').load('ajax/data/motor.php');
                            $('#transaction').modal('hide');
                        }
                        else if(respond == "null")
                        {
                            $('#msg').show();
                            $('#msg').html("Anda Belum Memasukan File Bukti");
                            $('#msg').removeClass("alert alert-success bg-success text-white mt-2");
                            $('#msg').removeClass("alert alert-warning bg-warning text-dark mt-2");
                            $('#msg').addClass("alert alert-danger bg-danger text-white mt-2");
                            $('#msg').delay(2000).fadeOut('slow');
                        }
                        else if(respond == "maxsize")
                        {
                            $('#msg').show();
                            $('#msg').html("Ukuran File Terlalu Besar Maximal 3 MB");
                            $('#msg').removeClass("alert alert-success bg-success text-white mt-2");
                            $('#msg').removeClass("alert alert-warning bg-warning text-dark mt-2");
                            $('#msg').addClass("alert alert-danger bg-danger text-white mt-2");
                            $('#msg').delay(2000).fadeOut('slow');
                        }
                        else if(respond == "extensionnotallowed")
                        {
                            $('#msg').show();
                            $('#msg').html("Ekstensi File Tidak Diizinkan");
                            $('#msg').removeClass("alert alert-success bg-success text-white mt-2");
                            $('#msg').removeClass("alert alert-danger bg-danger text-white mt-2");
                            $('#msg').addClass("alert alert-warning bg-warning text-dark mt-2");
                            $('#msg').delay(2000).fadeOut('slow');
                        }
                    }
                })
            }
        })

        $('#tkredit').on('click', '.pay', function(){
            var id = $(this).data("id");

            $.ajax({
                url: 'ajax/method_pembayaran_tenor.php',
                data: {id:id},
                type: 'post',
                success:function(r)
                {
                    $('#bayar-tenor').modal('show');
                    $('#pay').html(r);
                }
            })
        })

        $('#pay').on('click', '#pay-kredit', function(){
            var id = $(this).data("id");

            $.ajax({
                url: 'ajax/payment_kredit.php',
                data: {id:id},
                type: 'post',
                success:function(r)
                {
                    $('#bayar').modal('show');
                    $('#form-bayar').html(r);
                }
            })
        })

        $('#form-bayar').on('click', '.via-pay', function(){
            var value = $('.via-pay:checked').val();

            if(value == "Transfer")
            {
                $('#transfer-method').show();
            }else{
                $('#transfer-method').hide();
            }
        })

        $('#form-bayar').on('click', '.bayar', function(){
            var value = $('.via-pay:checked').val();

            $('.msg').delay(5000).fadeOut('slow');

            if(value == undefined)
            {
                $('.msg').show();
                $('.msg').html("Pilih Via Pembayaran Terlebih Dahulu");
                $('.msg').removeClass("alert-success bg-success text-white");
                $('.msg').removeClass("alert-warning bg-warning text-dark");
                $('.msg').addClass("alert alert-danger bg-danger text-white");
            }else{
                $('.msg').hide();

                var form = $('#form-bayar')[0];
                var data = new FormData(form);

                $.ajax({
                    url: 'ajax/proses-bayar.php',
                    type: 'post',
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success:function(message)
                    {
                        if(message == "berhasil")
                        {
                            $('.message').show();
                            $('.message').html("Berhasil Melakukan Pembayaran Tenor. Silahkan Tunggu Konfirmasi Dari Admin");
                            $('.message').removeClass("alert-danger bg-danger text-white");
                            $('.message').removeClass("alert-warning bg-warning text-dark");
                            $('.message').addClass("alert alert-success bg-success text-white");
                            $('.message').delay(5000).fadeOut('slow');
                            $('#bayar').modal('hide');
                            $('#bayar-tenor').modal('hide');
                        }
                        else if(message == "null")
                        {
                            $('.msg').show();
                            $('.msg').html("Bukti Transfer Belum di Upload");
                            $('.msg').removeClass("alert-success bg-success text-white");
                            $('.msg').removeClass("alert-warning bg-warning text-dark");
                            $('.msg').addClass("alert alert-danger bg-danger text-white");
                        }
                        else if(message == "maxsize")
                        {
                            $('.msg').show();
                            $('.msg').html("Ukuran File Anda Melebihi 2 MB");
                            $('.msg').removeClass("alert-success bg-success text-white");
                            $('.msg').removeClass("alert-warning bg-warning text-dark");
                            $('.msg').addClass("alert alert-danger bg-danger text-white");
                        }
                        else if(message == "extensionnotallow")
                        {
                            $('.msg').show();
                            $('.msg').html("Ekstensi File Anda Tidak Di Izinkan");
                            $('.msg').removeClass("alert-success bg-success text-white");
                            $('.msg').removeClass("alert-danger bg-danger text-white");
                            $('.msg').addClass("alert alert-warning bg-warning text-dark");
                        }
                        
                    }
                })
            }
        })

        // tombol untuk print

        // invoice pembelian cash
        $('#tcash').on('click', '.print-invoice-cash', function(){
            var id = $(this).data("id");

            window.open("print/print-invoice-cash.php?id="+id, '_blank');
        });

        // invoice pembelian kredit
        $('#tkredit').on('click', '.print-invoice-kredit', function(){
            var id = $(this).data("id");

            window.open("print/print-invoice-kredit.php?id="+id, '_blank');
        })

        // profile

        // view data profile
        $('#frm-profile').load("ajax/update-profile.php");
        
        $('#frm-profile').on('click', '.ubah-data', function(){
            var data =  $('#frm-profile').serialize();

            $.ajax({
                url: "ajax/profile.php",
                data: data,
                type: "post",
                success:function(r)
                {
                    if(r == "kosong")
                    {
                        $("#message").show();
                        $("#message").removeClass("alert-success bg-success text-white");
                        $("#message").addClass("alert alert-danger bg-danger text-white");
                        $("#message").html("Jangan Ada Yang Kosong !");
                        $('#message').delay(5000).fadeOut('slow');
                    }else if(r == "sukses")
                    {
                        $("#message").show();
                        $("#message").removeClass("alert-danger bg-danger text-white");
                        $("#message").addClass("alert alert-success bg-success text-white");
                        $("#message").html("Berhasil Ubah Data !");
                        $('#message').delay(5000).fadeOut('slow');
                        $('#frm-profile').load("ajax/method/update-profile.php");
                        $(window).scrollTop(0);
                    }
                }
            })
        })

        $('#update-pass').on('click', function(){
            var id = $(this).data("id");

            $.ajax({
                url: 'ajax/update-password.php',
                data: {id:id},
                type: 'post',
                success:function(r)
                {
                    $('#up-pass').modal('show');
                    $('#up-psw').html(r);
                }
            })
        })

        $('#up-psw').on('click', '.pl', function(){
            var paslam = $('.pwl').attr('type');

            if(paslam === "password")
            {
                $('.pwl').attr("type", "text");
                $('#icon-pw-lm').removeClass("fa-eye");
                $('#icon-pw-lm').addClass("fa-eye-slash");
            }else{
                $('.pwl').attr("type", "password");
                $('#icon-pw-lm').removeClass("fa-eye-slash");
                $('#icon-pw-lm').addClass("fa-eye");
            }
        });

        $('#up-psw').on('click', '.pb', function(){
            var pasbar = $('.pwb').attr("type");

            if(pasbar === "password")
            {
                $('.pwb').attr("type", "text");
                $('#icon-pw-br').removeClass("fa-eye");
                $('#icon-pw-br').addClass("fa-eye-slash");
            }else{
                $('.pwb').attr("type", "password");
                $('#icon-pw-br').removeClass("fa-eye-slash");
                $('#icon-pw-br').addClass("fa-eye");
            }
        });

        $('#up-psw').on('click', '.kpb', function(){
            var konpasbar = $('.kpwb').attr("type");

            if(konpasbar === "password")
            {
                $('.kpwb').attr("type", "text");
                $('#icon-kn-pw').removeClass("fa-eye");
                $('#icon-kn-pw').addClass("fa-eye-slash");
            }else{
                $('.kpwb').attr("type", "password");
                $('#icon-kn-pw').removeClass("fa-eye-slash");
                $('#icon-kn-pw').addClass("fa-eye");
            }
        });

        $('#up-psw').on('click', '.up-pass', function(){
            var id_user = $('#id_user').val();
            var pass_lama = $('.pwl').val();
            var pass_baru = $('.pwb').val();
            var kon_pass_baru = $('.kpwb').val();

            if(pass_lama == "")
            {
                $("#msg").show();
                $("#msg").removeClass("alert-success bg-success text-white");
                $("#msg").addClass("alert alert-danger bg-danger text-white");
                $("#msg").html("Password Lama Kosong");
                $('#msg').delay(5000).fadeOut('slow');
            }else{
                if(pass_baru == "")
                {
                    $("#msg").show();
                    $("#msg").removeClass("alert-success bg-success text-white");
                    $("#msg").addClass("alert alert-danger bg-danger text-white");
                    $("#msg").html("Password Baru Kosong");
                    $('#msg').delay(5000).fadeOut('slow');
                }
                else{
                    if(kon_pass_baru == "")
                    {
                        $("#msg").show();
                        $("#msg").removeClass("alert-success bg-success text-white");
                        $("#msg").addClass("alert alert-danger bg-danger text-white");
                        $("#msg").html("Konfirmasi Password Baru Kosong");
                        $('#msg').delay(5000).fadeOut('slow');
                    }else{
                        if(pass_baru != kon_pass_baru)
                        {
                            $("#msg").show();
                            $("#msg").removeClass("alert-success bg-success text-white");
                            $("#msg").addClass("alert alert-danger bg-danger text-white");
                            $("#msg").html("Konfimasi Password Baru Tidak Sama");
                            $('#msg').delay(5000).fadeOut('slow');
                        }else{
                            var data = "id="+id_user+"&passlama="+pass_lama+"&passbaru="+pass_baru+"&konpassbaru="+kon_pass_baru;

                            $.ajax({
                                url: 'ajax/password.php',
                                data: data,
                                type: "post",
                                success:function(r)
                                {
                                    if(r == "passlamainvalid")
                                    {
                                        $("#msg").show();
                                        $("#msg").removeClass("alert-success bg-success text-white");
                                        $("#msg").addClass("alert alert-danger bg-danger text-white");
                                        $("#msg").html("Password Lama Salah");
                                        $('#msg').delay(5000).fadeOut('slow');
                                    }else if(r == "sukses")
                                    {
                                        $("#message").show();
                                        $("#message").removeClass("alert-danger bg-danger text-white");
                                        $("#message").addClass("alert alert-success bg-success text-white");
                                        $("#message").html("Berhasil Ubah Password");
                                        $('#message').delay(5000).fadeOut('slow');
                                        $('#up-pass').modal('hide');
                                        $('#up-psw')[0].reset;
                                    }
                                }
                            })
                        }
                    }
                }
            }
        })

        
    </script>


    
</body>

</html>