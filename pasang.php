<?php
/*
 *      pasang.php
 *      
 *      Copyright 2011 Indra Sutriadi Pipii <indra@sutriadi.web.id>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

if (!defined('MODULES_WEB_ROOT_DIR')) {
	exit();
}

/*
konfigurasi tampilan kartu member
*/
$cardconf = array(
	'encbar' => '128', // encoding barcode
	'lebar' => 8.8, // lebar kartu dalam cm
	'tinggi' => 5.5, // tinggi kartu dalam cm
	'gaya' => 'default', // stylesheet yang akan digunakan kartu
	'pasfoto_lebar' => 2, // lebar pasfoto
	'pasfoto_tinggi' => 2.5, // tinggi pasfoto
	'perhal' => 2, // jumlah kartu per halaman saat cetak
	'ganda' => true, // tampilan bolak-balik? true = ya, false = tidak

	//~ nama file logo yang akan digunakan
	//~ di direktori ./images/logos/
	//~ ukuran normal 32 x 32 pixel
	'path_logo' => 'home.png',

	//~ kop kartu
	'nama_perpustakaan' => 'Perpustakaan si Tux', // nama perpustakaan
	'alamat_perpustakaan' => 'Jl. Kutub Utara-Selatan', // alamat perpustakaan
	
	//~ stempel pengesahan kartu
	'lokasi_stempel' => 'Ujung Pandang', // lokasi
	'pejabat_stempel' => 'Ilsin Nurkomalasari', // nama pejabat berwenang
	'nip_prefix_stempel' => 'NIP. ', // kata awal untuk mengawali angka nip
	'nip_pejabat_stempel' => '198712242911912001', // bila tidak menggunakan nip, biarkan kosong atau berikan nilai false atau null
	'jabatan_stempel' => 'Kepala Perpustakaan', // jabatan yang berwenang
	'gambar_stempel' => true, // menampilkan gambar stempel/tanda tangan? true = ya, false = tidak
	'path_stempel' => 'ttd.png',
	'tanggal_stempel' => "d-m-Y",
	'tanggal_fungsi' => "dynamic",

	'fields' => array(), // don't touch this!
	
	//~ untuk bagian depan
	//~ komponen relatif
	//~ mengaktif/nonaktif-kan kemungkinan harus mengubah komposisi di file css
	'stempel' => true, // menampilkan kotak stempel pengesahan? true = ya, false = tidak
	'kop' => true, // menampilkan kop perpustakaan? true = ya, false = tidak
	'logo' => true, // menampilkan logo? true = ya, false = tidak
	'pasfoto' => true, // menampilkan pasfoto? true = ya, false = tidak

	//~ komponen mutlak
	//~ tidak mempengaruhi tampilan bila diaktif/non-aktifkan
	'kodebar' => true, // menampilkan kodebar? true = ya, false = tidak
	
	//~ untuk bagian belakang
	//~ hanya bila opsi 'ganda' di bagian atas bernilai true
	//~ semuanya komponen relatif
	'logo_ganda' => true, // menampilkan logo? true = ya, false = tidak
	'stempel_ganda' => true, // menampilkan kotak stempel pengesahan? true = ya, false = tidak
	'kop_ganda' => true, // menampilkan kop? true = ya, false = tidak
	
	//~ pengaturan barcode tambahan
	'bar_rotate' => 0, // perputaraan searah jarum jam
);

$cardconf['fields'][] = 'member_id'; // ID member
$cardconf['fields'][] = 'member_name'; // Nama member
//~ $cardconf['idcard_member']['fields'][] = 'gender'; // Jenis kelamin
$cardconf['fields'][] = 'member_type_id'; // Jenis anggota member
$cardconf['fields'][] = 'member_address'; // Alamat member
//~ $cardconf['idcard_member']['fields'][] = 'member_email'; // Alamat e-mail member
//~ $cardconf['idcard_member']['fields'][] = 'member_phone'; // No telepon member
$cardconf['fields'][] = 'inst_name'; // Institusi / Jabatan member
$cardconf['fields'][] = 'register_date'; // Tanggal pendaftaran
$cardconf['fields'][] = 'expire_date'; // Tanggal kadaluarsa

//~ Isi bagian belakang kartu ganda
$cardconf['isiganda'] = "<p><strong>Peraturan Perpustakaan</strong></p>"
	."<ul>"
		."<li>Dilarang masuk dalam perpustakaan menggunakan kaos oblong dan sandal</li>"
		."<li>Dilarang masuk membawa tas dan sejenisnya</li>"
		."<li>Setiap pengunjung diharuskan mengisi buku kunjungan</li>"
		."<li>Dilarang mengacak-acak isi lemari/rak koleksi</li>"
		."<li>Koleksi yang terlambat dikembalikan, rusak atau hilang dikenakan denda</li>"
		."<li>Perpanjangan peminjaman koleksi harus dengan bukti-bukti yang sah</li>"
	."</ul>";

variable_set('smember_defstyle', 'sunny');
variable_set('smember_card_conf', json_encode($cardconf, JSON_FORCE_OBJECT));
