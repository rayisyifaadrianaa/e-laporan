<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-gray-800">Hasil Klasifikasi</h1>
        <a href="#" id="exportData" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Export Hasil Klasifikasi</a>
        <!-- <a href="<?php echo base_url(); ?>dashboard/tambah_dataset" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Dataset</a> -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Komentar</th>
                                    <th>Pre Processing</th>
                                    <th>Manual</th>
                                    <th>Sistem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($datasets as $d) { ?>
                                    <tr>
                                        <td><?php echo $no;
                                            $no++; ?></td>
                                        <td><?php echo $d['text']; ?></td>
                                        <td><?php echo $d['pre_processing_text']; ?></td>
                                        <td>
                                            <?php if ($d['label'] == 0) { ?>
                                                <a href="#" class="btn btn-danger btn-sm">Negatif</a>
                                            <?php } elseif ($d['label'] == 1) { ?>
                                                <a href="#" class="btn btn-success btn-sm">Positif</a>
                                            <?php } elseif ($d['label'] == 2) { ?>
                                                <a href="#" class="btn btn-info btn-sm">Netral</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($d['predicted_label'] == 1) { ?>
                                                <a href="#" class="btn btn-danger btn-sm">Negatif</a>
                                            <?php } elseif ($d['predicted_label'] == 2) { ?>
                                                <a href="#" class="btn btn-success btn-sm">Positif</a>
                                            <?php } elseif ($d['predicted_label'] == 3) { ?>
                                                <a href="#" class="btn btn-info btn-sm">Netral</a>
                                            <?php } else { ?>
                                                Belum Ada
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <hr />
                    <h5 class="mb-1 text-success" style="font-weight: bold;">Positif <?php echo $positif; ?> data</h5>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $positif_perc; ?>%" aria-valuenow="<?php echo $positif_perc; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h5 class="mb-1 text-danger" style="font-weight: bold;">Negatif <?php echo $negatif; ?> data</h5>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $negatif_perc; ?>%" aria-valuenow="<?php echo $negatif_perc; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <!-- <h5 class="mb-1 text-info" style="font-weight: bold;">Netral <?php echo $netral; ?> data</h5>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $netral_perc; ?>%" aria-valuenow="<?php echo $netral_perc; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Confusion Matrix</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Klasifikasi Positif</td>
                                    <td>Klasifikasi Negatif</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Aktual Positif</td>
                                    <td><?php echo $confusion_matrix['Positif']['Positif']; ?></td>
                                    <td><?php echo $confusion_matrix['Negatif']['Positif']; ?></td>
                                </tr>
                                <tr>
                                    <td>Aktual Negatif</td>
                                    <td><?php echo $confusion_matrix['Positif']['Negatif']; ?></td>
                                    <td><?php echo $confusion_matrix['Negatif']['Negatif']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Hasil Uji Confusion Matrix</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>Accuracy</td>
                                    <td>Precision</td>
                                    <td>Recall</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php 
                                            $hasil = 
                                                ($confusion_matrix['Positif']['Positif'] + $confusion_matrix['Negatif']['Negatif']) /  
                                                
                                                ($confusion_matrix['Positif']['Positif'] +  $confusion_matrix['Negatif']['Positif'] +  
                                                $confusion_matrix['Positif']['Negatif'] +  $confusion_matrix['Negatif']['Negatif']);
                                            $hasil_acc = round($hasil * 100, 0);
                                            echo round($hasil * 100, 0);
                                        ?>%
                                    </td>
                                    <td>
                                        <?php 
                                            $hasil = 
                                                ($confusion_matrix['Positif']['Positif']) /  
                                                
                                                ($confusion_matrix['Positif']['Positif'] +  $confusion_matrix['Negatif']['Positif']);
                                            echo round($hasil * 100, 0);
                                        ?>%
                                    </td>
                                    <td>
                                        <?php 
                                            $hasil = 
                                                ($confusion_matrix['Positif']['Positif']) /  
                                                
                                                ($confusion_matrix['Positif']['Positif'] +  $confusion_matrix['Positif']['Negatif']);
                                            echo round($hasil * 100, 0);
                                        ?>%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5>Persentase Grafik</h5>
                    <div class="chart-area">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <center class="mt-3">
                        <font class="text-success" style="font-weight: bold;">Positif: <?php echo 100 - (int) $negatif_perc - (int) $netral_perc; ?>%</font>&nbsp;&nbsp;<font class="text-danger" style="font-weight: bold;">Negatif: <?php echo (int) $negatif_perc; ?>%</font>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5>Akurasi Pengujian</h5>
                    <div class="chart-area">
                        <canvas id="myPieChart2"></canvas>
                    </div>
                    <center class="mt-3">
                        <font class="text-success" style="font-weight: bold;">Sesuai: <?php echo (int) $hasil_acc; ?>%</font>&nbsp;&nbsp;<font class="text-danger" style="font-weight: bold;">Tidak Sesuai: <?php echo (int) 100 - $hasil_acc; ?>%</font>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->