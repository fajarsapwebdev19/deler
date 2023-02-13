<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    
    $sql = mysqli_query($con, "SELECT 
    tk.id,
    pd.nama,
    pd.nik,
    m.nama_motor,
    m.tahun,
    m.harga,
    tk.uang_muka,
    tk.tenor,
    tk.tanggal_beli,
    tk.pembayaran,
    tk.status
    FROM transaksi_kredit tk 
    JOIN motor m ON tk.id_motor = m.id
    JOIN user u ON tk.id_user = u.id_user
    JOIN personal_data pd ON u.personal_id = pd.id
    WHERE tk.id='$id'");

    $data = mysqli_fetch_object($sql);

    $pembayaran = $data->pembayaran;

?>
<div class="modal-body">
    <div class="mb-3">
        <label>Nama Pemilik</label>
        <input type="text" class="form-control" value="<?= $data->nama; ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Waktu Pembelian</label>
        <input type="text" class="form-control" value="<?= ($data->tanggal_beli == NULL ? '' : date('d-m-Y H:i:s', strtotime($data->tanggal_beli))); ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Tipe Motor</label>
        <input type="text" class="form-control" value="<?= $data->nama_motor; ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="text" class="form-control" value="<?= "Rp. ".number_format($data->harga, 0,',','.'); ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Uang Muka</label>
        <input type="text" class="form-control" value="<?= "Rp. ".number_format($data->uang_muka, 0,',','.'); ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Tenor</label>
        <input type="text" class="form-control" value="<?= $data->tenor." X"; ?>" disabled>
    </div>
    <div class="mb-3">
        <label>Pembayaran Via</label>
        <input type="text" class="form-control" value="<?= $data->pembayaran; ?>" disabled>
    </div>
    <?php
        if($pembayaran == "Transfer")
        {
            ?>
                <div class="mb-3">
                    <label for="">Bukti</label>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary view_trf" data-id="<?= $data->id; ?>">
                            <em class="fas fa-search"></em> Bukti Transfer
                        </button>
                    </div>
                </div>
            <?php
        }
    ?>
    <div class="mb-3">
        <label>Pilih Status</label>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input sts trm" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Terima">
                <label class="form-check-label" for="inlineRadio1">Terima</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input sts tlk" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Tolak">
                <label class="form-check-label" for="inlineRadio2">Tolak</label>
            </div>
        </div>
    </div>
    <div id="tenor" style="display:none;">
        <div class="mb-3">
            <label for="">
                Uang Tenor
            </label>
            <input type="text" id="uang_tenor" class="form-control utn">
            <input type="hidden" id="idt" value="<?= $data->id; ?>">
            <input type="hidden" id="payment" value="<?= $data->pembayaran; ?>">
            <input type="hidden" id="tnr" value="<?= $data->tenor; ?>">
        </div>
    </div>

    <div id="msg"></div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-success verifikasi">
            Verifikasi
        </button>
</div>