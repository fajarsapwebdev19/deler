<div class="conatiner-fluid">
    <div id="message"></div>

    <div class="container">
        <div id="tcash" class="table-responsive">
            <table class="table table-striped table-sm" style="font-size:12px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe Motor</th>
                        <th>Harga</th>
                        <th>Pembayaran</th>
                        <th>Tanggal Beli</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id_user = $data_user->id_user;
                        $sql = mysqli_query($con, "SELECT *,motor.id AS id_motor FROM transaksi_cash tc JOIN motor ON tc.id_motor = motor.id WHERE id_user='$id_user'");
                        $no = 1;
                        while($data = mysqli_fetch_object($sql))
                        {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data->nama_motor ?> (<?= $data->tahun; ?>)</td>
                                    <td><?= 'Rp. '.number_format($data->harga, 0,'.','.') ?></td>
                                    <td><?= $data->pembayaran; ?></td>
                                    <td><?= date('d-m-Y', strtotime($data->tanggal_pembelian)); ?></td>
                                    <td><?= ($data->status == NULL ? 'Antrian' : $data->status); ?></td>
                                    <td>
                                        <button class="btn btn-info text-white btn-sm print-invoice-cash" <?= ($data->status == "Unpaid" ? 'disabled' : 'data-id="'."{$data->id}".'"')?> style="font-size: 10px;">
                                            <em class="fas fa-print"></em>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>