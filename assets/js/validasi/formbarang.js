function validateForm() {
    var barang = document.forms["myForm"]["barang"].value;
    var warna = document.forms["myForm"]["warna"].value;
    var stok = document.forms["myForm"]["stok"].value;
    var hargabeli = document.forms["myForm"]["hargabeli"].value;
    var hargajual = document.forms["myForm"]["hargajual"].value;
    var jenis = document.forms["myForm"]["jenis"].value;
    var satuan = document.forms["myForm"]["satuan"].value;
    

    if (barang == "") {
        validasi('Nama Barang wajib di isi!', 'warning');
        return false;
    } else if (warna == '') {
        validasi('Warna Barang wajib di isi!', 'warning');
        return false;
    } else if (stok == '') {
        validasi('Stok wajib di isi!', 'warning');
        return false;
    } else if (hargabeli == '') {
        validasi('Harga Beli wajib di isi!', 'warning');
        return false;
    } else if (hargajual == '') {
        validasi('Harga Jual wajib di isi!', 'warning');
        return false;
    } else if (jenis == '') {
        validasi('Jenis Barang wajib di isi!', 'warning');
        return false;
    } else if (satuan == '') {
        validasi('Satuan Barang wajib di isi!', 'warning');
        return false;
    } 

}


function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}


function fileIsValid(fileName) {
    var ext = fileName.match(/\.([^\.]+)$/)[1];
    ext = ext.toLowerCase();
    var isValid = true;
    switch (ext) {
        case 'png':
        case 'jpeg':
        case 'jpg':
        case 'tiff':
        case 'gif':
        case 'tif':

            break;
        default:
            this.value = '';
            isValid = false;
    }
    return isValid;
}

function VerifyFileNameAndFileSize() {
    var file = document.getElementById('GetFile').files[0];


    if (file != null) {
        var fileName = file.name;
        if (fileIsValid(fileName) == false) {
            validasi('Format bukan gambar!', 'warning');
            document.getElementById('GetFile').value = null;
            return false;
        }
        var content;
        var size = file.size;
        if ((size != null) && ((size / (1024 * 1024)) > 3)) {
            validasi('Ukuran maximum 1024px', 'warning');
            document.getElementById('GetFile').value = null;
            return false;
        }

        var ext = fileName.match(/\.([^\.]+)$/)[1];
        ext = ext.toLowerCase();
        $(".custom-file-label").addClass("selected").html(file.name);
        document.getElementById('outputImg').src = window.URL.createObjectURL(file);
        return true;

    } else
        return false;
}