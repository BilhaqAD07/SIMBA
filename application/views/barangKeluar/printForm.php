<?php 
require_once('tcpdf/tcpdf.php');

$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();

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
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

class MYPDF extends TCPDF {
	public function Header() {
		$this->SetFont('helvetica', 'B', 12);
		$this->Cell(0, 15, 'Laporan Barang Keluar', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SIMBA');
$pdf->SetTitle('Laporan Barang Keluar');
$pdf->SetHeaderData('', '', 'Laporan Barang Keluar', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();

$html = '<h3 align="center">Laporan Barang Keluar</h3>';
$html .= '<table border="1" cellpadding="4">
			<tr>
				<th>No</th>
				<th>QR Code</th>
				<th>Kode Produk</th>
				<th>Nama Produk</th>
				<th>Qty</th>
				<th>Status</th>
			</tr>';

$no = 1;
foreach ($data as $d) {
	$qrCode = base_url('assets/qrcode/'.$d->id_barang_keluar.'.png');
	$html .= '<tr>
				<td>'.$no++.'</td>
				<td><img src="'.$qrCode.'" width="50"></td>
				<td>'.$d->id_barang_keluar.'</td>
				<td>'.$d->nama_barang.'</td>
				<td>'.$d->jumlah_keluar.'</td>
				<td>'.$d->status.'</td>
			  </tr>';
}

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Laporan_Barang_Keluar.pdf', 'I');
?>
