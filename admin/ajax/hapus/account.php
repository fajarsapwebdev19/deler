<?php
   require '../../../database_connect.php';

   $id = mysqli_real_escape_string($con, $_POST['id']);

   $hapus = mysqli_query($con, "DELETE FROM personal_data WHERE id='$id'");
   $hapus .= mysqli_query($con, "ALTER TABLE user AUTO_INCREMENT=1");
   $hapus .= mysqli_query($con, "ALTER TABLE personal_data AUTO_INCREMENT=1");
?>