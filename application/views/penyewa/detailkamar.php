 <div class="container mt-4">
     <div class="x_panel">
         <div class="x_content">
             <?php foreach ($kamar as $k) { ?>
                 <!-- Carousel -->
                 <div id="demo" class="carousel slide" data-bs-ride="carousel">

                     <!-- Indicators/dots -->
                     <div class="carousel-indicators">
                         <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                         <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                         <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                     </div>

                     <!-- The slideshow/carousel -->
                     <div class="carousel-inner bg-dark justify-content-center align-items-center" style="height: 300px;"> <!-- Menambahkan d-flex dan height -->
                         <div class="carousel-item active">
                             <img src="<?php echo base_url(); ?>assets/img/upload/<?= $k->image; ?>" alt="Los Angeles" class="d-block mx-auto" style="height: 300px; ">
                         </div>
                         <div class="carousel-item">
                             <img src="<?php echo base_url(); ?>assets/img/upload/<?= $k->image; ?>" alt="Chicago" class="d-block mx-auto" style="height: 300px; ">
                         </div>
                         <div class="carousel-item">
                             <img src="<?php echo base_url(); ?>assets/img/upload/<?= $k->image; ?>" alt="New York" class="d-block mx-auto" style="height: 300px; ">
                         </div>
                     </div>

                     <!-- Left and right controls/icons -->
                     <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                         <span class="carousel-control-prev-icon"></span>
                     </button>
                     <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                         <span class="carousel-control-next-icon"></span>
                     </button>
                 </div>
             <?php } ?>
         </div>
     </div>
 </div>
 <?php foreach ($kamar as $k) { ?>
     <div class="container mt-2">
         <div class="row">
             <div class="col-12 col-sm-12 col-md-7 col-lg-8">
                 <div class="card bg-light" style="padding-right: 20px; padding-left: 20px;">
                     <div class="card-body">
                         <h4 class="card-title text-capitalize mb-3"><?= $k->nama_kamar ?></h4>

                         <p class="card-text"><?= $k->deskripsi ?></p>
                         <ul class="list-group mb-3">
                             <li class="list-group-item bg-transparent border-0">
                                 <i class="fas fa-fw fa-map-marker-alt"></i>
                                 <?= $k->lokasi ?>

                             </li>
                             <li class="list-group-item bg-transparent border-0">

                                 <i class="fas fa-fw fa-money-bill-wave"></i>
                                 <?= number_format($k->harga, 0, ',', '.') ?> /Bulan

                             </li>
                             <!-- <li class="list-group-item bg-transparent border-0">
                                 <i class="fas fa-fw fa-question-circle"></i>
                                 <?php
                                    if ($k->tersedia == 1) {
                                        echo 'Tersedia';
                                    } else {
                                        echo 'Sedang Disewa';
                                    }
                                    ?>
                                 <?= $k->tersedia ?>
                             </li> -->

                         </ul>

                         <div class=" mb-3 border-radius-2px embed-responsive embed-responsive-16by9">
                             <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.951984694391!2d107.07910917453182!3d-6.270045161379606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698f924e5689d5%3A0x3ac24ab1679a87ae!2sKontrakan%20bp.%20Adim!5e0!3m2!1sid!2sid!4v1729020065262!5m2!1sid!2sid" width="380" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                         </div>
                         <!-- <a href="https://wa.me/628978640547?text=Apakah <?= $k->nama_kamar ?> di <?= $k->lokasi ?> masih tersedia?" class="card-link btn btn-warning">Tanya-Tanya</a>

                     <a href="<?= base_url('sewa/index/') . $k->id_kamar ?>" class="card-link btn btn-danger">Sewa Kamar</a> -->
                     </div>
                 </div>
             </div>
             <div class=" gradient rounded-2 mt-4 d-none d-sm-none d-md-block d-xl-block col-md-5 col-lg-4">
                 <div class=" sticky-top" style="top: 90px;">
                     <div class="row m-3">
                         <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>"" class=" img-thumbnail rounded-circle col-3" alt="">
                         <p class="h3 fw-bold mt-4 col-sm-auto text-capitalize"><?= $user['nama'] ?></p>
                     </div>
                     <a href="https://wa.me/628978640547?text=Apakah <?= $k->nama_kamar ?> di <?= $k->lokasi ?> masih tersedia?" class="btn btn-warning col-12 mt-3"><i class="bi bi-chat-left-dots"></i> Tanya-Tanya</a>
                     <a href="<?= base_url('sewa/index/') . $k->id_kamar ?>" class="btn btn-danger col-12 mt-3">Sewa Kamar</a>
                 </div>
             </div>

         </div>
     </div>

     <div class="container-fluid d-md-none fixed-bottom bg-light">
         <div class=" text-dark">
             <div class="row">
                 <a class="btn m-3 btn-warning col-5" href="https://wa.me/628978640547?text=Apakah <?= $k->nama_kamar ?> di <?= $k->lokasi ?> masih tersedia?">Tanya-Tanya</a>
                 <a class="btn m-3 btn-danger col-5" href="<?= base_url('sewa/index/') . $k->id_kamar ?>">Sewa Kamar</a>
             </div>
         </div>
     </div>
 <?php } ?>