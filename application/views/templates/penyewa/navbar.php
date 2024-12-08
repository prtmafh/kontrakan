<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand ms-5 me-5" href="#">
            <i class="nav-icon fas fa-home"></i>
            Kontrakan
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') ? 'active' : '' ?>" href="<?= base_url('home') ?>">Home</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <button class="nav-link dropdown-toggle <?= ($this->uri->segment(2) == 'filterlokasi') ? 'active' : '' ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Lokasi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($lokasi as $lok): ?>
                            <a class="dropdown-item" href="<?= base_url('home/filterlokasi/' . $lok->lokasi) ?>"><?= $lok->lokasi ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>

            <!-- Tambahkan Menu Kamar Saya di Sebelah Profile -->
            <ul class="navbar-nav">
                <li class="nav-item me-4">
                    <a class="nav-link <?= ($this->uri->segment(2) == 'kamarsaya') ? 'active' : '' ?>" href="<?= base_url('sewa/kamarsaya') ?>">
                        <i class="fas fa-door-open"></i>
                        Kamar Saya
                    </a>
                </li>
                <!-- <li class="nav-item me-5">
                    <a class="nav-link <?= ($this->uri->segment(2) == 'logout') ? 'active' : '' ?>" href="<?= base_url('auth/logout') ?>">
                        <i class="nav-icon fas fa-user"></i> Profile
                    </a>
                </li> -->
                <li class="nav-item dropdown no-arrow">

                    <a class="nav-link <?= ($this->uri->segment(1) == 'profile' && $this->uri->segment(2) == '') ? 'active' : '' ?> dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-capitalize"><?= $user['nama']; ?> </span>
                        <img class="img-profile rounded-circle ms-2" style="max-height: 30px;width: auto;height: auto;object-fit: cover; border-radius: 50%;" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item <?= ($this->uri->segment(1) == 'profile' && $this->uri->segment(2) == '') ? 'active' : '' ?>" href="<?= base_url('profile'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile Saya
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('sewa/historykamarsaya'); ?>">
                            <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                            Riwayat Sewa
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>