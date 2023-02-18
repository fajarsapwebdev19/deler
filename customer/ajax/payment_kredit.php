<?php
    require '../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT * FROM pembayaran_tenor WHERE id='$id'");
    $data = mysqli_fetch_object($sql);
?>

<div class="modal-body">
    <div class="msg"></div>
    <div class="mb-3">
        <label for="">
            Pembayaran Ke
        </label>
        <input type="text" name="pembayaran_ke" class="form-control" value="<?= $data->pembayaran_ke; ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="">
            Nominal
        </label>
        <input type="text" name="nominal" class="form-control" value="<?= ($data->uang_tenor == NULL ? '' : "Rp. ".number_format($data->uang_tenor, 0, ',','.')); ?>" readonly>
        <input type="hidden" name="id_transaksi" value="<?= $data->id_transaksi; ?>">
    </div>
    <div class="mb-3">
        <label for="">
            Pembayaran Via
        </label>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input via-pay" type="radio" name="pembayaran" id="inlineRadio1" value="Tunai">
                <label class="form-check-label" for="inlineRadio1">Tunai</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input via-pay" type="radio" name="pembayaran" id="inlineRadio2" value="Transfer">
                <label class="form-check-label" for="inlineRadio2">Transfer</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div id="transfer-method" style="display:none;">
            <label for="">Bukti Transfer</label>
            <input type="file" name="bukti" class="form-control">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success bayar">
        Bayar
    </button>
</div>