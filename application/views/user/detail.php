<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-sm-flex">
            <a href="<?= base_url() ?>user" class="btn btn-md btn-circle btn-secondary">
                <i class="fas fa-arrow-left"></i>
            </a>
            &nbsp;
            <h1 class="h2 mb-0 text-gray-800">Detail Pengguna</h1>
        </div>
    </div>

    <?php foreach ($data as $d): ?>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Foto Pengguna -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img width="80%" style="border-radius: 10px;" src="<?= base_url() ?>assets/upload/pengguna/<?= $d->foto ?>" alt="Foto Pengguna">
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <!-- Detail Pengguna -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ID Anggota -->
                    <div class="form-group"><label>ID Pengguna</label>
                        <h4 class="h4 text-gray-800"><b><?= $d->id_user ?></b></h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- NIK -->
                    <div class="form-group"><label>NIK</label>
                        <h4 class="h4 text-gray-800"><?= $d->nik ?></h4>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group"><label>Nama Lengkap</label>
                        <h4 class="h4 text-gray-800"><?= $d->nama ?></h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Username -->
                    <div class="form-group"><label>Username</label>
                        <h4 class="h4 text-gray-800"><?= $d->username ?></h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- NoTelepon -->
                    <div class="form-group"><label>Nomor Telepon</label>
                        <!-- Tambahkan link WhatsApp -->
                        <h4 class="h4 text-gray-800">
                            <a href="https://wa.me/<?= $d->notelp ?>" target="_blank" style="text-decoration: none;">
                                <img src="<?= base_url() ?>assets/img/wa.png" alt="WhatsApp" width="60" height="60" style="margin-bottom: -7px;">
                                <?= $d->notelp ?>
                            </a>
                        </h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Email -->
                    <div class="form-group"><label>Email</label>
                        <h4 class="h4 text-gray-800"><?= $d->email ?></h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Level -->
                    <div class="form-group"><label>Level</label>
                        <h4 class="h4 text-gray-800"><?= $d->level ?></h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Status -->
                    <div class="form-group"><label>Status</label>
                        <?php if($d->status == "Aktif"): ?>
                            <h4 class="h4 text-success">
                        <?php else: ?>
                            <h4 class="h4 text-gray-800">
                        <?php endif; ?>
                            <?= $d->status ?>
                        </h4>
                    </div>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- Script dan CSS WhatsApp Icon -->
<style>
    .whatsapp-icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        vertical-align: middle;
        margin-bottom: -7px;
    }
</style>
