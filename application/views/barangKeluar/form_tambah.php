<!-- Begin Page Content -->
<div class="container-fluid">

    <form action="<?= base_url() ?>barangKeluar/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="d-sm-flex">
                <a href="<?= base_url() ?>barang_keluar" class="btn btn-md btn-circle btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                &nbsp;
                <h1 class="h2 mb-0 text-gray-800">Tambah Barang Keluar</h1>
            </div>

            <button type="submit" class="btn btn-primary btn-md btn-icon-split">
                <span class="text text-white">Simpan Data</span>
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
            </button>

        </div>

        <div class="d-sm-flex  justify-content-between mb-0">
            <div class="col-lg-8 mb-4">
                <!-- form -->
                <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Form Barang Keluar</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <!-- ID Transaksi -->
                            <div class="form-group"><label>ID Barang Keluar</label>
                                <input class="form-control" name="idbk" value="<?= $kode ?>" type="text" placeholder=""
                                    autocomplete="off" readonly>
                            </div>

                            <!-- Tgl Keluar -->
                            <div class="form-group"><label>Tanggal Keluar</label>
                                <input class="form-control" name="tgl" id="datepicker" value="<?= $tglnow ?>" type="text" placeholder=""
                                    autocomplete="off">
                            </div>

                            <!-- opsi barang -->
                            <div class="form-group">
                                <label>Barang</label> <br>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-primary active" id="manualSelectBK">
                                        <input type="radio" name="optionsBK" autocomplete="off" checked> Pilih Barang
                                    </label>
                                    <label class="btn btn-secondary" id="qrSelectBK">
                                        <input type="radio" name="optionsBK" autocomplete="off"> Scan
                                    </label>
                                </div>
                                <br><br>
                                <div id="manualOptionBK">
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
                                <div id="qrOptionBK" style="display: none;">
                                    <div id="readerBK" style="width: 500px; height: 500px;"></div>
                                </div>
                            </div>

                            <!-- Jumlah Barang -->
                           <div class="form-group"><label>Jumlah Keluar</label>
                                <input class="form-control" name="jmlbarang" type="number" min="1" placeholder="" oninput="calculateTotal()">
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

                            <div class="form-group"><label>Total Harga</label>
                                <h6 class="h6 text-gray-800" id="totalharga">-</h6>
                            </div>

                        </div>


                        <br>
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
                                <img id="preview" width="200px" src="<?= base_url() ?>assets/upload/barang/box.png"
                                    alt="">
                            </center>

                            <br>

                            <label><b>Nama Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="judul">-</h6>
                            <!-- Divider -->
                            <hr class="sidebar-divider">

                            <label><b>Stok Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="stok">-</h6>
                            <!-- Divider -->
                            <hr class="sidebar-divider">

                            <label><b>Warna Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="warna">-</h6>
                            <!-- Divider -->
                            <hr class="sidebar-divider">

                            <label><b>Harga Jual</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="hargajual">-</h6>
                            <!-- Divider -->
                            <hr class="sidebar-divider">

                            <label><b>Tanggal Masuk</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="created_at">-</h6>
                            <!-- Divider -->
                            <hr class="sidebar-divider">


                        </div>
                    </div>
                </div>

            </div>
        </div>


    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<!-- <script src="<?= base_url(); ?>assets/js/barangKeluar.js"></script> -->
<script src="<?= base_url(); ?>assets/js/validasi/formbarangkeluar.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<script>
    $(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');

    ambilBarang();
});

function calculateTotal() {
    var jumlah = document.querySelector('[name="jmlbarang"]').value;
    var hargaJual = document.getElementById('hargajual').innerText;

    // Pastikan nilai jumlah dan hargaJual diisi sebelum menghitung
    if (jumlah && hargaJual && !isNaN(hargaJual)) {
        var total = jumlah * parseFloat(hargaJual);
        document.getElementById('totalharga').innerText = total.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    } else {
        document.getElementById('totalharga').innerText = "-";
    }
}

// Panggil calculateTotal setiap kali ambilBarang dipanggil
function ambilBarang() {
    var link = $('#baseurl').val();
    var base_url = link + 'barangKeluar/getBarang';
    var barang = $('[name="barang"]').val();

    if (barang == '') {
        $('#preview').attr("src", link + "assets/upload/barang/box.png");
        $('#judul').text("-");
        $('#stok').text("-");
        $('#warna').text("-");
        $('#hargajual').text("-");
        $('#created_at').text("-");
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
                $('#hargajual').text(hasil[0].hargajual);
                $('#created_at').text(hasil[0].created_at);
                getTotalStok(hasil[0].stok, hasil[0].id_barang);

                // Panggil calculateTotal untuk memperbarui total harga
                calculateTotal();
            }
        });
    }
}



function getTotalStok(stok, id) {
    var link = $('#baseurl').val();
    var base_url = link + 'barangKeluar/getTotalStok';

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
    window.location.href = base_url + "barangKeluar/detail_data/" + id;

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
                    window.location.href = base_url + "barangKeluar/proses_hapus/" + id + '/' + jml + '/' + idb;
                }
            );
        }
    });

}
</script>

<script>
$('.chosen').chosen({
    width: '100%',

});

$('#datepicker').datepicker({
    autoclose: true
});

$(document).ready(function() {
    $('#manualSelectBK').click(function() {
        $('#manualOptionBK').show();
        $('#qrOptionBK').hide();
    });
    $('#qrSelectBK').click(function() {
        $('#manualOptionBK').hide();
        $('#qrOptionBK').show();
    });

    // Initialize QR code scanner
    let html5QrcodeScannerBK = new Html5QrcodeScanner("readerBK", { fps: 10, qrbox: 250 });
    html5QrcodeScannerBK.render(onScanSuccessBK, onScanFailureBK);
});

 let soundPlayed = false;
function onScanSuccessBK(qrCodeMessage) {
    if (!soundPlayed) {
            // Play success sound
            var audio = new Audio('<?= base_url() ?>assets/sounds/success.mp3');
            audio.play();
            soundPlayed = true; // Set the flag to true
        }
    // Handle scanned QR code data
    $('[name="barang"]').val(qrCodeMessage);
    // Trigger change event for chosen dropdown (if using chosen plugin)
    $('select[name="barang"]').val(qrCodeMessage).trigger('chosen:updated');
    // Update details based on scanned data (optional)
    ambilBarang(); // You may need to customize this function for barang keluar
    $('#manualSelectBK').click(); // Switch back to manual selection after scanning
}

function onScanFailureBK(error) {
    console.warn(`QR error = ${error}`);
}

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
<?php endif; ?> -->
