<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php require 'template/title.php'; echo $title; ?></title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="assets/ui-form-login/css/roboto-font.css">

    <link rel="stylesheet" href="assets/fw5/css/all.min.css">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="assets/ui-form-login/css/style.css"/>
    <style>
        .text-center{
            text-align: center;
        }

        .card{
            padding:10px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .form-control-lg{
            font-size: 18px;
        }
    </style>
</head>
<body class="form-v5">
	<div class="page-content">
		<?php require 'template/page.php'; ?>
	</div>

    <script src="assets/jquery-3.6.3.min.js"></script>

    <script>
        // enter to login
        $(document).on('keypress', function(e){
            if(e.which == 13)
            {
                $('#login').trigger("click");
                $('.regis').trigger("click");
            }
        });

        //login on click
        $(document).ready(function() {
            $('#login').on('click', function(){
                // get data in form login
                var data = $('#login-form').serialize();

               $.ajax({
                    url: 'ajax/proses-login.php',
                    data: data,
                    type: 'post',
                    success:function(response)
                    {
                        if(response == "kosong")
                        {
                            $('#pesan').show();
                            $('#pesan').addClass("error-message");
                            $('#pesan').removeClass('success-message');
                            $('#pesan').html("Masukan Username Dan Password");
                            $('.error-message').delay(5000).fadeOut('slow');
                        }
                        else if(response == "unameinvalid")
                        {
                            $('#pesan').show();
                            $('#pesan').addClass("error-message");
                            $('#pesan').removeClass('success-message');
                            $('#pesan').html("Username Invalid");
                            $('.error-message').delay(5000).fadeOut('slow');
                        }
                        else if(response == "passinvalid")
                        {
                            $('#pesan').show();
                            $('#pesan').addClass("error-message");
                            $('#pesan').removeClass('success-message');
                            $('#pesan').html("Password Invalid");
                            $('.error-message').delay(5000).fadeOut('slow');
                        }
                        else if(response == "noactive")
                        {
                            $('#pesan').show();
                            $('#pesan').addClass("error-message");
                            $('#pesan').removeClass('success-message');
                            $('#pesan').html("Nonactive Your Account");
                            $('.error-message').delay(5000).fadeOut('slow');
                        }
                        else if(response == "validadmin")
                        {
                            $('#pesan').show();
                            $('#pesan').addClass("success-message");
                            $('#pesan').removeClass('error-message');
                            $('#pesan').html("Login Success");
                            setTimeout(function() {
                                window.location.href = "admin";
                            }, 500);
                            $('.success-message').delay(5000).fadeOut('slow');
                        }
                        else if(response == "validuser")
                        {
                            $('#pesan').show();
                            $('#pesan').addClass("success-message");
                            $('#pesan').removeClass('error-message');
                            $('#pesan').html("Login Success");
                            setTimeout(function() {
                                window.location.href = "customer";
                            }, 500);
                            $('.success-message').delay(5000).fadeOut('slow');
                        }
                    }
               });
            });
        });

        // fade out 5 seconds in message
        $('.error-message').delay(5000).fadeOut('slow');
        $('.success-message').delay(5000).fadeOut('slow');

        $('#form-regis').on('click', '.shpw', function(){
            $('.pwicon').removeClass("fa-eye");
            $('.shpw').prop("class", "hdpw");
            $('.pwicon').addClass("fa-eye-slash");
            $('#password').prop("type", "text");
        });

        $('#form-regis').on('click', '.hdpw', function(){
            $('.pwicon').removeClass("fa-eye-slash");
            $('.hdpw').prop("class", "shpw");
            $('.pwicon').addClass("fa-eye");
            $('#password').prop("type", "password");
        });

        $('#login-form').on('click', '.shpw', function(){
            $('.pwicon').removeClass("fa-eye");
            $('.shpw').prop("class", "hdpw");
            $('.pwicon').addClass("fa-eye-slash");
            $('#password').prop("type", "text");
        });

        $('#login-form').on('click', '.hdpw', function(){
            $('.pwicon').removeClass("fa-eye-slash");
            $('.hdpw').prop("class", "shpw");
            $('.pwicon').addClass("fa-eye");
            $('#password').prop("type", "password");
        });

        $('#form-regis').on('click', '.regis', function(e){
            var data = $('#form-regis').serialize();
            e.preventDefault();
            
            $.ajax({
                url: 'ajax/register.php',
                data:data,
                type: 'post',
                success:function(r)
                {
                    if(r == "kosong")
                    {
                        $('#pesan').show();
                        $('#pesan').html("Silahkan Lengkapi Data");
                        $('#pesan').removeClass("alert-success bg-success text-white");
                        $('#pesan').addClass("alert alert-danger bg-danger text-white");
                        $('#pesan').delay(5000).fadeOut('slow');
                        $(window).scrollTop('slow');
                    }
                    else if(r == "nikduplicate")
                    {
                        $('#pesan').show();
                        $('#pesan').html("NIK anda sudah digunakan !");
                        $('#pesan').removeClass("alert-success bg-success text-white");
                        $('#pesan').addClass("alert alert-danger bg-danger text-white");
                        $('#pesan').delay(5000).fadeOut('slow');
                        $(window).scrollTop('slow');
                    }
                    else if(r == "telpduplicat")
                    {
                        $('#pesan').show();
                        $('#pesan').html("Nomor Telpon anda sudah digunakan !");
                        $('#pesan').removeClass("alert-success bg-success text-white");
                        $('#pesan').addClass("alert alert-danger bg-danger text-white");
                        $('#pesan').delay(5000).fadeOut('slow');
                        $(window).scrollTop('slow');
                    }
                    else if(r == "usernameduplicat")
                    {
                        $('#pesan').show();
                        $('#pesan').html("Username sudah digunakan !");
                        $('#pesan').removeClass("alert-success bg-success text-white");
                        $('#pesan').addClass("alert alert-danger bg-danger text-white");
                        $('#pesan').delay(5000).fadeOut('slow');
                        $(window).scrollTop('slow');
                    }else{
                        $('#pesan').show();
                        $('#pesan').html("Berhasil ! Silahkan Info Admin Untuk Aktivasi Akun Anda");
                        $('#pesan').removeClass("alert-danger bg-danger text-white");
                        $('#pesan').addClass("alert alert-success bg-success text-white");
                        $('#pesan').delay(5000).fadeOut('slow');
                        $('#form-regis')[0].reset();
                        $(window).scrollTop('slow');
                    }
                }
            })
        })
    </script>
</body>
</html>