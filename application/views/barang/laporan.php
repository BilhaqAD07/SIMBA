<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Stok Barang</h1>
    </div>

    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <div class="card border-bottom-secondary shadow mb-4">
            <div class="card-body">
                <form action="<?= base_url() ?>laporan/barang_pdf" method="POST" target="_blank">
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <div class="input-group">
                                <input name="tglawal" id="datepicker1" autocomplete="off" placeholder="tanggal mulai"
                                class="form-control border-1 small" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="date1">
                                        <i class="fas fa-calendar fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div class="input-group">
                                <input name="tglakhir" id="datepicker2" autocomplete="off" placeholder="tanggal akhir"
                                class="form-control border-1 small" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="date1">
                                        <i class="fas fa-calendar fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <!-- ... existing code ... -->

                            <select class="form-control" id="jenisFilter" name="jenisFilter">
                                <option value="">All Types</option>
                                <?php foreach ($jenis_barang as $jenis): ?>
                                    <option value="<?= $jenis->id_jenis; ?>"><?= $jenis->nama_jenis; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-lg mb-4">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-md btn-primary btn-icon-split mb-2" onclick="filter()">
                                    <span class="text text-white">Filter</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </a>

                                <a href="#" class="btn btn-md btn-secondary btn-icon-split mb-2" onclick="reset()">
                                    <span class="text text-white">Reset</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-undo"></i>
                                    </span>
                                </a>


                                <button type="submit" class="btn btn-md btn-danger btn-icon-split mb-2">
                                    <span class="text text-white">PDF</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-file-pdf"></i>
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
                <form action="<?= base_url() ?>laporan/barang_excel" method="POST" target="_blank">
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <div class="input-group">
                                <input name="tglawal2" id="datepicker3" autocomplete="off" placeholder="tanggal mulai"
                                class="form-control border-1 small" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="date1">
                                        <i class="fas fa-calendar fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div class="input-group">
                                <input name="tglakhir2" id="datepicker4" autocomplete="off" placeholder="tanggal akhir"
                                class="form-control border-1 small" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="date1">
                                        <i class="fas fa-calendar fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <!-- ... existing code ... -->

                            <select class="form-control" id="jenisFilter2" name="jenisFilter2">
                                <option value="">All Types</option>
                                <?php foreach ($jenis_barang as $jenis2): ?>
                                    <option value="<?= $jenis2->id_jenis; ?>"><?= $jenis2->nama_jenis; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-lg mb-4">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-md btn-primary btn-icon-split mb-2" onclick="filter2()">
                                    <span class="text text-white">Filter</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </a>

                                <a href="#" class="btn btn-md btn-secondary btn-icon-split mb-2" onclick="reset2()">
                                    <span class="text text-white">Reset</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-undo"></i>
                                    </span>
                                </a>
                                
                                <button id="export_excel_btn" class="btn btn-md btn-success btn-icon-split mb-2">
                                 <span class="text text-white"> Excel</span>
                                 <span class="icon text-white-50">
                                    <i class="fas fa-file-excel"></i>
                                </span>
                            </button>

                            
                        </div>
                    </div>

                </div>
            </form>

            <div class="table-responsive">
                <table class="table" id="dtHorizontalExample" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="1%">No</th>

                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Warna</th>
                            <th>Satuan</th>
                            <th>Stok Awal</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

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
        ambilB();
    });


    function filter() {
        var tglawal = $("[name='tglawal']").val();
        var tglakhir = $("[name='tglakhir']").val();
    var jenisFilter = $("#jenisFilter").val(); // Add this line

    if (tglawal != '' && tglakhir != '') {
        filterB(tglawal, tglakhir, jenisFilter); // Modify this line
    } else {
        validasi("Tanggal Filter wajib di isi!", "warning");
    }
}
function filter2() {
    var tglawal2 = $("[name='tglawal2']").val();
    var tglakhir2 = $("[name='tglakhir2']").val();
    var jenisFilter2 = $("#jenisFilter2").val(); // Add this line

    if (tglawal2 != '' && tglakhir2 != '') {
        filterB(tglawal2, tglakhir2, jenisFilter2); // Modify this line
    } else {
        validasi("Tanggal Filter wajib di isi!", "warning");
    }
}

function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}

function refresh() {
    var t = $('#dtHorizontalExample').DataTable();
    t.ajax.reload();
}

function reset() {
    $("[name='tglawal']").val("");
    $("[name='tglakhir']").val("");
    ambilB();
}

function reset2() {
    $("[name='tglawal2']").val("");
    $("[name='tglakhir2']").val("");
    ambilB();
}

function ambilB() {
    var link = $('#baseurl').val();
    var base_url = link + 'Barang/getBarang';


    var t = $('#dtHorizontalExample').DataTable({
        "processing": true,
        "info": false,
        "searching": true,
        "order": [
            [0, "desc"]
            ],
        lengthChange: false,
        "ajax": {
            "url": base_url,
            "dataSrc": ""
        },
        columns: [
            { "data": "created_at" },
            { "data": "id_barang" },
            { "data": "nama_barang" },
            { "data": "nama_jenis" },
            { "data": "warna" },
            { "data": "nama_satuan" },
            { "data": "stok" },
            { "data": "hargabeli" },
            { "data": "hargajual" },
            ],

        "destroy": true

    });

    t.on('order.dt search.dt', function() {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();


    $('.dataTables_length').addClass('bs-select');
}

function filterB(tglawal, tglakhir, jenisFilter) {
    var link = $('#baseurl').val();
    var base_url = link + 'Barang/filterBarang/' + tglawal + '/' + tglakhir + '/' + jenisFilter; // Modify this line


    var t = $('#dtHorizontalExample').DataTable({
        "processing": true,
        "info": false,

        "order": [
            [0, "desc"]
            ],
        lengthChange: false,
        "ajax": {
            "url": base_url,
            "dataSrc": ""
        },
        columns: [
            { "data": "created_at" },
            { "data": "id_barang" },
            { "data": "nama_barang" },
            { "data": "nama_jenis" },
            { "data": "warna" },
            { "data": "nama_satuan" },
            { "data": "stok" },
            { "data": "hargabeli" },
            { "data": "hargajual" },
            ],

        "destroy": true

    });

    t.on('order.dt search.dt', function() {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();


    $('.dataTables_length').addClass('bs-select');
}
</script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

    $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

    $('#datepicker3').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

    $('#datepicker4').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
</script>
<!-- 
<?php if($this->session->flashdata('Pesan')): ?>
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