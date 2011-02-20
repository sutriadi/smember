<?php
/**
 *
 * Member Card Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: ./conf/card.conf.php
 * @desc: member card configuration
 *
 */

$cardconf['idcard_member'] = array(
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
	'tanggal_stempel' => date("d-m-Y"),

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

/**
field yang akan ditampilkan tambahkan sesuai keinginan
cara menambahkan cukup dengan mengeluarkan tanda komentar '//' pada baris yang ingin diaktifkan
cara mengurangi cukup dengan memberikan tanda komentar '//' pada baris yang ingin dinonaktifkan

NT. jangan lupa sesuaikan dengan layout yang disediakan oleh file css
*/

$cardconf['idcard_member']['fields'][] = 'member_id'; // ID member
$cardconf['idcard_member']['fields'][] = 'member_name'; // Nama member
//~ $cardconf['idcard_member']['fields'][] = 'gender'; // Jenis kelamin
$cardconf['idcard_member']['fields'][] = 'member_type_id'; // Jenis anggota member
$cardconf['idcard_member']['fields'][] = 'member_address'; // Alamat member
//~ $cardconf['idcard_member']['fields'][] = 'member_email'; // Alamat e-mail member
//~ $cardconf['idcard_member']['fields'][] = 'member_phone'; // No telepon member
$cardconf['idcard_member']['fields'][] = 'inst_name'; // Institusi / Jabatan member
$cardconf['idcard_member']['fields'][] = 'register_date'; // Tanggal pendaftaran
$cardconf['idcard_member']['fields'][] = 'expire_date'; // Tanggal kadaluarsa

//~ Isi bagian belakang kartu ganda
$cardconf['idcard_member']['isiganda'] = "<p><strong>Peraturan Perpustakaan</strong></p>"
	."<ul>"
		."<li>Dilarang masuk dalam perpustakaan menggunakan kaos oblong dan sandal</li>"
		."<li>Dilarang masuk membawa tas dan sejenisnya</li>"
		."<li>Setiap pengunjung diharuskan mengisi buku kunjungan</li>"
		."<li>Dilarang mengacak-acak isi lemari/rak koleksi</li>"
		."<li>Koleksi yang terlambat dikembalikan, rusak atau hilang dikenakan denda</li>"
		."<li>Perpanjangan peminjaman koleksi harus dengan bukti-bukti yang sah</li>"
	."</ul>";
