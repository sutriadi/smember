<?php
/**
 *
 * Join CSV Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: index.php
 * @desc: csv uploader page
 *
 */

$level = '../../../../../../';
require $level . 'sysconfig.inc.php';

require SENAYAN_BASE_DIR.'admin/default/session.inc.php';
require SENAYAN_BASE_DIR.'admin/default/session_check.inc.php';

$can_read = utility::havePrivilege('membership', 'r');
$can_write = utility::havePrivilege('membership', 'w');

if ( ! $can_read && ! $can_write)
	die('<div class="errorBox">You dont have enough privileges to view this section</div>');

require('../../../conf.php');
require('../../../func.php');

checkip($conf);
checken();
checkref();

require '../../conf/download.conf.php';
require './csv.func.php';

$confs = $letterconf['letter_member'];
extract($confs);

echo "<html>"
	."<head>"
		."<title>Upload Form</title>"
		."<style type=\"text/css\">* { font-family: verdana, tahoma, sans; font-size: 8pt; }</style>"
		."<link href=\"../../css/ui-themes/default/jquery-ui-1.7.2.custom.css\" rel=\"stylesheet\" type=\"text/css\" />"
		."<style type=\"text/css\">"
			.".ui-button { "
				."outline: 0; margin:0; padding: .4em 1em .5em; "
				."text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; "
			."}"
		."</style>"
	."</head>"
	."<body>";
if ( ! $_FILES)
{
	echo "<fieldset class=\"ui-widget\"><legend>Upload Form</legend>"
			."<form enctype=\"multipart/form-data\" action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\">"
				."<p>"
					."<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$csv_max_filesize\" />"
					."Process this file: <input name=\"$csv_file\" class=\"ui-button ui-state-default ui-corner-all\" type=\"file\" />"
				."</p>"
				."<p>"
					."<input type=\"submit\" class=\"ui-button ui-state-default ui-corner-all\" value=\"Process File &#187;\" /> "
					."<input type=\"button\" class=\"ui-button ui-state-default ui-corner-all\" value=\"Close &#215;\" onclick=\"window.close();\" /> "
				."</p>"
			."</form>"
		."</fieldset>";
}
else if ($_FILES[$csv_file]['error'] != 0 || ! in_array($_FILES[$csv_file]['type'], array('text/csv', 'text/plain')))
{
	switch ($_FILES[$csv_file]['error'])
	{
		case 1: $msg = "File melewati batas ukuran upload_max_filesize pada berkas <em>php.ini</em>."
			." Ukuran yang dibolehkan: ". ini_get("upload_max_filesize"); break;
		case 2: $msg = "Ukuran file melewati kapasitas yang dibolehkan oleh formulir: $csv_max_filesize bytes."; break;
		case 3: $msg = "File hanya berhasil diupload sebagian."; break;
		case 4: $msg = "Tidak ada file yang diupload."; break;
		case 6: $msg = "Tidak ada direktori temporary untuk upload."; break;
		case 7: $msg = "Gagal menulis file temporary."; break;
		case 8: $msg = "Proses upload dihentikan oleh program lain."; break;
		default: $msg = "Berkas tidak valid, bukan jenis CSV atau kesalahan lain.";
	}
	echo "<p>Tidak dapat memproses berkas kiriman. Terdapat kesalahan:<br />$msg</p>"
		."<p><input type=\"button\" class=\"ui-button ui-state-default ui-corner-all\" value=\"&#171; Back\" onclick=\"history.back(1)\" /></p>";
}
else
{
	$file = $_FILES[$csv_file]['tmp_name'];
	$lines = file($file);
	$numlines = count($lines) - 1;
	$number = 0;
	$col_head = array();
	$col_cont = array();
	$col_cont_custom = array();
	$mtype_id_cache = array();
	$sqls = array();
	$failed = 0;
	$inserted = 0;
	foreach ($lines as $preline)
	{
		$line = trim($preline);
		if ($number == 0)
		{
			$header = str_getcsv($line);
			foreach ($header as $key => $value)
			{
				if ($value == $csv_member_id_title || array_key_exists($value, $csv_field))
					$col_head[] = $key;
				//~ else
					//~ $col_head_custom[] = array($key => $value);
			}
			if (in_array('member_type_name', $csv_field))
			{
				$key = array_search('member_type_name', $csv_field);
				$replacer = array($key => 'member_type_id');
				$csv_field = array_replace($csv_field, $replacer);
				$insert_mode = TRUE;
			}
			else
			{
				$insert_mode = FALSE;
				$failed++;
			}
		}
		else
		{
			$contents = str_getcsv($line);
			$col_cont[$number] = array();
			$col_cont_custom[$number] = $string_begin;
			foreach ($contents as $key => $value)
			{
				if (in_array($key, $col_head))
				{
					if ($header[$key] == $csv_member_id_title)
						$col_cont[$number]['member_id'] = $value;
					else
						$col_cont[$number][$csv_field[$header[$key]]] = $value;
				}
				else if ( ! empty($value))
					$col_cont_custom[$number] .= $string_custom_label . $header[$key] . $string_custom_value . $value . $string_sep;
				//~ else
					//~ unset($col_cont_custom[$number]);
			}
			if ($col_cont_custom[$number] != $string_begin)
				$col_cont[$number][$field_look_string] = $col_cont_custom[$number];
			unset($col_cont_custom[$number]);
		}
		$number++;
		unset($col_cont_custom);
	}

	$mid_column = implode(", ", $csv_field);
	$insert_column = "member_id, $mid_column, $field_look_string";
	$insert_array = explode(", ", $insert_column);
	foreach ($col_cont as $member)
	{
		if ($insert_mode === TRUE)
		{
			$member['member_type_id'] = utility::getID($dbs, 'mst_member_type', 'member_type_id', 'member_type_name', $member['member_type_id'], $mtype_id_cache);
			if ( ! $member['member_type_id']) $member['member_type_id'] = 1;
			unset($member['member_type_name']);
		}
		$member_id = delbadstring($member['member_id']);
		$query = $dbs->query("SELECT * FROM member WHERE member_id = '$member_id'");
		if ($query->num_rows != 0)
			$mode = "update";
		else
			$mode = "insert";

		if ($mode == "insert" && $insert_mode === TRUE)
		{
			$sql = "INSERT IGNORE INTO member ($insert_column)";
			$midsql = '';
			foreach ($insert_array as $key => $value)
			{
				$midsql .= ! empty($midsql) ? ", " : "";
				$midsql .= array_key_exists($value, $member) ? ($value == 'member_id' ?  "'$member_id'" : "'" . addslashes($member[$value]) . "'") : "''";
			}
			$insert_sql = "$sql VALUES ($midsql)";
			$sqls[] = $insert_sql;
		}
		else if ($mode == "update")
		{
			$sql = "UPDATE member SET";
			$midsql = '';
			foreach ($member as $column => $value)
			{
				$midsql .= ! empty($midsql) ? ", " : "";
				$midsql .= "$column = '" . addslashes($value) ."'";
			}
			$update_sql = "$sql $midsql WHERE member_id = '$member_id'";
			$sqls[] = $update_sql;
		}
	}
	echo "<pre>";
	//~ print_r($sqls);
	foreach ($sqls as $sql)
	{
		@$dbs->query($sql);
		if ( ! $dbs->error)
			$inserted++;
		else
			$failed++;
	}
	echo "<p>File: {$_FILES[$csv_file]['name']} berhasil diproses. $inserted baris berhasil disimpan, $failed baris gagal disimpan!</p>"
		."<p><input type=\"button\" class=\"ui-button ui-state-default ui-corner-all\" value=\"&#171; Back\" onclick=\"history.back(1)\" /></p>";

}
echo "<hr /><address>Join CSV Module SMember Plugin &copy; 1431 H / 2010 M by <a href=\"mailto: indra.sutriadi@gmail.com\">Indra Sutriadi Pipii</a></address>"
	."</body></html>";
