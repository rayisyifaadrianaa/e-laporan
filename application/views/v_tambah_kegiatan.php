<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-gray-800">Tambah/Perbarui Kegiatan</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Uraian Kegiatan</label>
                            <div class="col-sm-9">
                                <input required type="text" name="uraian" class="form-control" id="" placeholder="" value="<?php echo $fetch['uraian']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Target</label>
                            <div class="col-sm-9">
                                <input required type="text" name="target" class="form-control" id="" placeholder="" value="<?php echo $fetch['target']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Satuan</label>
                            <div class="col-sm-9">
                                <input required type="text" name="satuan" class="form-control" id="" placeholder="" value="<?php echo $fetch['satuan']; ?>">
                            </div>
                        </div>
                        <?php if (in_array($_SESSION['role'], ['admin', 'manager'])) { ?>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pegawai</label>
                                <div class="col-sm-9">
                                    <select required class="form-control" name="id_pegawai">
                                        <option value="">Pilih Data Pegawai</option>
                                        <?php foreach ($pegawai as $i) { ?>
                                            <option <?php if ($i['id'] == $fetch['id_pegawai']) { echo "selected='selected'"; } ?> value="<?php echo $i['id']; ?>"><?php echo $i['nip_pegawai']; ?> - <?php echo $i['nama_pegawai']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" name="id_pegawai" value="<?php echo $_SESSION['id_pegawai']; ?>" />
                        <?php } ?>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-md btn-info">Simpan</button>
                                <a href="<?php echo base_url(); ?>dashboard/daftar_kegiatan" class="btn btn-md btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->