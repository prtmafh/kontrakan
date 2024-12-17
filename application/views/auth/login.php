<div class="card card-outline card-danger">
    <div class="card-header text-center">
        <a href="" class="h1"><b>Login</b></a>
    </div>
    <div class="card-body">
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->
        <div id="flash-message">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
        <form action="<?= base_url('auth'); ?>" method="post">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <div class="input-group-append">
                    <div class="input-group-text" onclick=" togglePasswordVisibility('password')">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="social-auth-links text-center mt-4 mb-3">
                <button type="submit" class="btn btn-block btn-danger">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </div>
        </form>
        <!-- /.social-auth-links -->


        <p class="mb-0">
            <a href="<?= base_url('auth/register') ?>" class="text-center">Daftar disini</a>
        </p>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->