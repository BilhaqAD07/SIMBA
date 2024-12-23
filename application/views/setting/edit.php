<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Setting Web
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open_multipart('', [], ['id' => $setting['id']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="foto">Logo</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url() ?>assets/img/logo/<?= $setting['logo']; ?>" alt="<?= $setting['nama']; ?>" class="shadow-sm img-thumbnail">
                            </div>
                            <div class="col-9">
                                <input type="file" name="foto" id="foto">
                                <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama">Nama Web</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('nama', $setting['nama']); ?>" name="nama" id="nama" type="text" class="form-control" placeholder="Nama...">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="pemilik">Nama Pemilik</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('pemilik', $setting['pemilik']); ?>" name="pemilik" id="pemilik" type="text" class="form-control" placeholder="Nama Pemilik...">
                        </div>
                        <?= form_error('pemilik', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="kontak">No. HP</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('kontak', $setting['kontak']); ?>" name="kontak" id="kontak" type="text" class="form-control" placeholder="Kontak...">
                        </div>
                        <?= form_error('kontak', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="alamat">Alamat Kota</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('alamat', $setting['alamat']); ?>" name="alamat" id="alamat" type="text" class="form-control" placeholder="Alamat...">
                        </div>
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="zona_waktu">Kode Zona Waktu</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('zona_waktu', $setting['zona_waktu']); ?>" name="zona_waktu" id="zona_waktu" type="text" class="form-control" placeholder="Contoh Bandung_z41c">
                        </div>
                        <span style="color: red;"><b >Keterangan: _z41c (WIB) , _z41b (WITA), Dan _z41d (WIT)</b></span>
                        <?= form_error('zona_waktu', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                
                <!-- New fields for header and sidebar background colors -->
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="header_background_color">Header Background Color</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('header_background_color', $setting['header_background_color']); ?>" name="header_background_color" id="header_background_color" type="color" class="form-control">
                        <?= form_error('header_background_color', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="sidebar_background_color">Sidebar Background Color</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('sidebar_background_color', $setting['sidebar_background_color']); ?>" name="sidebar_background_color" id="sidebar_background_color" type="color" class="form-control">
                        <?= form_error('sidebar_background_color', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
