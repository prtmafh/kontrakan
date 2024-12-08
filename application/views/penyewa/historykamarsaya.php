<div class="container mt-4">
    <h2 class="mb-4 text-center">Riwayat Sewa Kamar</h2>

    <?php if (!empty($kamar_saya)): ?>
        <?php foreach ($kamar_saya as $booking): ?>
            <div class="card mb-4 p-3 shadow-lg rounded" style="border: none;">
                <div class="row g-0 align-items-center">
                    <!-- Gambar di sebelah kiri -->
                    <div class="col-md-4">
                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $booking->image; ?>" alt="Gambar Kamar" class="img-fluid rounded fixed-image shadow-sm">
                    </div>

                    <!-- Informasi kamar -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-3" style="font-weight: 700; color: #333;"><?= $booking->nama_kamar; ?></h5>
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td><i class="fas fa-fw fa-map-marker-alt "></i> <span class="">Lokasi</span></td>
                                    <td style="font-weight: 600;"><?= $booking->lokasi; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-fw fa-calendar "></i> <span class="">Tanggal Mulai</span></td>
                                    <td><?= date('d-m-Y', strtotime($booking->sewa_start)); ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-fw fa-calendar "></i> <span class="">Tanggal Akhir</span></td>
                                    <td><?= date('d-m-Y', strtotime($booking->sewa_end)); ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-fw fa-money-bill "></i> <span class="">Harga</span></td>
                                    <td>Rp<?= number_format($booking->harga, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-fw fa-info-circle "></i> <span class="">Status</span></td>
                                    <td>
                                        <span class="badge rounded-pill border border-2 bg-<?php echo ($booking->status === 'ongoing') ? 'success' : (($booking->status === 'pending') ? 'warning' : 'danger'); ?>">
                                            <?= ucfirst($booking->status); ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning text-center mt-5" role="alert" style="border: 2px solid #f0ad4e;">
            <i class="fas fa-exclamation-circle fa-2x"></i>
            <h5 class="mt-2">Oh Tidak!</h5>
            <p>Kamu belum menyewa kamar. Yuk, jelajahi pilihan kamar kami dan temukan yang cocok untukmu!</p>
        </div>
    <?php endif; ?>
</div>

<!-- CSS tambahan untuk tampilan -->
<style>
    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 20px;
        color: #235391;
    }

    .table td {
        padding: 0.6rem;
        font-size: 15px;
    }

    .badge {
        font-size: 14px;
        padding: 0.35rem 0.75rem;
        font-weight: 600;
    }

    .fixed-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Menambahkan warna teks pada ikon */
    /* .fas {
        color: #235391;
    } */
</style>