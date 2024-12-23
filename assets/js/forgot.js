function forgotPassword() {

    var email = $("[name='email']").val();

    if (email == "") {
        validasi('Email masih kosong!', 'warning');
        return false;
    } else {
        cek_user(email);
    }

}

function cek_user(email) {
    var link = $('#baseurl').val();
    var base_url = link + 'login/forgotPassword';
    $("#forgot").text("Memuat...");

    $.ajax({
        type: 'POST',
        data: {
            email: email
           
        },
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            if (hasil.respon == 'success') {
                pesan('Email Berhasil Terkirim! Silahkan Cek Email Untuk Ganti Passsword', 'success', 'true');
                $("#forgot").text("Forgot Password");
            } else {
                pesan('Email Belum Terdaftar', 'error', 'false');
                $("#forgot").text("Login");

            }
        }
    });

}

function logout() {

    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Anda ingin logout?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Iya',
        confirmButtonColor: '#4e73df',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Memuat...',
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            window.location.href = base_url + "login/logout/";
        }
    });

}

function pesan(judul, status, boolean) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
        showConfirmButton: true,
    }).then((result) => {
        if (boolean == 'true') {
            Swal.fire({
                title: 'Memuat...',
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            location.reload(true);
        }
    });
}

function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    }).then((result) => {

    });
}