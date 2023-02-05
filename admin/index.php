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

    $data = mysqli_fetch_object($query);
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
    <style>
        .card {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php require 'template/navbar.php'; ?>

    <?php require 'template/page.php'; ?>

    <script src="../assets/jquery-3.6.3.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script>
        $('.account').load("ajax/data/account.php");
        // on click button tambah akun
        $('.tambah-admin').on('click', function() {
            $('#tambah-akun-admin').modal('show');
        });

        // on click button batal
        $('#form-tambah-akun').on('click', '.reset', function() {
            $('#tambah-akun-admin').modal('hide');
            $('.form-control').val(null);
            $('.form-check-input').prop('checked', false);
        });

        // on click tambah on tambah admin
        $('#form-tambah-akun').on('click', '.tambah', function() {
            var data = $('#form-tambah-akun').serialize();

            $.ajax({
                url: 'ajax/tambah/akun-admin.php',
                data: data,
                type: 'post',
                success: function(response) {
                    if (response == "valueinvalid") {
                        $('#message').show();
                        $('#message').removeClass("alert alert-success bg-success text-white mt-2");
                        $('#message').addClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').html("Masukan Data Secara Lengkap !");
                        $('#tambah-akun-admin').modal('hide');
                        $('.account').load("ajax/data/account.php");
                        setTimeout(function() {
                            $('#message').slideUp('slow');
                        }, 3500)
                    } else if (response == "valid") {
                        $('#message').show();
                        $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').addClass("alert alert-success bg-success text-white mt-2");
                        $('#message').html("Tambah Admin Berhasil");
                        $('.form-control').val(null);
                        $('.form-check-input').prop('checked', false);
                        $('#tambah-akun-admin').modal('hide');
                        $('.account').load("ajax/data/account.php");
                        setTimeout(function() {
                            $('#message').slideUp('slow');
                        }, 3500)
                    }
                }
            });
        });

        // on click button delete in account
        $('.account').on('click', '.delete', function() {
            var id = $(this).data("id");

            $.ajax({
                url: 'ajax/method/delete-account.php',
                data: {
                    id: id
                },
                type: 'post',
                success: function(response) {
                    $('#delete').modal('show');
                    $('#action-delete').html(response);
                }
            });
        });

        // on click button batal in action delete account
        $('#action-delete').on('click', '.batal', function() {
            setTimeout(function() {
                $('#delete').slideUp("fast").modal('hide');
            }, 1000)
        });

        // on click button hapus in action delete account
        $('#action-delete').on('click', '.hapus', function() {
            var id = $('#id_user').val();

            $.ajax({
                url: 'ajax/hapus/account.php',
                data: {
                    id: id
                },
                type: 'post',
                success: function(response) {
                    $('#message').show();
                    $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                    $('#message').addClass("alert alert-success bg-success text-white mt-2");
                    $('#message').html("Berhasil Hapus Data");
                    $('#delete').modal('hide');
                    $('.account').load('ajax/data/account.php');
                    setTimeout(function() {
                        $('#message').slideUp('slow');
                    }, 3500)
                }
            });
        });

        // on click edit button in account
        $('.account').on('click', '.edit', function() {
            var id = $(this).data("id");

            $.ajax({
                url: 'ajax/method/update-account.php',
                data: {
                    id: id
                },
                type: 'post',
                success: function(response) {
                    $('#update').modal('show');
                    $('#action-edit').html(response);
                }
            });
        });

        // on click reset in action edit account
        $('#action-edit').on('click', '.reset', function() {
            $('#update').modal('hide');
        });

        // on click edit button in action edit account
        $('#action-edit').on('click', '.edit', function() {
            var data = $('#action-edit').serialize();

            $.ajax({
                url: 'ajax/edit/account.php',
                data: data,
                type: 'post',
                success: function(respond) {
                    if (respond == "success") {
                        $('#message').show();
                        $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').addClass("alert alert-success bg-success text-white mt-2");
                        $('#message').html("Data Berhasil Diubah");
                        $('.data').load('ajax/data/account.php');
                        $('#update').modal('hide');
                        setTimeout(function() {
                            $('#message').slideUp('slow');
                        }, 3500)
                    }
                }
            });
        });

        // on click button active or non active account
        $('.account').on('click', '.acnc', function() {
            var id = $(this).data("id");

            $.ajax({
                url: 'ajax/method/actvnonactaccount.php',
                data: {
                    id_user: id
                },
                type: 'post',
                success: function(response) {
                    $('#acnon').modal('show');
                    $('#action-acnon').html(response);
                }
            });
        });

        $('#action-acnon').on('click', '.nonactive', function() {
            var id_user = $('#user_id').val();
            $.ajax({
                url: 'ajax/method/aktivasiaccount.php',
                data: {
                    id_user: id_user,
                    method: 'nonactive'
                },
                type: 'post',
                success: function(response) {
                    if (response == "oke") {
                        $('#message').show();
                        $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').addClass("alert alert-success bg-success text-white mt-2");
                        $('#message').html("Berhasil Melakukan Nonaktifkan Akun");
                        $('#acnon').modal('hide');
                        $('.account').load('ajax/data/account.php');
                    } else {
                        $('#message').show();
                        $('#message').removeClass("alert alert-success bg-success text-white mt-2");
                        $('#message').addClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').html("Gagal");
                        $('#acnon').modal('hide');
                        $('.account').load('ajax/data/account.php');
                    }

                    setTimeout(function() {
                        $('#message').slideUp('slow');
                    }, 3000)
                }
            });
        });

        $('#action-acnon').on('click', '.active', function() {
            var id_user = $('#user_id').val();
            $.ajax({
                url: 'ajax/method/aktivasiaccount.php',
                data: {
                    id_user: id_user,
                    method: 'active'
                },
                type: 'post',
                success: function(response) {
                    if (response == "oke") {
                        $('#message').show();
                        $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').addClass("alert alert-success bg-success text-white mt-2");
                        $('#message').html("Berhasil Melakukan Aktifkan Akun");
                        $('#acnon').modal('hide');
                        $('.account').load('ajax/data/account.php');
                    } else {
                        $('#message').show();
                        $('#message').removeClass("alert alert-success bg-success text-white mt-2");
                        $('#message').addClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').html("Gagal");
                        $('#acnon').modal('hide');
                        $('.account').load('ajax/data/account.php');
                    }

                    setTimeout(function() {
                        $('#message').slideUp('slow');
                    }, 3000)
                }
            });
        });

        // onclick button batal in modal account
        $('#action-acnon').on('click', '.cancel', function() 
        {
            $('#acnon').modal('hide');
        });

        // show or hide password in add account modal
        $('.show').change(function() 
        {
            $(this).prop("checked") ? $('.pwd').prop('type', 'text') : $('.pwd').prop('type', 'password');
        });

        // show data merk
        $('.dm').load('ajax/data/merk.php');

        $('.tambah-merk').on('click', function() 
        {
            $('#add').modal('show');
        });

        $('#add-form').on('click', '.add', function() 
        {
            var name = $('#name').val();
            var logo = $('#up_logo').prop('files')[0];

            let formData = new FormData();
            formData.append('logo', logo);
            formData.append('name', name);

            $.ajax({
                url: 'ajax/tambah/merk.php',
                type: 'post',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success:function(response)
                {
                    if(response == "picturenull")
                    {
                        $('#message').show();
                        $('#message').removeClass("alert alert-success bg-success text-white mt-2");
                        $('#message').addClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').html("Foto Kosong");
                        $('#add').modal('hide');
                        // $('.account').load('ajax/data/account.php');
                        setTimeout(function() {
                            $('#message').fadeOut('slow');
                        }, 5000)
                    }
                    else if(response == "sizemax")
                    {
                        $('#message').show();
                        $('#message').removeClass("alert alert-success bg-success text-white mt-2");
                        $('#message').addClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').html("Ukuran File Foto Melebihi 2 MB");
                        $('#add').modal('hide');
                        // $('.account').load('ajax/data/account.php');
                        setTimeout(function() {
                            $('#message').fadeOut('slow');
                        }, 5000)
                    }
                    else if(response == "extensinotallowed")
                    {
                        $('#message').show();
                        $('#message').removeClass("alert alert-success bg-success text-white mt-2");
                        $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').addClass("alert alert-warning bg-warning text-dark mt-2");
                        $('#message').html("Extensi File Harus jpg,jpeg,atau png");
                        $('#add').modal('hide');
                        // $('.account').load('ajax/data/account.php');
                        setTimeout(function() {
                            $('#message').fadeOut('slow');
                        }, 5000)
                    }
                    else if(response == "success")
                    {
                        $('#message').show();
                        $('#message').removeClass("alert alert-danger bg-danger text-white mt-2");
                        $('#message').removeClass("alert alert-warning bg-warning text-white mt-2");
                        $('#message').addClass("alert alert-success bg-success text-white mt-2");
                        $('#message').html("Berhasil Tambah Data !");
                        $('#add').modal('hide');
                        $('.dm').load('ajax/data/merk.php');
                        setTimeout(function() {
                            $('#message').fadeOut('slow');
                        }, 5000)
                    }
                }
            });
        });

        // on click update button in merk data
        $('.dm').on('click', '.ubah', function(){
            var id = $(this).data('id');

            $.ajax({
                url: 'ajax/method/update-merk.php',
                data: {id:id},
                type: 'post',
                success:function(respond)
                {
                    $('#update').modal('show');
                    $('#method-update').html(respond);
                }
            })
        })
    </script>
</body>

</html>