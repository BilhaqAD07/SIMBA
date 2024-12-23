<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-3 pt-lg-4">

    <div class="col-xl-8 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg" style="background: rgba(255, 255, 255, 0.8);">
            <div class="card-body p-lg-3 p-0">
                <!-- Nested Row within Card Body -->
                <div align="center">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-10">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900">
                                    <img src="<?= base_url('assets/img/logo/').$setting['logo'] ?>" width="100px" style="border-radius: 8px">
                                </h1>
                                <span class="h4 text-gray-900"><?= $setting['nama'] ?></span><br>
                                <span class="text-muted">Login</span>
                            </div>
                             <?= $this->session->flashdata('pesan'); ?>
                                  <?= form_open('', ['class' => 'user']); ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="user" name="user" aria-describedby="usernameHelp"
                                            placeholder="Username" autocomplete="off">
                                    </div>
                                    <!-- Tambahkan sebuah tombol atau ikon untuk melihat password -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-user" id="pwd" name="pwd" placeholder="Password" minlength="4">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="eye-toggle" onclick="togglePasswordVisibility()">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" onclick="proses_login()" id="login" class="btn btn-primary btn-user btn-block shadow">
                                        Login
                                    </a>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

</div>

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/login.js"></script>
<!-- <?php if($this->session->flashdata('Pesan')): ?>
<?= $this->session->flashdata('Pesan'); ?>
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
<script>
function togglePasswordVisibility() {
    var pwdInput = document.getElementById("pwd");
    var eyeIcon = document.getElementById("eye-toggle").querySelector("i");

    if (pwdInput.type === "password") {
        pwdInput.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        pwdInput.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}
</script>
