<div class="container mt-4">
    <!-- Modal Alert Pembayaran Berhasil -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sewa Kamar Berhasil!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Terima kasih, sewa kamar Anda telah berhasil diproses. Silakan hubungi pemilik kontrakan untuk konfirmasi dan detail lebih lanjut.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('home/kamarsaya'); ?>" class="btn btn-warning">Tutup</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        <?php if (!empty($booking)): ?>
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        <?php endif; ?>
    };
</script>