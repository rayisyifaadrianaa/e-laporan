<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800 mb-3">Daftar Divisi</h1>
    <a href="<?php echo base_url(); ?>dashboard/tambah_divisi" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Divisi</a>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Divisi</th>
                                    <th class="exclude-export">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($datasets as $d) { ?>
                                    <tr>
                                        <td><?php echo $no;
                                            $no++; ?></td>
                                        <td><?php echo $d['nama_divisi']; ?></td>
                                        <td class="exclude-export">
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>dashboard/tambah_divisi?id=<?php echo $d['id']; ?>"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-sm btn-danger" href="<?php echo base_url(); ?>dashboard/delete_divisi?id=<?php echo $d['id']; ?>"><i class="fa fa-trash"></i></a>
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