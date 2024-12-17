<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="mb-3">
                        Daftar Kamar
                        <!-- <?php if (!empty($kontrakan)) { ?>
                            <?= $kontrakan[0]->lokasi ?>
                        <?php } ?> -->
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="<?= base_url('admin/tambahkamar') ?>" class="btn btn-block bg-gradient-danger">
                            <i class="fas fa-plus-square"></i>
                            Tambah Kamar
                        </a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('upload_error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('upload_error'); ?>
        </div>
    <?php endif; ?>
    <div id="flash-message">
        <?= $this->session->flashdata('pesan'); ?>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row g-4">
                <?php if (!empty($kontrakan)) { ?>
                    <?php foreach ($kontrakan as $k) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card shadow-sm h-100">
                                <img class="card-img-top" src="<?= base_url(); ?>assets/img/upload/<?= $k->image; ?>" alt="<?= $k->nama_kamar ?>" style="height: 250px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-capitalize"><?= $k->nama_kamar ?></h5>
                                    <p class="card-text mb-3">
                                        <?php if ($k->tersedia == 1): ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Sedang Disewa</span>
                                        <?php endif; ?>
                                    </p>
                                    <a href="<?= base_url('admin/detailkamar/') . $k->id_kamar ?>" class="btn btn-warning mt-auto">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak ada data kamar untuk ditampilkan.
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

</div>