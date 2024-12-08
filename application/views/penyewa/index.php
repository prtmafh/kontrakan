<div class="container mt-5">
    <div style="padding: 5px;">
        <div class="x_panel">
            <div class="x_content">
                <?= $this->session->flashdata('pesan'); ?>
                <marquee class="bg-black rounded" scrollamount="30">
                    <h1 class="text-danger fw-bold text-uppercase">
                        yang kerja bukan lu doang bangsat!! gw juga kerja ya anjing!!!
                    </h1>
                </marquee>
                <!-- Peraturan Kontrakan dengan tampilan formal -->
                <div class="card mb-5 bg-light shadow-sm">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-gavel me-2"></i> Peraturan Kontrakan
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">

                            <li class="mb-2">
                                <i class="fas fa-fw fa-clock text-warning"></i>
                                Kunjungan tamu diperbolehkan hingga pukul 22.00 WIB.
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-fw fa-user-friends text-warning"></i>
                                Dilarang mengizinkan teman lawan jenis untuk menginap tanpa izin.
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-fw fa-home text-warning"></i>
                                Harap memberitahukan kepada pemilik jika ada tamu yang akan menginap, terutama dari kampung halaman.
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-fw fa-exclamation-triangle text-warning"></i>
                                Segala bentuk tindakan tidak senonoh sangat dilarang.
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-fw fa-ban text-warning"></i>
                                Dilarang membawa atau mengonsumsi minuman beralkohol di lingkungan kontrakan.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Daftar kamar -->
                <?php if (!empty($kamar)): ?>
                    <div class="row row-cols-1 row-cols-md-3 g-4"> <!-- Penggunaan grid Bootstrap -->
                        <?php foreach ($kamar as $k) { ?>
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    <div class="img-container">
                                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $k->image; ?>" alt="Gambar Kamar" class="card-img-top img-fluid rounded" style="height: 300px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title text-capitalize"><?= $k->nama_kamar ?></h4>
                                        <p class="card-text">
                                            <i class="fas fa-map-marker-alt"></i> <?= $k->lokasi ?>
                                        </p>
                                        <p class="card-text"><span class="fw-bold">Rp<?= number_format($k->harga, 0, ',', '.'); ?></span> /Bulan</p>
                                        <a href="<?= base_url('home/detailkamar/') . $k->id_kamar ?>" class="btn btn-warning w-100">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center mt-5" role="alert">
                        <i class="fas fa-exclamation-circle fa-2x"></i>
                        <h5 class="mt-2">Mohon Maaf</h5>
                        <p>Saat ini semua kamar sedang terisi. Silahkan cek kembali secara berkala dilain waktu</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Menambahkan hover efek untuk gambar */
    .img-container {
        overflow: hidden;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .img-container img {
        transition: transform 0.3s ease-in-out;
    }

    .img-container:hover img {
        transform: scale(1.1);
        /* Zoom in saat hover */
    }

    /* Card hover efek */
    .card {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        /* Sedikit perbesar card saat hover */
    }

    /* Menambahkan shadow untuk efek kedalaman */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    /* Peraturan bagian ikon dan teks */
    .list-unstyled li {
        font-size: 1.1em;
    }

    .list-unstyled i {
        margin-right: 10px;
    }

    .card-header {
        border-bottom: 2px solid #e0a800;
    }

    .btn-warning {
        transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        box-shadow: 0 4px 12px rgba(224, 168, 0, 0.4);
    }
</style>