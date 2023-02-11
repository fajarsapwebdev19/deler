<?php
    require '../../../database_connect.php';

    $id_transaksi = mysqli_real_escape_string($con, $_POST['id']);

    $tc = mysqli_query($con, "SELECT *, tc.id AS idt FROM transaksi_cash tc JOIN motor m ON tc.id_motor = m.id JOIN user u ON tc.id_user = u.id_user JOIN personal_data pd ON u.personal_id = pd.id WHERE tc.id='$id_transaksi'");

    $data = mysqli_fetch_object($tc);

    $payment = $data->pembayaran;

    if($payment == "Tunai")
    {
        ?>
            <form type="post" id="verifikasi_cash_tunai">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama Pemilik</label>
                        <input type="text" class="form-control" value="<?= $data->nama; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Pembelian</label>
                        <input type="text" class="form-control" value="<?= ($data->tanggal_pembelian == NULL ? '' : date('d-m-Y H:i:s', strtotime($data->tanggal_pembelian))) ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Tipe Motor</label>
                        <input type="text" class="form-control" value="<?= $data->nama_motor; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Tahun</label>
                        <input type="text" class="form-control" value="<?= $data->tahun; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" value="<?= $data->harga; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Pembayaran Via</label>
                        <input type="text" class="form-control" value="<?= $data->pembayaran; ?>" disabled>
                        <input type="hidden" name="id" id="idt" value="<?= $id_transaksi; ?>">
                        <input type="hidden" name="pembayaran" id="payment" value="<?= $data->pembayaran; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success terima">Terima</button>
                    <button type="button" class="btn btn-danger tolak">Tolak</button>
                </div>
            </form>
        <?php
    }
    else if($payment == "Transfer")
    {
        ?>
            <form type="post" id="verifikasi_cash_tranfer">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama Pemilik</label>
                        <input type="text" class="form-control" value="<?= $data->nama; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Pembelian</label>
                        <input type="text" class="form-control" value="<?= ($data->tanggal_pembelian == NULL ? '' : date('d-m-Y H:i:s', strtotime($data->tanggal_pembelian))) ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Tipe Motor</label>
                        <input type="text" class="form-control" value="<?= $data->nama_motor; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Tahun</label>
                        <input type="text" class="form-control" value="<?= $data->tahun; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" value="<?= $data->harga; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Pembayaran Via</label>
                        <input type="text" class="form-control" value="<?= $data->pembayaran; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Bukti</label>
                        <div class="mb-3">
                            <input type="hidden" name="id" id="idt" value="<?= $id_transaksi; ?>">
                            <input type="hidden" name="pembayaran" id="payment" value="<?= $data->pembayaran; ?>">
                            <button type="button" class="btn btn-primary open" data-id="<?= $id_transaksi; ?>">
                                <em class="fas fa-search"></em> Bukti Transfer
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success terima">Terima</button>
                    <button type="button" class="btn btn-danger tolak">Tolak</button>
                </div>
            </form>
        <?php
    }
?>