<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-gray-800">Approval Laporan Kinerja</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="hidden" name="kegiatan_id" value="<?php echo $fetch['kegiatan_id']; ?>" />

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Uraian Kegiatan</label>
                            <div class="col-sm-9">
                                <select class="form-control" disabled>
                                    <option value="">Pilih Kegiatan</option>
                                    <?php foreach ($kegiatan as $i) { ?>
                                        <option <?php if ($i['id'] == $fetch['kegiatan_id']) { echo "selected='selected'"; } ?> value="<?php echo $i['id']; ?>"><?php echo $i['uraian']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Detil Kegiatan</label>
                            <div class="col-sm-9">
                                <textarea readonly="readonly" class="form-control" name="detil_kegiatan" style="height: 150px;"><?php echo $fetch['detil_kegiatan']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Waktu Mulai</label>
                            <div class="col-sm-9">
                                <input readonly="readonly" required type="datetime-local" name="waktu" class="form-control" id="" placeholder="" value="<?php echo $fetch['waktu']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Waktu Selesai</label>
                            <div class="col-sm-9">
                                <input readonly="readonly" type="datetime-local" name="waktu_selesai" class="form-control" id="" placeholder="" value="<?php echo $fetch['waktu_selesai']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input readonly="readonly" type="text" name="status" class="form-control" id="" placeholder="" value="<?php echo $fetch['status']; ?>">
                            </div>
                        </div>
                        <?php if (in_array($_SESSION['role'], ['admin', 'manager'])) { ?>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Pegawai</label>
                                <div class="col-sm-9">
                                    <select readonly="readonly" required class="form-control" disabled>
                                        <option value="">Pilih Data Pegawai</option>
                                        <?php foreach ($pegawai as $i) { ?>
                                            <option <?php if ($i['id'] == $fetch['id_pegawai']) { echo "selected='selected'"; } ?> value="<?php echo $i['id']; ?>"><?php echo $i['nip_pegawai']; ?> - <?php echo $i['nama_pegawai']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id_pegawai" value="<?php echo $fetch['id_pegawai']; ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="id_pegawai" value="<?php echo $_SESSION['id_pegawai']; ?>" />
                        <?php } ?>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Status Approval</label>
                            <div class="col-sm-9">
                                <select required class="form-control" name="status_atasan">
                                    <option value="">Pilih Status Approval</option>
                                    <option <?php if ($fetch['status_atasan'] == 'Pending') { echo "selected='selected'"; } ?> value="Pending">Pending</option>
                                    <option <?php if ($fetch['status_atasan'] == 'Approved') { echo "selected='selected'"; } ?> value="Approved">Approved</option>
                                    <option <?php if ($fetch['status_atasan'] == 'Rejected') { echo "selected='selected'"; } ?> value="Rejected">Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Komentar</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="notes_atasan" style="height: 150px;"><?php echo $fetch['notes_atasan']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Hasil</label>
                            <div class="col-sm-9">
                                <input type="text" name="hasil_atasan" class="form-control" id="" placeholder="" value="<?php echo $fetch['hasil_atasan']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-md btn-info">Simpan</button>
                                <a href="<?php echo base_url(); ?>dashboard/approval" class="btn btn-md btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->