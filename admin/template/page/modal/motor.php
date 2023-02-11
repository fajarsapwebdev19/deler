<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Motor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="tambah-motor">
       <div class="modal-body">
        <div class="mb-3">
          <label for="">
            Brand
          </label>
          <select name="brand" class="form-control">
            <?php
              $sql = mysqli_query($con, "SELECT * FROM merk");
              while($m = mysqli_fetch_object($sql))
              {
                ?>
                  <option value="<?= $m->id ?>"><?= $m->merk_name; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="">
            Nama Motor
          </label>
          <input type="text" name="nama_motor" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">
            Tahun
          </label>
          <input type="text" name="tahun" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">
            Kondisi
          </label>
          <input type="text" name="kondisi" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">
            Harga
          </label>
          <input type="number" name="harga" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">
            Stok
          </label>
          <input type="number" name="stok" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">
            Foto Motor
          </label>
          <input type="file" name="foto_motor" class="form-control">
        </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-success tambah">Tambah</button>
       </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data Motor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="hapus-motor">
       
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Motor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="edit-motor">
       
      </form>
    </div>
  </div>
</div>