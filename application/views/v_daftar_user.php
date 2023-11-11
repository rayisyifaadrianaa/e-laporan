<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> -->
        <h1 class="h3 mb-0 text-gray-800 mb-3">Daftar Data User</h1>
        <a href="<?php echo base_url(); ?>dashboard/tambah_user" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
        <!-- <a onclick="$('#filename').click();" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm mb-3" style="cursor: pointer;"><i class="fas fa-file fa-sm text-white-50"></i> Import Dataset</a> -->
    <!-- </div> -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Posisi</th>
                                    <th>Divisi</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <!-- <th>Password</th> -->
                                    <th>Foto</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($datasets as $d) { ?>
                                <tr>
                                    <td><?php echo $no; $no++; ?></td>
                                    <td><?php echo $d['nip']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['jabatan']; ?></td>
                                    <td><?php echo $d['jabatan_detil']; ?></td>
                                    <td><?php echo $d['divisi']; ?></td>
                                    <td><?php echo $d['email']; ?></td>
                                    <td><?php echo $d['username']; ?></td>
                                    <!-- <td>*****</td> -->
                                    <td><img class="mb-3" src="<?php echo base_url().'assets/upload/avatar/'.$d['foto']; ?>" style="width: 100px; height: 100px; object-fit: cover;" /></td>
                                    <td><?php echo $d['role']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>dashboard/tambah_user?id=<?php echo $d['id']; ?>"><i class="fa fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger" href="<?php echo base_url(); ?>dashboard/delete_user?id=<?php echo $d['id']; ?>"><i class="fa fa-trash"></i></a>
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
                        // Get a reference to the file input element
                        const fileInput = document.getElementById('filename');

                        // Add an event listener to the file input element
                        fileInput.addEventListener('change', () => {
                            // Check if a file has been selected
                            if (fileInput.files.length > 0) {
                                // Automatically submit the form when a file is selected
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