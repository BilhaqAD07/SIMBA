$(document).ready(function() {
    ambilB();
});


function filter() {
    var tglawal = $("[name='tglawal']").val();
    var tglakhir = $("[name='tglakhir']").val();
    if (tglawal != '' && tglakhir != '') {
        filterB(tglawal, tglakhir);
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

function filterB(tglawal, tglakhir) {
    var link = $('#baseurl').val();
    var base_url = link + 'Barang/filterBarang/' + tglawal + '/' + tglakhir + '';


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