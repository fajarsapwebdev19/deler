<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php require 'template/title.php'; echo $title; ?></title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="assets/ui-form-login/css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="assets/ui-form-login/fonts/font-awesome-5/css/fontawesome-all.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="assets/ui-form-login/css/style.css"/>
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
            }
        });

        //login on click
        $(document).ready(function() {
            $('#login').on('click', function(){
                // get data in form login
                var data = $('.form-detail').serialize();

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
    </script>
</body>
</html>