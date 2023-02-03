<?php
    require '../../../database_connect.php';
?>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Email</th>
            <th class="text-center">Sudah Verifikasi</th>
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
                <td><?= $data->email; ?></td>
                <td class="text-center"><?= ($data->verifikasi_email == "Belum" ? '<em class="fas fa-times-circle text-danger"></em>' : ($data->verifikasi_email == "Sudah" ? '<em class="fas fa-check-circle text-success"></em>' : '')); ?></td>
                <td><?= $data->username; ?></td>
                <td><?= $data->password; ?></td>
                <td>
                    <button class="btn btn-sm btn-danger mb-2"><em class="fas fa-user-times"></em></button>
                    <button class="btn btn-sm btn-info edit mb-2" data-id="<?= $data->id; ?>"><em class="fas fa-edit text-white"></em></button>
                    <button class="btn btn-sm btn-danger delete mb-2" data-id="<?= $data->id; ?>"><em class="fas fa-trash-alt"></em></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>