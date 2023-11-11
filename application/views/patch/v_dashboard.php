<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> -->

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $positif + $negatif + $netral; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Data Uji Keseluruhan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-plus fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $positif; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Data Uji Positif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fa fa-minus fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $negatif; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Data Uji Negatif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-xl-3 col-md-3 mb-4">
            <div class="card shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fa fa-list fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $netral; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Dataset Netral</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow h-100 py-2 bg-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $positif_latih + $negatif_latih + $netral_latih; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Data Latih Keseluruhan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow h-100 py-2 bg-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-plus fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $positif_latih; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Data Latih Positif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card shadow h-100 py-2 bg-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fa fa-minus fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $negatif_latih; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Data Latih Negatif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-xl-3 col-md-3 mb-4">
            <div class="card shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fa fa-list fa-2x text-gray-300" style="color: #fff !important;"></i>
                        </div>
                        <div class="col ml-4">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #fff !important;"><?php echo $netral; ?></div>
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1" style="color: #fff !important;">
                                Jumlah Dataset Netral</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <!-- <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Cross Validation</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart2"></canvas>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Persentase Dataset</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myPieChart3"></canvas>
                    </div>
                    <center class="mt-3">
                        <font class="text-success" style="font-weight: bold;">Positif: <?php echo 100 - (int) $negatif_perc - (int) $netral_perc; ?>%</font>&nbsp;&nbsp;<font class="text-danger" style="font-weight: bold;">Negatif: <?php echo (int) $negatif_perc; ?>%</font>
                        </font>
                    </center>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <!-- <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Pengujian Sistem Berdasarkan Nilai K</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nilai K</th>
                                    <th>Akurasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($kvold_acc as $k) { ?>
                                    <tr>
                                        <td>K<?php echo $no;
                                                $no++; ?></td>
                                        <td><?php echo (int) $k; ?>%</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Masukkan Jumlah K-Vold</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <input <?php if ($_SESSION['role'] == 'user') {
                                        echo "readonly='readonly'";
                                    } ?> type="number" class="form-control" name="kvold" value="<?php echo $kvold['jumlah']; ?>" />
                        </div>

                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-info w-100" value="Simpan" />
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- /.container-fluid -->