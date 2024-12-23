<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        <a href="<?= base_url() ?>profile/ubah/<?= $this->session->userdata('login_session')['id_user'] ?>" class="btn btn-sm btn-primary btn-icon-split">
            <span class="text text-white">Ubah Profil</span>
            <span class="icon text-white-50">
                <i class="fas fa-pen"></i>
            </span>
        </a>
    </div>
     <?php if ($this->session->flashdata('Pesan')): ?>
        <?= $this->session->flashdata('Pesan') ?>
    <?php endif; ?>
    <div class="row">
        
        <div class="col-lg-2"></div>

        <div class="col-lg-8 mb-4">

            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <div class="mb-3">
                                <img class="img-profile rounded-circle" id="outputImg" width="150" height="150" src="<?= base_url() ?>assets/upload/pengguna/user.png">
                            </div>
                            <div class="mb-3">
                                <h1 class="h4 mb-0 text-gray-800" id="namaL">-</h1>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <h3 class="h5 mb-0 text-gray-800">
                                    <i class="fa fa-qrcode"></i>
                                    <span class="ml-2" id="nik">-</span>
                                </h3>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h3 class="h5 mb-0 text-gray-800">
                                    <i class="fa fa-envelope"></i>
                                    <span class="ml-2" id="email">-</span>
                                </h3>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h3 class="h5 mb-0 text-gray-800">
                                    <i class="fa fa-phone"></i>
                                    <span class="ml-2" id="notelp">-</span>
                                </h3>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h3 class="h5 mb-0 text-gray-800">
                                    <i class="fa fa-check-circle"></i>
                                    <span class="ml-2" id="status">-</span>
                                </h3>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h3 class="h5 mb-0 text-gray-800">
                                    <i class="fa fa-user"></i>
                                    <span class="ml-2" id="level">-</span>
                                </h3>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Profile Card -->
        </div>
    </div>
</div>
<!-- End of Main Content -->



<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/profile.js"></script>

<!-- <?php if($this->session->flashdata('Pesan')): ?>
<?= $this->session->flashdata('Pesan') ?>
<?php else: ?>
<script>
$(document).ready(function() {
    let timerInterval
    Swal.fire({
        title: 'Memuat...',
        timer: 1000,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        $("#profil").addClass("bounceIn");
    })
});
</script>
<?php endif; ?> -->