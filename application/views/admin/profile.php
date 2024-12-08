<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?= base_url('') ?>assets/img/profile/<?= $user['image'] ?>"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center text-capitalize"><?= $user['nama']; ?></h3>

                            <p class="text-muted text-center"><?= $user['role']; ?></p>

                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editProfileModal"><b>Edit Profile</b></a>

                            <!-- Modal -->
                            <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('admin/edit_profile') ?>" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">No. Telpon</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $user['no_hp']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Foto Profil</label>
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-bold my-0">Identitas</h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="bg-light"><i class="bi bi-person-fill text-primary"></i> Nama</th>
                                            <td class="text-capitalize"> <?= $user['nama'] ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="bg-light"><i class="bi bi-envelope-fill text-primary"></i> Email</th>
                                            <td class="text-lowercase"> <?= $user['email'] ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="bg-light"><i class="bi bi-telephone-fill text-primary"></i> No. Telpon</th>
                                            <td> <?= $user['no_hp'] ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="bg-light"><i class="bi bi-calendar-fill text-primary"></i> Bergabung Sejak</th>
                                            <td> <?= date('d M Y', strtotime($user['created_at'])) ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>