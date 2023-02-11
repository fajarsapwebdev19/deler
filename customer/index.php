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

        
    </script>


    
</body>

</html>