<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<div class="d-sm-flex">
			<a href="<?= base_url() ?>barang" class="btn btn-md btn-circle btn-secondary">
				<i class="fas fa-arrow-left"></i>
			</a>
			&nbsp;
			<h1 class="h2 mb-0 text-gray-800">Detail Barang</h1>
		</div>
		<!-- 
            <button type="submit" class="btn btn-primary btn-md btn-icon-split">
                <span class="text text-white">Simpan Data</span>
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
            </button>
            -->
	</div>

	<?php foreach ($data as $d): ?>

		<div class="d-sm-flex  justify-content-between mb-0">
			<div class="col-lg-12 mb-4">
				<!-- Barang -->
				<div class="card shadow border-bottom-secondary mb-4">
					<div class="card-body d-sm-flex">
						<div class="col-lg-3">
							<div class="form-group"><label>Riwayat Tanggal</label>
								<h4 class="h4 text-gray-800"><?= date('d F Y', strtotime($d->created_at)) ?></h4>
							</div>
							<a href="<?= base_url() ?>assets/upload/barang/<?= $d->foto ?>" data-lightbox="user-foto" data-title="<?= $d->nama_barang ?>">
								<img width="100%" style="border-radius: 10px;margin-top: 30%;" src="<?= base_url() ?>assets/upload/barang/<?= $d->foto ?>" alt="<?= $d->nama_barang ?>">
							</a>
						</div>

						<br>

						<div class="col-lg-4">
							<!-- ID Barang -->
							<div class="form-group"><label>ID Barang</label>
								<?php
								$id_barang = $d->id_barang;
								$qr_exists = file_exists('assets/qrcode/' . $id_barang . '.png');
								$barcode_exists = file_exists('assets/barcode/' . $id_barang . '.png');
								?>

								<h4 class="h4 text-gray-800"><b><?= $id_barang ?></b></h4>

								<?php if ($qr_exists || $barcode_exists): ?>
									<?php if ($qr_exists): ?>
										<a href="<?= base_url() ?>assets/qrcode/<?= $id_barang ?>.png" data-lightbox="user-foto" data-title="<?= $id_barang ?> | <?= $d->nama_barang ?>">
											<img style="border-radius: 5px;" src="<?= base_url('assets/qrcode/' . $id_barang . '.png') ?>" alt="<?= $id_barang ?> | <?= $d->nama_barang ?>" width="75px">
										</a>
									<?php endif; ?>
									<?php if ($barcode_exists): ?>
										<a href="<?= base_url() ?>assets/barcode/<?= $id_barang ?>.png" data-lightbox="user-foto" data-title="<?= $id_barang ?> | <?= $d->nama_barang ?>">
											<img style="border-radius: 5px;" src="<?= base_url('assets/barcode/' . $id_barang . '.png') ?>" alt="<?= $id_barang ?> | <?= $d->nama_barang ?>" width="75px">
										</a>
									<?php endif; ?>
								<?php else: ?>
									<!-- Jika QR code dan Barcode tidak ada -->
								<?php endif; ?>



							</div>

							<!-- Divider -->
							<hr class="sidebar-divider">

							<!-- Nama Barang -->
							<div class="form-group"><label>Nama Barang</label>
								<h4 class="h4 text-gray-800"><?= $d->nama_barang ?></h4>
							</div>

							<!-- Divider -->
							<hr class="sidebar-divider">

							<div class="form-group"><label>Jenis Barang</label>
								<h4 class="h4 text-gray-800"><?= $d->nama_jenis ?></h4>
							</div>

							<hr class="sidebar-divider">

							<div class="form-group"><label>Warna Barang</label>
								<h4 class="h4 text-gray-800"><?= $d->warna ?></h4>
							</div>

							<!-- Divider -->
							<hr class="sidebar-divider">
							<!-- Stok -->

							<!-- Satuan Barang -->
							<div class="form-group"><label>Satuan Barang</label>
								<h4 class="h4 text-gray-800"><?= $d->nama_satuan ?></h4>
							</div>
							<!-- Divider -->
							<hr class="sidebar-divider">

							<!-- Harga Beli -->
							<div class="form-group"><label>Harga Beli</label>
								<h4 class="h4 text-gray-800">Rp <?= number_format($d->hargabeli) ?></h4>
							</div>

						</div>

						<div class="col-lg-4">
							<div class="form-group"><label>Harga Jual</label>
								<h4 class="h4 text-gray-800">Rp <?= number_format($d->hargajual) ?></h4>
							</div>
							<hr class="sidebar-divider">
							<!-- ID Barang -->
							<div class="form-group"><label>Stok Awal</label>
								<h4 class="h4 text-gray-800"><?= $d->stok ?></h4>
							</div>
							<!-- Divider -->
							<hr class="sidebar-divider">
							<div class="form-group"><label>Jumlah Stok Masuk</label>
								<?php
								$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
								$data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();

								$bm = $data->row();
								$bk = $data2->row();
								$barangmasuk = (intval($bm->jumlah_masuk));

								?>
								<h4 class="h4 text-gray-800"><?= $barangmasuk ?></h4>
							</div>
							<hr class="sidebar-divider">
							<div class="form-group"><label>Jumlah Stok Keluar</label>
								<?php
								$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
								$data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();

								$bm = $data->row();
								$bk = $data2->row();
								$barangkeluar = (intval($bk->jumlah_keluar));

								?>
								<h4 class="h4 text-gray-800"><?= $barangkeluar ?></h4>
							</div>
							<hr class="sidebar-divider">
							<div class="form-group"><label>Total Sisa Stok</label>
								<?php
								$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
								$data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();

								$bm = $data->row();
								$bk = $data2->row();
								$hasil = intval($d->stok) + (intval($bm->jumlah_masuk) - intval($bk->jumlah_keluar));
								?>

								<h4 class="h4 text-gray-800"><b><?= $hasil ?></b></h4>
							</div>

							<!-- Divider -->
							<hr class="sidebar-divider">

							<!-- Harga Beli -->
							<div class="form-group"><label>Status Barang</label>
								<h4 class="h4 text-gray-800">Aktif</h4>
								<h4 class="h4 text-gray-800">Non Delivery</h4>
							</div>
							<!--   <div class="form-group"><label>Total Harga Pembelian Stok</label>
                            <?php
							$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();

							$bm = $data->row();
							$hasil = (intval($bm->jumlah_masuk));
							$beli = $hasil * $d->hargabeli;
							?>
                            <h4 class="h4 text-gray-800"><b>Rp <?= number_format($beli) ?></b></h4>
                        </div>
                         <hr class="sidebar-divider">
                          <div class="form-group"><label>Total Harga Stok Terjual</label>
                            <?php
							$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
							$data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();

							$bm = $data->row();
							$bk = $data2->row();
							$hasil = (intval($bk->jumlah_keluar));
							$jual = $hasil * $d->hargajual;
							?>
                            <h4 class="h4 text-gray-800"><b>Rp <?= number_format($jual) ?></b></h4>
                        </div> -->
						</div>
						<!--  <div class="col-lg-3">
                        
                        <div class="form-group"><label>Total Harga Belum Terjual</label>
                             <?php
								$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
								$data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();


								$bm = $data->row();
								$bk = $data2->row();
								$hasil = intval($d->stok) + (intval($bm->jumlah_masuk) - intval($bk->jumlah_keluar));
								$totalbelum = $hasil * $d->hargajual;
								?>
                            <h4 class="h4 text-gray-800"><b>Rp <?= number_format($totalbelum) ?></b></h4>
                        </div>
                    </div> -->
					</div>
				</div>

			</div>

		<?php endforeach; ?>

		</div>
		<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>

<?php if ($this->session->flashdata('Pesan')): ?>

<?php else: ?>
	<script>
		$(document).ready(function() {

			$('#pdf').hide();

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
<?php endif; ?>
