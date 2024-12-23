<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
?>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Barang_masuk.xls");
header("Pragma: no-cache");
header("Expires: 0");
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
        <td align="center"><h1>Laporan Barang Masuk</h1></td>
    </tr>
   <tr>
        <td></td>
        <td align="center">
        <?php foreach ($jenis_barang as $jenis2): ?>
        <?php if ($jenis2->id_jenis == $jenisFilter2): ?>
            <h5>Jenis : <?= $jenis2->nama_jenis ?></h5><br>
        <?php endif; ?>
        <?php endforeach; ?>

        <!-- Continue with the existing code -->
        <?php if ($tglawal2 == '' || $tglakhir2 == ''): ?>
            <h6>Semua Tanggal</h6>
        <?php else: ?>
            <h6><?= tgl_indo($tglawal2) ?> - <?= tgl_indo($tglakhir2) ?></h6>
        <?php endif; ?>
            
        </td>
    </tr>
</table>
<br>
<table id="customers">
  <tr>
    <th>No</th>
    <th>Tanggal Masuk</th>
    <th>No.Transaksi</th>
    <th>Supplier</th>
    <th>Nama Barang</th>
    <th>Jenis Barang</th>
    <th>Jumlah Masuk</th>
    <th>Harga Beli</th>
    <th>Total Harga</th>
  </tr>
      <?php $no=1; foreach ($data as $d) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= tgl_indo($d->tgl_masuk) ?></td>
          <td><?= $d->id_barang_masuk ?></td>
          <td><?= $d->nama_supplier ?></td>
          <td><?= $d->nama_barang ?></td>
          <td><?= $d->nama_jenis ?></td>
          <td><?= $d->jumlah_masuk ?></td>
          <td><?= $d->hargabeli ?></td>
          <td><?= number_format($d->jumlah_masuk * $d->hargabeli, 2, ',', '.') ?></td>
        </tr>
      <?php } ?>
</table>

</body>
</html>
