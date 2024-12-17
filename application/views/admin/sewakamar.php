<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kamar yang Sedang Disewa</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-door-open"></i> Daftar Kamar yang Sedang Disewa</h4>
                </div>
                <div class="card-body">
                    <!-- Menampilkan pesan jika ada -->
                    <div id="flash-message">
                        <?= $this->session->flashdata('pesan'); ?>
                    </div>

                    <!-- Tombol untuk memperbarui status -->
                    <!-- <form action="<?= site_url('sewa/updateStatus') ?>" method="post" class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync-alt"></i> Refresh Status Sewa
                        </button>
                    </form> -->

                    <?php if (!empty($sewa)): ?>
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
                                        <th>Status Sewa</th> <!-- New column for rental status -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($sewa as $rental): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $rental->nama_kamar; ?></td>
                                            <td><?= $rental->lokasi; ?></td>
                                            <td class="text-capitalize"><?= $rental->nama; ?></td>
                                            <td><?= date('d M Y', strtotime($rental->sewa_start)); ?></td>
                                            <td><?= date('d M Y', strtotime($rental->sewa_end)); ?></td>
                                            <td>
                                                <span class="badge badge-<?= ($rental->status == 'ongoing') ? 'success' : 'warning'; ?>">
                                                    <?= ucfirst($rental->status); ?>
                                                </span>
                                            </td> <!-- Display the status -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                            <h5 class="mt-2">Tidak ada kamar yang sedang disewa saat ini.</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>