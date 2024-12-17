<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perpanjangan Kamar</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div id="flash-message">
                <?= $this->session->flashdata('pesan'); ?>
            </div>
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0"> <i class="fas fa-list"></i> Daftar Perpanjangan Kamar yang Menunggu Persetujuan</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($pending_bookings)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kamar</th>
                                        <th>Nama Penyewa</th>
                                        <th>Tanggal Booking</th>
                                        <th>Tanggal Mulai Sewa</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Booking</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pending_bookings as $booking): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $booking->nama_kamar; ?></td>
                                            <td class="text-capitalize"><?= $booking->nama; ?></td>
                                            <td><?= date('d M Y', strtotime($booking->created_at)); ?></td>
                                            <td><?= date('d M Y', strtotime($booking->sewa_start)); ?></td>
                                            <td>Rp<?= number_format($booking->jumlah, 0, ',', '.'); ?></td>
                                            <td>
                                                <a href="#" class="badge badge-<?php
                                                                                if ($booking->payment_status == 'paid') {
                                                                                    echo 'success';
                                                                                } elseif ($booking->payment_status == 'pending') {
                                                                                    echo 'warning';
                                                                                } else {
                                                                                    echo 'danger';
                                                                                }
                                                                                ?>"
                                                    data-toggle="modal"
                                                    data-target="#paymentModal"
                                                    data-booking-id="<?= $booking->id_booking; ?>"
                                                    data-nama="<?= $booking->nama; ?>"
                                                    data-jumlah="<?= number_format($booking->jumlah, 0, ',', '.'); ?>"
                                                    data-proof="<?= base_url('assets/img/pembayaran/' . $booking->bukti_transfer); ?>"
                                                    data-payment-method="<?= $booking->payment_method; ?>"
                                                    data-account-number="<?= $booking->no_rekening; ?>"
                                                    data-account-name="<?= $booking->nama_rekening; ?>">
                                                    <?= ucfirst($booking->payment_status); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?= $booking->booking_status == 'approved' ? 'success' : ($booking->booking_status == 'pending' ? 'warning' : 'danger'); ?>">
                                                    <?= ucfirst($booking->booking_status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/approve_perpanjangan/' . $booking->id_booking); ?>" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </a>
                                                    <a href="<?= base_url('admin/reject_perpanjangan/' . $booking->id_booking); ?>" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                            <h5 class="mt-2">Tidak Ada Booking yang Menunggu Persetujuan</h5>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Modal Pembayaran -->
                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Detail Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama Penyewa:</strong> <span class="text-capitalize" id="modalPenyewa"></span></p>
                                <p><strong>Jumlah Pembayaran: </strong>Rp <span id="modalAmount"></span></p>
                                <p><strong>Metode Pembayaran:</strong> <span id="modalPaymentMethod"></span></p>
                                <p><strong>Nomor Rekening:</strong> <span id="modalAccountNumber"></span></p>
                                <p><strong>Nama Rekening:</strong> <span id="modalAccountName"></span></p>
                                <p><strong>Bukti Pembayaran:</strong></p>
                                <img id="modalProof" class="img-fluid" alt="Bukti Pembayaran">
                            </div>
                            <div class="modal-footer">
                                <a href="#" id="approvePaymentBtn" class="btn btn-success">Setujui Pembayaran</a>
                                <a href="#" id="rejectPaymentBtn" class="btn btn-danger">Tolak Pembayaran</a>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        // Ketika modal ditampilkan
                        $('#paymentModal').on('show.bs.modal', function(event) {
                            var button = $(event.relatedTarget); // Tombol yang memicu modal

                            // Ambil data dari tombol
                            var nama = button.data('nama');
                            var jumlah = button.data('jumlah');
                            var proof = button.data('proof');
                            var bookingId = button.data('booking-id');
                            var paymentMethod = button.data('payment-method'); // Ambil metode pembayaran
                            var accountNumber = button.data('account-number'); // Ambil nomor rekening
                            var accountName = button.data('account-name'); // Ambil nama rekening

                            // Set data ke modal
                            $('#modalPenyewa').text(nama);
                            $('#modalAmount').text(jumlah);

                            // Cek metode pembayaran
                            if (paymentMethod === 'bank_transfer') {
                                $('#modalPaymentMethod').text('Transfer Bank'); // Set metode pembayaran ke "Transfer Bank"
                                $('#modalAccountNumber').text(accountNumber); // Set nomor rekening jika transfer
                                $('#modalAccountName').text(accountName); // Set nama rekening jika transfer
                                $('#modalProof').attr('src', proof); // Set bukti transfer
                            } else if (paymentMethod === 'cash') {
                                $('#modalPaymentMethod').text('Tunai'); // Set metode pembayaran ke "Tunai"
                                $('#modalAccountNumber').text('-'); // Kosongkan jika tunai
                                $('#modalAccountName').text('-'); // Kosongkan jika tunai
                                $('#modalProof').attr('src', ''); // Kosongkan bukti transfer jika tunai
                            }

                            // Set link untuk menyetujui atau menolak pembayaran
                            $('#approvePaymentBtn').attr('href', '<?= base_url("admin/approve_perpanjangan_payment/"); ?>' + bookingId);
                            $('#rejectPaymentBtn').attr('href', '<?= base_url("admin/reject_perpanjangan_payment/"); ?>' + bookingId);
                        });
                    });
                </script>


            </div>
        </div>
</div>
</section>
</div>