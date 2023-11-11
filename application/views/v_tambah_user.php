<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggota > <strong>Daftar Anggota</strong></h1>
        <a href="<?php echo base_url(); ?>dashboard/tambah_anggota" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota</a>
    </div> -->

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-gray-800">Tambah/Perbarui User</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input required type="text" name="email" class="form-control" id="" placeholder="" value="<?php echo $fetch['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input required type="text" name="username" class="form-control" id="" placeholder="" value="<?php echo $fetch['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input <?php if (!$fetch['password']) { echo "required"; } ?> type="password" name="password" class="form-control" id="" <?php if ($fetch['password']) { ?>placeholder="Kosongkan Apabila Tidak Dirubah"<?php } ?> value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select required class="form-control" name="role">
                                    <option value="">Pilih Role</option>
                                    <option <?php if ($fetch['role'] == 'pegawai') { echo "selected='selected'"; } ?> value="pegawai">Pegawai</option>
                                    <option <?php if ($fetch['role'] == 'manager') { echo "selected='selected'"; } ?> value="manager">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Pegawai</label>
                            <div class="col-sm-10">
                                <select required class="form-control" name="id_pegawai">
                                    <option value="">Pilih Data Pegawai</option>
                                    <?php if ($fetch['password']) { $pegawai = $pegawai2; }  foreach ($pegawai as $i) { ?>
                                        <option <?php if ($i['id'] == $fetch['id_pegawai']) { echo "selected='selected'"; } ?> value="<?php echo $i['id']; ?>"><?php echo $i['nip_pegawai']; ?> - <?php echo $i['nama_pegawai']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <?php if ($fetch['foto']) { ?>
                                    <img class="mb-3" src="<?php echo base_url().'assets/upload/avatar/'.$fetch['foto']; ?>" style="width: 200px; height: 200px; object-fit: cover;" /><br />
                                <?php } ?>
                                <!-- <input type="text" class="form-control" id="" placeholder="Tidak perlu diisi"> -->
                                <input type="file" name="foto" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-md btn-info">Simpan</button>
                                <a href="<?php echo base_url(); ?>dashboard/daftar_user" class="btn btn-md btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->