<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Buku > <strong>Tambah Buku</strong></h1>
        <a href="<?php echo base_url(); ?>dashboard/tambah_anggota" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota</a>
    </div> -->

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-gray-800">Profil</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input name="email" type="text" class="form-control" id="" value="<?php echo $_SESSION['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input name="username" type="text" class="form-control" id="" value="<?php echo $_SESSION['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="" value="<?php echo $_SESSION['password']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <img class="mb-3" src="<?php echo base_url().'assets/upload/avatar/'.$_SESSION['foto']; ?>" style="width: 200px; height: 200px; object-fit: cover;" /><br />
                                <!-- <input type="text" class="form-control" id="" placeholder="Tidak perlu diisi"> -->
                                <input type="file" name="foto" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-md btn-info">Simpan</a>
                                <!-- <a href="<?php echo base_url(); ?>dashboard/daftar_transaksi" class="btn btn-md btn-danger">Batal</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->