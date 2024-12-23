<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
if ($this->session->has_userdata('login_session')) {
    redirect('home');
}

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

<body style="background-image: url('assets/img/bg.png');background-size: 100%;background-repeat: no-repeat;">
<!-- <body style="background-color: #FF5900;"> -->
<!-- Base url untuk js-->
<input type="hidden" value="<?= base_url() ?>" id="baseurl">