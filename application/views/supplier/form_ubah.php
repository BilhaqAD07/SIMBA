<div class="container-fluid">

    <?php foreach($supplier as $s): ?>
<form action="<?= base_url() ?>supplier/proses_ubah" name="myForm" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Ubah Supplier</h5>
                    
                </div>

                <div class="col-lg-12">
                    <br>
                    <!-- Id Supplier -->
                      <div class="form-group"><label>ID Supplier</label>
                                <input class="form-control" name="idsupplier" type="text" value="<?= $s->id_supplier ?>" readonly>
                      </div>

                    <!-- Nama Supplier -->
                     <div class="form-group"><label>Nama Supplier</label>
                                <input class="form-control" name="supplier" type="text" value="<?= $s->nama_supplier ?>">
                     </div>

                    <!-- Nomor Telepon -->
                     <div class="form-group"><label>Nomor Telepon</label>
                                <input class="form-control" name="notelp" type="text" maxlength="20" value="<?= $s->notelp ?>" maxlength="20">
                            </div>

                    <!-- Alamat -->
                    <div class="form-group"><label>Alamat</label>
                      <input class="form-control" name="alamat" type="text" value="<?= $s->alamat ?>">
                    </div>
                      <!-- Foto -->
                    <div class="form-group"><label>Foto</label>
                        <div class="card bg-warning text-white shadow">
                            <div class="card-body">
                                Format
                                <div class="text-white-45 small">.png .jpeg .jpg .tiff .gif .tif</div>
                            </div>
                        </div>
                        <br>
                        <center>
                            <div>
                                <img src="<?= base_url() ?>assets/upload/supplier/<?= $s->foto ?>" id="outputImg" width="200"
                                    maxheight="300">
                            </div>
                        </center>
                        <br>
                        <span class="text-danger">*kosongkan jika tidak ingin merubah</span>
                        <!-- foto -->
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="hidden" name="fotoLama" value="<?= $s->foto ?>">
                                <input class="custom-file-input" type="file" id="GetFile" name="photo"
                                    onchange="VerifyFileNameAndFileSize()" accept=".png,.gif,.jpeg,.tiff,.jpg">
                                <label class="custom-file-label" for="customFile">Pilih File</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text text-white">Simpan Perubahan</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    </div>
<!-- /.container-fluid -->

<?php endforeach; ?>

</div>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/supplier.js"></script>
<script src="<?= base_url(); ?>assets/js/validasi/formsupplier.js"></script>

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

    })
});
</script>
<?php endif; ?>