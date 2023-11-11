<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> -->

    <!-- Content Row -->
    <?php if (in_array($_SESSION['role'], ['admin', 'manager'])) { ?>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-3 mb-3">
                <div class="card shadow h-100 py-2 bg-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-gray-300" style="color: #fff !important;"></i>
                            </div>
                            <div class="col ml-4">
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $divisi; ?></div>
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Data Divisi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-3">
                <div class="card shadow h-100 py-2 bg-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-paper-plane fa-2x text-gray-300" style="color: #fff !important;"></i>
                            </div>
                            <div class="col ml-4">
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $jabatan; ?></div>
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Data Jabatan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-3">
                <div class="card shadow h-100 py-2 bg-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fa fa-user-tie fa-2x text-gray-300" style="color: #fff !important;"></i>
                            </div>
                            <div class="col ml-4">
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $pegawai; ?></div>
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Data Pegawai</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-3">
                <div class="card shadow h-100 py-2 bg-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300" style="color: #fff !important;"></i>
                            </div>
                            <div class="col ml-4">
                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $user; ?></div>
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Data User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Selamat Datang di Sistem Informasi Laporan Kinerja Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-20 col-md-12 text-center">
                            <img src="<?php echo base_url(); ?>assets/img/bankbjb.png" style="height: 32em; width: auto;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->