<?php
/*
 *      index.php
 *      
 *      Copyright 2011 Indra Sutriadi Pipii <indra.sutriadi@gmail.com>
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

if (!defined('SENAYAN_BASE_DIR')) {
    require '../../../../sysconfig.inc.php';
    require SENAYAN_BASE_DIR.'admin/default/session.inc.php';
}

require SENAYAN_BASE_DIR.'admin/default/session_check.inc.php';

$can_read = utility::havePrivilege('plugins', 'r');
$can_write = utility::havePrivilege('plugins', 'w');

if (!$can_read && !$can_write) {
	die('<div>You dont have enough privileges to view this section</div>');
}

$conf = $_SESSION['plugins_conf'];
include('../func.php');

checkip();
checken();
checkref();

$version = '0.4';
$dirmods = "./mods";
$files = scandir($dirmods);
sort($files);
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

$cssdir = "./css/ui-themes/";
$styles = scandir($cssdir);
sort($styles);
$defstyle = variable_get('smember_defstyle', 'default');
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
