<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link d-flex">
        <img src="<?= base_url('') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Kontrakan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('') ?>assets/img/profile/<?= $user['image'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('admin/profile') ?>" class="d-block text-capitalize"><?= $user['nama'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA</li>

                <!-- Data Kamar Kontrakan -->
                <li class="nav-item">
                    <a href="#" class="nav-link <?= ($this->uri->segment(2) == 'lokasicibitung' || $this->uri->segment(2) == 'lokasicikarang') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Data Kamar Kontrakan <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lokasicibitung') ?>" class="nav-link <?= ($this->uri->segment(2) == 'lokasicibitung') ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cibitung</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lokasicikarang') ?>" class="nav-link <?= ($this->uri->segment(2) == 'lokasicikarang') ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cikarang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Data Penyewa -->
                <li class="nav-item">
                    <a href="<?= base_url('admin/data_penyewa') ?>" class="nav-link <?= ($this->uri->segment(2) == 'data_penyewa') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Data Penyewa</p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>

                <!-- Booking -->
                <li class="nav-item">
                    <a href="<?= base_url('admin/booking_list') ?>" class="nav-link <?= ($this->uri->segment(2) == 'booking_list') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>Booking</p>
                    </a>
                </li>

                <!-- Sewa Kamar -->
                <li class="nav-item">
                    <a href="<?= base_url('sewa/sewakamar') ?>" class="nav-link <?= ($this->uri->segment(2) == 'sewakamar') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-donate"></i>
                        <p>Sewa Kamar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/perpanjangan_list') ?>" class="nav-link <?= ($this->uri->segment(2) == 'perpanjangan_list') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Perpanjangan</p>
                    </a>
                </li>


                <li class="nav-header">LAPORAN</li>

                <!-- Laporan Penyewaan -->
                <li class="nav-item">
                    <a href="<?= base_url('sewa/laporan_penyewaan') ?>" class="nav-link <?= ($this->uri->segment(2) == 'laporan_penyewaan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Penyewaan</p>
                    </a>
                </li>
                <!-- Pembayaran -->
                <li class="nav-item">
                    <a href="<?= base_url('sewa/laporan_pembayaran') ?>" class="nav-link <?= ($this->uri->segment(2) == 'laporan_pembayaran') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>