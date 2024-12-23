<?php 
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();

?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
    
         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4" id="barang">
            <div class="card border-left-primary shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Barang
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $jmlbarang ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-xl-3 col-md-6 mb-4" id="barang_masuk">
            <div class="card border-left-danger shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Barang Masuk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $jmlBM ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" id="barang_keluar">
            <div class="card border-left-warning shadow h-100 py-2 bg-danger">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Barang Keluar
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $jmlBK ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-upload fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" id="stok">
            <div class="card border-left-success shadow h-100 py-2 bg-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Total Stok Barang
                            </div>
                            <?php  
                                $data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->get();
                                $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->get();
                                $data3 = $this->db->select_sum('stok')->from('barang')->get();


                                $bm = $data->row();
                                $bk = $data2->row();
                                $b = $data3->row();
                                $hasil = $b->stok + (intval($bm->jumlah_masuk) - intval($bk->jumlah_keluar));
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $hasil ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" id="user">
            <div class="card border-left-warning shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Total User
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $jmlUser ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-xl-3 col-md-6 mb-4" id="supplier">
            <div class="card border-left-warning shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Supplier
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $jmlsupplier ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-xl-3 col-md-6 mb-4" id="tanggal">
            <div class="card border-left-warning shadow h-100 py-2 bg-secondary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center text-white">
                        <div class="col mr-2">
                           <p><span id="tanggalwaktu"></span></p>
                            <script>
                            var tw = new Date();
                            if (tw.getTimezoneOffset() == 0) (a=tw.getTime() + ( 7 *60*60*1000))
                            else (a=tw.getTime());
                            tw.setTime(a);
                            var tahun= tw.getFullYear ();
                            var hari= tw.getDay ();
                            var bulan= tw.getMonth ();
                            var tanggal= tw.getDate ();
                            var hariarray=new Array("Minggu,","Senin,","Selasa,","Rabu,","Kamis,","Jum'at,","Sabtu,");
                            var bulanarray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
                            document.getElementById("tanggalwaktu").innerHTML = hariarray[hari]+" "+tanggal+" "+bulanarray[bulan]+" "+tahun;
                            </script>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-xl-3 col-md-6 mb-4" id="supplier">
            <div class="card border-left-warning shadow h-100 py-2 bg-secondary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-white">
                             <a href="https://time.is/<?= $setting['alamat'] ?>" id="time_is_link" rel="nofollow" style="font-size:15px;text-decoration:none;color: white;" ><?= $setting['alamat'] ?>,</a>
                         <span id="<?= $setting['zona_waktu'] ?>" style="font-size:15px"></span>
                         <script src="//widget.time.is/t.js"></script>
                         <script>time_is_widget.init({<?= $setting['zona_waktu'] ?>:{}});</script>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4" id="grafik">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold border-0 text-white">Total Transaksi Barang Perbulan</h6>
                    
                    <div class="col-lg-2">
                        <select name="tahun" id="tahun" class="form-control" onchange="filterTahun()">
                            <option value="<?= $yearnow ?>"><?= $yearnow ?></option>
                            <option value="<?= $previousyear ?>"><?= $previousyear ?></option>
                            <option value="<?= $twoyearago ?>"><?= $twoyearago ?></option>
                        </select>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" id="chart">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4" id="grafikpie">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold border-0 text-white">Transaksi Barang</h6>
                    
                    <div class="col-lg">
                        <select name="tahunpie" id="tahunpie" class="form-control" onchange="filterTahunPie()">
                            <option value="<?= $yearnow ?>"><?= $yearnow ?></option>
                            <option value="<?= $previousyear ?>"><?= $previousyear ?></option>
                            <option value="<?= $twoyearago ?>"><?= $twoyearago ?></option>
                        </select>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" id="chartpie">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <span class="badge badge-success" id="bm"></span> Barang Masuk
                    </span>
                    <span class="mr-2">
                        <span class="badge badge-danger" id="bk"></span> Barang Keluar
                    </span>
                </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-md-4 mb-4" id="bmterakhir">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success">
                <h6 class="m-0 font-weight-bold border-0 text-white">5 Barang Masuk Terakhir</h6>
                <?php if($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'user'): ?>
                    <a href="<?= base_url() ?>barang_masuk" class="btn btn-success btn-md btn-circle">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php foreach($bm5Terakhir as $bm): ?>
                        
                    <div class="col-lg-2 mb-2">
                        <img src="<?= base_url() ?>assets/upload/barang/<?= $bm->foto ?>" alt="" width="100%" style="border-radius: 5px;">
                    </div>
                    <div class="col-lg-10">
                        <h5 class="h5 mb-0 text-gray-800"><b><?= $bm->nama_barang ?></b></h5>
                        <h6 class="h6 mb-0 text-gray-800"><?= $bm->tgl_masuk ?></h6>
                        <span class="badge badge-success"> <i class="fa fa-plus"></i> <?= $bm->jumlah_masuk ?></span>
                    </div>

                    <div class="col-lg-12">
                        <!-- Divider -->
                        <hr class="sidebar-divider">
                    </div>

                    <?php endforeach; ?>

                </div>
            

            </div>
        </div>
    </div>


    <div class="col-xl-4 col-md-4 mb-4" id="bkterakhir">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger">
                <h6 class="m-0 font-weight-bold border-0 text-white">5 Barang Keluar Terakhir</h6>
                <?php if($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'user'): ?>
                    <a href="<?= base_url() ?>barang_keluar" class="btn btn-danger btn-md btn-circle">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php foreach($bk5Terakhir as $bk): ?>
                        
                    <div class="col-lg-2 mb-2">
                        <img src="<?= base_url() ?>assets/upload/barang/<?= $bk->foto ?>" alt="" width="100%" style="border-radius: 5px;">
                    </div>
                    <div class="col-lg-10">
                        <h5 class="h5 mb-0 text-gray-800"><b><?= $bk->nama_barang ?></b></h5>
                        <h6 class="h6 mb-0 text-gray-800"><?= $bk->tgl_keluar ?></h6>
                        <span class="badge badge-danger"> <i class="fa fa-minus"></i> <?= $bk->jumlah_keluar ?></span>
                    </div>

                    <div class="col-lg-12">
                        <!-- Divider -->
                        <hr class="sidebar-divider">
                    </div>

                    <?php endforeach; ?>

                </div>
            
            </div>
        </div>
    </div>


    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/sbadmin/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/js/chart/chart-area.js"></script>
<script src="<?= base_url(); ?>assets/js/chart/pie-chart.js"></script>

<script src="<?= base_url(); ?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/js/dashboard.js"></script>

<?php if($this->session->flashdata('Pesan')): ?>

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
        $("#barang").addClass("bounceIn");
        $("#supplier").addClass("bounceIn");
        $("#stok").addClass("bounceIn");
        $("#user").addClass("bounceIn");
        $("#grafik").addClass("bounceIn");
        $("#grafikpie").addClass("bounceIn");
        $("#bmterakhir").addClass("bounceIn");
        $("#bkterakhir").addClass("bounceIn");
    })
});
</script>
<?php endif; ?>
