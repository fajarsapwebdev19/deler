<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
?>
<div class="modal-body">
    <p>Apakah Anda Ingin Menghapus Sebuah Data Tersebut ?</p>
    <input type="hidden" name="id" id="id_user" value="<?= $id; ?>">
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success hapus">Hapus</button>
    <button type="button" class="btn btn-danger batal">Batal</button>
</div>