<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800 mb-3">Approval Laporan Kinerja</h1>
    <!-- <a href="<?php echo base_url(); ?>dashboard/tambah_laporan" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Laporan</a> -->
    <a href="#" id="exportData" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Export Data</a>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <form action="" method="GET">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-success w-100" value="Filter Tanggal" />
                                    <?php if ($from_date && $to_date) { ?>
                                        <a href="<?php echo base_url(); ?>dashboard/daftar_laporan" class="btn btn-md btn-danger w-100 mt-2">Reset Filter</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr /> -->

                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian</th>
                                    <th>Detil Kegiatan</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <?php if (in_array($_SESSION['role'], ['admin', 'manager'])) { ?>
                                        <th>NIP Pegawai</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Posisi</th>
                                        <th>Divisi</th>
                                    <?php } ?>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                    <th>Approval</th>
                                    <th>Komentar</th>
                                    <th class="exclude-export">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($datasets as $d) { ?>
                                    <tr>
                                        <td><?php echo $no;
                                            $no++; ?></td>
                                        <td><?php echo $d['uraian']; ?></td>
                                        <td><?php echo $d['detil_kegiatan']; ?></td>
                                        <td><?php echo $d['target']; ?></td>
                                        <td><?php echo $d['satuan']; ?></td>
                                        <?php if (in_array($_SESSION['role'], ['admin', 'manager'])) { ?>
                                            <td><?php echo $d['nip']; ?></td>
                                            <td><?php echo $d['pegawai']; ?></td>
                                            <td><?php echo $d['jabatan']; ?></td>
                                            <td><?php echo $d['jabatan_detil']; ?></td>
                                            <td><?php echo $d['divisi']; ?></td>
                                        <?php } ?>
                                        <td><?php echo $d['waktu']; ?></td>
                                        <td><?php echo $d['waktu_selesai']; ?></td>
                                        <td><?php echo $d['status']; ?></td>
                                        <td>
                                            <?php if ($d['status_atasan'] == 'Approved') { ?>
                                                <a href="#" class="btn btn-sm btn-success">Approved</a>
                                            <?php } elseif ($d['status_atasan'] == 'Rejected') { ?>
                                                <a href="#" class="btn btn-sm btn-danger">Rejected</a>
                                            <?php } elseif ($d['status_atasan'] == 'Pending') { ?>
                                                <a href="#" class="btn btn-sm btn-warning">Pending</a>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $d['notes_atasan']; ?></td>
                                        <td class="exclude-export">
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>dashboard/tambah_approval?id=<?php echo $d['id']; ?>"><i class="fa fa-pen"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <form id="fileUploadForm" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>dashboard/import">
                        <input style="display: none;" type="file" id="filename" name="file" />
                    </form>
                    <script>
                        const fileInput = document.getElementById('filename');
                        fileInput.addEventListener('change', () => {
                            if (fileInput.files.length > 0) {
                                document.getElementById('fileUploadForm').submit();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->