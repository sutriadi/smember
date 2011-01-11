<?php
/**
 *
 * Download CSV Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: index.php
 * @desc: csv page
 *
 */

$level = '../../../../../../';
require $level . 'sysconfig.inc.php';

require SENAYAN_BASE_DIR.'admin/default/session.inc.php';
require SENAYAN_BASE_DIR.'admin/default/session_check.inc.php';

$can_read = utility::havePrivilege('membership', 'r');

if (!$can_read)
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

$criteria = 'member_id';
foreach ($csv_field as $field)
	$criteria .= ", $field";
$criteria .= ", $field_look_string";

$column = array($csv_member_id_title);
foreach ($csv_field as $q => $v)
	$column[] = $q;
foreach ($csv_custom as $q)
	$column[] = $q;

$numcols = count($column);
$header = implode($csv_sep, $column);

if (array_key_exists('members', $_POST))
{
	$itemid = $_POST['members'];
	$lines = array();
	foreach($itemid as $index => $value)
	{
		$query = $dbs->query("SELECT $criteria FROM member, mst_member_type AS m_type WHERE member_id = '$value' AND m_type.member_type_id = member.member_type_id");
		$result = $query->fetch_assoc();

		$line = array();
		foreach ($result as $q => $v)
		{
			if ($q == $field_look_string)
				$line[] = parsing($v, $confs);
			else
				$line[] = $v;
		}
		$line = implode($csv_sep, $line);
		$numcol = count(explode($csv_sep, $line));
		if ($numcol != $numcols)
			$line .= str_repeat($csv_sep, $numcols - $numcol);
		$lines[] = $line;
	}
	$contents = array_merge(array($header), $lines);

	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename="dokumen.csv"');
	
	foreach ($contents as $value)
		echo $value . "\r\n";
}
