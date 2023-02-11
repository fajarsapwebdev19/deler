<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT * FROM motor WHERE id='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <div class="mb-3">
        <label for="">
            Brand
        </label>
        <select name="brand" class="form-control">
            <?php
              $sql = mysqli_query($con, "SELECT * FROM merk");
              while($m = mysqli_fetch_object($sql))
              {
                ?>
            <option value="<?= $m->id ?>" <?= ($data->id_merk == $m->id ? 'selected' : '')?>><?= $m->merk_name; ?> </option>
            <?php
              }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">
            Nama Motor
        </label>
        <input type="text" name="nama_motor" class="form-control" value="<?= $data->nama_motor; ?>">
    </div>
    <div class="mb-3">
        <label for="">
            Tahun
        </label>
        <input type="text" name="tahun" class="form-control" value="<?= $data->tahun; ?>">
    </div>
    <div class="mb-3">
        <label for="">
            Kondisi
        </label>
        <input type="text" name="kondisi" class="form-control" value="<?= $data->kondisi; ?>">
    </div>
    <div class="mb-3">
        <label for="">
            Harga
        </label>
        <input type="number" name="harga" class="form-control" value="<?= $data->harga; ?>">
    </div>
    <div class="mb-3">
        <label for="">
            Stok
        </label>
        <input type="number" name="stok" class="form-control" value="<?= $data->stok; ?>">
    </div>
    <div class="mb-3">
        <label for="">
            Foto Motor
        </label>
        <input type="file" name="foto_motor" class="form-control">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="mt-2">
            <div id="msg"></div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-info update text-white">Ubah</button>
</div>