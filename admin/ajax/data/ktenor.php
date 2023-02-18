<table class="table table-sm table-striped">
   <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tipe Motor</th>
        <th>Uang Muka</th>
        <th>Tenor</th>
        <th>Uang Tenor</th>
        <th>Status</th>
        <th class="text-center">Verifikasi</th>
    </tr>
   </thead>
   <tbody>
    <?php
        require '../../../database_connect.php';
        $no = 1;
        $sql = mysqli_query($con, "SELECT 
        tk.id,
        pd.nama,
        m.nama_motor,
        m.tahun,
        tk.uang_muka,
        tk.tenor,
        tk.uang_tenor,
        tk.status_lunas
        FROM transaksi_kredit tk
        JOIN motor m ON tk.id_motor = m.id
        JOIN user u ON tk.id_user = u.id_user
        JOIN personal_data pd ON u.personal_id = pd.id
        WHERE tk.status='Terima'");

        while($data = mysqli_fetch_object($sql))
        {
                $idt = $data->id;

                $unpaid = mysqli_query($con, "SELECT * FROM pembayaran_tenor WHERE id_transaksi='$idt' AND status_bayar='Belum'");
                $u = mysqli_num_rows($unpaid);

                if($u == 0)
                {
                    $mysql = mysqli_query($con, "UPDATE transaksi_kredit SET status_lunas='Lunas' WHERE id='$idt'");
                }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data->nama; ?></td>
                    <td><?= $data->nama_motor;  ?> (<?= $data->tahun; ?>)</td>
                    <td><?= ($data->uang_muka == NULL ? '' : "Rp. ".number_format($data->uang_muka, 0,',','.'))?></td>
                    <td><?= $data->tenor." X"; ?></td>
                    <td><?= ($data->uang_tenor == NULL ? '' : "Rp. ".number_format($data->uang_tenor, 0,',','.'))?></td>
                    <td><?= ($data->status_lunas == "Lunas" ? '<span class="badge bg-success">Sudah</span>' : ($data->status_lunas == "Belum" ? '<span class="badge bg-danger">Belum</span>' : '') )?></td>
                    <td class="text-center"><button type="button" class="btn btn-success btn-sm verifikasi" <?= ($data->status_lunas == "Lunas" ? 'disabled' : '')?> data-id="<?= $data->id; ?>"><em class="fas fa-check"></em></button></td>
                </tr>
            <?php
        }
    ?>
   </tbody>
</table>