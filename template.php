<?php
/*
 *      template.php
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

if ( ! defined('SENAYAN_BASE_DIR')) { exit(); }
if (!$can_read)
	die('<div class="errorBox">You dont have enough privileges to view this section</div>');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SMember Plugin v 0.2</title>
	<style type="text/css" title="currentStyle">
		@import "./css/demo_page.css";
		@import "./css/demo_table_jui.css";
		.ui-button { outline: 0; margin:0; padding: .4em 1em .5em; text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; }
	</style>
	<script type="text/javascript" language="javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="./js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="./js/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="./js/data.js"></script>
<?php if (isset($jsfiles) && count($jsfiles) != 0): foreach ($jsfiles as $jsfile):?>
	<script type="text/javascript" language="javascript" src="<?php echo $jsfile;?>"></script>
<?php endforeach; endif; ?>

</head>
<body id="dt_example" onload="<?php echo $onload;?>">
	<div id="container">
		<div style="float:right;">
			<label for="theme"><u>T</u>heme:</label>
			<?php echo $optstyles;?>
		</div>
		<h1>SMember v 0.2</h1>
		<div id="demo">
			<form id="formulir" name="formulir" target="" action="" method="POST">
				<div style="text-align:left; padding-bottom: 1em; float: left;" class="ui-widget">
					<label for="dofirst"><u>G</u>o:</label>
					<select id="dofirst" name="dofirst" accesskey="G" onchange="eval(this.value);" class="ui-state-default ui-corner-all">
						<option>-- Mau diapakan? --</option>
						<?php echo $option;?>
					</select>
				</div>
				<div style="text-align:right; padding-bottom:1em;" class="ui-widget">
					<button type="submit" id="kirim" name="kirim" title="Alt+Shift+S" accesskey="S" class="ui-button ui-state-default ui-corner-all">
						<u>S</u>ubmit form
					</button>
				</div>
				<div style="margin: 5px 0px;" width="100%">
					<button type="button" onclick="allcheck(this);" id="btn1" accesskey="A" title="Alt+Shift+A" class="ui-button ui-state-default ui-corner-all">Check <u>A</u>ll</button>
					<button type="button" onclick="alluncheck(this);" id="btn2" accesskey="U" title="Alt+Shift+U" class="ui-button ui-state-default ui-corner-all"><u>U</u>ncheck All</button>
					<button type="button" onclick="invertcheck(this);" id="btn3" accesskey="I" title="Alt+Shift+I" class="ui-button ui-state-default ui-corner-all">Check <u>I</u>nvert</button>
				</div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="members">
					<thead>
						<tr>
							<th width="4%"></th>
							<th width="15%">Member ID</th>
							<th width="20%">Name</th>
							<th width="10%">Type</th>
							<th width="30%">Institution</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="5" class="dataTables_empty">Loading data from server</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th>Member ID</th>
							<th>Name</th>
							<th>Type</th>
							<th>Institution</th>
							<th>Email</th>
						</tr>
					</tfoot>
				</table>
				<div style="margin: 5px 0px;" width="100%">
					<button type="button" onclick="allcheck(this);" id="btn4" accesskey="A" title="Alt+Shift+A" class="ui-button ui-state-default ui-corner-all">Check <u>A</u>ll</button>
					<button type="button" onclick="alluncheck(this);" id="btn5" accesskey="U" title="Alt+Shift+U" class="ui-button ui-state-default ui-corner-all"><u>U</u>ncheck All</button>
					<button type="button" onclick="invertcheck(this);" id="btn6" accesskey="I" title="Alt+Shift+I" class="ui-button ui-state-default ui-corner-all">Check <u>I</u>nvert</button>
				</div>
			</form>
		</div>
		<div class="spacer"></div>
		<div style="text-align:left; padding-bottom:1em; float: left;" class="ui-widget">
			<button type="button" id="reload" accesskey="R" title="Alt+Shift+R" class="ui-button ui-state-default ui-corner-all">
				<u>R</u>eload
			</button>
		</div>
		<div style="text-align:right; padding-bottom:1em;" class="ui-widget">
			<button type="button" id="tutup" accesskey="X" title="Alt+Shift+X" class="ui-button ui-state-default ui-corner-all">
				E<u>x</u>it
			</button>
		</div>
		<address style="text-align: center;">
			Copyright &copy; 1431-1432 H / 2010-2011 M by Indra Sutriadi Pipii.<br />
			Build with jQuery-UI + dataTables plugin.
		</address>
	</div>
	<div id="dialog" title="Information">
		<p id="validateTips"></p>
	</div>
</body>
</html>
