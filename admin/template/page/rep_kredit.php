<div class="container-fluid mt-4">
    <h5>Laporan Pembelian Kredit</h5>
    <button class="btn btn-danger btn-sm print-rep-kredit">
        <em class="fas fa-download"></em> Download Laporan
    </button>

    <div class="table-responsive mt-2">
        <table class="table table-striped table-sm rep-kredit" style="font-size:14px;">
            <thead>
                <tr>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Pemilik</th>
                    <th>Tipe Motor</th>
                    <th>Harga</th>
                    <th>Uang Muka</th>
                    <th>Tenor</th>
                    <th>Status Lunas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($con, "SELECT tk.id, tk.tanggal_beli,tk.uang_muka, pd.nama, m.nama_motor, m.tahun, m.harga, tk.tenor, tk.status_lunas FROM transaksi_kredit tk JOIN motor m ON tk.id_motor = m.id JOIN user u ON tk.id_user = u.id_user JOIN personal_data pd ON u.personal_id = pd.id WHERE tk.status='Terima' ORDER BY tk.status_lunas DESC");
                    
                    
                    while($data = mysqli_fetch_object($sql))
                    {
                        ?>
                            <tr>
                                <td><?= ($data->tanggal_beli == NULL ? '' : date('d-m-Y H:i:s', strtotime($data->tanggal_beli))); ?></td>
                                <td><?= $data->nama; ?></td>
                                <td><?= $data->nama_motor. " ({$data->tahun})"; ?></td>
                                <td><?= ($data->harga == NULL ? '' : "Rp. ".number_format($data->harga, 0,',','.'))?></td>
                                <td><?= ($data->uang_muka == NULL ? '' : "Rp. ".number_format($data->uang_muka, 0,',','.'))?></td>
                                <td><?= $data->tenor." X"?></td>
                                <td><?= $data->status_lunas; ?></td>
                                <td><button type="button" class="btn btn-info text-white btn-sm print-invoice-kredit" style="font-size: 10px;"><em class="fas fa-print"></em></button></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>