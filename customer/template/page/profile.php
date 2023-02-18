<div class="container-fluid mt-5">
    <div id="message"></div>
    <div class="row">
        <div class="col-md-8">
            <form method="post" id="frm-profile">
                
            </form>
        </div>
        <div class="col-md-4">
            <div class="card card-body">
                <a href="#" id="update-pass" data-id="<?= $data_user->id_user; ?>" style="text-decoration: none;"><em class="fas fa-key"></em> Update Password</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="up-pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="up-psw">
       
      </form>
    </div>
  </div>
</div>