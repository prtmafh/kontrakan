<div class="container mt-4">
    <h2 class="mb-4 text-center">Kamar Saya</h2>

    <?php if (!empty($kamar_saya)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4"> <!-- Menggunakan card group untuk tata letak grid -->
            <?php foreach ($kamar_saya as $booking): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="img-container">
                            <img src="<?php echo base_url(); ?>assets/img/upload/<?= $booking->image; ?>" alt="Gambar Kamar" class="card-img-top img-fluid rounded" style="height: 250px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $booking->nama_kamar; ?></h5>
                            <p class="card-text">Lokasi: <?= $booking->lokasi; ?></p>
                            <p class="card-text">Harga: <span class="fw-bold">Rp<?= number_format($booking->harga, 0, ',', '.'); ?></span> /Bulan</p>
                            <!-- <p class="card-text">
                                Status Booking:
                                <span class="badge bg-<?php
                                                        echo ($booking->booking_status === 'approved') ? 'success' : (($booking->booking_status === 'pending') ? 'warning' : 'danger');
                                                        ?>">
                                    <?= ucfirst($booking->booking_status); ?>
                                </span>
                            </p> -->



                            <p class="card-text">
                                Status Pembayaran:
                                <span class="badge bg-<?php
                                                        if ($booking->payment_status === 'paid') {
                                                            echo 'success'; // Hijau untuk 'paid'
                                                        } elseif ($booking->payment_status === 'pending') {
                                                            echo 'warning'; // Kuning untuk 'pending'
                                                        } elseif ($booking->payment_status === 'rejected') {
                                                            echo 'danger';
                                                        } {
                                                            echo ''; // Merah untuk 'rejected'
                                                        }
                                                        ?>">
                                    <?= ucfirst($booking->payment_status); ?>
                                </span>
                            </p>
                            <p class="card-text">
                                Status Sewa Kamar:
                                <span class="badge bg-<?php
                                                        echo ($booking->status === 'ongoing') ? 'success' : (($booking->status === 'pending') ? 'warning' : 'danger');
                                                        ?>">
                                    <?= ucfirst($booking->status); ?>
                                </span>
                            </p>


                            <?php if ($booking->booking_status === 'approved'): ?>
                                <a href="<?= base_url('sewa/detail_kamar_saya/' . $booking->id_sewa) ?>" class="btn btn-warning w-100 ">Detail Kamar</a>
                            <?php elseif ($booking->booking_status === 'pending'): ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Sewa Kamar masih dalam proses. Tunggu konfirmasi admin.
                                </div>
                            <?php elseif ($booking->booking_status === 'rejected'): ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    Sewa kamar ditolak!. Silahkan lakukan penyewaan ulang
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center mt-5" role="alert">
            <i class="fas fa-exclamation-circle fa-2x"></i>
            <h5 class="mt-2">Oh Tidak!</h5>
            <p>Kamu belum menyewa kamar. Yuk, jelajahi pilihan kamar kami dan temukan yang cocok untukmu!</p>
        </div>
    <?php endif; ?>
</div>

<style>
    /* Tambahkan gaya khusus */
    .card {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        /* Animasi saat hover */
    }

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
        /* Zoom gambar saat hover */
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-warning {
        background-color: #ffc107;
    }

    .badge-danger {
        background-color: #dc3545;
    }
</style>