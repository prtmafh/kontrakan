<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h2 class="text-capitalize">Pembayaran untuk: <?= $booking->nama_kamar ?></h2>
        </div>
        <div class="card-body">
            <p class="fs-5">Total Harga: <span class="fw-bold">Rp<?= number_format($booking->jumlah, 0, ',', '.') ?></span></p>

            <!-- Form pembayaran utama -->
            <form id="paymentForm" action="<?= base_url('pembayaran/proses_pembayaran') ?>" method="post">
                <input type="hidden" name="id_booking" value="<?= $booking->id_booking ?>"> <!-- ID booking harus ada -->
                <input type="hidden" name="jumlah" value="<?= $booking->jumlah ?>"> <!-- Pastikan total harga juga ada -->

                <div class="mb-4">
                    <label for="payment_method" class="form-label fs-5">Pilih Metode Pembayaran</label>
                    <select class="form-select form-select-lg" id="payment_method" name="payment_method" required>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="cash">Tunai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning btn-lg w-100">Bayar Sekarang</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk Transfer Bank -->
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="transferModalLabel">Detail Transfer Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Silakan transfer ke rekening berikut:</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><strong>Nama Rekening:</strong> Adim Assalam</li>
                    <li><strong>Nomor Rekening:</strong> 1234567890</li>
                </ul>

                <!-- Form input data transfer -->
                <form id="transferForm" action="<?= base_url('pembayaran/proses_transfer') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_booking" value="<?= $booking->id_booking ?>">
                    <input type="hidden" name="jumlah" value="<?= $booking->jumlah ?>">

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Nomor Rekening Anda</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" required placeholder="Masukkan nomor rekening Anda">
                    </div>

                    <div class="mb-3">
                        <label for="account_name" class="form-label">Nama Rekening Anda</label>
                        <input type="text" class="form-control" id="account_name" name="account_name" required placeholder="Masukkan nama rekening Anda">
                    </div>

                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Unggah Bukti Transfer</label>
                        <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100">Konfirmasi Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Cegah form agar tidak langsung dikirim jika metode pembayaran adalah transfer bank

        var paymentMethod = document.getElementById('payment_method').value;

        if (paymentMethod === 'bank_transfer') {
            // Tampilkan modal jika metode pembayaran adalah Transfer Bank
            var transferModal = new bootstrap.Modal(document.getElementById('transferModal'));
            transferModal.show();

            // Saat submit di form modal transfer
            document.getElementById('transferForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Cegah pengiriman form default
                this.submit(); // Kirim form setelah pengguna mengisi detail transfer
            });
        } else {
            // Jika pembayaran tunai, langsung submit form utama
            this.submit();
        }
    });
</script>