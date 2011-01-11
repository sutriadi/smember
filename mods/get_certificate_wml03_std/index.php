<?php
/**
 *
 * Download Certificate (XML Word 2003) Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: index.php
 * @desc: attacher certificate page
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
require './xml.function.php';

$confs = $letterconf['letter_member'];
extract($confs);

$criteria = "$field_look_string";
foreach ($field_show as $field)
	$criteria .= ", $field";

if ($_POST['members'])
{
	$itemid = $_POST['members'];
	$num_pages = count($itemid);
	header('Content-type: application/xml');
	header('Content-Disposition: attachment; filename="surat_keterangan_bebas.xml"');
	include './xml.php';
}
else
	exit();