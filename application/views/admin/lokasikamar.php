<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 ">
                    <h1 class="mb-2">Daftar Kamar</h1>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownLokasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Lokasi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownLokasi">
                            <?php foreach ($lokasi as $lok): ?>
                                <a class="dropdown-item" href="<?= base_url('admin/filterlokasi/' . $lok['id_lokasi']) ?>"><?= $lok['lokasi'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="<?= base_url('admin/tambahkamar') ?>" class="btn btn-block bg-gradient-danger">
                            <i class="fas fa-plus-square"></i>
                            Tambah Kamar
                        </a>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->

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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <?php foreach ($kontrakan as $k) : ?>


                    <div class="col-lg-3 col-6 mb-4">
                        <div class="card" style="width:200px">
                            <img class="card-img-top" style="height: 250px;" src=" <?php echo base_url(); ?>assets/img/upload/<?= $k['image']; ?>" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title text-capitalize"><?= $k['nama_kamar'] ?></h4>
                                <p class="card-text">
                                    <?php
                                    if ($k['tersedia'] == 1) {
                                        echo '<span class="badge badge-success">Tersedia</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Sedang Disewa</span>';
                                    }
                                    ?>
                                </p>
                                <a href="<?= base_url('admin/detailkamar/') . $k['id_kamar'] ?>" class="btn btn-warning">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

</div>