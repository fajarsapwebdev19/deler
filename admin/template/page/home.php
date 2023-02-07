<div class="container-fluid  mb-5" style="padding-top: 180px;">
        <div class="row">
            <div class="col-md-12">
                <h2>Welcome, <?= $data->nama; ?> Anda Login Sebagai <?= $data->role_name; ?></h2>
                <div class="row">
                    <div class="col-md-6 col-6 mb-3 text-center">
                        <a href="?page=account" class="card">
                            <div class="card-body">
                                <h1 class="fas fa-unlock"></h2>
                                <h5>Account</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-6 mb-3 text-center">
                        <a href="?page=motor" class="card">
                            <div class="card-body">
                                <h1 class="fas fa-bicycle"></h1>
                                <h5>Motor</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-6 mb-3 text-center">
                        <a href="" class="card">
                            <div class="card-body">
                                <h1 class="fas fa-money-bill-alt"></h1>
                                <h5>Pembayaran</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-6 mb-3 text-center">
                        <a href="" class="card">
                            <div class="card-body">
                                <h1 class="fas fa-dollar-sign"></h1>
                                <h5>Kredit</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>