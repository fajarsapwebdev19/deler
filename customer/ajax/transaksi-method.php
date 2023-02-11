<?php
require '../../database_connect.php';
session_start();

$id = mysqli_real_escape_string($con, $_POST['id']);

$sql = mysqli_query($con, "SELECT * FROM motor WHERE id='$id'");
$data = mysqli_fetch_object($sql);

$username = $_SESSION['username'];
$query = mysqli_query($con, "SELECT * FROM user JOIN personal_data ON user.personal_id = personal_data.id JOIN role ON user.role_id = role.id WHERE user.username='$username'");

$data_user = mysqli_fetch_object($query);
?>
<div class="modal-body">
    <div class="card">
        <div class="card-body">
            <center>
                <img src="../img/motor/<?= $data->foto; ?>" alt="" style="max-width: 100%; height: 180px; ">
            </center>
        </div>
    </div>
    <table class="table table-striped table-sm border-bottom">
        <tr>
            <th>Tipe</th>
            <td><?= $data->nama_motor; ?></td>
        </tr>
        <tr>
            <th>Kondisi</th>
            <td><?= $data->kondisi; ?></td>
        </tr>
        <tr>
            <th>Tahun</th>
            <td><?= $data->tahun; ?></td>
        </tr>
        <tr>
            <th>Harga</th>
            <td><?= "Rp. " . number_format($data->harga, 0, 0, '.') ?></td>
        </tr>
    </table>

    <input type="hidden" name="id_user" value="<?= $data_user->id_user; ?>">
    <input type="hidden" name="id_motor" value="<?= $data->id; ?>">
    <div class="mb-3">
        <label for="">
            Pembelian
        </label>
        <div class="mb-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input pembelian_method" type="radio" name="pembelian" id="cash" value="Cash">
                <label class="form-check-label" for="cash">Cash</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input pembelian_method" type="radio" name="pembelian" id="kredit" value="Kredit">
                <label class="form-check-label" for="kredit">Kredit</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <!-- kredit -->
        <div id="kredit_payment" style="display:none;">
            <div class="mb-3">
                <label for="">
                    Uang Muka
                </label>
                <select name="uang_muka" class="form-control um">
                    <option value="2300000">Rp. 2.300.000</option>
                    <option value="3000000">Rp. 3.000.000</option>
                    <option value="4000000">Rp. 4.000.000</option>
                    <option value="5000000">Rp. 5.000.000</option>
                    <option value="6000000">Rp. 6.000.000</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="">
                    Tenor Kredit
                </label>
                <select name="tenor" class="form-control tn">
                   <option value="3">3 X</option>
                   <option value="6">6 X</option>
                   <option value="12">12 X</option>
                </select>
            </div>
        </div>
        <!-- end kredit -->

        <div id="payment" style="display:none;">
            <div class="mb-3">
                <label for="">
                    Pembayaran
                </label>
                <div class="mb-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input pm" type="radio" name="payment_method" id="tunai" value="Tunai">
                        <label class="form-check-label" for="tunai">Tunai</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input pm" type="radio" name="payment_method" id="transfer" value="Transfer">
                        <label class="form-check-label" for="transfer">Transfer</label>
                    </div>
                    <div id="message">

                    </div>
                </div>
            </div>
            <div id="transfer_method" style="display:none;">
                <div class="mb-3">
                    <label for="">
                        Bukti Transfer
                    </label>
                    <input type="file" class="form-control btf" name="bukti">
                </div>
            </div>
        </div>
        <div id="msg">
                        
        </div>
    </div>
    <div class="d-grid gap-2">
        <button type="button" class="btn btn-success ajukan">
            Ajukan
        </button>
    </div>
</div>