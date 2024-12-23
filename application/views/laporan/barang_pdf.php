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
        <td align="center"><h1>Laporan Barang</h1></td>
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
    <th>Riwayat Tanggal</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Jenis Barang</th>
    <th>Warna</th>
    <th>Satuan</th>
    <th>Stok Awal</th>
    <th>Stok Masuk</th>
    <th>Stok Keluar</th>
    <th>Sisa Stok</th>
    <th>Harga Beli</th>
    <th>Harga Jual</th>
  </tr>
      <?php $no=1; foreach ($data as $d) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= date('d F Y', strtotime($d->created_at)) ?></td>
          <td><?= $d->id_barang ?></td>
          <td><?= $d->nama_barang ?></td>
          <td><?= $d->nama_jenis ?></td>
          <td><?= $d->warna ?></td>
          <td><?= $d->nama_satuan ?></td>
          <td><?= $d->stok ?></td>
          <td>
                                    <?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
                                    $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();
                                

                                    $dm = $data->row();
                                    $dk = $data2->row();
                                    $masuk = intval($dm->jumlah_masuk);
                                    ?>
                                    <?= $masuk ?>
                                </td>
                                <td>
                                    <?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
                                    $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();
                                

                                    $dm = $data->row();
                                    $dk = $data2->row();
                                    $keluar = intval($dk->jumlah_keluar);
                                    ?>
                                    <?= $keluar ?>
                                </td>
                                <td>
                                    <?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $d->id_barang)->get();
                                    $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $d->id_barang)->get();
                                

                                    $dm = $data->row();
                                    $dk = $data2->row();
                                    $hasil = intval($d->stok) + (intval($dm->jumlah_masuk) - intval($dk->jumlah_keluar));
                                    ?>
                                    <?= $hasil ?>
                                </td>
                                <td>Rp <?= number_format($d->hargabeli) ?></td>
                                <td>Rp <?= number_format($d->hargajual) ?></td>
        </tr>
      <?php } ?>
</table>

</body>
</html>
