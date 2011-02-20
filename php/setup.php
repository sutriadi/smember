<?php
/*
 *      setup.php
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

if (!defined('SENAYAN_BASE_DIR')) {
	require '../../../../../sysconfig.inc.php';
	require SENAYAN_BASE_DIR.'admin/default/session.inc.php';
}
require SENAYAN_BASE_DIR.'admin/default/session_check.inc.php';

$can_read = utility::havePrivilege('plugins', 'r');
$can_read = utility::havePrivilege('plugins', 'w');

if (!$can_read) {
      die('<div class="errorBox">You dont have enough privileges to view this section</div>');
}

$conf = $_SESSION['plugins_conf'];
include('../../func.php');

checkip();
checken();
checkref();

if (isset($_GET) && isset($_GET['conf']))
{
	$toconf = $_GET['conf'];
	if ($toconf == 'card')
	{
		if (isset($_POST) && count($_POST) > 0)
		{
			$cardconf = $_POST;
			$cardconf['ganda'] = isset($cardconf['ganda']) ? true : false;
			$cardconf['gambar_stempel'] = isset($cardconf['gambar_stempel']) ? true : false;
			$cardconf['stempel'] = isset($cardconf['stempel']) ? true : false;
			$cardconf['kop'] = isset($cardconf['kop']) ? true : false;
			$cardconf['logo'] = isset($cardconf['logo']) ? true : false;
			$cardconf['pasfoto'] = isset($cardconf['pasfoto']) ? true : false;
			$cardconf['kodebar'] = isset($cardconf['kodebar']) ? true : false;
			$cardconf['logo_ganda'] = isset($cardconf['logo_ganda']) ? true : false;
			$cardconf['stempel_ganda'] = isset($cardconf['stempel_ganda']) ? true : false;
			$cardconf['kop_ganda'] = isset($cardconf['kop_ganda']) ? true : false;
			
			variable_set('smember_card_conf', json_encode($cardconf, JSON_FORCE_OBJECT));
			echo json_encode(array('track' => 'sukses'), JSON_FORCE_OBJECT);
		}
		else
			echo json_encode(array('track' => 'gagal'), JSON_FORCE_OBJECT);
	}
	else if ($toconf == 'cert')
	{
		if (isset($_POST) && count($_POST) > 0)
		{
/*
			variable_set('smember_cert_conf', json_encode($_POST, JSON_FORCE_OBJECT));
*/
/*
			echo '{ "track" : "sukses", }';
*/
		}
/*
		else
			echo '{ "track" : "gagal", }';
*/
	}
}
