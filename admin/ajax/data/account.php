<?php
    require '../../../database_connect.php';
?>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>JK</th>
            <th class="text-center">Status Akun</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $sql = mysqli_query($con, "SELECT * FROM user JOIN personal_data ON user.personal_id = personal_data.id");
        while ($data = mysqli_fetch_object($sql)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data->nama; ?></td>
                <td><?= ($data->jenis_kelamin == "Laki-Laki" ? 'L' : ($data->jenis_kelamin == "Perempuan" ? 'P' : '')) ?></td>
                <td class="text-center"><?= ($data->status_akun == "Tidak Aktif" ? '<em class="fas fa-times-circle text-danger"></em>' : ($data->status_akun == "Aktif" ? '<em class="fas fa-check-circle text-success"></em>' : '')); ?></td>
                <td><?= $data->username; ?></td>
                <td><?= $data->password; ?></td>
                <td>
                    <?php
                        if($data->status_akun == "Aktif")
                        {
                            ?>
                                <button class="btn btn-sm btn-danger btn-sm mb-2 acnc" style="font-size:10px;" data-id="<?= $data->id_user; ?>"><em class="fas fa-times"></em></button>
                            <?php
                        }
                        else if($data->status_akun == "Tidak Aktif")
                        {
                            ?>
                                <button class="btn btn-sm btn-success btn-sm mb-2 acnc" style="font-size:10px;" data-id="<?= $data->id_user; ?>"><em class="fas fa-check"></em></button>
                            <?php
                        }
                    ?>
                    <button class="btn btn-sm btn-info edit mb-2" style="font-size:10px;" data-id="<?= $data->id; ?>"><em class="fas fa-edit text-white"></em></button>
                    <button class="btn btn-sm btn-danger delete mb-2" style="font-size:10px;" data-id="<?= $data->id; ?>"><em class="fas fa-trash-alt"></em></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>