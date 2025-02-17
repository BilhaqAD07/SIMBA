$(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');

});


function detail(id) {
    var base_url = $('#baseurl').val();
    window.location.href = base_url + "barang/detail/" + id;

}

// function ambilBarang() {
//     var link = $('#baseurl').val();
//     var base_url = link + 'barang/getBarang';
//     var barang = $('[name="barang"]').val();

//     if (barang == '') {
//         $('#preview').attr("src", link + "assets/upload/barang/box.png");
//         $('#judul').text("-");
//         $('#stok').text("-");
//         $('#created_at').text("-");
//     } else {
//         $.ajax({
//             type: 'POST',
//             data: 'id=' + barang,
//             url: base_url,
//             dataType: 'json',
//             success: function(hasil) {
//                 $('#preview').attr("src", link + "assets/upload/barang/" + hasil[0].foto);
//                 $('#judul').text(hasil[0].nama_barang);
//                 $('#created_at').text(hasil[0].created_at);
//                 getTotalStok(hasil[0].stok, hasil[0].id_barang);
//             }
//         });
//     }


// }


// function getTotalStok(stok, id) {
//     var link = $('#baseurl').val();
//     var base_url = link + 'barang/getTotalStok';

//     $.ajax({
//         type: 'POST',
//         data: {
//             id: id
//         },
//         url: base_url,
//         dataType: 'json',
//         success: function(hasil) {
//             console.log(hasil.total);
//             $('#stok').text(parseInt(stok) + parseInt(hasil.total));
//         }
//     });
// }

function konfirmasi(id) {
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
                    window.location.href = base_url + "barang/proses_hapus/" + id;
                }
            );
        }
    });

}