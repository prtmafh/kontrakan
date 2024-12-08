<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <div id="demo" class="carousel slide mb-4" data-bs-ride="carousel">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner bg-dark rounded" style="height: 400px;">
                    <div class="carousel-item active">
                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $kamar->image; ?>" alt="Gambar Kamar" class="d-block mx-auto img-fluid" style="max-height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $kamar->image; ?>" alt="Gambar Kamar" class="d-block mx-auto img-fluid" style="max-height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url(); ?>assets/img/upload/<?= $kamar->image; ?>" alt="Gambar Kamar" class="d-block mx-auto img-fluid" style="max-height: 400px;">
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <h3 class="card-title text-center text-capitalize"><?= $kamar->nama_kamar ?></h3>
            <p class="card-text text-center text-muted">Lokasi: <?= $kamar->lokasi ?></p>
            <p class="card-text text-center text-success">Harga per bulan: <strong>Rp<?= number_format($kamar->harga, 0, ',', '.') ?></strong></p>

            <!-- Form untuk penyewaan -->
            <form action="<?= base_url('sewa/proses_sewa') ?>" method="post" class="p-4">
                <input type="hidden" name="id_kamar" value="<?= $kamar->id_kamar ?>">
                <input type="hidden" name="harga" value="<?= $kamar->harga ?>">

                <div class="form-floating mb-3">
                    <input type="date" class="form-control shadow-sm rounded" id="tanggal_mulai" name="tanggal_mulai" required>
                    <label for="tanggal_mulai">Tanggal Mulai Sewa</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control shadow-sm rounded" id="durasi" name="durasi" min="1" placeholder="Masukkan durasi sewa dalam bulan" required>
                    <label for="durasi">Durasi Sewa (bulan)</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control shadow-sm rounded" id="total_harga" name="total_harga" readonly>
                    <label for="total_harga">Total Harga yang Harus Dibayar</label>
                </div>

                <button type="submit" class="btn btn-warning btn-lg w-100 shadow-sm">Sewa Sekarang</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('durasi').addEventListener('input', function() {
            var durasi = this.value;
            var hargaPerBulan = <?= $kamar->harga ?>; // Harga per bulan dari database
            var totalHarga = durasi * hargaPerBulan;

            // Format rupiah
            var totalHargaFormatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(totalHarga);

            document.getElementById('total_harga').value = totalHargaFormatted;
        });
    </script>
</div>