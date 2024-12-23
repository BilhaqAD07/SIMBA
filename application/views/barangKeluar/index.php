<?php
function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Barang Keluar</h1>
		<a href="<?= base_url() ?>barangKeluar/tambah" class="btn btn-sm btn-primary btn-icon-split">
			<span class="text text-white">Tambah Data</span>
			<span class="icon text-white-50">
				<i class="fas fa-plus"></i>
			</span>
		</a>

	</div>
	<?php if ($this->session->flashdata('Pesan')): ?>
		<?= $this->session->flashdata('Pesan') ?>
	<?php endif; ?>
	<div class="col-lg-12 mb-4" id="container">

		<!-- Illustrations -->
		<div class="card border-bottom-secondary shadow mb-4">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="dtHorizontalExample" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>No.Transaksi</th>
								<th>Tgl Keluar</th>
								<th>Nama Barang</th>
								<th>Jumlah Keluar</th>
								<th>Status Barang</th>
								<th>Harga Jual</th>
								<th>Total Harga</th>
								<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
									<th width="1%">Aksi</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php $no = 1;
							foreach ($bk as $bk): ?>
								<tr>
									<td><?= $no++ ?>.</td>
									<td><?= $bk->id_barang_keluar ?></td>
									<td><?= date('d F Y', strtotime($bk->tgl_keluar)) ?></td>
									<td><?= $bk->nama_barang ?></td>
									<td><span class="badge badge-danger"> <i class="fa fa-minus"></i> <?= $bk->jumlah_keluar ?></span></td>
									<td class="d-flex flex-column">
										<span>Aktif</span>
										<span>Non Delivery</span>
									</td>
									<td id="hargajual_<?= $bk->id_barang_keluar ?>">Rp <?= number_format($bk->hargajual, 0, ',', '.') ?></td>
									<td id="total_harga_<?= $bk->id_barang_keluar ?>"></td>
									<td>
										<center>
											<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
												<a href="<?= base_url() ?>barangKeluar/ubah/<?= $bk->id_barang_keluar ?>"
													class="btn btn-circle btn-success btn-sm">
													<i class="fas fa-pen"></i>
												</a>
											<?php endif; ?>
											<?php if ($this->session->userdata('login_session')['level'] == 'superadmin'): ?>
												<a href="#"
													onclick="konfirmasi('<?= $bk->id_barang_keluar ?>','<?= $bk->jumlah_keluar ?>','<?= $bk->id_barang ?>')"
													class="btn btn-circle btn-danger btn-sm">
													<i class="fas fa-trash"></i>
												</a>
											<?php endif; ?>
										</center>
									</td>
								</tr>
								<script>
									// Hitung total harga
									var jumlah_keluar = <?= $bk->jumlah_keluar ?>;
									var hargajual = <?= $bk->hargajual ?>;
									var total_harga = jumlah_keluar * hargajual;

									// Format dan tampilkan total harga
									document.getElementById('total_harga_<?= $bk->id_barang_keluar ?>').innerText = 'Rp ' + total_harga.toLocaleString('id-ID');
								</script>
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
<script src="<?= base_url(); ?>assets/js/barangKeluar.js"></script>
