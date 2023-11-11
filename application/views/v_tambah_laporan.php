<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="text-gray-800">Tambah/Perbarui Laporan</h4>
				</div>
				<div class="card-body">
					<form method="post" action="" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Uraian Kegiatan</label>
							<div class="col-sm-9">
								<select required class="form-control" name="kegiatan_id">
									<option value="">Pilih Kegiatan</option>
									<?php foreach ($kegiatan as $i) { ?>
										<option <?php if ($i['id'] == $fetch['kegiatan_id']) {
													echo "selected='selected'";
												} ?> value="<?php echo $i['id']; ?>"><?php echo $i['uraian']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Detil Kegiatan</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="detil_kegiatan" style="height: 150px;"><?php echo $fetch['detil_kegiatan']; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Waktu Mulai</label>
							<div class="col-sm-9">
								<input required type="datetime-local" name="waktu" class="form-control" id="" placeholder="" value="<?php echo $fetch['waktu']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Waktu Selesai</label>
							<div class="col-sm-9">
								<input type="datetime-local" name="waktu_selesai" class="form-control" id="" placeholder="" value="<?php echo $fetch['waktu_selesai']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<select <?php if ($fetch['status_atasan']) {
											echo "disabled";
										} ?> required class="form-control" <?php if (!$fetch['status_atasan']) {
																				echo "name='status'";
																			} ?>>
									<!-- <option value="">Pilih Status</option> -->
									<option <?php if ($fetch['status'] == 'Belum Selesai') {
												echo "selected='selected'";
											} ?> value="Belum Selesai">Belum Selesai</option>
									<option <?php if ($fetch['status'] == 'Sedang Dikerjakan') {
												echo "selected='selected'";
											} ?> value="Sedang Dikerjakan">Sedang Dikerjakan</option>
									<option <?php if ($fetch['status'] == 'Selesai') {
												echo "selected='selected'";
											} ?> value="Selesai">Selesai</option>
									<?php // if (in_array($_SESSION['role'], ['admin', 'manager'])) { 
									?>
									<option <?php if ($fetch['status'] == 'Terlambat') {
												echo "selected='selected'";
											} ?> value="Terlambat">Terlambat</option>
									<?php // } 
									?>
								</select>
								<?php if ($fetch['status_atasan']) { ?>
									<input type="hidden" name="status" value="<?php echo $fetch['status']; ?>" />
								<?php } ?>
							</div>
						</div>
						<?php if (in_array($_SESSION['role'], ['admin', 'manager'])) { ?>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Pegawai</label>
								<div class="col-sm-9">
									<select required class="form-control" name="id_pegawai">
										<option value="">Pilih Data Pegawai</option>
										<?php foreach ($pegawai as $i) { ?>
											<option <?php if ($i['id'] == $fetch['id_pegawai']) {
														echo "selected='selected'";
													} ?> value="<?php echo $i['id']; ?>"><?php echo $i['nip_pegawai']; ?> - <?php echo $i['nama_pegawai']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						<?php } else { ?>
							<input type="hidden" name="id_pegawai" value="<?php echo $_SESSION['id_pegawai']; ?>" />
						<?php } ?>

						<input type="hidden" name="status_atasan" value="<?php echo $fetch['status_atasan']; ?>" />
						<input type="hidden" name="notes_atasan" value="<?php echo $fetch['notes_atasan']; ?>" />
						<input type="hidden" name="hasil_atasan" value="<?php echo $fetch['hasil_atasan']; ?>" />
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label">Upload Dokumen Pendukung Berupa PDF</label>
							<div class="col-sm-9">
								<input type="file" name="laporan" class="form-control" id="" placeholder="">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-9">
								<button class="btn btn-md btn-info">Simpan</button>
								<a href="<?php echo base_url(); ?>dashboard/daftar_laporan" class="btn btn-md btn-danger">Batal</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->