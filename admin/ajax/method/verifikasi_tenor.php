<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT
    tk.id AS id_transaksi,
    pt.pembayaran_ke,
    m.nama_motor,
    pd.nama,
    tk.uang_tenor,
    pt.pembayaran
    FROM pembayaran_tenor pt
    JOIN transaksi_kredit tk ON pt.id_transaksi = tk.id
    JOIN motor m ON tk.id_motor = m.id
    JOIN user u ON tk.id_user = u.id_user
    JOIN personal_data pd ON u.personal_id = pd.id
    WHERE pt.id='$id'");

    $tn = mysqli_fetch_object($sql);
?>

<div class="modal-body">
    <?php
        if($tn->pembayaran == NULL)
        {
            ?>
                <div class="alert alert-danger bg-danger text-white">
                    Pemilik Belum Melakukan Transaksi
                </div>
            <?php
        }else{
            ?>
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" value="<?= $tn->nama; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="">Pembayaran Ke</label>
                    <input type="text" class="form-control" value="<?= $tn->pembayaran_ke; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="">Jumlah Bayar</label>
                    <input type="text" class="form-control" value="<?= ($tn->uang_tenor == NULL ? '' : "Rp. ".number_format($tn->uang_tenor, 0,',','.')); ?>" disabled>
                    <input type="hidden" id="idt" value="<?= $tn->id_transaksi; ?>">
                    <input type="hidden" id="pembayaran-ke" value="<?= $tn->pembayaran_ke; ?>">
                    <input type="hidden" id="pembayaran" value="<?= $tn->pembayaran; ?>">
                </div>
                <?php
                    if($tn->pembayaran == "Transfer")
                    {
                        ?>
                            <div class="mb-3">
                                <label for="">Bukti</label>
                                <?php
                                    $idt = $tn->id_transaksi;
                                    $b = mysqli_query($con, "SELECT bukti FROM bukti_transfer_tenor WHERE id_transaksi='$idt'");
                                    $bkt = mysqli_fetch_object($b);
                                ?>
                                <div class="mb-3">
                                    <img src="../img/bukti_transfer/<?= $bkt->bukti; ?>" style="max-width: 100%; height: 200px;" alt="">
                                </div>
                            </div>
                        <?php
                    }
                ?>
            <?php
        }
    ?>
</div>
<div class="modal-footer" <?= ($tn->pembayaran == NULL ? 'style="display:none;"' : '')?>>
    <button type="button" class="btn btn-success terima">
        Terima
    </button>
    <button type="button" class="btn btn-danger tolak">
        Tolak
    </button>
</div>