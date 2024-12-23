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

	// variabel pecahkan 1 = tanggal
	// variabel pecahkan 0 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Barang Masuk</h1>
		<a href="<?= base_url() ?>barangMasuk/tambah" class="btn btn-sm btn-primary btn-icon-split">
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
								<th>Tgl Masuk</th>
								<th>Supplier</th>
								<th>Nama Barang</th>
								<th>Jenis Barang</th>
								<th>Jumlah Masuk</th>
								<th>Harga Beli</th>
								<th>Total Harga</th>
								<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin'): ?>
									<th width="1%">Aksi</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php $no = 1;
							foreach ($bm as $bm): ?>
								<tr>
									<td><?= $no++ ?>.</td>
									<td><?= $bm->id_barang_masuk ?></td>
									<td><?= tgl_indo($bm->tgl_masuk) ?></td>
									<td><?= $bm->nama_supplier ?></td>
									<td><?= $bm->nama_barang ?></td>
									<td><?= $bm->nama_jenis ?></td>
									<td><span class="badge badge-success"> <i class="fa fa-plus"></i> <?= $bm->jumlah_masuk ?></span></td>
									<td><?= $bm->hargabeli ?></td>
									<td><?= number_format($bm->jumlah_masuk * $bm->hargabeli, 2, ',', '.') ?></td> <!-- Kolom Total Harga -->
									<td>
										<center>
											<?php if ($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'superadmin' || $this->session->userdata('login_session')['level'] == 'admin'): ?>
												<a href="<?= base_url() ?>barangMasuk/ubah/<?= $bm->id_barang_masuk ?>"
													class="btn btn-circle btn-success btn-sm">
													<i class="fas fa-pen"></i>
												</a>
											<?php endif; ?>
											<?php if ($this->session->userdata('login_session')['level'] == 'superadmin'): ?>
												<a href="#"
													onclick="konfirmasi('<?= $bm->id_barang_masuk ?>','<?= $bm->jumlah_masuk ?>','<?= $bm->id_barang ?>')"
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
<script>
	$(document).ready(function() {
		$('#dtHorizontalExample').DataTable({
			"scrollX": true
		});
		$('.dataTables_length').addClass('bs-select');

		ambilBarang()


	});

	function ambilBarang() {
		var link = $('#baseurl').val();
		var base_url = link + 'barangMasuk/getBarang';
		var barang = $('[name="barang"]').val();

		if (barang == '') {
			$('#preview').attr("src", link + "assets/upload/barang/box.png");
			$('#judul').text("-");
			$('#stok').text("-");
			$('#warna').text("-");
		} else {
			$.ajax({
				type: 'POST',
				data: 'id=' + barang,
				url: base_url,
				dataType: 'json',
				success: function(hasil) {
					$('#preview').attr("src", link + "assets/upload/barang/" + hasil[0].foto);
					$('#judul').text(hasil[0].nama_barang);
					$('#warna').text(hasil[0].warna);
					getTotalStok(hasil[0].stok, hasil[0].id_barang);
				}
			});
		}


	}

	function getTotalStok(stok, id) {
		var link = $('#baseurl').val();
		var base_url = link + 'barangMasuk/getTotalStok';

		$.ajax({
			type: 'POST',
			data: {
				id: id
			},
			url: base_url,
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil.total);
				$('#stok').text(parseInt(stok) + parseInt(hasil.total));
			}
		});

	}



	function detail(id) {
		var base_url = $('#baseurl').val();
		window.location.href = base_url + "barangMasuk/detail_data/" + id;

	}

	function konfirmasi(id, jml, idb) {
		var base_url = $('#baseurl').val();

		swal.fire({
			title: "Hapus Data ini?",
			icon: "warning",
			closeOnClickOutside: false,
			showCancelButton: true,
			confirmButtonText: 'Iya',
			confirmButtonColor: '#4e73df',
			cancelButtonText: 'Batal',
			cancelButtonColor: '#d33',
		}).then((result) => {
			if (result.value) {
				Swal.fire({
					title: "Memuat...",
					onBeforeOpen: () => {
						Swal.showLoading()
					},
					timer: 1000,
					showConfirmButton: false,
				}).then(
					function() {
						window.location.href = base_url + "barangMasuk/proses_hapus/" + id + '/' + jml + '/' + idb;
					}
				);
			}
		});

	}
</script>

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
