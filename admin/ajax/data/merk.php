<?php
    require '../../../database_connect.php';

    $sql = mysqli_query($con, "SELECT * FROM merk");
?>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Merk</th>
            <th>Logo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            while($data = mysqli_fetch_object($sql))
            {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data->merk_name; ?></td>
                        <td><img src="../img/logo/<?= $data->logo; ?>" width="90" alt=""></td>
                        <td><button class="btn btn-info btn-sm mb-2 ubah" data-id="<?= $data->id; ?>"><em class="fas fa-edit text-white"></em></button> <button class="btn btn-danger btn-sm mb-2 hapus" data-id="<?= $data->id; ?>"><em class="fas fa-trash-alt text-white"></em></button></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>