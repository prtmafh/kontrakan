<div class="container mt-5">
    <?= $this->session->flashdata('pesan'); ?>

    <div class="d-flex justify-content-center">
        <div class="card mb-3 shadow-lg" style="max-width: 700px; border-radius: 15px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded p-2" alt="<?= $user['nama']; ?>" style="border-radius: 50%; max-height: 250px; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize"><?= $user['nama'] ?></h5>
                        <p class="card-text"><?= $user['email'] ?></p>
                        <p class="text-muted"><?= $user['no_hp'] ?></p>
                        <p class="card-text">
                            <small class="text-muted">Bergabung sejak <?= date('d M Y', strtotime($user['created_at'])) ?></small>
                        </p>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('profile/edit_profile'); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Ubah Foto Profil</label>
                        <input class="form-control" type="file" id="profilePicture" name="profile_picture">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="nama" value="<?= $user['nama']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">No. Telpon</label>
                        <input type="text" class="form-control" id="name" name="nama" value="<?= $user['nama']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>