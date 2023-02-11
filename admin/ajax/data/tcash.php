<?php
    require '../../../database_connect.php';
?>

<table class="table table-hover table-striped">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Tipe Motor</th>
        <th>Waktu Pembelian</th>
        <th>Pembayaran</th>
        <th>Status</th>
        <th class="text-center">Verifikasi</th>
    </tr>
    <tbody>
        <?php
            $sql = mysqli_query($con, "SELECT 
            tc.id,
            pd.nama,
            pd.nik,
            m.nama_motor,
            m.tahun,
            m.harga,
            tc.tanggal_pembelian,
            tc.pembayaran,
            tc.status
            FROM transaksi_cash tc 
            JOIN motor m ON tc.id_motor = m.id 
            JOIN user u ON tc.id_user = u.id_user 
            JOIN personal_data pd ON u.personal_id = pd.id");
            $no = 1;
            while($data = mysqli_fetch_object($sql))
            {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data->nama; ?></td>
                        <td><?= $data->nik; ?></td>
                        <td><?= $data->nama_motor; ?> (<?= $data->tahun?>)</td>
                        <td><?= ($data->tanggal_pembelian == NULL || $data->tanggal_pembelian == "" ? '' : date('d-m-Y H:i:s', strtotime($data->tanggal_pembelian))); ?></td>
                        <td><?= $data->pembayaran; ?></td>
                        <td><?= ($data->status == NULL ? 'Antrian' : $data->status); ?></td>
                        <td class="text-center">
                            <button type="button" data-id="<?= $data->id; ?>" class="btn btn-success btn-sm text-white verifikasi" <?= ($data->status == "Paid" || $data->status == "Unpaid" ? 'disabled' : '')?>><em class="fas fa-check"></em></button>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>