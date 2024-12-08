<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Penyewaan</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Laporan Penyewaan Kamar</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="get" action="<?= base_url('sewa/laporan_penyewaan'); ?>">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="keyword"
                                        class="form-control"
                                        placeholder="Cari Nama Kamar atau Nama Penyewa"
                                        value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                                    <button type="submit" class="btn btn-danger">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (!empty($laporan)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kamar</th>
                                        <th>Lokasi</th>
                                        <th>Nama Penyewa</th>
                                        <th>Tanggal Mulai Sewa</th>
                                        <th>Tanggal Selesai Sewa</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Penyewaan</th> <!-- New column for rental status -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($laporan as $report): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $report->nama_kamar; ?></td>
                                            <td><?= $report->lokasi; ?></td>
                                            <td class="text-capitalize"><?= $report->nama; ?></td>
                                            <td><?= date('d M Y', strtotime($report->sewa_start)); ?></td>
                                            <td><?= date('d M Y', strtotime($report->sewa_end)); ?></td>
                                            <td>Rp<?= number_format($report->jumlah, 0, ',', '.'); ?></td>
                                            <td>
                                                <span class="badge badge-<?= $report->payment_status == 'paid' ? 'success' : ($report->payment_status == 'pending' ? 'warning' : 'danger'); ?>">
                                                    <?= ucfirst($report->payment_status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?= $report->status == 'ongoing' ? 'success' : ($report->status == 'pending' ? 'warning' : 'danger'); ?>">
                                                    <?= ucfirst($report->status); ?>
                                                </span>
                                            </td> <!-- Display the rental status -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                            <h5 class="mt-2">Tidak Ada Data Penyewaan</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>