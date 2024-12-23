function validateForm() {
    var nik = document.forms["myForm"]["nik"].value;
    var namaL = document.forms["myForm"]["namaL"].value;
    var user = document.forms["myForm"]["user"].value;
    var notelp = document.forms["myForm"]["notelp"].value;
    var email = document.forms["myForm"]["email"].value;
    var level = document.forms["myForm"]["level"].value;
    var pwd = document.forms["myForm"]["pwd"].value;
    var kpwd = document.forms["myForm"]["kpwd"].value;

    if (nik !== "" || nik == '') {
         if(nik == ''){
            validasi('NIK wajib di isi', 'warning');
            return false;
        }else if(nik.length > 16){
            validasi('Panjang NIK Maximal 16 karakter!', 'warning');
            return false;
        }
    } else if (namaL == '') {
        validasi('Nama wajib di isi!', 'warning');
        return false;
    } else if (user == '') {
        validasi('Username wajib di isi!', 'warning');
        return false;
    } else if (notelp !== '' || notelp == '') {
        if(notelp == ''){
            validasi('No Telepon wajib di isi!', 'warning');
            return false;
        }else if(notelp.length > 12){
           validasi('Panjang Maximal No Telepon 12 karakter!', 'warning');
            return false;
        }
    } else if (email == '') {
        validasi('Email wajib di isi!', 'warning');
        return false;
    } else if (level == '') {
        validasi('Level wajib di isi!', 'warning');
        return false;
    } else if (pwd !== '' || kpwd !== '') {

        if(pwd.length < 4){
            validasi('Panjang Password minimal 4 karakter!', 'warning');
            return false;
        }else if(pwd !== kpwd){
            validasi('Konfirmasi Password tidak sesuai!', 'warning');
            return false;
        }
       
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
        case 'pdf':

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

        if (ext == 'pdf') {
            $('#pdf').show();
            $('#img').hide();
            $(".custom-file-label").addClass("selected").html(file.name);
            document.getElementById('outputPdf').src = window.URL.createObjectURL(file);
        } else {
            $('#pdf').hide();
            $('#img').show();
            $(".custom-file-label").addClass("selected").html(file.name);
            document.getElementById('outputImg').src = window.URL.createObjectURL(file);
        }
        return true;

    } else
        return false;
}