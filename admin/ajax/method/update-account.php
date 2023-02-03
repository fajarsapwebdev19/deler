<?php
require '../../../database_connect.php';

$id = mysqli_real_escape_string($con, $_POST['id']);

$query = mysqli_query($con, "SELECT * FROM user JOIN personal_data ON user.personal_id = personal_data.id WHERE user.id_user='$id'");

$data = mysqli_fetch_object($query);
?>

<div class="modal-body">
    <div class="mb-3">
        <label for="">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?=$data->nama;?>">
    </div>
    <div class="mb-3">
        <label for="">Jenis Kelamin</label>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" <?= ($data->jenis_kelamin == "Laki-Laki" ? 'checked' : '')?>>
                <label class="form-check-label" for="inlineRadio1">L</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" <?= ($data->jenis_kelamin == "Perempuan" ? 'checked' : '')?>>
                <label class="form-check-label" for="inlineRadio2">P</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="">NIK</label>
        <input type="text" name="nik" class="form-control" value="<?= $data->nik; ?>" maxlength="16" minlength="16">
    </div>
    <div class="mb-3">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" value="<?= $data->email; ?>">
    </div>
    <div class="mb-3">
        <label for="">No Telp</label>
        <input type="tel" name="telp" class="form-control" value="<?= $data->no_telp; ?>" maxlength="13" minlength="12">
        <input type="hidden" name="id" value="<?= $data->id; ?>">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info text-white edit">Update</button>
    <button type="button" class="btn btn-danger reset">Batal</button>
</div>