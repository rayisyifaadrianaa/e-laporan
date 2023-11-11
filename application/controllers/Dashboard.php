<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$_SESSION['username']) {
			echo "<script>alert('Anda harus login terlebih dahulu untuk dapat mengakses halaman ini'); location.href = '" . base_url() . "login'</script>";
		}
		if ($_SESSION['role'] == 'pasien') {
			echo "<script>alert('Anda tidak memiliki izin untuk mengakses halaman ini'); location.href = '" . base_url() . "feedback'</script>";
		}
	}

	public function index()
	{
		$user = $this->db->get('users')->result_array();
		$pegawai = $this->db->get('pegawai')->result_array();
		$jabatan = $this->db->get('jabatan')->result_array();
		$divisi = $this->db->get('divisi')->result_array();

		$data['user'] = count($user);
		$data['pegawai'] = count($pegawai);
		$data['jabatan'] = count($jabatan);
		$data['divisi'] = count($divisi);

		$this->load->view('v_header', $data);
		$this->load->view('v_dashboard', $data);
		$this->load->view('v_footer');
	}

	#region divisi
	public function daftar_divisi()
	{
		$data['datasets'] = $this->db->get('divisi')->result_array();
		$data['active'] = 'datadivisi';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_divisi');
		$this->load->view('v_footer');
	}

	public function tambah_divisi()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$params = $this->input->post();

			if ((int) $params['id'] > 0) {
				$this->db->where('id', $params['id']);
				$this->db->update('divisi', [
					'nama_divisi' => $params['nama_divisi'],
				]);
			} else {
				$this->db->insert('divisi', [
					'nama_divisi' => $params['nama_divisi'],
				]);
			}

			echo "<script>alert('Data Divisi berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_divisi';</script>";
		} else {
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('divisi')->row_array();
			}

			$data['id'] = $id;
			$data['active'] = 'datadivisi';
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_divisi');
			$this->load->view('v_footer');
		}
	}

	public function delete_divisi()
	{
		$params = $_REQUEST;
		$this->db->where('id', $params['id']);
		$this->db->delete('divisi');

		echo "<script>alert('Data Divisi berhasil dihapus'); location.href = '" . base_url() . "dashboard/daftar_divisi';</script>";
	}
	#endregion

	#region jabatan
	public function daftar_jabatan()
	{
		$data['datasets'] = $this->db->get('jabatan')->result_array();
		$data['active'] = 'datajabatan';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_jabatan');
		$this->load->view('v_footer');
	}

	public function tambah_jabatan()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$params = $this->input->post();

			if ((int) $params['id'] > 0) {
				$this->db->where('id', $params['id']);
				$this->db->update('jabatan', [
					'nama_jabatan' => $params['nama_jabatan'],
				]);
			} else {
				$this->db->insert('jabatan', [
					'nama_jabatan' => $params['nama_jabatan'],
				]);
			}

			echo "<script>alert('Data Jabatan berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_jabatan';</script>";
		} else {
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('jabatan')->row_array();
			}

			$data['id'] = $id;
			$data['active'] = 'datajabatan';
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_jabatan');
			$this->load->view('v_footer');
		}
	}

	public function delete_jabatan()
	{
		$params = $_REQUEST;
		$this->db->where('id', $params['id']);
		$this->db->delete('jabatan');

		echo "<script>alert('Data Jabatan berhasil dihapus'); location.href = '" . base_url() . "dashboard/daftar_jabatan';</script>";
	}
	#endregion

	#region pegawai
	public function daftar_pegawai()
	{
		if (in_array($_SESSION['role'], ['manager'])) {
			$data['datasets'] = $this->db->query(
				'SELECT pegawai.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, p2.nama_pegawai as atasan
                FROM pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id
                LEFT JOIN pegawai as p2 ON p2.id = pegawai.atasan_id
                WHERE pegawai.divisi_id = ' . $_SESSION['pegawai']['divisi_id']
			)->result_array();
		} else {
			$data['datasets'] = $this->db->query(
				'SELECT pegawai.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, p2.nama_pegawai as atasan
                FROM pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id
                LEFT JOIN pegawai as p2 ON p2.id = pegawai.atasan_id'
			)->result_array();
		}

		$data['active'] = 'datapegawai';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_pegawai');
		$this->load->view('v_footer');
	}

	public function tambah_pegawai()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$params = $this->input->post();

			if ((int) $params['id'] > 0) {
				$this->db->where('id', $params['id']);
				$this->db->update('pegawai', [
					'nip_pegawai' => $params['nip_pegawai'],
					'nama_pegawai' => $params['nama_pegawai'],
					'no_handphone' => $params['no_handphone'],
					'atasan_id' => $params['atasan_id'] ? $params['atasan_id'] : 0,
					'jabatan_id' => $params['jabatan_id'],
					'jabatan_detil' => $params['jabatan_detil'],
					'divisi_id' => $params['divisi_id'],
				]);
			} else {
				$this->db->insert('pegawai', [
					'nip_pegawai' => $params['nip_pegawai'],
					'nama_pegawai' => $params['nama_pegawai'],
					'no_handphone' => $params['no_handphone'],
					'atasan_id' => $params['atasan_id'] ? $params['atasan_id'] : 0,
					'jabatan_id' => $params['jabatan_id'],
					'jabatan_detil' => $params['jabatan_detil'],
					'divisi_id' => $params['divisi_id'],
				]);
			}

			echo "<script>alert('Data Pegawai berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_pegawai';</script>";
		} else {
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('pegawai')->row_array();
			}

			$data['divisi'] = $this->db->get('divisi')->result_array();
			$data['jabatan'] = $this->db->get('jabatan')->result_array();
			$data['pegawai'] = $this->db->get('pegawai')->result_array();
			$data['id'] = $id;
			$data['active'] = 'datapegawai';
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_pegawai');
			$this->load->view('v_footer');
		}
	}
	public function get_last_nip()
	{
		$last_nip = $this->db->select('nip_pegawai')
			->from('pegawai')
			->order_by('id', 'desc')
			->limit(1)
			->get()
			->row();

		echo $last_nip->nip_pegawai;
	}


	public function delete_pegawai()
	{
		$params = $_REQUEST;
		$this->db->where('id', $params['id']);
		$this->db->delete('pegawai');

		echo "<script>alert('Data Pegawai berhasil dihapus'); location.href = '" . base_url() . "dashboard/daftar_pegawai';</script>";
	}
	#endregion

	#region kegiatan
	public function daftar_kegiatan()
	{
		if (in_array($_SESSION['role'], ['admin'])) {
			$data['datasets'] = $this->db->query(
				'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
                FROM kegiatan
                JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id'
			)->result_array();
		} else if (in_array($_SESSION['role'], ['manager'])) {
			$this->db->where('atasan_id', $_SESSION['id_pegawai']);
			$ids_pegawai = $this->db->get('pegawai')->result_array();
			$ids_pegawai = array_column($ids_pegawai, 'id');
			$ids_pegawai = implode(',', $ids_pegawai);

			$data['datasets'] = $this->db->query(
				'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
                FROM kegiatan
                JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id
                WHERE kegiatan.id_pegawai IN (' . $ids_pegawai . ') '
			)->result_array();
		} else {
			$data['datasets'] = $this->db->query(
				'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
                FROM kegiatan
                JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id
                WHERE kegiatan.id_pegawai = ' . $_SESSION['id_pegawai']
			)->result_array();
		}
		$data['active'] = 'datakegiatan';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_kegiatan');
		$this->load->view('v_footer');
	}

	public function tambah_kegiatan()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$params = $this->input->post();

			if ((int) $params['id'] > 0) {
				$this->db->where('id', $params['id']);
				$this->db->update('kegiatan', [
					'uraian' => $params['uraian'],
					'satuan' => $params['satuan'],
					'target' => $params['target'],
					'id_pegawai' => $params['id_pegawai'],
				]);
			} else {
				$this->db->insert('kegiatan', [
					'uraian' => $params['uraian'],
					'satuan' => $params['satuan'],
					'target' => $params['target'],
					'id_pegawai' => $params['id_pegawai'],
				]);
			}

			echo "<script>alert('Data Kegiatan berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_kegiatan';</script>";
		} else {
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('kegiatan')->row_array();
			}

			if (in_array($_SESSION['role'], ['manager'])) {
				$this->db->where('atasan_id', $_SESSION['id_pegawai']);
				$ids_pegawai = $this->db->get('pegawai')->result_array();
				$ids_pegawai = array_column($ids_pegawai, 'id');

				$this->db->where_in('id', $ids_pegawai);
				$data['pegawai'] = $this->db->get('pegawai')->result_array();
			} else {
				$data['pegawai'] = $this->db->get('pegawai')->result_array();
			}

			$data['id'] = $id;
			$data['active'] = 'datakegiatan';
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_kegiatan');
			$this->load->view('v_footer');
		}
	}

	public function delete_kegiatan()
	{
		$params = $_REQUEST;
		$this->db->where('id', $params['id']);
		$this->db->delete('kegiatan');

		echo "<script>alert('Data Kegiatan berhasil dihapus'); location.href = '" . base_url() . "dashboard/daftar_kegiatan';</script>";
	}
	#endregion

	#region user
	public function daftar_user()
	{
		$data['datasets'] = $this->db->query(
			'SELECT users.*, pegawai.nama_pegawai as nama, pegawai.nip_pegawai as nip, pegawai.jabatan_detil as jabatan_detil, divisi.nama_divisi as divisi, jabatan.nama_jabatan as jabatan
            FROM users 
            JOIN pegawai ON pegawai.id = users.id_pegawai
            JOIN divisi ON divisi.id = pegawai.divisi_id
            JOIN jabatan ON jabatan.id = pegawai.jabatan_id
            WHERE users.role != "admin" '
		)->result_array();
		$data['active'] = 'datauser';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_user');
		$this->load->view('v_footer');
	}

	public function tambah_user()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$params = $this->input->post();

			if ($_FILES['foto']['name']) {
				$upload_dir = './assets/upload/avatar/';

				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0755, true);
				}

				$temp_file = $_FILES['foto']['tmp_name'];
				$original_file = $_FILES['foto']['name'];

				$unique_filename = uniqid() . '_' . $original_file;
				if (move_uploaded_file($temp_file, $upload_dir . $unique_filename)) {
					// echo "File uploaded successfully!";
				} else {
					// echo "Error uploading file.";
				}
			} else {
				// echo "No file uploaded or an error occurred.";
			}

			if ($unique_filename) {
				if ((int) $params['id'] > 0) {
					$input = [
						'email' => $params['email'],
						'username' => $params['username'],
						'password' => md5($params['password']),
						'foto' => $unique_filename,
						'role' => $params['role'],
						'id_pegawai' => $params['id_pegawai'],
					];
					if (empty($params['password'])) {
						unset($input['password']);
					}

					$this->db->where('id', $params['id']);
					$this->db->update('users', $input);
				} else {
					$this->db->insert('users', [
						'email' => $params['email'],
						'username' => $params['username'],
						'password' => md5($params['password']),
						'foto' => $unique_filename,
						'role' => $params['role'],
						'id_pegawai' => $params['id_pegawai'],
					]);
				}
			} else {
				if ((int) $params['id'] > 0) {
					$input = [
						'email' => $params['email'],
						'username' => $params['username'],
						'password' => md5($params['password']),
						'role' => $params['role'],
						'id_pegawai' => $params['id_pegawai'],
					];
					if (empty($params['password'])) {
						unset($input['password']);
					}

					$this->db->where('id', $params['id']);
					$this->db->update('users', $input);
				} else {
					$this->db->insert('users', [
						'email' => $params['email'],
						'username' => $params['username'],
						'password' => md5($params['password']),
						'foto' => 'default.jpg',
						'role' => $params['role'],
						'id_pegawai' => $params['id_pegawai'],
					]);
				}
			}

			echo "<script>alert('Data berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_user';</script>";
		} else {
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('users')->row_array();
			}

			$data['id'] = $id;
			$data['active'] = 'datauser';
			$data['pegawai'] = $this->db->query(
				'SELECT pegawai.* FROM pegawai
                LEFT JOIN users ON users.id_pegawai = pegawai.id
                WHERE users.id IS NULL'
			)->result_array();
			$data['pegawai2'] = $this->db->get('pegawai')->result_array();
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_user');
			$this->load->view('v_footer');
		}
	}

	public function delete_user()
	{
		$params = $_REQUEST;
		$this->db->where('id', $params['id']);
		$this->db->delete('users');

		echo "<script>alert('Dataset berhasil dihapus'); location.href = '" . base_url() . "dashboard/daftar_user';</script>";
	}
	#endregion

	#region laporan
	public function daftar_laporan()
	{
		// if (in_array($_SESSION['role'], ['admin', 'manager'])) {
		//     $data['datasets'] = $this->db->query(
		//         'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
		//         FROM laporan
		//         JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
		//         JOIN jabatan ON jabatan.id = pegawai.jabatan_id
		//         JOIN divisi ON divisi.id = pegawai.divisi_id'
		//     )->result_array();
		// } else {
		//     $data['datasets'] = $this->db->query(
		//         'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
		//         FROM laporan
		//         JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
		//         JOIN jabatan ON jabatan.id = pegawai.jabatan_id
		//         JOIN divisi ON divisi.id = pegawai.divisi_id
		//         WHERE kegiatan.id_pegawai = '.$_SESSION['id_pegawai']
		//     )->result_array();
		// }

		$from_date = $_REQUEST['from_date'] ? $_REQUEST['from_date'] : '';
		$to_date = $_REQUEST['to_date'] ? $_REQUEST['to_date'] : '';

		if ($from_date && $to_date) {
			$data['datasets'] = $this->db->query(
				'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target
                FROM laporan
                JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
                WHERE kegiatan.id_pegawai = ' . $_SESSION['id_pegawai'] . '
                AND laporan.waktu >= "' . $from_date . '"
                AND laporan.waktu <= "' . $to_date . '"
                ORDER BY laporan.id DESC'
			)->result_array();
		} else {
			$data['datasets'] = $this->db->query(
				'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target
                FROM laporan
                JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
                WHERE kegiatan.id_pegawai = ' . $_SESSION['id_pegawai'] . '
                ORDER BY laporan.id DESC'
			)->result_array();
		}

		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

		$data['active'] = 'laporan';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_laporan');
		$this->load->view('v_footer');
	}

	// public function tambah_laporan()
	// {
	// 	if ($this->input->server('REQUEST_METHOD') === 'POST') {
	// 		$params = $this->input->post();

	// 		if ((int) $params['id'] > 0) {
	// 			$input = [
	// 				'waktu' => $params['waktu'],
	// 				'waktu_selesai' => $params['waktu_selesai'],
	// 				'kegiatan_id' => $params['kegiatan_id'],
	// 				'status' => $params['status'],
	// 				'status_atasan' => $params['status_atasan'],
	// 				'notes_atasan' => $params['notes_atasan'],
	// 				'hasil_atasan' => $params['hasil_atasan'],
	// 				'detil_kegiatan' => $params['detil_kegiatan'],
	// 				'id_pegawai' => $params['id_pegawai'],
	// 			];

	// 			$this->db->where('id', $params['id']);
	// 			$refetch_data = $this->db->get('laporan')->row_array();

	// 			if ($input['status'] == 'Selesai' && empty($refetch_data['status_atasan'])) {
	// 				$input['status_atasan'] = 'Pending';
	// 			}

	// 			$this->db->where('id', $params['id']);
	// 			$this->db->update('laporan', $input);
	// 			$id_notif = $params['id'];
	// 		} else {
	// 			$input = [
	// 				'waktu' => $params['waktu'],
	// 				'waktu_selesai' => $params['waktu_selesai'] ? $params['waktu_selesai'] : null,
	// 				'kegiatan_id' => $params['kegiatan_id'],
	// 				'status' => $params['status'],
	// 				'status_atasan' => $params['status_atasan'] ? $params['status_atasan'] : '',
	// 				'notes_atasan' => $params['notes_atasan'] ? $params['notes_atasan'] : '',
	// 				'hasil_atasan' => $params['hasil_atasan'] ? $params['hasil_atasan'] : '',
	// 				'detil_kegiatan' => $params['detil_kegiatan'] ? $params['detil_kegiatan'] : '',
	// 				'id_pegawai' => $params['id_pegawai'],
	// 			];
	// 			if ($input['status'] == 'Selesai') {
	// 				$input['status_atasan'] = 'Pending';
	// 			}

	// 			$this->db->insert('laporan', $input);

	// 			$last_fetch = $this->db->query('SELECT id, kegiatan_id FROM laporan ORDER BY id DESC LIMIT 1')->row_array();
	// 			$id_notif = $last_fetch['id'];
	// 		}

	// 		$this->db->where('id', $id_notif);
	// 		$notif_check = $this->db->get('laporan')->row_array();

	// 		if ($notif_check['notif_atasan'] == '0' && $input['status'] == 'Selesai') {
	// 			$this->db->where('id', $notif_check['id_pegawai']);
	// 			$pegawai_data = $this->db->get('pegawai')->row_array();

	// 			$this->db->where('id', $pegawai_data['atasan_id']);
	// 			$atasan_data = $this->db->get('pegawai')->row_array();

	// 			$this->db->where('id', $params['kegiatan_id']);
	// 			$kegiatan_data = $this->db->get('kegiatan')->row_array();

	// 			$input_wa_arr = [
	// 				"phoneNumber" => $atasan_data['no_handphone'] . "@c.us",
	// 				"opMessage" => "Dengan Hormat, " . $atasan_data['nama_pegawai'] . "\n\nNIP Pegawai: " . $pegawai_data['nip_pegawai'] . "\nNama Pegawai: " . $pegawai_data['nama_pegawai'] . "\nTelah menyelesaikan pekerjaan/kegiatan: " . $kegiatan_data['uraian'] . " dan membutuhkan approval Anda. Silahkan klik link dibawah untuk lebih lanjut:\n" . base_url() . "dashboard/tambah_approval?id=" . $id_notif,
	// 			];

	// 			$curl = curl_init();
	// 			curl_setopt_array($curl, array(
	// 				CURLOPT_URL => 'http://localhost:3000/whatsapp',
	// 				CURLOPT_RETURNTRANSFER => true,
	// 				CURLOPT_ENCODING => '',
	// 				CURLOPT_MAXREDIRS => 10,
	// 				CURLOPT_TIMEOUT => 0,
	// 				CURLOPT_FOLLOWLOCATION => true,
	// 				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 				CURLOPT_CUSTOMREQUEST => 'POST',
	// 				CURLOPT_POSTFIELDS => json_encode($input_wa_arr),
	// 				CURLOPT_HTTPHEADER => array(
	// 					'Content-Type: application/json'
	// 				),
	// 			));

	// 			$response = curl_exec($curl);
	// 			curl_close($curl);
	// 			if ($response == 'message triggered successfully') {
	// 				$this->db->where('id', $id_notif);
	// 				$this->db->update('laporan', [
	// 					'notif_atasan' => 1
	// 				]);
	// 			}
	// 		}

	// 		echo "<script>alert('Data Laporan berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_laporan';</script>";
	// 	} else {
	// 		$params = $_REQUEST;
	// 		$data['fetch'] = [];
	// 		$id = $params['id'];
	// 		if ((int) $id > 0) {
	// 			$this->db->where('id', $id);
	// 			$data['fetch'] = $this->db->get('laporan')->row_array();
	// 		}

	// 		$data['pegawai'] = $this->db->get('pegawai')->result_array();

	// 		if (in_array($_SESSION['role'], ['admin', 'manager'])) {
	// 			$data['kegiatan'] = $this->db->get('kegiatan')->result_array();
	// 		} else {
	// 			$this->db->where('id_pegawai', $_SESSION['id_pegawai']);
	// 			$data['kegiatan'] = $this->db->get('kegiatan')->result_array();
	// 		}

	// 		$data['id'] = $id;
	// 		$data['active'] = 'laporan';
	// 		$this->load->view('v_header', $data);
	// 		$this->load->view('v_tambah_laporan');
	// 		$this->load->view('v_footer');
	// 	}
	// }
	public function tambah_laporan()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			// Tangani input form
			$params = $this->input->post();

			// Handle file upload
			$laporan_filename = '';
			if (!empty($_FILES['laporan']['name'])) {
				$config['upload_path'] = './assets/laporan/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = 2048; // Ukuran maksimum file (dalam KB)

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('laporan')) {
					$upload_data = $this->upload->data();
					$laporan_filename = $upload_data['file_name'];
				} else {
					// Tangani kesalahan unggah file jika diperlukan
					$error = $this->upload->display_errors();
					echo "<script>alert('Error uploading file: $error'); location.href = '" . base_url() . "dashboard/tambah_laporan';</script>";
					return;
				}
			}

			// Buat array data input
			$input = [
				'waktu' => $params['waktu'],
				'waktu_selesai' => $params['waktu_selesai'],
				'kegiatan_id' => $params['kegiatan_id'],
				'status' => $params['status'],
				'status_atasan' => $params['status_atasan'],
				'notes_atasan' => $params['notes_atasan'],
				'hasil_atasan' => $params['hasil_atasan'],
				'detil_kegiatan' => $params['detil_kegiatan'],
				'id_pegawai' => $params['id_pegawai'],
				'laporan' => $laporan_filename, // Simpan nama file dokumen
			];

			// Simpan data ke database
			if ((int) $params['id'] > 0) {
				$this->db->where('id', $params['id']);
				$refetch_data = $this->db->get('laporan')->row_array();

				if ($input['status'] == 'Selesai' && empty($refetch_data['status_atasan'])) {
					$input['status_atasan'] = 'Pending';
				}

				$this->db->where('id', $params['id']);
				$this->db->update('laporan', $input);
				$id_notif = $params['id'];
			} else {
				$this->db->insert('laporan', $input);

				$last_fetch = $this->db->query('SELECT id, kegiatan_id FROM laporan ORDER BY id DESC LIMIT 1')->row_array();
				$id_notif = $last_fetch['id'];
			}

			// Kirim notifikasi jika sesuai kondisi
			$this->db->where('id', $id_notif);
			$notif_check = $this->db->get('laporan')->row_array();

			if ($notif_check['notif_atasan'] == '0' && $input['status'] == 'Selesai') {
				// Kode untuk mengirim notifikasi WhatsApp
				$this->db->where('id', $notif_check['id_pegawai']);
				$pegawai_data = $this->db->get('pegawai')->row_array();

				$this->db->where('id', $pegawai_data['atasan_id']);
				$atasan_data = $this->db->get('pegawai')->row_array();

				$this->db->where('id', $params['kegiatan_id']);
				$kegiatan_data = $this->db->get('kegiatan')->row_array();

				$input_wa_arr = [
					"phoneNumber" => $atasan_data['no_handphone'] . "@c.us",
					"opMessage" => "Dengan Hormat, " . $atasan_data['nama_pegawai'] . "\n\nNIP Pegawai: " . $pegawai_data['nip_pegawai'] . "\nNama Pegawai: " . $pegawai_data['nama_pegawai'] . "\nTelah menyelesaikan pekerjaan/kegiatan: " . $kegiatan_data['uraian'] . " dan membutuhkan approval Anda. Silahkan klik link dibawah untuk lebih lanjut:\n" . base_url() . "dashboard/tambah_approval?id=" . $id_notif,
				];

				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => 'http://localhost:3000/whatsapp',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => json_encode($input_wa_arr),
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$response = curl_exec($curl);
				curl_close($curl);
				if ($response == 'message triggered successfully') {
					$this->db->where('id', $id_notif);
					$this->db->update('laporan', [
						'notif_atasan' => 1
					]);
				}
			}

			echo "<script>alert('Data Laporan berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_laporan';</script>";
		} else {
			// Tampilkan form input
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('laporan')->row_array();
			}

			$data['pegawai'] = $this->db->get('pegawai')->result_array();

			if (in_array($_SESSION['role'], ['admin', 'manager'])) {
				$data['kegiatan'] = $this->db->get('kegiatan')->result_array();
			} else {
				$this->db->where('id_pegawai', $_SESSION['id_pegawai']);
				$data['kegiatan'] = $this->db->get('kegiatan')->result_array();
			}

			$data['id'] = $id;
			$data['active'] = 'laporan';
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_laporan');
			$this->load->view('v_footer');
		}
	}


	public function delete_laporan()
	{
		$params = $_REQUEST;
		$this->db->where('id', $params['id']);
		$this->db->delete('laporan');

		echo "<script>alert('Data Laporan berhasil dihapus'); location.href = '" . base_url() . "dashboard/daftar_laporan';</script>";
	}

	public function approval()
	{
		// if (in_array($_SESSION['role'], ['admin', 'manager'])) {
		//     $data['datasets'] = $this->db->query(
		//         'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
		//         FROM laporan
		//         JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
		//         JOIN jabatan ON jabatan.id = pegawai.jabatan_id
		//         JOIN divisi ON divisi.id = pegawai.divisi_id'
		//     )->result_array();
		// } else {
		//     $data['datasets'] = $this->db->query(
		//         'SELECT kegiatan.*, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip
		//         FROM laporan
		//         JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
		//         JOIN jabatan ON jabatan.id = pegawai.jabatan_id
		//         JOIN divisi ON divisi.id = pegawai.divisi_id
		//         WHERE kegiatan.id_pegawai = '.$_SESSION['id_pegawai']
		//     )->result_array();
		// }

		$from_date = $_REQUEST['from_date'] ? $_REQUEST['from_date'] : '';
		$to_date = $_REQUEST['to_date'] ? $_REQUEST['to_date'] : '';

		$this->db->where('atasan_id', $_SESSION['id_pegawai']);
		$ids_pegawai = $this->db->get('pegawai')->result_array();
		$ids_pegawai = array_column($ids_pegawai, 'id');
		$ids_pegawai = implode(',', $ids_pegawai);

		if ($from_date && $to_date) {
			$data['datasets'] = $this->db->query(
				'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip, pegawai.jabatan_detil
                FROM laporan
                JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
                JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id
                WHERE kegiatan.id_pegawai IN (' . $ids_pegawai . ')
                AND laporan.waktu >= "' . $from_date . '"
                AND laporan.waktu <= "' . $to_date . '"
                AND laporan.status_atasan = "Pending"
                ORDER BY laporan.id DESC'
			)->result_array();
		} else {
			$data['datasets'] = $this->db->query(
				'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target, jabatan.nama_jabatan as jabatan, divisi.nama_divisi as divisi, pegawai.nama_pegawai as pegawai, pegawai.nip_pegawai as nip, pegawai.jabatan_detil
                FROM laporan
                JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
                JOIN pegawai ON pegawai.id = kegiatan.id_pegawai
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                JOIN divisi ON divisi.id = pegawai.divisi_id
                WHERE kegiatan.id_pegawai IN (' . $ids_pegawai . ')
                AND laporan.status_atasan = "Pending"
                ORDER BY laporan.id DESC'
			)->result_array();
		}

		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

		$data['active'] = 'approval';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_approval');
		$this->load->view('v_footer');
	}

	public function tambah_approval()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$params = $this->input->post();

			if ((int) $params['id'] > 0) {
				$input = [
					'waktu' => $params['waktu'],
					'waktu_selesai' => $params['waktu_selesai'],
					'kegiatan_id' => $params['kegiatan_id'],
					'status' => $params['status'],
					'status_atasan' => $params['status_atasan'],
					'notes_atasan' => $params['notes_atasan'],
					'hasil_atasan' => $params['hasil_atasan'],
					'detil_kegiatan' => $params['detil_kegiatan'],
					'id_pegawai' => $params['id_pegawai'],
				];

				$this->db->where('id', $params['id']);
				$this->db->update('laporan', $input);
				$id_notif = $params['id'];
			}

			$this->db->where('id', $id_notif);
			$notif_check = $this->db->get('laporan')->row_array();

			if ($notif_check['notif_pegawai'] == '0' && $input['status_atasan'] != 'Pending') {
				$this->db->where('id', $notif_check['id_pegawai']);
				$pegawai_data = $this->db->get('pegawai')->row_array();

				$this->db->where('id', $pegawai_data['atasan_id']);
				$atasan_data = $this->db->get('pegawai')->row_array();

				$this->db->where('id', $params['kegiatan_id']);
				$kegiatan_data = $this->db->get('kegiatan')->row_array();

				$input_wa_arr = [
					"phoneNumber" => $pegawai_data['no_handphone'] . "@c.us",
					"opMessage" => "Dengan Hormat, " . $pegawai_data['nama_pegawai'] . "\n\nPekerjaan/kegiatan: " . $kegiatan_data['uraian'] . ". Telah diperbarui status approvalnya sebagai berikut:\n\nStatus Approval: " . $input['status_atasan'] . "\nKomentar: " . ($input['notes_atasan'] ? $input['notes_atasan'] : '-') . "\nHasil Pekerjaan/Kegiatan: " . ($input['hasil_atasan'] ? $input['hasil_atasan'] : '-') . "\n\nSilahkan klik link dibawah untuk lebih lanjut:\n" . base_url() . "dashboard/tambah_laporan?id=" . $id_notif,
				];

				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => 'http://localhost:3000/whatsapp',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => json_encode($input_wa_arr),
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$response = curl_exec($curl);
				curl_close($curl);
				if ($response == 'message triggered successfully') {
					$this->db->where('id', $id_notif);
					$this->db->update('laporan', [
						'notif_pegawai' => 1
					]);
				}
			}

			echo "<script>alert('Data Approval berhasil disimpan'); location.href = '" . base_url() . "dashboard/approval';</script>";
		} else {
			$params = $_REQUEST;
			$data['fetch'] = [];
			$id = $params['id'];
			if ((int) $id > 0) {
				$this->db->where('id', $id);
				$data['fetch'] = $this->db->get('laporan')->row_array();
			}

			$data['pegawai'] = $this->db->get('pegawai')->result_array();

			if (in_array($_SESSION['role'], ['admin', 'manager'])) {
				$data['kegiatan'] = $this->db->get('kegiatan')->result_array();
			} else {
				$this->db->where('id_pegawai', $_SESSION['id_pegawai']);
				$data['kegiatan'] = $this->db->get('kegiatan')->result_array();
			}

			$data['id'] = $id;
			$data['active'] = 'approval';
			$this->load->view('v_header', $data);
			$this->load->view('v_tambah_approval');
			$this->load->view('v_footer');
		}
	}

	public function laporan()
	{
		date_default_timezone_set("Asia/Jakarta");
		$from_date = $_REQUEST['from_date'] ? $_REQUEST['from_date'] : date('Y-m-01');
		$to_date = $_REQUEST['to_date'] ? $_REQUEST['to_date'] : date('Y-m-d', strtotime('+1 day'));
		$pegawai_sel = $_REQUEST['pegawai_sel'] ? $_REQUEST['pegawai_sel'] : "";
		$this->db->where('atasan_id', $_SESSION['id_pegawai']);
		$ids_pegawai = $this->db->get('pegawai')->result_array();
		$_ids_pegawai = array_column($ids_pegawai, 'id');
		$ids_pegawai = implode(',', $_ids_pegawai);

		$data['datasets'] = $this->db->query(
			'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target
            FROM laporan
            JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
            WHERE kegiatan.id_pegawai = "' . $pegawai_sel . '"
            AND laporan.waktu >= "' . $from_date . '"
            AND laporan.waktu <= "' . $to_date . '"
            AND status_atasan = "Approved"
            ORDER BY laporan.id DESC'
		)->result_array();

		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['pegawai_sel'] = $pegawai_sel;
		$data['pegawai_info'] = [];
		if ($pegawai_sel) {
			$data['pegawai_info'] = $this->db->query(
				'SELECT pegawai.*, laporan.laporan, divisi.nama_divisi as divisi, jabatan.nama_jabatan as jabatan
				FROM pegawai
				JOIN divisi ON divisi.id = pegawai.divisi_id
				JOIN jabatan ON jabatan.id = pegawai.jabatan_id
				JOIN laporan ON laporan.id_pegawai = pegawai.id
				WHERE pegawai.id = "' . $pegawai_sel . '"'
			)->row_array();
		}

		if ($_SESSION['role'] == 'manager') {
			$this->db->where_in('id', $_ids_pegawai);
			$data['pegawai'] = $this->db->get('pegawai')->result_array();
		} else {
			$data['pegawai'] = $this->db->get('pegawai')->result_array();
		}

		$data['active'] = 'laporan';
		$this->load->view('v_header', $data);
		$this->load->view('v_daftar_laporan_hari');
		$this->load->view('v_footer');
	}

	public function laporan_cetak()
	{
		date_default_timezone_set("Asia/Jakarta");
		$from_date = $_REQUEST['from_date'] ? $_REQUEST['from_date'] : date('Y-m-d');
		$to_date = $_REQUEST['to_date'] ? $_REQUEST['to_date'] : date('Y-m-d', strtotime('+1 day'));
		$pegawai_sel = $_REQUEST['pegawai_sel'] ? $_REQUEST['pegawai_sel'] : "";

		$this->db->where('atasan_id', $_SESSION['id_pegawai']);
		$ids_pegawai = $this->db->get('pegawai')->result_array();
		$_ids_pegawai = array_column($ids_pegawai, 'id');
		$ids_pegawai = implode(',', $_ids_pegawai);

		$data['datasets'] = $this->db->query(
			'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target
            FROM laporan
            JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
            WHERE kegiatan.id_pegawai = "' . $pegawai_sel . '"
            AND laporan.waktu >= "' . $from_date . '"
            AND laporan.waktu <= "' . $to_date . '"
            AND status_atasan = "Approved"
            ORDER BY laporan.waktu_selesai ASC'
		)->result_array();

		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['pegawai_sel'] = $pegawai_sel;
		$data['pegawai_info'] = [];
		$data['atasan_info'] = [];
		if ($pegawai_sel) {
			$data['pegawai_info'] = $this->db->query(
				'SELECT pegawai.*, divisi.nama_divisi as divisi, jabatan.nama_jabatan as jabatan
                FROM pegawai
                JOIN divisi ON divisi.id = pegawai.divisi_id
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                WHERE pegawai.id = "' . $pegawai_sel . '" '
			)->row_array();
			$data['atasan_info'] = $this->db->query(
				'SELECT pegawai.*, divisi.nama_divisi as divisi, jabatan.nama_jabatan as jabatan
                FROM pegawai
                JOIN divisi ON divisi.id = pegawai.divisi_id
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                WHERE pegawai.id = "' . $data['pegawai_info']['atasan_id'] . '" '
			)->row_array();
		}

		if ($_SESSION['role'] == 'manager') {
			$this->db->where_in('id', $_ids_pegawai);
			$data['pegawai'] = $this->db->get('pegawai')->result_array();
		} else {
			$data['pegawai'] = $this->db->get('pegawai')->result_array();
		}

		$month_str = '';
		$curr_month = date('m');
		if ($curr_month == '01') {
			$month_str = 'Januari';
		} elseif ($curr_month == '02') {
			$month_str = 'Februari';
		} elseif ($curr_month == '03') {
			$month_str = 'Maret';
		} elseif ($curr_month == '04') {
			$month_str = 'April';
		} elseif ($curr_month == '05') {
			$month_str = 'Mei';
		} elseif ($curr_month == '06') {
			$month_str = 'Juni';
		} elseif ($curr_month == '07') {
			$month_str = 'Juli';
		} elseif ($curr_month == '08') {
			$month_str = 'Agustus';
		} elseif ($curr_month == '09') {
			$month_str = 'September';
		} elseif ($curr_month == '10') {
			$month_str = 'Oktober';
		} elseif ($curr_month == '11') {
			$month_str = 'November';
		} elseif ($curr_month == '12') {
			$month_str = 'Desember';
		}

		$from_month = date('m', strtotime($from_date));
		$to_month = date('m', strtotime($to_date));
		$from_year = date('Y', strtotime($from_date));
		if ($from_month == $to_month) {
			$periode = $month_str . ' ' . $from_year;
		} else {
			$periode = $from_date . ' s/d ' . $to_date;
		}

		$data['periode'] = $periode;
		$data['month_str'] = $month_str;
		$data['active'] = 'laporan';
		// $this->load->view('v_header', $data);
		$this->load->view('v_laporan_cetak', $data);
		// $this->load->view('v_footer');
	}

	/*
    public function daftar_laporan_hari()
    {
        date_default_timezone_set("Asia/Jakarta");
        $from_date = $_REQUEST['from_date'] ? $_REQUEST['from_date'] : date('Y-m-d');
        $to_date = $_REQUEST['to_date'] ? $_REQUEST['to_date'] : date('Y-m-d', strtotime('+1 day'));
        $pegawai_sel = $_REQUEST['pegawai_sel'] ? $_REQUEST['pegawai_sel'] : "";

        $this->db->where('atasan_id', $_SESSION['id_pegawai']);
        $ids_pegawai = $this->db->get('pegawai')->result_array();            
        $_ids_pegawai = array_column($ids_pegawai, 'id');
        $ids_pegawai = implode(',', $_ids_pegawai);

        $data['datasets'] = $this->db->query(
            'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target
            FROM laporan
            JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
            WHERE kegiatan.id_pegawai = "'.$pegawai_sel.'"
            AND laporan.waktu >= "'.$from_date.'"
            AND laporan.waktu <= "'.$to_date.'"
            AND status_atasan = "Approved"
            ORDER BY laporan.id DESC'
        )->result_array(); 

        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['pegawai_sel'] = $pegawai_sel;
        $data['pegawai_info'] = [];
        if ($pegawai_sel) {
            $data['pegawai_info'] = $this->db->query(
                'SELECT pegawai.*, divisi.nama_divisi as divisi, jabatan.nama_jabatan as jabatan
                FROM pegawai
                JOIN divisi ON divisi.id = pegawai.divisi_id
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                WHERE pegawai.id = "'.$pegawai_sel.'" '
            )->row_array();
        }

        if ($_SESSION['role'] == 'manager') {
            $this->db->where_in('id', $_ids_pegawai);
            $data['pegawai'] = $this->db->get('pegawai')->result_array();

        } else {
            $data['pegawai'] = $this->db->get('pegawai')->result_array();
        }

        $data['active'] = 'laporan';
        $this->load->view('v_header', $data);
        $this->load->view('v_daftar_laporan_hari');
        $this->load->view('v_footer');
    }
    */

	/*
    public function daftar_laporan_bulan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $from_date = $_REQUEST['from_date'] ? $_REQUEST['from_date'] : date('Y-m-d');
        $to_date = $_REQUEST['to_date'] ? $_REQUEST['to_date'] : date('Y-m-d', strtotime('+1 day'));
        $pegawai_sel = $_REQUEST['pegawai_sel'] ? $_REQUEST['pegawai_sel'] : "";

        $this->db->where('atasan_id', $_SESSION['id_pegawai']);
        $ids_pegawai = $this->db->get('pegawai')->result_array();            
        $_ids_pegawai = array_column($ids_pegawai, 'id');
        $ids_pegawai = implode(',', $_ids_pegawai);

        $data['datasets'] = $this->db->query(
            'SELECT laporan.*, kegiatan.uraian, kegiatan.satuan, kegiatan.target
            FROM laporan
            JOIN kegiatan ON kegiatan.id = laporan.kegiatan_id
            WHERE kegiatan.id_pegawai = "'.$pegawai_sel.'"
            AND laporan.waktu >= "'.$from_date.'"
            AND laporan.waktu <= "'.$to_date.'"
            AND status_atasan = "Approved"
            ORDER BY laporan.id DESC
            GROUP BY kegiatan.uraian'
        )->result_array(); 

        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['pegawai_sel'] = $pegawai_sel;
        $data['pegawai_info'] = [];
        if ($pegawai_sel) {
            $data['pegawai_info'] = $this->db->query(
                'SELECT pegawai.*, divisi.nama_divisi as divisi, jabatan.nama_jabatan as jabatan
                FROM pegawai
                JOIN divisi ON divisi.id = pegawai.divisi_id
                JOIN jabatan ON jabatan.id = pegawai.jabatan_id
                WHERE pegawai.id = "'.$pegawai_sel.'" '
            )->row_array();
        }

        if ($_SESSION['role'] == 'manager') {
            $this->db->where_in('id', $_ids_pegawai);
            $data['pegawai'] = $this->db->get('pegawai')->result_array();

        } else {
            $data['pegawai'] = $this->db->get('pegawai')->result_array();
        }

        $data['active'] = 'laporan';
        $this->load->view('v_header', $data);
        $this->load->view('v_daftar_laporan_hari');
        $this->load->view('v_footer');
    }
    */
	#endregion

	public function import()
	{
		$upload_success = false;
		$file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
		if ($file_ext == "csv") {
			$upload_success = true;
		}
		if ($upload_success) {
			$file = fopen($_FILES['file']['tmp_name'], "r");
			$excel_data = explode("\r", reset(fgetcsv($file)));
			// var_dump($excel_data);
			// exit;
			while (($arr = fgetcsv($file)) !== false) {
				if ($arr[2] == 'positif') {
					$label = '1';
				} elseif ($arr[2] == 'negatif') {
					$label = '0';
				} else {
					$label = '2';
				}
				$this->db->insert('datasets', [
					'text' => $arr[1],
					'label' => $label,
					'pre_processing_text' => '',
					'predicted_label' => 0
				]);
			}
			echo "<script>alert('Dataset berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_dataset';</script>";
		} else {
			echo "<script>alert('Dataset gagal disimpan, pastikan format import .csv dan data sudah terisi semua'); location.href = '" . base_url() . "dashboard/daftar_dataset';</script>";
		}
	}

	public function import2()
	{
		$upload_success = false;
		$file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
		if ($file_ext == "csv") {
			$upload_success = true;
		}
		if ($upload_success) {
			$file = fopen($_FILES['file']['tmp_name'], "r");
			$excel_data = explode("\r", reset(fgetcsv($file)));
			// var_dump($excel_data);
			// exit;
			while (($arr = fgetcsv($file)) !== false) {
				if ($arr[2] == 'positif') {
					$label = '1';
				} elseif ($arr[2] == 'negatif') {
					$label = '0';
				} else {
					$label = '2';
				}
				$this->db->insert('datalatih', [
					'text' => $arr[1],
					'label' => $label,
					'pre_processing_text' => '',
					'predicted_label' => 0
				]);
			}
			echo "<script>alert('Data Latih berhasil disimpan'); location.href = '" . base_url() . "dashboard/daftar_datalatih';</script>";
		} else {
			echo "<script>alert('Data Latih gagal disimpan, pastikan format import .csv dan data sudah terisi semua'); location.href = '" . base_url() . "dashboard/daftar_datalatih';</script>";
		}
	}

	public function data_admin()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$foto = '';
			if ($_FILES['foto']['name']) {
				$upload_dir = './assets/upload/avatar/';

				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0755, true);
				}

				$temp_file = $_FILES['foto']['tmp_name'];
				$original_file = $_FILES['foto']['name'];

				$unique_filename = uniqid() . '_' . $original_file;
				if (move_uploaded_file($temp_file, $upload_dir . $unique_filename)) {
					// echo "File uploaded successfully!";
				} else {
					// echo "Error uploading file.";
				}
			} else {
				// echo "No file uploaded or an error occurred.";
			}

			$params = $this->input->post();
			if ($unique_filename) {
				$this->db->where('id', $_SESSION['id']);
				$this->db->update('users', [
					'email' => $params['email'],
					'username' => $params['username'],
					'password' => md5($params['password']),
					'foto' => base_url() . 'assets/upload/avatar/' . $unique_filename
				]);
				$_SESSION['email'] = $params['email'];
				$_SESSION['username'] = $params['username'];
				$_SESSION['password'] = $params['password'];
				$_SESSION['foto'] = base_url() . 'assets/upload/avatar/' . $unique_filename;
			} else {
				$this->db->where('id', $_SESSION['id']);
				$this->db->update('users', [
					'email' => $params['email'],
					'username' => $params['username'],
					'password' => md5($params['password']),
				]);
				$_SESSION['email'] = $params['email'];
				$_SESSION['username'] = $params['username'];
				$_SESSION['password'] = $params['password'];
			}

			echo "<script>alert('Data berhasil disimpan'); location.href = '" . base_url() . "dashboard/data_admin';</script>";
		} else {
			$data['active'] = 'data_admin';
			$this->load->view('v_header', $data);
			$this->load->view('v_data_admin');
			$this->load->view('v_footer');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login', 'refresh');
	}
}
