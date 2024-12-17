<div class="card card-outline card-danger">
    <div class="card-header text-center">
        <a href="#" class="h1"><b>Daftar</b></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Daftar Penyewa</p>

        <?php if ($this->session->flashdata('pesan')) : ?>
            <div id="flash-message">
                <?= $this->session->flashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/register'); ?>" method="post">

            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama Lengkap" id="nama" name="nama">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>

            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Alamat Email" id="email" name="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="input" class="form-control" placeholder="Nomor Handphone" id="no_hp" name="no_hp">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-fax"></span>
                    </div>
                </div>
            </div>
            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Kata Sandi" id="password1" name="password1">
                <div class="input-group-append">
                    <div class="input-group-text" onclick="togglePasswordVisibility('password1')">
                        <span class="fas fa-eye"></span>
                    </div>
                </div>
            </div>

            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Ulangi Kata Sandi" id="password2" name="password2">
                <div class="input-group-append">
                    <div class="input-group-text" onclick="togglePasswordVisibility('password2')">
                        <span class="fas fa-eye"></span>
                    </div>
                </div>
            </div>

            <button type='submit' class="btn btn-block btn-danger mb-3">
                <i class="fas fa-user"></i>
                Daftar
            </button>
        </form>

        <a href="<?= base_url('auth') ?>" class="text-center">Saya sudah punya akun</a>
    </div>
</div>