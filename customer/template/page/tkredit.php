<div class="conatiner-fluid">
    <div class="container">
        <div class="message"></div>
        <div id="tkredit" class="table-responsive">
            <table class="table table-striped table-sm" style="font-size:12px;">
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
                        $sql = mysqli_query($con, "SELECT *, tk.id AS id_transaksi FROM transaksi_kredit tk JOIN motor ON tk.id_motor = motor.id WHERE tk.id_user='$id_user' ORDER BY tk.status_lunas DESC");
                        $no = 1;
                        while($data = mysqli_fetch_object($sql))
                        {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data->nama_motor; ?> (<?= $data->tahun ?>)</td>
                                    <td><?= ($data->harga == NULL ? '' : "Rp. ".number_format($data->harga,0,',','.')) ?></td>
                                    <td><?= ($data->uang_muka == NULL ? '' : "Rp. ".number_format($data->uang_muka,0,',','.')) ?></td>
                                    <td><?= $data->tenor."X" ?></td>
                                    <td><?= ($data->uang_tenor == NULL ? '' : "Rp. ".number_format($data->uang_tenor,0,',','.')) ?></td>
                                    <td><?= ($data->tanggal_beli == NULL ? '' : date('d-m-Y ', strtotime($data->tanggal_beli))); ?></td>
                                    <td><?= $data->status; ?></td>
                                    <td><?= $data->status_lunas; ?></td>
                                    <td><button class="btn btn-success btn-sm pay mb-2" <?= ($data->status == "Antrian" ? 'disabled' : 'data-id="'."{$data->id_transaksi}".'"')?> style="font-size: 10px;"><em class="fas fa-hand-holding-usd"></em></button> <button class="btn btn-info btn-sm print-invoice-kredit mb-2 text-white" <?= ($data->status == "Antrian" ? 'disabled' : 'data-id="'."{$data->id_transaksi}".'"')?> style="font-size: 10px;"><em class="fas fa-print"></em></button></td>
                                    <td></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require 'modal/bayar_tenor.php' ?>