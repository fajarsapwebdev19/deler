<?php
    require '../../../database_connect.php';

    $id_user = mysqli_real_escape_string($con, $_POST['id_user']);

    $sql = mysqli_query($con, "SELECT * FROM user WHERE id_user='$id_user'");

    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <input type="hidden" id="user_id" name="id" value="<?= $id_user; ?>">
    <?php
        if($data->status_akun == "Aktif")
        {
            ?>
                Apakah Anda Ingin Nonactifkan Akun Tersebut ?
            <?php
        }
        else if($data->status_akun == "Tidak Aktif")
        {
            ?>
                Apakah Anda Ingin Mengaktifkan Akun Tersebut ?
            <?php
        }
    ?>
</div>
<div class="modal-footer">
<?php
        if($data->status_akun == "Aktif")
        {
            ?>
                <button type="button" class="btn btn-success nonactive">Ya, Nonaktifkan</button>
            <?php
        }
        else if($data->status_akun == "Tidak Aktif")
        {
            ?>
               <button type="button" class="btn btn-success active">Ya, Aktifkan</button>
            <?php
        }
    ?>
    <button type="button" class="btn btn-danger cancel">Batal</button>
</div>