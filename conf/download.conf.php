<?php
/**
 *
 * Download Letter Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: ./conf/download.conf.php
 * @desc: xml and csv configuration
 *
 */

$letterconf['letter_member'] = array(
	'surat_nama_perpustakaan' => 'Nama Perpustakaan',
	'surat_judul' => 'Keterangan Bebas Pinjam Perpustakaan',
	'surat_nomor_label' => 'Nomor:',
	'surat_nomor_kode' => array(
		'nomor' => null, // bila kosong, tuliskan dengan null atau ''
		'hal' => 'BP', // Contoh: BP = Bebas Pinjam
		'institusi' => 'NP', // Contoh: NP = Nama Perpustakaan
		'bulan' => date('m'), // untuk bulan gunakan date('m')
		'tahun' => date('Y'), // untuk tahun gunakan date('Y')
		//~ contoh hasil (diurutkan dari atas) : .../BP/NP/X/2010
	),
	'surat_nomor_kode_sep' => '/',
	'surat_nomor_kode_romawi' => array('bulan'), // bila kosong tuliskan: berikan nilai null
	'surat_logo_perpustakaan' => 'penguin.png',
	'surat_alamat_perpustakaan' => 'Jl. Kutub Utara-Selatan, No. 01, Kel. Iglo, Kab. Kutub, Prop. Es',
	
	'surat_kalimat_awal' => 'Kami yang bertanda tangan di bawah ini menerangkan bahwa:',
	'surat_kalimat_tengah' => 'Menurut pemeriksaan dan catatan kami, yang bersangkutan sudah tidak mempunyai tanggungan atau pinjaman di',
	'surat_kalimat_tengah2' => 'Adapun surat keterangan ini dipergunakan untuk',
	'surat_kalimat_keperluan' => 'Pengurusan Surat Bebas',
	'surat_kalimat_akhir' => 'Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya',
	
	'surat_lokasi' => 'Kotamobagu',
	'surat_kata_mengetahui' => 'Mengetahui,',
	'surat_posisi_pejabat' => 'Kepala Perpustakaan',
	'surat_nama_pejabat' => 'Ilsin Nurkomalasari',
	'surat_nip_pejabat' => '198712242911912001',
	'surat_nip_prefix' => 'NIP. ',

	//~ 'surat_format_xml' => 1, // 0 = flat xml odt (fodt); 1 = ms word 2003 xml (wml); 2 = odt

	'field_look_string' => 'member_notes',
	'string_begin' => '##begin##',
	'string_sep' => ';',
	'field_show' => array(
		'Nama' => 'member_name',
		'Institusi' => 'inst_name',
		'Jenis Anggota' => 'member_type_name',
	),
	'use_string_custom' => true,
	'string_custom_label' => '--',
	'string_custom_value' => ':',
	/**
	contoh format pengisian:
		##begin##--NIM:421402001;--Program Studi/Jurusan:Fisika/Fisika;--Fakultas:MIPA;--Perguruan Tinggi:Universitas Negeri Kutub Utara
	**/

	//~ untuk administrasi dgn file csv
	'csv_file' => 'csvfile',
	'csv_max_filesize' => 81920000,
	'csv_sep' => ',',
	'csv_member_id_title' => 'Id',
	'csv_field' => array(
		'Nama' => 'member_name',
		'Institusi' => 'inst_name',
		'Jenis Anggota' => 'member_type_name',
	),
	'csv_custom' => array(
		'Program Studi', 'Jurusan', 'Fakultas', 'Perguruan Tinggi'
	),
	'csv_ordered' => true,
);
