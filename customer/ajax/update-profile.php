<?php
    session_start();

    $id = $_SESSION['username'];

    require '../../database_connect.php';

    $sql = mysqli_query($con, "SELECT * FROM user u JOIN personal_data pd ON u.personal_id = pd.id WHERE u.username='$id'");
    $data = mysqli_fetch_object($sql);
?>

<div class="mb-3">
    <label for="">Nama</label>
    <input type="hidden" name="id" value="<?= $data->personal_id; ?>">
    <input type="text" name="nama" class="form-control" value="<?= $data->nama; ?>">
</div>
<div class="mb-3">
    <label for="">Jenis Kelamin</label>
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" <?= ($data->jenis_kelamin == "Laki-Laki" ? 'checked' : '') ?>>
            <label class="form-check-label" for="inlineRadio1">L</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" <?= ($data->jenis_kelamin == "Perempuan" ? 'checked' : '') ?>>
            <label class="form-check-label" for="inlineRadio2">P</label>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="">NIK</label>
    <input type="text" name="nik" class="form-control" value="<?= $data->nik; ?>">
</div>
<div class="mb-3">
    <label for="">Alamat</label>
    <textarea name="alamat" class="form-control"><?= $data->alamat; ?></textarea>
</div>
<div class="mb-3">
    <label for="">No Telp</label>
    <input type="text" name="no_telp" class="form-control" value="<?= $data->no_telp; ?>">
</div>

<div class="mb-3">
    <button type="button" class="btn btn-success ubah-data">
        Ubah Data
    </button>
</div>