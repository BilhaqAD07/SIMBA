<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setting Web</h1>
    </div>
     <?php if ($this->session->flashdata('Pesan')): ?>
        <?= $this->session->flashdata('Pesan') ?>
    <?php endif; ?>
    <div class="col-lg-12 mb-4" id="container">
        <div class="card border-bottom-secondary shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengaturan Aplikasi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped dt-responsive nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Aplikasi</th>
                                <th>Pemilik</th>
                                <th>Kontak</th>
                                <th>Alamat Kota</th>
                                <th>Logo</th>
                                <th>Header Color</th>
                                <th>Sidebar Color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $setting['nama'] ?></td>
                                <td><?= $setting['pemilik'] ?></td>
                                <td><?= $setting['kontak'] ?></td>
                                <td><?= $setting['alamat'] ?></td>
                                <td><img src="<?= base_url() ?>assets/img/logo/<?= $setting['logo']; ?>" class="img-thumbnail" width="50"></td>
                                <td>
                                    <div style="width: 50px; height: 20px; background-color: <?= $setting['header_background_color']; ?>;"></div>
                                    <!-- <?= $setting['header_background_color']; ?> -->
                                </td>
                                <td>
                                    <div style="width: 50px; height: 20px; background-color: <?= $setting['sidebar_background_color']; ?>;"></div>
                                    <!-- <?= $setting['sidebar_background_color']; ?> -->
                                </td>
                                <td>
                                    <a href="<?= base_url('SettingWeb/edit/') . $setting['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-fw fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for the table -->
<!-- <style>
    .table thead th {
        border-bottom: 2px solid #e3e6f0;
        background-color: #4e73df;
        color: white;
    }
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style> -->

<!-- DataTables JavaScript and Initialization -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            columnDefs: [
                { orderable: false, targets: [4, 5, 6, 7] } // Disable ordering for certain columns
            ]
        });
    });
</script>
