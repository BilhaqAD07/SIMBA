<!-- views/laporan/barang_excel.php -->
<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
?>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Barang_stok.xls");
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
    <title>Excel Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <!-- <th>Tanggal</th> -->
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Warna</th>
            <th>Satuan</th>
            <th>Stok Awal</th>
            <th>Stok Masuk</th>
            <th>Stok Keluar</th>
            <th>Total Sisa Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($data as $row): ?>
            <tr><td><?= $no++; ?></td>
                <td><?= $row->id_barang; ?></td>
                <!-- <td><?= $row->created_at; ?></td> -->
                <td><?= $row->nama_barang; ?></td>
                <td><?= $row->nama_jenis; ?></td>
                <td><?= $row->warna; ?></td>
                <td><?= $row->nama_satuan; ?></td>
                <td><?= $row->stok; ?></td>
                <td><?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $row->id_barang)->get();
                                    $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $row->id_barang)->get();
                                

                                    $dm = $data->row();
                                    $dk = $data2->row();
                                    $masuk = intval($dm->jumlah_masuk);
                                    ?>
                                    <?= $masuk ?></td>
                <td><?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $row->id_barang)->get();
                                    $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $row->id_barang)->get();
                                

                                    $dm = $data->row();
                                    $dk = $data2->row();
                                    $keluar = intval($dk->jumlah_keluar);
                                    ?>
                                    <?= $keluar ?></td>
                                    <td><?php  
                                    $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where('id_barang', $row->id_barang)->get();
                                    $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where('id_barang', $row->id_barang)->get();
                                

                                    $dm = $data->row();
                                    $dk = $data2->row();
                                    $hasil = intval($row->stok) + (intval($dm->jumlah_masuk) - intval($dk->jumlah_keluar));
                                    ?>
                                    <?= $hasil ?></td>
                <td><?= $row->hargabeli; ?></td>
                <td><?= $row->hargajual; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
