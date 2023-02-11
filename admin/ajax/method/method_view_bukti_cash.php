<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    
    $sql = mysqli_query($con, "SELECT bukti FROM bukti_transfer_cash WHERE id_transaksi='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <img src="../img/bukti_transfer/<?= $data->bukti; ?>" style="max-width: 100%; ">
</div>
<div class="modal-footer">
    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">
        Tutup
    </button>
</div>