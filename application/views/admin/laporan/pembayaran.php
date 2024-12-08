<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Pembayaran</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Laporan Pembayaran Kamar</h4>
                </div>

                <div class="card-body">
                    <!-- Pendapatan Bulan Ini dan Histori Pendapatan -->
                    <div class="row mb-3">
                        <!-- Pendapatan Bulan Ini -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5>Pendapatan Bulan Ini - <?= date('M'); ?> <?= date('Y') ?></h5>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-success">
                                        <strong>Rp<?= number_format($pendapatan_bulan_ini, 0, ',', '.'); ?></strong>
                                    </h4>
                                    <p class="text-muted">Pendapatan bulan ini berdasarkan pembayaran yang sudah diterima.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Histori Pendapatan -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5>Histori Pendapatan Bulanan</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Dropdown Pilih Bulan -->
                                    <div class="dropdown mb-3">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilih Bulan
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <?php foreach ($pendapatan_histori as $histori): ?>
                                                <li>
                                                    <a class="dropdown-item" href="#" onclick="showPendapatan('<?= $histori->bulan; ?>', <?= $histori->total; ?>)">
                                                        <?= $histori->bulan; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                    <!-- Menampilkan Pendapatan Berdasarkan Bulan -->
                                    <div id="pendapatanBulan" class="mt-3" style="display: none;">
                                        <h6><strong>Total Pendapatan : <span class="text-success" id="pendapatanTotal" class="fs-4"></span></strong></h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Search form -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="get" action="<?= base_url('sewa/laporan_pembayaran'); ?>">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="keyword"
                                        class="form-control"
                                        placeholder="Cari Nama Kamar atau Nama Penyewa"
                                        value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Laporan -->
                    <?php if (!empty($laporan)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kamar</th>
                                        <th>Lokasi</th>
                                        <th>Nama Penyewa</th>
                                        <th>Total Pembayaran</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Keterangan</th>
                                        <th>Bukti Pembayaran</th>
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
                                            <td>Rp<?= number_format($report->jumlah, 0, ',', '.'); ?></td>
                                            <td>
                                                <?php
                                                if ($report->payment_method == 'bank_transfer') {
                                                    echo 'Transfer Bank';
                                                } elseif ($report->payment_method == 'cash') {
                                                    echo 'Tunai';
                                                } else {
                                                    echo ucfirst($report->payment_method);
                                                }
                                                ?>
                                            </td>
                                            <td><?= date('d M Y', strtotime($report->tanggal_pembayaran)); ?></td>
                                            <td>
                                                <span class="badge badge-<?= $report->payment_status == 'paid' ? 'success' : ($report->payment_status == 'pending' ? 'warning' : 'danger'); ?>">
                                                    <?= ucfirst($report->payment_status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= $report->perpanjangan == 1 ? 'Perpanjangan' : 'Sewa'; ?>
                                            </td>
                                            <td>
                                                <?php if ($report->payment_method == 'cash'): ?>
                                                    <span class="badge badge-secondary">Pembayaran Tunai</span>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalBukti<?= $report->id_pembayaran; ?>">
                                                        Lihat Bukti
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                            <h5 class="mt-2">Tidak Ada Data Pembayaran</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    // Fungsi untuk menampilkan pendapatan sesuai bulan yang dipilih
    function showPendapatan(bulan, total) {
        // Menampilkan div dengan informasi pendapatan
        document.getElementById("pendapatanBulan").style.display = "block";

        // Mengubah teks pendapatan yang akan ditampilkan
        document.getElementById("pendapatanTotal").innerText = "Rp" + total.toLocaleString('id-ID');
    }
</script>


<!-- Include Bootstrap CSS and JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>