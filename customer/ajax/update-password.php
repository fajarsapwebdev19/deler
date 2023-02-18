<?php
    require '../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
?>
<div class="modal-body">
    <div id="msg"></div>
    <div class="mb-1">
        <label>Password Lama</label>
    </div>
    <div class="input-group icon-sh mb-3">
        <input type="hidden" name="id" id="id_user" value="<?= $id; ?>">
        <input type="password" name="password-lama" class="form-control pwl">
        <span class="input-group-text pl"><em id="icon-pw-lm" class="fas fa-eye"></em></span>
    </div>
    <div class="mb-1">
        <label>Password Baru</label>
    </div>
    <div class="input-group icon-sh mb-3">
        <input type="password" name="password-baru" class="form-control pwb">
        <span class="input-group-text pb"><em id="icon-pw-br" class="fas fa-eye"></em></span>
    </div>
    <div class="mb-1">
        <label>Konfirmasi Password Baru</label>
    </div>
    <div class="input-group icon-sh mb-3">
        <input type="password" name="kon-password-baru" class="form-control kpwb">
        <span class="input-group-text kpb"><em id="icon-kn-pw" class="fas fa-eye"></em></span>
    </div>
    <button type="button" class="btn btn-success up-pass">Update Password</button>
</div>