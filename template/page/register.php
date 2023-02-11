<div class="col-md-5" style="margin-left: 10px; margin-right:10px;">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h4>Registrasi</h4>
            </div>
            <div id="pesan"></div>
            <form id="form-regis" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-user"></em></span>
                    <input type="text" name="nama" class="form-control form-control-lg" placeholder="Nama">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-mars"></em></span>
                    <select name="jenis_kelamin" id="" class="form-control form-control-lg">
                        <option value="">Jenis Kelamin</option>
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-passport"></em></span>
                    <input type="text" name="nik" class="form-control form-control-lg"
                        placeholder="Nomor Induk Kependudukan (NIK)">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-home"></em></span>
                    <input type="text" name="alamat" class="form-control form-control-lg" placeholder="Alamat Rumah">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-phone"></em></span>
                    <input type="text" name="telp" class="form-control form-control-lg" placeholder="Nomor Telpon">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-user"></em></span>
                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><em class="fas fa-key"></em></span>
                    <input type="password" name="password" class="form-control form-control-lg" id="password"
                        placeholder="Password">
                    <span class="input-group-text"><a class="shpw"><em class="fas fa-eye pwicon"></em></a></span>
                </div>
                <center>
                    <button class="btn btn-lg btn-success regis">
                        REGISTER
                    </button>
                    <br><br>
                    <a href="./" style="text-decoration:none;">Login</a>
                </center>
            </form>
        </div>
    </div>
</div>