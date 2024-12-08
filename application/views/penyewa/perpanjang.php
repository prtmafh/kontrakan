<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">

            <h3 class="card-title text-center text-capitalize">Perpanjang Sewa: <?= $kamar->nama_kamar ?></h3>
            <p class="card-text text-center text-muted">Lokasi: <?= $kamar->lokasi ?></p>
            <p class="card-text text-center text-success">Harga per bulan: <strong>Rp<?= number_format($kamar->harga, 0, ',', '.') ?></strong></p>

            <!-- Form untuk penyewaan -->
            <form action="<?= base_url('sewa/perpanjang_sewa/') ?>" method="post" class="p-4">
                <input type="hidden" name="id_kamar" value="<?= $kamar->id_kamar ?>">
                <input type="hidden" name="harga" value="<?= $kamar->harga ?>">
                <input type="hidden" name="tanggal_mulai" value="<?= $kamar->sewa_end ?>">
                <input type="hidden" name="id_booking" value="<?= $kamar->id_booking ?>">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control shadow-sm rounded" id="durasi" name="durasi" min="1" placeholder="Masukkan durasi sewa dalam bulan" required>
                    <label for="durasi">Durasi Perpanjangan Sewa (bulan)</label>
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