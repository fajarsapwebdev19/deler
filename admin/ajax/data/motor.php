<?php
    require '../../../database_connect.php';

    $sql = mysqli_query($con, "SELECT *,motor.id AS id_motor FROM motor JOIN merk ON motor.id_merk = merk.id");
?>

<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th>Brand</th>
            <th>Nama Motor</th>
            <th class="text-center">Foto Motor</th>
            <th class="text-center">Tahun</th>
            <th class="text-center">Kondisi</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Action</th>
        </tr>
        <tbody>
            <?php
                $no = 1;
                while($data = mysqli_fetch_object($sql))
                {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $data->merk_name; ?></td>
                            <td><?= $data->nama_motor; ?></td>
                            <td class="text-center"><img src="../img/motor/<?= $data->foto; ?>" width="80" alt=""></td>
                            <td class="text-center"><?= $data->tahun; ?></td>
                            <td class="text-center"><?= $data->kondisi; ?></td>
                            <td class="text-center"><?= 'Rp.'.number_format($data->harga, 0,0,'.') ?></td>
                            <td class="text-center"><?= $data->stok; ?></td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm edit mb-2" data-id="<?= $data->id_motor; ?>"><em class="fas fa-edit text-white"></em></button>
                                <button class="btn btn-danger btn-sm hapus mb-2" data-id="<?= $data->id_motor; ?>"><em class="fas fa-trash text-white"></em></button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </thead>
</table>