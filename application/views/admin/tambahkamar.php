<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Kamar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/daftarkamar') ?>">Daftar Kamar</a></li>
                        <li class="breadcrumb-item active">Tambah Kamar</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url('admin/tambahkamar') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Kamar</label></label>
                                    <input type="text" class="form-control" id="nama_kamar" name="nama_kamar">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea type="text" class="form-control" rows="3" id="deskripsi" name="deskripsi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lokasi</label></label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi">
                                </div>
                                <label>Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Kamar</label>
                                    <input type="file" class="form-control form-control-user" id="image" name="image" multiple>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>