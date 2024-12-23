<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Supplier</h1>
		<div class="d-flex">
			<a href="" data-toggle="modal" data-target="#form" class="btn btn-sm btn-primary btn-icon-split mr-2">
				<span class="text text-white">Tambah Data</span>
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
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
					<table class="table " id="dtHorizontalExample" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Kode Supplier</th>
								<th>Foto</th>
								<th>Nama Supplier</th>
								<th>No.Telepon</th>
								<th>Alamat</th>
								<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
									<th width="1%">Aksi</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php $no = 1;
							foreach ($supplier as $s) { ?>
								<tr>
									<td><?= $no++ ?>.</td>
									<td><?= $s->id_supplier ?></td>
									<td><a href="assets/upload/supplier/<?= $s->foto ?>" data-lightbox="user-foto" data-title="<?= $s->nama_supplier ?>">
											<img style="border-radius: 5px;" src="assets/upload/supplier/<?= $s->foto ?>" alt="<?= $s->nama_supplier ?>" width="50px">
										</a></td>

									<td><?= $s->nama_supplier ?></td>
									<td>
										<?php
										// Nomor telepon dari database
										$notelp = $s->notelp;
										// Hilangkan karakter selain angka dari nomor telepon
										$notelp_clean = preg_replace('/\D/', '', $notelp);
										// Format tautan WhatsApp
										$wa_link = "https://wa.me/$notelp_clean";
										?>
										<a href="<?= $wa_link ?>" target="_blank">
											<img src="assets/img/wa.png" alt="WhatsApp" width="50px">
										</a>
									</td>
									<td><?= $s->alamat ?></td>
									<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
										<td>
											<center>
												<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
													<a href="<?= base_url() ?>supplier/ubah/<?= $s->id_supplier ?>"
														class="btn btn-circle btn-success btn-sm">
														<i class="fas fa-pen"></i>
													</a>
												<?php endif; ?>
												<?php if ($this->session->userdata('login_session')['level'] == 'superadmin'): ?>
													<a href="#" onclick="konfirmasi('<?= $s->id_supplier ?>')"
														class="btn btn-circle btn-danger btn-sm">
														<i class="fas fa-trash"></i>
													</a>
												<?php endif; ?>
											</center>
										</td>
									<?php endif; ?>
								</tr>
							<?php } ?>
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


<!-- form input -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form action="<?= base_url() ?>supplier/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Tambah Supplier</h5>
					<button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="col-lg-12">
					<br>
					<!-- Nama Supplier -->
					<div class="form-group"><label>Nama Supplier</label>
						<input class="form-control" name="supplier" type="text" placeholder="">
					</div>

					<!-- Nomor Telepon -->
					<div class="form-group"><label>Nomor Telepon</label>
						<input class="form-control" name="notelp" type="text" value="+62" maxlength="20" placeholder="+62">
					</div>

					<!-- Alamat -->
					<div class="form-group"><label>Alamat</label>
						<textarea class="form-control" name="alamat"></textarea>
					</div>

					<div class="form-group"><label>Foto</label>
						<div class="card bg-warning text-white shadow">
							<div class="card-body">
								Format
								<div class="text-white-45 small">.png .jpeg .jpg .tiff .gif .tif</div>
							</div>
						</div>
						<br>
						<center>
							<div>
								<img src="<?= base_url() ?>assets/upload/supplier/user.png" id="outputImg" width="200"
									maxheight="300">
							</div>
						</center>
						<br>
						<!-- foto -->
						<div class="form-group">
							<div class="custom-file">
								<input class="custom-file-input" type="file" id="GetFile" name="photo"
									onchange="VerifyFileNameAndFileSize()" accept=".png,.gif,.jpeg,.tiff,.jpg">
								<label class="custom-file-label" for="customFile">Pilih File</label>
							</div>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-save"></i>
						</span>
						<span class="text text-white">Simpan Data</span>
					</button>
					<button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
						<span class="icon text-white-50">
							<i class="fas fa-times"></i>
						</span>
						<span class="text text-white">Batal</span>
					</button>

				</div>
			</div>
		</div>
	</form>
</div>

<!-- form ubah -->


<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/supplier.js"></script>
<script src="<?= base_url(); ?>assets/js/validasi/formsupplier.js"></script>

<!-- <?php if ($this->session->flashdata('Pesan')): ?>
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
