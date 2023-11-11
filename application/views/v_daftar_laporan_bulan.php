<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800 mb-3">Laporan Per Hari</h1>
    
    <?php if ($pegawai_sel) { ?>
        <!-- <a href="<?php echo base_url(); ?>dashboard/tambah_laporan" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Laporan</a> -->
        <a href="#" id="exportData" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Export Data</a>
        <a href="#" id="exportData" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm mb-3"><i class="fas fa-file fa-sm text-white-50"></i> Cetak Laporan</a>
    <?php } ?>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Data Pegawai</label>
                                    <select required class="form-control" name="pegawai_sel">
                                        <option value="">Pilih Data Pegawai</option>
                                        <?php foreach ($pegawai as $i) { ?>
                                            <option <?php if ($i['id'] == $pegawai_sel) { echo "selected='selected'"; } ?> value="<?php echo $i['id']; ?>"><?php echo $i['nip_pegawai']; ?> - <?php echo $i['nama_pegawai']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>" />
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-success w-100" value="Tampilkan Laporan" />
                                    <?php if ($from_date && $to_date && $pegawai_sel) { ?>
                                        <a href="<?php echo base_url(); ?>dashboard/daftar_laporan_hari" class="btn btn-md btn-danger w-100 mt-2">Reset Filter</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <?php if ($pegawai_sel) { ?>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Posisi</th>
                                    <th>Divisi</th>
                                </tr>
                                <tr>
                                    <td><?php echo $pegawai_info['nip_pegawai']; ?></td>
                                    <td><?php echo $pegawai_info['nama_pegawai']; ?></td>
                                    <td><?php echo $pegawai_info['jabatan']; ?></td>
                                    <td><?php echo $pegawai_info['jabatan_detil']; ?></td>
                                    <td><?php echo $pegawai_info['divisi']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <hr style="margin-top: 0;" />
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th>Target</th>
                                        <th>Satuan</th>
                                        <th>Status</th>
                                        <th>Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($datasets as $d) { ?>
                                        <tr>
                                            <td><?php echo $no;
                                                $no++; ?></td>
                                            <td><?php echo $d['uraian']; ?></td>
                                            <td><?php echo $d['target']; ?></td>
                                            <td><?php echo $d['satuan']; ?></td>
                                            <td><?php echo $d['status']; ?></td>
                                            <td><?php echo $d['hasil_atasan']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- <a href="<?php echo base_url(); ?>dashboard/daftar_laporan" class="btn btn-md btn-primary w-100 mt-2">Cetak Laporan</a> -->
                    <?php } ?>

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