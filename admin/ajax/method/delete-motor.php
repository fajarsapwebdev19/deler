<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
?>
<div class="modal-body">
    <p>Apakah Anda Ingin Menghapus Data Tersebut ? </p>
    <input type="hidden" name="id" value="<?= $id; ?>">
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success oke">
        Ya, Hapus
    </button>
</div>