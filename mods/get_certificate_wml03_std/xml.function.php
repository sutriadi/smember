<?php
/**
 *
 * Download Certificate (XML Word 2003) Module for SMember Plugin SLiMS
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

	function dxcontent($confs, $result)
	{
		extract($confs);
		$surat_nip = '';
		$underline = '';
		if ( ! empty($surat_nip_pejabat))
		{
			$underline = '<w:u w:val="single"/>';
			$surat_nip = $surat_nip_prefix . $surat_nip_pejabat;
		}
		$dxcontent = "<w:p/>"
				."<w:p>"
					."<w:pPr>"
						."<w:jc w:val=\"center\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:b/>"
							."<w:b-cs/>"
							."<w:u w:val=\"single\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:b/>"
							."<w:b-cs/>"
							."<w:u w:val=\"single\"/>"
						."</w:rPr>"
						."<w:t>$surat_judul</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:jc w:val=\"center\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
						."</w:rPr>"
						."<w:t>$surat_nomor_label "
						.dxnumber($surat_nomor_kode, $surat_nomor_kode_sep, $surat_nomor_kode_romawi)
						."</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:jc w:val=\"both\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
						."</w:rPr>"
						."<w:t>$surat_kalimat_awal</w:t>"
					."</w:r>"
				."</w:p>";
		foreach ($field_show as $q => $v)
			$dxcontent .= dxlist($q, $result[$v], $confs);
		//~ $dxcontent .= dxlist("Test", dxcustom($result[$field_look_string], $confs), $confs);
		if ($use_string_custom === true)
			$dxcontent .= dxcustom($result[$field_look_string], $confs);
		$dxcontent .= "<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:jc w:val=\"both\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:jc w:val=\"both\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
						."<w:t>$surat_kalimat_tengah </w:t>"
					."</w:r>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:b/>"
							."<w:b-cs/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
						."<w:t>$surat_nama_perpustakaan</w:t>"
					."</w:r>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
						."<w:t>.</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:jc w:val=\"both\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:jc w:val=\"both\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"PL\"/>"
						."</w:rPr>"
						."<w:t>$surat_kalimat_tengah2 $surat_kalimat_keperluan.</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:jc w:val=\"both\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
						."<w:t>$surat_kalimat_akhir.</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
						."<w:t>$surat_lokasi,     "
						.bulan(date('m')) . ' ' . date('Y')
						."</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
						."<w:t>$surat_kata_mengetahui</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
						."<w:t>$surat_posisi_pejabat</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
							.$underline
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
							.$underline
						."</w:rPr>"
						."<w:t>$surat_nama_pejabat</w:t>"
					."</w:r>"
				."</w:p>"
				."<w:p>"
					."<w:pPr>"
						."<w:ind w:left=\"4320\"/>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
					."</w:pPr>"
					."<w:r>"
						."<w:rPr>"
							."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
							."<wx:font wx:val=\"Arial\"/>"
							."<w:lang w:val=\"FI\"/>"
						."</w:rPr>"
						."<w:t>"
							.$surat_nip
						."</w:t>"
					."</w:r>"
				."</w:p>";
		return $dxcontent;
	}

	function dxbreak($type)
	{
		$break = "<w:p>"
				."<w:r>"
					."<w:rPr><w:lang w:val=\"FI\"/></w:rPr>"
					."<w:br w:type=\"$type\"/>"
				."</w:r>"
			."</w:p>";
		return $break;
	}

	function dxsection($confs)
	{
		extract($confs);
		$section = "<w:p/>"
			."<w:sectPr>"
				."<w:hdr w:type=\"even\">"
					."<wx:pBdrGroup>"
						."<wx:apo><wx:jc wx:val=\"center\"/></wx:apo>"
						."<w:p>"
							."<w:pPr>"
								."<w:pStyle w:val=\"Header\"/>"
								."<w:framePr w:wrap=\"around\" w:vanchor=\"text\" w:hanchor=\"margin\" w:x-align=\"center\" w:y=\"1\"/>"
								."<w:rPr><w:rStyle w:val=\"PageNumber\"/></w:rPr>"
							."</w:pPr>"
							."<w:r>"
								."<w:rPr><w:rStyle w:val=\"PageNumber\"/></w:rPr>"
								."<w:fldChar w:fldCharType=\"begin\"/>"
							."</w:r>"
							."<w:r>"
								."<w:rPr><w:rStyle w:val=\"PageNumber\"/></w:rPr>"
								."<w:instrText>PAGE  </w:instrText>"
							."</w:r>"
							."<w:r>"
								."<w:rPr><w:rStyle w:val=\"PageNumber\"/></w:rPr>"
								."<w:fldChar w:fldCharType=\"end\"/>"
							."</w:r>"
						."</w:p>"
					."</wx:pBdrGroup>"
					."<w:p>"
						."<w:pPr><w:pStyle w:val=\"Header\"/></w:pPr>"
					."</w:p>"
				."</w:hdr>"
				."<w:hdr w:type=\"odd\">"
					."<w:p>"
						."<w:pPr>"
							."<w:pStyle w:val=\"Header\"/>"
							."<w:tabs>"
								."<w:tab w:val=\"clear\" w:pos=\"4320\"/>"
								."<w:tab w:val=\"clear\" w:pos=\"8640\"/>"
							."</w:tabs>"
							."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
							."<w:jc w:val=\"center\"/>"
							."<w:rPr>"
								."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
								."<wx:font wx:val=\"Arial\"/>"
								."<w:b/>"
								."<w:b-cs/>"
								."<w:sz w:val=\"48\"/>"
								."<w:sz-cs w:val=\"48\"/>"
								."<w:lang w:val=\"ES-TRAD\"/>"
							."</w:rPr>"
						."</w:pPr>"
						."<w:r>"
							."<w:rPr><w:noProof/></w:rPr>"
							."<w:pict>"
								."<v:shapetype id=\"_x0000_t75\" coordsize=\"21600,21600\" o:spt=\"75\" o:preferrelative=\"t\" path=\"m@4@5l@4@11@9@11@9@5xe\" filled=\"f\" stroked=\"f\">"
									."<v:stroke joinstyle=\"miter\"/>"
									."<v:formulas>"
										."<v:f eqn=\"if lineDrawn pixelLineWidth 0\"/>"
										."<v:f eqn=\"sum @0 1 0\"/>"
										."<v:f eqn=\"sum 0 0 @1\"/>"
										."<v:f eqn=\"prod @2 1 2\"/>"
										."<v:f eqn=\"prod @3 21600 pixelWidth\"/>"
										."<v:f eqn=\"prod @3 21600 pixelHeight\"/>"
										."<v:f eqn=\"sum @0 0 1\"/>"
										."<v:f eqn=\"prod @6 1 2\"/>"
										."<v:f eqn=\"prod @7 21600 pixelWidth\"/>"
										."<v:f eqn=\"sum @8 21600 0\"/>"
										."<v:f eqn=\"prod @7 21600 pixelHeight\"/>"
										."<v:f eqn=\"sum @10 21600 0\"/>"
									."</v:formulas>"
									."<v:path o:extrusionok=\"f\" gradientshapeok=\"t\" o:connecttype=\"rect\"/>"
									."<o:lock v:ext=\"edit\" aspectratio=\"t\"/>"
								."</v:shapetype>"
								."<w:binData w:name=\"wordml://$surat_logo_perpustakaan\">"
								//~ ."<w:binData>"
								.encpicture($surat_logo_perpustakaan)
								."</w:binData>"
								."<v:shape id=\"_x0000_s2049\" type=\"#_x0000_t75\" style=\"position:absolute;left:0;text-align:left;margin-left:-12.75pt;margin-top:-8.7pt;width:63pt;height:62.55pt;z-index:-1\" o:allowoverlap=\"f\">"
									."<v:imagedata src=\"wordml://$surat_logo_perpustakaan\" o:title=\"$surat_logo_perpustakaan\"/>"
									."<w10:wrap type=\"square\"/>"
								."</v:shape>"
							."</w:pict>"
						."</w:r>"
						."<w:r>"
							."<w:rPr>"
								."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
								."<wx:font wx:val=\"Arial\"/>"
								."<w:b/>"
								."<w:b-cs/>"
								."<w:sz w:val=\"48\"/>"
								."<w:sz-cs w:val=\"48\"/>"
							."</w:rPr>"
							."<w:t>$surat_nama_perpustakaan</w:t>"
						."</w:r>"
					."</w:p>"
					."<wx:pBdrGroup>"
						."<wx:borders><wx:bottom wx:val=\"double\" wx:bdrwidth=\"45\" wx:space=\"1\" wx:color=\"auto\"/></wx:borders>"
						."<w:p>"
							."<w:pPr>"
								."<w:pStyle w:val=\"Header\"/>"
								."<w:pBdr><w:bottom w:val=\"double\" w:sz=\"6\" wx:bdrwidth=\"45\" w:space=\"1\" w:color=\"auto\"/></w:pBdr>"
								."<w:tabs>"
									."<w:tab w:val=\"clear\" w:pos=\"4320\"/>"
									."<w:tab w:val=\"clear\" w:pos=\"8640\"/>"
								."</w:tabs>"
								."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
								."<w:jc w:val=\"center\"/>"
								."<w:rPr>"
									."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
									."<wx:font wx:val=\"Arial\"/>"
									."<w:i/>"
									."<w:i-cs/>"
									."<w:sz w:val=\"20\"/>"
									."<w:sz-cs w:val=\"20\"/>"
									."<w:lang w:val=\"ES-TRAD\"/>"
								."</w:rPr>"
							."</w:pPr>"
							."<w:r>"
							."<w:rPr>"
								."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
								."<wx:font wx:val=\"Arial\"/>"
								."<w:i/>"
								."<w:i-cs/>"
								."<w:sz w:val=\"20\"/>"
								."<w:sz-cs w:val=\"20\"/>"
								."<w:lang w:val=\"ES-TRAD\"/>"
							."</w:rPr>"
							."<w:t>$surat_alamat_perpustakaan</w:t>"
							."</w:r>"
						."</w:p>"
					."</wx:pBdrGroup>"
				."</w:hdr>"
				."<w:pgSz w:w=\"11907\" w:h=\"16840\" w:code=\"9\"/>"
				."<w:pgMar w:top=\"2336\" w:right=\"927\" w:bottom=\"1701\" w:left=\"1701\" w:header=\"1079\" w:footer=\"720\" w:gutter=\"0\"/>"
				."<w:cols w:space=\"720\"/>"
				."<w:docGrid w:line-pitch=\"360\"/>"
			."</w:sectPr>";
		return $section;
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
		$dxlist = "<w:p>"
				."<w:pPr>"
					."<w:tabs><w:tab w:val=\"left\" w:pos=\"3520\"/></w:tabs>"
					."<w:spacing w:line=\"360\" w:line-rule=\"auto\"/>"
					."<w:ind w:left=\"720\"/>"
					."<w:jc w:val=\"both\"/>"
					."<w:rPr>"
						."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
						."<wx:font wx:val=\"Arial\"/>"
						."<w:lang w:val=\"PL\"/>"
					."</w:rPr>"
				."</w:pPr>"
				."<w:r>"
					."<w:rPr>"
						."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
						."<wx:font wx:val=\"Arial\"/>"
						."<w:lang w:val=\"PL\"/>"
					."</w:rPr>"
					."<w:t>$q</w:t>"
				."</w:r>"
				."<w:r>"
					."<w:rPr>"
						."<w:rFonts w:ascii=\"Arial\" w:h-ansi=\"Arial\" w:cs=\"Arial\"/>"
						."<wx:font wx:val=\"Arial\"/>"
						."<w:lang w:val=\"PL\"/>"
					."</w:rPr>"
					."<w:tab wx:wTab=\"1170\" wx:tlc=\"none\" wx:cTlc=\"19\"/>"
					."<w:t>: $v</w:t>"
				."</w:r>"
			."</w:p>";
		return $dxlist;
	}
 