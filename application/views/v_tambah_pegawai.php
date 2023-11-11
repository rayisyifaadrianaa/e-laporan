<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-6">
			<div class="card">
				<div class="card-header">
					<h4 class="text-gray-800">Tambah/Perbarui Pegawai</h4>
				</div>
				<div class="card-body">
					<form method="post" action="">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">NIP</label>
							<div class="col-sm-6">
								<input type="text" readonly required name="nip_pegawai" class="form-control" id="nip_pegawai" placeholder="" value="<?php echo $fetch['nip_pegawai']; ?>">
							</div>
							<div class="col-sm-3">
								<button id="get_last_nip" class="btn btn-sm btn-info">Ambil NIP Terakhir</button>
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Nama</label>
							<div class="col-sm-9">
								<input required type="text" name="nama_pegawai" class="form-control" id="" placeholder="" value="<?php echo $fetch['nama_pegawai']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">No Handphone</label>
							<div class="col-sm-9">
								<input required type="number" name="no_handphone" class="form-control" id="" placeholder="" value="<?php echo $fetch['no_handphone']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Jabatan</label>
							<div class="col-sm-9">
								<select required class="form-control" name="jabatan_id">
									<option value="">Pilih Jabatan</option>
									<?php foreach ($jabatan as $i) { ?>
										<option <?php if ($i['id'] == $fetch['jabatan_id']) {
													echo "selected='selected'";
												} ?> value="<?php echo $i['id']; ?>"><?php echo $i['nama_jabatan']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Posisi</label>
							<div class="col-sm-9">
								<input required type="text" name="jabatan_detil" class="form-control" id="" placeholder="" value="<?php echo $fetch['jabatan_detil']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Divisi</label>
							<div class="col-sm-9">
								<select required class="form-control" name="divisi_id">
									<option value="">Pilih Divisi</option>
									<?php foreach ($divisi as $i) { ?>
										<option <?php if ($i['id'] == $fetch['divisi_id']) {
													echo "selected='selected'";
												} ?> value="<?php echo $i['id']; ?>"><?php echo $i['nama_divisi']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Atasan</label>
							<div class="col-sm-9">
								<select required class="form-control" name="atasan_id">
									<option value="">Pilih Data Pegawai</option>
									<?php foreach ($pegawai as $i) { ?>
										<option <?php if ($i['id'] == $fetch['atasan_id']) {
													echo "selected='selected'";
												} ?> value="<?php echo $i['id']; ?>"><?php echo $i['nip_pegawai']; ?> - <?php echo $i['nama_pegawai']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-9">
								<button class="btn btn-md btn-info">Simpan</button>
								<a href="<?php echo base_url(); ?>dashboard/daftar_pegawai" class="btn btn-md btn-danger">Batal</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function() {
		$("#get_last_nip").click(function() {
			$.ajax({
				url: "<?php echo site_url('Dashboard/get_last_nip'); ?>",
				type: "GET",
				dataType: "text",
				success: function(data) {
					$("#nip_pegawai").val(data);
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		});
	});
</script>