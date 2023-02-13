<div class="container-fluid mt-4">
    <h5>Laporan Pembelian Cash</h5>
    <button class="btn btn-danger btn-sm print-rep-cash">
        <em class="fas fa-download"></em> Download Laporan
    </button>

    <div class="table-responsive mt-2">
        <table class="table table-striped table-sm rep-cash" style="font-size: 8px;">
            <thead>
                <tr>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Pemilik</th>
                    <th>Tipe Motor</th>
                    <th>Harga</th>
                    <th>Pembayaran Via</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($con, "SELECT
                    tc.id, 
                    tc.tanggal_pembelian,
                    pd.nama,
                    m.nama_motor,
                    m.harga,
                    m.tahun,
                    tc.pembayaran,
                    tc.status
                    FROM transaksi_cash tc
                    JOIN motor m ON tc.id_motor = m.id
                    JOIN user u ON tc.id_user = u.id_user
                    JOIN personal_data pd ON u.personal_id = pd.id WHERE tc.status='Paid'");

                    while($data = mysqli_fetch_object($sql))
                    {
                        ?>
                            <tr>
                                <td><?= $data->tanggal_pembelian; ?></td>
                                <td><?= $data->nama; ?></td>
                                <td><?= $data->nama_motor; ?> (<?= $data->tahun ?>)</td>
                                <td><?= ($data->harga == NULL ? '' : "Rp. ".number_format($data->harga, 0,',','.')); ?></td>
                                <td><?= $data->pembayaran; ?></td>
                                <td><?= $data->status; ?></td>
                                <td><button type="button" class="btn btn-info btn-sm print-invoice-cash" style="font-size: 10px;" data-id="<?= $data->id; ?>"><em class="fas fa-print text-white"></em></button></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>