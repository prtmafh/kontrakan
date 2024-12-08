<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Detail Sewa Kamar</h3>
            <ul class="list-group list-group-flush mb-4">
                <!-- Informasi Sewa -->
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-calendar-alt me-2"></i> Tanggal Mulai Sewa</span>
                    <span><?= date('d-m-Y', strtotime($sewa->sewa_start)) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-calendar-check me-2"></i> Tanggal Selesai Sewa</span>
                    <span><?= date('d-m-Y', strtotime($sewa->sewa_end)) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2"></i> Durasi Sewa</span>
                    <span>
                        <?php
                        $sewa_start = new DateTime($sewa->sewa_start);
                        $sewa_end = new DateTime($sewa->sewa_end);
                        $interval = $sewa_start->diff($sewa_end);
                        echo $interval->m . ' Bulan';
                        ?>
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-hourglass-half me-2"></i> Sisa Waktu Sewa</span>
                    <span id="sisa_waktu_sewa">-</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-money-bill-wave me-2"></i> Harga Sewa</span>
                    <span>Rp<?= number_format($sewa->harga, 0, ',', '.') ?></span>
                </li>

                <!-- Tambahan Total Bayar dan Metode Pembayaran -->
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-hand-holding-usd me-2"></i> Total Bayar</span>
                    <span>Rp<?= number_format($sewa->jumlah, 0, ',', '.') ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-credit-card me-2"></i> Metode Pembayaran</span>
                    <span>
                        <?php
                        if ($sewa->payment_method == 'bank_transfer') {
                            echo 'Transfer Bank';
                        } elseif ($sewa->payment_method == 'cash') {
                            echo 'Tunai';
                        } else {
                            echo ucfirst($sewa->payment_method); // default tampilkan seperti aslinya jika metode lain
                        }
                        ?>
                    </span>
                </li>


                <!-- Status Sewa -->
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2"></i> Status</span>
                    <span>
                        <?php if ($sewa->status == 'completed'): ?>
                            <span class="badge bg-danger"><?= ucfirst($sewa->status); ?></span>
                        <?php elseif ($sewa->status == 'ongoing'): ?>
                            <span class="badge bg-success"><i class="fas fa-check-circle"></i> <?= ucfirst($sewa->status); ?></span>
                        <?php elseif ($sewa->status == 'canceled'): ?>
                            <span class="badge bg-danger"><i class="fas fa-times-circle"></i> <?= ucfirst($sewa->status); ?></span>
                            <p class="text-danger mt-2">Pembayaran Ditolak</p>
                        <?php elseif ($sewa->status == 'pending'): ?>
                            <span class="badge bg-warning"><i class="fas fa-hourglass-half"></i> <?= ucfirst($sewa->status); ?></span>
                        <?php endif; ?>
                    </span>
                </li>
            </ul>

            <!-- Pengingat -->
            <div id="pengingat_sewa" class="text-center mb-4"></div>

            <!-- Tombol Perpanjang Sewa -->
            <?php if ($sewa->status !=  'completed'): ?>
                <a href="<?= base_url('sewa/perpanjang/' . $sewa->id_kamar) ?>" class="btn btn-warning btn-lg w-100 mb-3">Perpanjang Sewa</a>
            <?php endif; ?>

            <button class="btn btn-danger btn-lg w-100" onclick="window.history.go(-1)">Kembali</button>
        </div>
    </div>
</div>

<script>
    var sewaStart = new Date("<?= $sewa->sewa_start ?>").setHours(0, 0, 0, 0); // Set time to midnight
    var sewaEnd = new Date("<?= $sewa->sewa_end ?>").getTime();
    var today = new Date().setHours(0, 0, 0, 0); // Set time to midnight for today's date

    function updateRemainingTime() {
        var currentTime = new Date().getTime();
        var statusSewa = <?= json_encode($sewa->status) ?>;

        // Jika status sewa completed atau canceled, keluar dari fungsi
        if (statusSewa === 'completed' || statusSewa === 'canceled') {
            clearInterval(countdownInterval);
            document.getElementById("sisa_waktu_sewa").innerHTML = "Sewa Sudah Habis";
        }

        // Jika tanggal sekarang kurang dari tanggal mulai sewa, tidak perlu menghitung sisa waktu
        if (currentTime <= sewaStart) {
            document.getElementById("sisa_waktu_sewa").innerHTML = "Sewa Belum Dimulai";
            return;
        }

        var timeRemaining = sewaEnd - currentTime;
        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        // Tampilkan sisa waktu sewa
        document.getElementById("sisa_waktu_sewa").innerHTML = days + " Hari " + hours + " Jam";

        // Tampilkan alert jika sisa waktu kurang dari atau sama dengan 3 hari
        if (days <= 3 && days > 0) {
            document.getElementById("pengingat_sewa").innerHTML =
                '<div class="alert alert-warning">Sisa ' + days + ' hari. Silahkan lakukan perpanjangan sewa!</div>';
        } else {
            document.getElementById("pengingat_sewa").innerHTML = ""; // Kosongkan alert jika tidak relevan
        }

        // Jika sisa waktu sudah habis
        if (days <= 0) {
            clearInterval(countdownInterval);
            document.getElementById("sisa_waktu_sewa").innerHTML = "Sewa Sudah Habis";
            document.getElementById("pengingat_sewa").innerHTML = ""; // Kosongkan alert saat waktu habis
        }
    }

    var countdownInterval = setInterval(updateRemainingTime, 1000);


    var countdownInterval = setInterval(updateRemainingTime, 1000);
</script>

<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .badge {
        padding: 0.5em 1em;
        font-size: 1em;
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
    }

    .alert-warning {
        background-color: #ffdd57;
        color: #856404;
    }

    ul.list-group {
        margin-bottom: 20px;
        font-size: 1.1em;
    }
</style>