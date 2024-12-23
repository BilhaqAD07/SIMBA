<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
?>
<?php
function tgl_indo($tanggal){
	$bulan = array (
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
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $judul ?></title>
<style>

body{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
#customers {
  border-collapse: collapse;
  width: 100%;
  
}

#customers td {
  border: 0px solid #ddd;
  padding: 8px;
  font-size: 12px;
}
#customers th{
  padding: 8px;
  font-size: 12px;
}


#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #858796;
  color: white;
}
</style>
</head>
<body>
<table border="0" width="100%">
    <tr>
        <td><img class="img-profile rounded-circle" src="<?= base_url('assets/img/logo/').$setting['logo'] ?>" width="50"></td>
        <td align="center"><h1>Laporan Barang Keluar</h1></td>
    </tr>
    <tr>
        <td></td>
        <td align="center">
        <?php foreach ($jenis_barang as $jenis): ?>
        <?php if ($jenis->id_jenis == $jenisFilter): ?>
            <h5>Jenis : <?= $jenis->nama_jenis ?></h5><br>
        <?php endif; ?>
        <?php endforeach; ?>

        <!-- Continue with the existing code -->
        <?php if ($tglawal == '' || $tglakhir == ''): ?>
            <h6>Semua Tanggal</h6>
        <?php else: ?>
            <h6><?= tgl_indo($tglawal) ?> - <?= tgl_indo($tglakhir) ?></h6>
        <?php endif; ?>
            
        </td>
    </tr>
</table>
<br>
<table id="customers">
  <tr>
    <th>No</th>
    <!-- <th>Tanggal Masuk</th> -->
    <th>Tanggal Keluar</th>
    <th>No.Transaksi</th>
    <th>Nama Barang</th>
    <th>Jenis Barang</th>
    <th>Jumlah Stok</th>
    <th>Jumlah Keluar</th>
    <th>Persediaan</th>
    <th>Harga Jual</th>
    <th>Total Harga</th>
  </tr>
      <?php $no=1; foreach ($data as $d) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <!-- <td><?= date('d F Y', strtotime($d->created_at)) ?></td> -->
          <td><?= date('d F Y', strtotime($d->tgl_keluar)) ?></td>
          <td><?= $d->id_barang_keluar ?></td>
          <td><?= $d->nama_barang ?></td>
           <td><?= $d->nama_jenis ?></td>
          <td>  <?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
                                    $bm = $data->row();
                                    $hasil1 = intval($d->stok) + (intval($bm->jumlah_masuk));
                                    ?>
                                    <?= $hasil1 ?></b></td>
          <td><?= $d->jumlah_keluar ?></td>
           <td>  <?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
                                    $bm = $data->row();
                                    $hasil2 = intval($d->stok) + (intval($bm->jumlah_masuk) - intval($d->jumlah_keluar));
                                    ?>
                                    <?= $hasil2 ?></b></td>
        <td><?= number_format($d->hargajual, 2, ',', '.') ?></td>
        <td><?= number_format($d->jumlah_keluar * $d->hargajual, 2, ',', '.') ?></td>
        </tr>
      <?php } ?>
</table>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/barangKeluar.js"></script>
<script src="<?= base_url(); ?>assets/js/validasi/formbarangkeluar.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>


<script>
$('.chosen').chosen({
    width: '100%',

});

$('#datepicker').datepicker({
    autoclose: true
});
</script>

<!-- <?php if($this->session->flashdata('Pesan')): ?>

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
<?php endif; ?>
</body>
</html>
