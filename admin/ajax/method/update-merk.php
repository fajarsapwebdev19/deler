<?php
    require '../../../database_connect.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $sql = mysqli_query($con, "SELECT * FROM merk WHERE id='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <div class="mb-3">
        <label for="">Nama Merk</label>
        <input type="hidden" name="id" value="<?= $data->id; ?>">
        <input type="text" name="merk_name" id="name" class="form-control" value="<?= $data->merk_name; ?>">
    </div>
    <div class="mb-3">
        <label for="">Logo</label>
        <input type="file" name="logo" id="up_logo" class="form-control">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info text-white update">Ubah</button>
</div>