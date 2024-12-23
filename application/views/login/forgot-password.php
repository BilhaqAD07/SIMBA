<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
     <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/').$setting['logo'] ?>"/>
    <link href="<?= base_url(); ?>assets/loading/loader.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/all.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/animate/animate.min.css" rel="stylesheet">
    <title><?= $setting['nama'] ?> | Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/sbadmin/css/sb-admin-biru.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".judul").hide();
    });

    $(window).load(function() {
        $(".judul").fadeIn("slow");
        $(".spinner").fadeOut("slow");
    });
    </script>

</head>

<body style="background-color: #000C62 ;">
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-3 pt-lg-4">

    <div class="col-xl-8 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg bg-transparant shadow-sm" style="margin-bottom: 30px;">
            <div class="card-body p-lg-3 p-0">
                <!-- Nested Row within Card Body -->
                <div align="center">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-10">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900"><img src="<?= base_url('assets/img/logo/').$setting['logo'] ?>" width="100px"></h1>
                                <span class="h4 text-gray-900"><?= $setting['nama'] ?></span><br>
                                 <span class="text-muted">Forgot Password</span>
                            </div>
                             <?= $this->session->flashdata('pesan'); ?>
                            <?= form_open('', ['class' => 'user']); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" value="<?= set_value('email'); ?>" type="email" name="email" id="email" class="form-control form-control-user" placeholder="Email">
                                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <BR>
                            <button type="submit" class="btn btn-primary btn-user btn-block shadow" onclick="forgotPassword()" id="forgot">
                                Ganti Password
                            </button>
                            <BR></BR>
                             <div class=" small text-center mt-4">
                               <a href="<?= base_url('login') ?>" style="text-decoration:none;">Kembali Ke Login</a>
                               
                             </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>


<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/forgot.js"></script>
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
