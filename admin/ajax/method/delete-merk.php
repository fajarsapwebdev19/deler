<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
?>
<div class="modal-body">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <p>Apakah Anda Ingin Menghapus Data Ini ?</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success yes">
        Ya, Hapus
    </button>
</div>