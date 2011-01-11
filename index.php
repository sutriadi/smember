<?php
/*
 *
 * SMember Plugin
 * Copyright (c) 1431 H / 2010 M
 * by Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: index.php
 * @desc: display information of php
 *
 */

if (!defined('SENAYAN_BASE_DIR')) {
    //~ require '../../../../sysconfig.inc.php';
    require '../slims/sysconfig.inc.php';
    require SENAYAN_BASE_DIR.'admin/default/session.inc.php';
}

require SENAYAN_BASE_DIR.'admin/default/session_check.inc.php';

$can_read = utility::havePrivilege('plugins', 'r');
$can_write = utility::havePrivilege('plugins', 'w');

if (!$can_read && !$can_write) {
	die('<div>You dont have enough privileges to view this section</div>');
}

//~ include('../conf.php');
//~ include('../func.php');

include('../plugins/conf.php');
include('../plugins/func.php');

checkip($conf);
checken();
checkref();

$dirmods = "./mods";
$files = scandir($dirmods);
sort($files);
//~ $jsfiles = array();
//~ $cssfiles = array();
$options = array();
foreach ($files as $file)
{
	$dirmod = $dirmods . '/' . $file;
	$optfile = $dirmod . '/opt.php';
	$mainfile = $dirmod . '/index.php';
	//~ echo "<pre>$file => $dirmod</pre>";
	if ($file != "." AND $file != ".." AND ! is_dir($dirmod))
		continue;
	if (file_exists($optfile) AND file_exists($mainfile))
	{
		include($optfile);
		//~ $jsfiles[] = $dirmod . '/' . $opt['jsfile'];
		$options[] = array(
			'text' => $opt['text'],
			'target' => 'card_std',
			'action' => $dirmod . '/' . $opt['action'],
		);
		unset($opt);
	}
}

$opt = '';
foreach ($options as $option)
	$opt .= "<option value=\"chform('{$option['target']}', '{$option['action']}')\">{$option['text']}</option>";
$option = $opt;

require('./conf/plugin.conf.php');

$cssdir = "./css/ui-themes/";
$styles = scandir($cssdir);
sort($styles);
$optstyle = '';
foreach ($styles as $style)
{
	$selected = $style == $defstyle ? 'selected' : '';
	if ($style != "." AND $style != ".." AND is_dir($cssdir . "/" . $style))
		$optstyle .= "<option $selected value=\"$style\">$style</option>";
}
$optstyles = "<select id=\"theme\" accesskey=\"T\" class=\"ui-state-default ui-corner-all\" onchange=\"reload(this.value, '$cssdir')\">"
		. $optstyle
	. "</select>";
$onload = "reload('$defstyle', '$cssdir');";

include('./template.php');

exit();
