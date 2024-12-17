<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="mb-3">
                        Edit Kamar - <?= $kamar->nama_kamar ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <span onclick="window.history.go(-1)" class="btn btn-block bg-gradient-danger">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kamar
                        </span>
                    </ol> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Error & Success Messages -->
    <?php if ($this->session->flashdata('upload_error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('upload_error'); ?>
        </div>
    <?php endif; ?>
    <div id="flash-message">
        <?= $this->session->flashdata('pesan'); ?>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <!-- Form wrapped in a card -->
                    <div class="card shadow">
                        <!-- <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Edit Kamar</h4>
                        </div> -->
                        <div class="card-body">
                            <form action="<?= base_url('admin/editkamar/' . $kamar->id_kamar); ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-3 text-center">
                                    <img src="<?= base_url('assets/img/upload/') . $kamar->image ?>" class="card-img-top rounded mb-3" alt="<?= $kamar->nama_kamar; ?>" style="object-fit: cover; height: 300px;">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_kamar" class="form-label">Nama Kamar</label>
                                    <input type="text" class="form-control" name="nama_kamar" id="nama_kamar" value="<?php echo set_value('nama_kamar', $kamar->nama_kamar); ?>" required>
                                    <?php echo form_error('nama_kamar'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required><?php echo set_value('deskripsi', $kamar->deskripsi); ?></textarea>
                                    <?php echo form_error('deskripsi'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" name="harga" id="harga" value="<?php echo set_value('harga', $kamar->harga); ?>" required>
                                    <?php echo form_error('harga'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    <input type="hidden" name="old_image" value="<?php echo $kamar->image; ?>">
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary">Update Kamar</button>
                                    <span onclick="window.history.go(-1)" class="btn btn-secondary">Batal</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript Redirect if Upload is Success -->
<script>
    <?php if ($this->session->flashdata('upload_status') == 'success'): ?>
        // Jika upload sukses, kembali ke halaman sebelumnya
        setTimeout(function() {
            window.history.go(-1);
        }, 2000); // Setelah 2 detik akan redirect
    <?php endif; ?>
</script>