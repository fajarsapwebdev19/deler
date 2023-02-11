<div class="conatiner-fluid">
    <div id="message"></div>

    <div class="container">
        <div id="tcash" class="table-responsive">
            <table class="table table-striped table-sm" style="font-size:10px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe Motor</th>
                        <th>Harga</th>
                        <th>Uang Muka</th>
                        <th>Tenor</th>
                        <th>Uang Tenor</th>
                        <th>Tanggal Beli</th>
                        <th>Status</th>
                        <th>Status Lunas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $id_user = $data_user->id_user;
                        $sql = mysqli_query($con, "SELECT * FROM transaksi_kredit tk JOIN motor ON tk.id_motor = motor.id WHERE tk.id_user='$id_user'");
                        $no = 1;
                        while($data = mysqli_fetch_object($sql))
                        {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data->nama_motor; ?> (<?= $data->tahun ?>)</td>
                                    <td><?= "Rp. ".number_format($data->harga,0,',','.') ?></td>
                                    <td><?= "Rp. ".number_format($data->uang_muka,0,',','.') ?></td>
                                    <td><?= $data->tenor."X" ?></td>
                                    <td><?= $data->uang_tenor; ?></td>
                                    <td><?= date('d-m-Y H:i:s', strtotime($data->tanggal_beli)); ?></td>
                                    <td><?= $data->status; ?></td>
                                    <td><?= $data->status_lunas; ?></td>
                                    <td><button class="btn btn-success btn-sm pay" <?= ($data->status == "Antrian" ? 'disabled' : '')?>><em class="fas fa-hand-holding-usd"></em></button></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>