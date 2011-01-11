<?php
/**
 *
 * Download Certificate (FODT) Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: xml.function.php
 * @desc: download certificate function
 *
 */

	function encpicture($file)
	{
		$file = "../../images/logos/$file";
		if (file_exists($file))
		{
			$contents = file_get_contents($file);
			$encoded = trim(base64_encode($contents));
		} else $encoded = '';
		return $encoded;
	}

	function bulan($m)
	{
		switch ($m)
		{
			case 1: $b = 'Januari'; break;
			case 2: $b = 'Pebruari'; break;
			case 3: $b = 'Maret'; break;
			case 4: $b = 'April'; break;
			case 5: $b = 'Mei'; break;
			case 6: $b = 'Juni'; break;
			case 7: $b = 'Juli'; break;
			case 8: $b = 'Agustus'; break;
			case 9: $b = 'September'; break;
			case 10: $b = 'Oktober'; break;
			case 11: $b = 'Nopember'; break;
			default: $b = 'Desember';
		}
		return $b;
	}

	function romanNumerals($num) 
	{
		/**
		 *
		 * @create a roman numeral from a number
		 *
		 * @param int $num
		 *
		 * @return string
		 *
		 */
		$n = intval($num);
		$res = '';
		
		/*** roman_numerals array  ***/
		$roman_numerals = array(
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1
		);
	 
		foreach ($roman_numerals as $roman => $number) 
		{
			/*** divide to get  matches ***/
			$matches = intval($n / $number);
	 
			/*** assign the roman char * $matches ***/
			$res .= str_repeat($roman, $matches);
	 
			/*** substract from the number ***/
			$n = $n % $number;
		}
	 
		/*** return the res ***/
		return $res;
    }

	function dxnumber($nokode, $nokodesep, $nokoderoma)
	{
		$pre_nomor = array();
		foreach ($nokode as $kode => $nilai)
		{
			$nilai = trim($nilai);
			if (count($nokoderoma) > 0 && in_array($kode, $nokoderoma))
				$pre_nomor[] = romanNumerals((int) $nilai);
			else if ($nilai == null || empty($nilai))
				$pre_nomor[] = '     ';
			else
				$pre_nomor[] = $nilai;
		}
		$post_nomor = implode($nokodesep, $pre_nomor);
		return $post_nomor;
	}

	function dxbreak()
	{
		$break = "<text:p text:style-name=\"P17\"/>";
		return $break;
	}

	function dxcustom($string, $confs)
	{
		extract($confs);
		$string = trim($string);
		$dxcustom = '';
		if ( ! empty($string))
		{
			if (preg_match('/^'.$string_begin.'+./', $string))
			{
				list($none, $toproc) = explode($string_begin, $string);
				$fields = explode($string_sep, $toproc);
				foreach ($fields as $field)
				{
					preg_match('/'.$string_custom_label.'(?<q>.+)'.$string_custom_value.'(?<v>.+)'.'/', $field, $values);
					if ($values['q'] && $values['v'])
						$dxcustom .= dxlist($values['q'], $values['v'], $confs);
				}
			}
		}
		return $dxcustom;
	}

	function dxlist($q, $v, $confs)
	{
		$dxlist = "<text:p text:style-name=\"P13\">$q<text:tab/>: $v</text:p>";
		return $dxlist;
	}
 
	function dxcontent($confs, $result)
	{
		extract($confs);
		$surat_nip = '';
		if ( ! empty($surat_nip_pejabat))
			$surat_nip = $surat_nip_prefix . $surat_nip_pejabat;
		
		$dxcontent = "<text:p text:style-name=\"Standard\"/>"
			."<text:p text:style-name=\"P5\">$surat_judul</text:p>"
			."<text:p text:style-name=\"P6\">$surat_nomor_label "
				."<text:s text:c=\"5\"/>"
				.dxnumber($surat_nomor_kode, $surat_nomor_kode_sep, $surat_nomor_kode_romawi)
			."</text:p>"
			."<text:p text:style-name=\"P7\"/>"
			."<text:p text:style-name=\"P8\">$surat_kalimat_awal</text:p>";
		foreach ($field_show as $q => $v)
			$dxcontent .= dxlist($q, $result[$v], $confs);
		if ($use_string_custom === true)
			$dxcontent .= dxcustom($result[$field_look_string], $confs);
		$dxcontent .= "<text:p text:style-name=\"P9\"/>"
			."<text:p text:style-name=\"P12\">"
				."<text:span text:style-name=\"T2\">$surat_kalimat_tengah </text:span>"
				."<text:span text:style-name=\"T3\">".$surat_nama_perpustakaan."</text:span>"
				."<text:span text:style-name=\"T2\">.</text:span>"
			."</text:p>"
			."<text:p text:style-name=\"P9\"/>"
			."<text:p text:style-name=\"P9\">$surat_kalimat_tengah2 $surat_kalimat_keperluan.</text:p>"
			."<text:p text:style-name=\"P11\">$surat_kalimat_akhir.</text:p>"
			."<text:p text:style-name=\"P10\"/>"
			."<text:p text:style-name=\"P14\">$surat_lokasi, <text:s text:c=\"4\"/>"
				.bulan(date('m')) . ' ' . date('Y')
			."</text:p>"
			."<text:p text:style-name=\"P14\"/>"
			."<text:p text:style-name=\"P14\">$surat_kata_mengetahui</text:p>"
			."<text:p text:style-name=\"P14\">$surat_posisi_pejabat</text:p>"
			."<text:p text:style-name=\"P14\"/>"
			."<text:p text:style-name=\"P14\"/>"
			."<text:p text:style-name=\"P14\"/>"
			."<text:p text:style-name=\"P15\">$surat_nama_pejabat</text:p>"
			."<text:p text:style-name=\"P14\">$surat_nip</text:p>"
			."<text:p text:style-name=\"Standard\"/>";
		return $dxcontent;
	}
