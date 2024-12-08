<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Kamar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/daftarkamar') ?>">Daftar Kamar</a></li>
                        <li class="breadcrumb-item active">Detail Kamar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?= $this->session->flashdata('pesan') ?>
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0 rounded-3">
                        <?php foreach ($kamar as $k) : ?>
                            <img src="<?= base_url('assets/img/upload/') . $k['image']; ?>" class="card-img-top rounded-top" alt="<?= $k['nama_kamar']; ?>" style="object-fit: cover; height: 400px;">
                            <div class="card-body p-5">

                                <h3 class="text-bold text-capitalize mb-4"><?= $k['nama_kamar']; ?></h3>

                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-muted">Deskripsi</th>
                                            <td><?= $k['deskripsi']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-muted">Lokasi</th>
                                            <td><?= $k['lokasi']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-muted">Status</th>
                                            <td>
                                                <?php if ($k['tersedia'] == 1): ?>
                                                    <span class="badge bg-success py-2 px-3">Tersedia</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger py-2 px-3">Sedang Disewa</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-muted">Harga</th>
                                            <td><?= 'Rp ' . number_format($k['harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="d-grid gap-2 mt-5">
                                    <button class="btn btn-warning shadow-sm" onclick="window.history.go(-1)">Kembali</button>
                                    <a href="<?= base_url('admin/editkamar/') . $k['id_kamar'] ?>" class="btn btn-danger shadow-sm mt-auto">Edit Kamar</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>