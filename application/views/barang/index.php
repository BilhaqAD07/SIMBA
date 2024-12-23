<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
        <div class="d-flex">
            <a href="<?= base_url() ?>barang/tambah" class="btn btn-sm btn-primary btn-icon-split mr-2">
                <span class="text text-white">Tambah Data</span>
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
            </a>

            <a href="<?= base_url('barang/scan_code') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                <span class="text text-white">Scan Code</span>
                <span class="icon text-white-50">
                    <i class="fas fa-qrcode"></i>
                </span>
            </a>
        </div>

    </div>
     <?php if ($this->session->flashdata('Pesan')): ?>
                        <?= $this->session->flashdata('Pesan') ?>
                    <?php endif; ?>
    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <div class="card border-bottom-secondary shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dtHorizontalExample" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Kode Barang</th>
                                <th>Foto</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
								<th>Status Barang</th>
                             
                                <th width="1%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="cursor:pointer;" id="tbody">
                            <?php $no=1; foreach ($barang as $b): ?>
                            <tr>
                                <td><?= $no++ ?>.</td>
                               <!-- View (index.php) -->
                               <td>
                                <?php
                                $id_barang = $b->id_barang;
                                $qr_exists = file_exists('assets/qrcode/' . $id_barang . '.png');
                                $barcode_exists = file_exists('assets/barcode/' . $id_barang . '.png');

                                if ($qr_exists || $barcode_exists): ?>
                                    <?php if ($qr_exists): ?>
                                        <a href="<?= base_url('barang/download_qr/' . $id_barang) ?>" class="btn btn-primary">
                                            <img src="<?= base_url('assets/qrcode/' . $id_barang . '.png') ?>" alt="QR Code" width="75px" />
                                            <br><?= $id_barang ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($barcode_exists): ?>
                                        <a href="<?= base_url('barang/download_barcode/' . $id_barang) ?>" class="btn btn-secondary">
                                            <img src="<?= base_url('assets/barcode/' . $id_barang . '.png') ?>" alt="Barcode Barang" width="75px" /> <br><?= $id_barang ?>
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?= $id_barang ?>
                                <?php endif; ?>
                            </td>


                                <td><a href="assets/upload/barang/<?= $b->foto ?>" data-lightbox="user-foto" data-title="<?= $b->nama_barang ?>">
                                        <img style="border-radius: 5px;" src="assets/upload/barang/<?= $b->foto ?>" alt="<?= $b->nama_barang ?>" width="75px">
                                    </a></td>
                                <!-- <td onclick="detail('<?= $b->id_barang ?>')"><?= $b->id_barang ?></td> -->
                                <td><?= $b->nama_barang ?></td>
                                <td><?= $b->nama_jenis ?></td>
								<td class="d-flex flex-column">
									<span>Aktif</span>
									<span>Non Delivery</span>
								</td>
                             
                                <td>
                                    <center>
                                         <a href="<?= base_url('barang/generate_qr/'.$b->id_barang) ?>" class="btn btn btn-primary btn-sm">Generate <i class="fas fa-qrcode"></i> </a>
                                          <!-- <a href="<?= base_url() ?>barang/detail2/<?= $b->id_barang ?>"
                                            class="btn btn btn-primary btn-sm">
                                            <i class="fas fa-file"></i> FIFO
                                        </a>
                                         <a href="<?= base_url() ?>barang/detail3/<?= $b->id_barang ?>"
                                            class="btn btn btn-success btn-sm">
                                            <i class="fas fa-file"></i> LIFO
                                        </a> -->
                                        <a href="<?= site_url('barang/generate_barcode/' . $b->id_barang) ?>" class="btn btn-primary btn-sm">Generate <i class="fas fa-barcode"></i> </a>
                                        <!-- <a href="<?= site_url('barang/download_barcode/' . $b->id_barang) ?>" class="btn btn-success">Download Barcode</a> -->

										
										<a href="<?= base_url() ?>barang/detail/<?= $b->id_barang ?>"
											class="btn btn-circle btn-info btn-sm">
											<i class="fas fa-eye"></i>
										</a>
										
										
										<?php if($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
											<a href="<?= base_url() ?>barang/ubah/<?= $b->id_barang ?>"
												class="btn btn-circle btn-success btn-sm">
												<i class="fas fa-pen"></i>
											</a>
										<?php endif; ?>

										<?php if($this->session->userdata('login_session')['level'] == 'superadmin'): ?>
                                        <a href="#" onclick="konfirmasi('<?= $b->id_barang ?>')"
                                            class="btn btn-circle btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
										<?php endif; ?>
                                    </center>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/barang.js"></script>
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

    })
});
</script>
<?php endif; ?> -->


