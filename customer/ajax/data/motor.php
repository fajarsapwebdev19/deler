<?php
    require '../../../database_connect.php';
?>
<div class="row">
        <?php
            $sql = mysqli_query($con, "SELECT * FROM motor");
            while($data = mysqli_fetch_object($sql))
            {
                ?>
                    <div class="col-md-4 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                <img src="../img/motor/<?= $data->foto; ?>" style="width: auto; height: 65px; text-align: center;" alt="">
                                </center>
                                <br>
                                <b>Stok <?= $data->stok; ?></b>
                                <br>
                                <h5><?= $data->nama_motor; ?></h5>
                                <h6>(<?= $data->tahun; ?>)</h6>
                                <h6><?= "Rp ".number_format($data->harga, 0,'.','.'); ?></h6>
                                <div class="d-grid gap-2">
                                    <button data-id="<?= $data->id; ?>" class="btn btn-success buy" type="button" <?= ($data->stok == 0 ? 'disabled' : '')?>>Beli</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>