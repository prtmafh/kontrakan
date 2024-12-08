<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penyewa</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Informasi Penyewa</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="get" action="<?= base_url('admin/data_penyewa'); ?>">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="keyword"
                                        class="form-control"
                                        placeholder="Cari Nama Penyewa"
                                        value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                                    <button type="submit" class="btn btn-secondary">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (!empty($penyewa)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Penyewa</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($penyewa as $tenant): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <img src="<?= base_url('assets/img/profile/' . $tenant->image); ?>" alt="Foto Penyewa" class="img-thumbnail" style="width: 60px; height: 60px;">
                                            </td>
                                            <td class="text-capitalize"><?= $tenant->nama; ?></td>
                                            <td><?= $tenant->email; ?></td>
                                            <td><?= $tenant->no_hp; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                            <h5 class="mt-2">Tidak Ada Data Penyewa</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>