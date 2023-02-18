<?php
    require '../../database_connect.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT 
    tk.id,
    pd.nama,
    m.nama_motor,
    m.tahun,
    m.harga,
    tk.tenor,
    tk.uang_tenor,
    tk.uang_muka
    FROM transaksi_kredit tk
    JOIN motor m ON tk.id_motor = m.id
    JOIN user u ON tk.id_user = u.id_user
    JOIN personal_data pd ON u.personal_id = pd.id
    WHERE tk.id='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <div class="mb-3">
        <label for="">
            Nama
        </label>
        <input type="text" class="form-control" value="<?= $data->nama; ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="">
            Tipe Motor
        </label>
        <input type="text" class="form-control" value="<?= $data->nama_motor; ?> (<?= $data->tahun?>)" disabled>
    </div>
    <div class="mb-3">
        <label for="">
            Harga
        </label>
        <input type="text" class="form-control" value="<?= ($data->harga == NULL ? '' : "Rp. ".number_format($data->harga, 0,',','.')) ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="">
            Uang Muka
        </label>
        <input type="text" class="form-control" value="<?= ($data->uang_muka == NULL ? '' : "Rp. ".number_format($data->uang_muka, 0,',','.')) ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="">
            Tenor
        </label>
        <input type="text" class="form-control" value="<?= $data->tenor; ?> X" disabled>
    </div>

    <table class="table table-sm" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="30%" class="text-center">Pembayaran Ke</th>
                <th width="20%" class="text-center">Biaya</th>
                <th class="text-center">Pembayaran Via</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <?php
            $tn = mysqli_query($con, "SELECT * FROM pembayaran_tenor WHERE id_transaksi='$id'");
            while($t = mysqli_fetch_object($tn))
            {
                ?>
                    <tr id="<?= $t->pembayaran == NULL ? 'pay-kredit' : ''?>" class="<?= ($t->status_bayar == "Sudah" ? 'bg-success text-white' : 'bg-danger text-white')?>" data-id="<?= $t->id; ?>">
                        <td class="text-center"><?= $t->pembayaran_ke?></td>
                        <td class="text-center"><?= ($t->uang_tenor == NULL ? '' : "Rp. ".number_format($t->uang_tenor, 0,',','.'))?></td>
                        <td class="text-center"><?= ($t->pembayaran == NULL ? 'belum bayar' : $t->pembayaran ) ?></td>
                        <td class="text-center"><?= $t->status_bayar?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</div>