<!-- Begin Page Content -->
<div class="container-fluid">
    <form action="<?= base_url() ?>barangMasuk/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="d-sm-flex">
                <a href="<?= base_url() ?>barang_masuk" class="btn btn-md btn-circle btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                &nbsp;
                <h1 class="h2 mb-0 text-gray-800">Tambah Barang Masuk</h1>
            </div>
            <button type="submit" class="btn btn-primary btn-md btn-icon-split">
                <span class="text text-white">Simpan Data</span>
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
            </button>
        </div>

        <div class="d-sm-flex justify-content-between mb-0">
            <div class="col-lg-8 mb-4">
                <!-- form -->
                <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Form Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <!-- ID Transaksi -->
                            <div class="form-group">
                                <label>ID Barang Masuk</label>
                                <input class="form-control" name="idbm" value="<?= $kode ?>" type="text" readonly>
                            </div>

                            <!-- Tgl Masuk -->
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input class="form-control" name="tgl" id="datepicker" value="<?= $tglnow ?>" type="text" autocomplete="off">
                            </div>

                            <!-- opsi barang -->
                            <div class="form-group">
                                <label>Barang</label> <br>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-primary active" id="manualSelect">
                                        <input type="radio" name="options" autocomplete="off" checked> Pilih Barang
                                    </label>
                                    <label class="btn btn-secondary" id="qrSelect">
                                        <input type="radio" name="options" autocomplete="off"> Scan
                                    </label>
                                </div>
                                <br><br>
                                <div id="manualOption">
                                    <?php if($jmlbarang > 0): ?>
                                    <select name="barang" class="form-control chosen" onchange="ambilBarang()">
                                        <option value="">--Pilih--</option>
                                        <?php foreach($barang as $b): ?>
                                        <option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?php else: ?>
                                    <input type="hidden" name="barang">
                                    <div class="d-sm-flex justify-content-between">
                                        <span class="text-danger"><i>(Belum Ada Data Barang!)</i></span>
                                        <a href="<?= base_url() ?>barang" class="btn btn-sm btn-primary btn-icon-split">
                                            <span class="icon text-white">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div id="qrOption" style="display: none;">
                                    <div id="reader" style="width: 500px; height: 500px;"></div>
                                </div>
                            </div>

                            <!-- opsi Supplier -->
                            <?php if($jmlsupplier > 0): ?>
                            <div class="form-group">
                                <label>Supplier</label>
                                <select name="supplier" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($supplier as $s): ?>
                                    <option value="<?= $s->id_supplier ?>"><?= $s->nama_supplier ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="form-group">
                                <label>Supplier</label>
                                <input type="hidden" name="supplier">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data supplier!)</i></span>
                                    <a href="<?= base_url() ?>supplier" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Jumlah Barang -->
                            <div class="form-group">
                                <label>Jumlah Masuk</label>
                                <input class="form-control" name="jmlbarang" type="number" min="1">
                            </div>

							<!-- Status Barang -->
							<div class="form-group">
								<label>Status Barang Aktif</label>
								<select name="status" class="form-control">
									<option value="1" selected>Aktif</option>
									<option value="0">Non Aktif</option>
								</select>
							 </div>

							 <div class="form-group">
								<label>Status Barang Delivery</label>
								<select name="status" class="form-control">
									<option value="1" selected>Delivery</option>
									<option value="0">Non Delivery</option>
								</select>
							 </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <!-- file -->
                <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Preview</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <center>
                                <img id="preview" width="200px" src="<?= base_url() ?>assets/upload/barang/box.png" alt="">
                            </center>
                            <br>
                            <label><b>Nama Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="judul">-</h6>
                            <hr class="sidebar-divider">
                            <label><b>Stok Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="stok">-</h6>
                            <hr class="sidebar-divider">
                            <label><b>Warna Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="warna">-</h6>
                            <hr class="sidebar-divider">
                            <label><b>Harga Beli</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="hargabeli">-</h6>
                            <hr class="sidebar-divider">
                            <label><b>Total Harga</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="totalharga">-</h6>
                            <hr class="sidebar-divider">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

<!-- Include the HTML5 QR Code Scanner library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script>
    function checkInput() {
        var input = document.getElementById('jmlbarang');
        if (input.value < 0) {
            input.value = 0;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#manualSelect').click(function() {
            $('#manualOption').show();
            $('#qrOption').hide();
        });
        $('#qrSelect').click(function() {
            $('#manualOption').hide();
            $('#qrOption').show();
        });

        $('#dtHorizontalExample').DataTable({
            "scrollX": true
        });
        $('.dataTables_length').addClass('bs-select');

        ambilBarang();
    });

   function hitungTotalHarga() {
    var jumlahBarang = $('[name="jmlbarang"]').val();
    var hargaBeli = $('#hargabeli').text().replace(/[^\d]/g, ''); // Hapus tanda selain angka
    if (jumlahBarang && hargaBeli) {
        var totalHarga = parseInt(jumlahBarang) * parseInt(hargaBeli);
        $('#totalharga').text("Rp " + totalHarga.toLocaleString()); // Format angka dengan pemisah ribuan
    } else {
        $('#totalharga').text('-');
    }
}

// Panggil hitungTotalHarga ketika jumlah barang atau harga beli berubah
$('[name="jmlbarang"]').on('input', hitungTotalHarga);

// Modifikasi ambilBarang untuk memanggil hitungTotalHarga setelah harga beli diperoleh
function ambilBarang() {
    var link = $('#baseurl').val();
    var base_url = link + 'barangMasuk/getBarang';
    var barang = $('[name="barang"]').val();

    if (barang == '') {
        $('#preview').attr("src", link + "assets/upload/barang/box.png");
        $('#judul').text("-");
        $('#nama_jenis').text("-");
        $('#stok').text("-");
        $('#warna').text("-");
        $('#hargabeli').text("-");
        $('#totalharga').text("-");
    } else {
        $.ajax({
            type: 'POST',
            data: 'id=' + barang,
            url: base_url,
            dataType: 'json',
            success: function(hasil) {
                $('#preview').attr("src", link + "assets/upload/barang/" + hasil[0].foto);
                $('#judul').text(hasil[0].nama_barang);
                $('#nama_jenis').text(hasil[0].nama_jenis);
                $('#warna').text(hasil[0].warna);
                $('#hargabeli').text(hasil[0].hargabeli);
                getTotalStok(hasil[0].stok, hasil[0].id_barang);

                // Panggil fungsi hitungTotalHarga untuk menghitung total harga
                hitungTotalHarga();
            }
        });
    }
}


    function getTotalStok(stok, id) {
        var link = $('#baseurl').val();
        var base_url = link + 'barangMasuk/getTotalStok';

        $.ajax({
            type: 'POST',
            data: { id: id },
            url: base_url,
            dataType: 'json',
            success: function(hasil) {
                $('#stok').text(parseInt(stok) + parseInt(hasil.total));
            }
        });
    }

    // Variable to track if the sound has been played
    let soundPlayed = false;

    function onScanSuccess(qrCodeMessage) {
        if (!soundPlayed) {
            // Play success sound
            var audio = new Audio('<?= base_url() ?>assets/sounds/success.mp3');
            audio.play();
            soundPlayed = true; // Set the flag to true
        }

        $('[name="barang"]').val(qrCodeMessage);
        $('select[name="barang"]').val(qrCodeMessage).trigger('chosen:updated');
        ambilBarang();
        $('#manualSelect').click();
    }

    function onScanFailure(error) {
        console.warn(`QR error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

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
                }).then(() => {
                    window.location.href = base_url + "barangMasuk/proses_hapus/" + id + '/' + jml + '/' + idb;
                });
            }
        });
    }
</script>

<script src="<?= base_url(); ?>assets/js/validasi/formbarangmasuk.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<script>
    $('.chosen').chosen({ width: '100%' });

    $('#datepicker').datepicker({ autoclose: true });
</script>

<?php if($this->session->flashdata('Pesan')): ?>
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
        });
    });
</script>
<?php endif; ?>

