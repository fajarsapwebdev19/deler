<?php
    require '../../../database_connect.php';
?>

<table class="table table-hover table-striped">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Tipe Motor</th>
        <th>Uang Muka</th>
        <th>Tenor</th>
        <th>Uang Tenor</th>
        <th>Pembayaran</th>
        <th>Status</th>
        <th class="text-center">Verifikasi</th>
    </tr>
    <tbody>
        <?php
            $sql = mysqli_query($con, "SELECT 
            tk.id,
            pd.nama,
            pd.nik,
            m.nama_motor,
            m.tahun,
            tk.tenor,
            tk.uang_muka,
            tk.uang_tenor,
            tk.pembayaran,
            tk.status
            FROM transaksi_kredit tk 
            JOIN motor m ON tk.id_motor = m.id 
            JOIN user u ON tk.id_user = u.id_user 
            JOIN personal_data pd ON u.personal_id = pd.id");
            $no = 1;
            while($data = mysqli_fetch_object($sql))
            {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data->nama; ?></td>
                        <td><?= $data->nik; ?></td>
                        <td><?= $data->nama_motor; ?> (<?= $data->tahun; ?>)</td>
                        <td><?= "Rp. ".number_format($data->uang_muka, 0,',','.')?></td>
                        <td><?= $data->tenor.' X'; ?></td>
                        <td><?= ($data->uang_tenor == NULL ? 'Belum Di Tentukan' : "Rp. ".number_format($data->uang_tenor, 0,',','.'))?></td>
                        <td><?= $data->pembayaran; ?></td>
                        <td><?= $data->status; ?></td>
                        <td class="text-center"><button type="button" class="btn btn-success btn-sm verifikasi" data-id="<?= $data->id; ?>"><em class="fas fa-check"></em></button></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>