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

// mengambil konfigurasi kartu
$card_conf = json_decode(variable_get('smember_card_conf'));

// mengambil daftar nama kolom tabel member, dan urutan kolom
$base_cols_name = base_cols_name('member');
$fcols = cols_get('smember');

$dtables = table_render('smember');
extract($dtables);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $name;?> <?php echo $version;?></title>
	<style type="text/css" title="currentStyle">
		@import "../../library/dataTables/css/demo_page.css";
		@import "../../library/dataTables/css/demo_table_jui.css";
		@import "../../<?php echo css_get();?>";
		@import "./css/s.css";
		@import "./css/custom.css";
	</style>
	<script type="text/javascript">
		<?php if (isset($php_js)) echo $php_js;?>
	</script>
	<script type="text/javascript" language="javascript" src="../../library/js/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../library/ui/js/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../library/dataTables/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="./js/s.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="./js/custom.js"></script>

</head>
<body id="dt_example">
	<div id="container">
		<h1>SMember <?php echo $version;?></h1>
		<div id="demo">
		<!--
		<input type="button" id="ngetes" value="TEST" />
		-->
			<form id="formulir" name="formulir" target="" action="" method="POST">
				<div style="text-align:left; padding-bottom: 1em; float: left;" class="ui-widget">
					<label for="dofirst"><?php echo __('<u>G</u>o');?>:</label>
					<select id="dofirst" name="dofirst" accesskey="G" onchange="eval(this.value);" class="ui-state-default ui-corner-all">
						<option><?php echo __('What to do?');?></option>
						<?php echo $option;?>
					</select>
				</div>
				<div style="text-align:right; padding-bottom:1em;" class="ui-widget">
					<button type="button" id="to-conf-card" title="Alt+Shift+C" accesskey="C">
						<?php echo __('<u>C</u>ard Setup');?>
					</button>
					<button type="submit" id="kirim" name="kirim" title="Alt+Shift+S" accesskey="S" class="ui-button ui-button-text ui-state-default ui-corner-all">
						<?php echo __('<u>S</u>ubmit form');?>
					</button>
				</div>
				<div style="margin: 5px 0px;" width="100%">
					<button type="button" onclick="allcheck(this);" id="btn1" accesskey="A" title="Alt+Shift+A" class="ui-button ui-state-default ui-corner-all"><?php echo __('Check <u>A</u>ll');?></button>
					<button type="button" onclick="alluncheck(this);" id="btn2" accesskey="U" title="Alt+Shift+U" class="ui-button ui-state-default ui-corner-all"><?php echo __('<u>U</u>ncheck All');?></button>
					<button type="button" onclick="invertcheck(this);" id="btn3" accesskey="I" title="Alt+Shift+I" class="ui-button ui-state-default ui-corner-all"><?php echo __('Check <u>I</u>nvert');?></button>
				</div>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="members">
					<?php echo $thead;?>
					<?php echo $tbody;?>
					<?php echo $tfoot;?>
				</table>
				<div style="margin: 5px 0px;" width="100%">
					<button type="button" onclick="allcheck(this);" id="btn4" accesskey="A" title="Alt+Shift+A" class="ui-button ui-state-default ui-corner-all"><?php echo __('Check <u>A</u>ll');?></button>
					<button type="button" onclick="alluncheck(this);" id="btn5" accesskey="U" title="Alt+Shift+U" class="ui-button ui-state-default ui-corner-all"><?php echo __('<u>U</u>ncheck All');?></button>
					<button type="button" onclick="invertcheck(this);" id="btn6" accesskey="I" title="Alt+Shift+I" class="ui-button ui-state-default ui-corner-all"><?php echo __('Check <u>I</u>nvert');?></button>
				</div>
			</form>
		</div>
		<div class="spacer"></div>
		<div style="text-align:left; padding-bottom:1em; float: left;" class="ui-widget">
			<button type="button" id="reload" accesskey="R" title="Alt+Shift+R" class="ui-button ui-state-default ui-corner-all">
				<?php echo __('<u>R</u>eload');?>
			</button>
		</div>
		<div style="text-align:right; padding-bottom:1em;" class="ui-widget">
			<button type="button" id="tutup" accesskey="X" title="Alt+Shift+X" class="ui-button ui-state-default ui-corner-all">
				<?php echo __('E<u>x</u>it');?>
			</button>
		</div>
		<address style="text-align: center;">
			Copyright &copy; 1431-1432 H / 2010-2011 M by Indra Sutriadi Pipii.<br />
			Build with jQuery-UI + dataTables plugin.
		</address>
	</div>
	<div id="dialog" title="<?php echo __('Information');?>">
		<p id="validateTips"></p>
	</div>

<?php
	$encoding = array(
		'128' => '128', '128b' => '128B',
		'128c' => '128C', 'isbn' => 'ISBN',
		'39' => '39', 'cbr' => 'Codabar',
		'msi' => 'MSI', 'pls' => 'Plessey',
		'i25' => 'Interleaved 2 of 5',
		'upc' => '12 Digit EAN' , 'ean' => '8, 13 Digit EAN'
	);
	$options_encoding = '';
	foreach ($encoding as $key => $val)
	{
		$selected = (isset($card_conf->encbar) && $key == $card_conf->encbar) ? "selected" : "";
		$options_encoding .= "<option $selected value=\"$key\">$val</option>";
	}
	$date_function = array('static', 'dynamic');
	$options_date_function = '';
	foreach ($date_function as $f)
	{
		$selected = (isset($card_conf->tanggal_fungsi) && $f == $card_conf->tanggal_fungsi) ? "selected" : "";
		$options_date_function .= "<option $selected value=\"$f\">$f</option>";
	}
	
	$mfields = array(
		'member_id', 'member_name', 'member_type_id',
		'member_address', 'inst_name', 'register_date',
		'expire_date', 'gender', 'member_email', 'member_phone'
	);
	$options_fields = '';
	$fields = isset($card_conf->fields) ? (array) $card_conf->fields : array();
	foreach ($mfields as $mfield)
	{
		$count_fields = (count($fields) > 0) ? true : false;
		$selected = ($count_fields === true && in_array($mfield, $fields)) ? "selected" : "";
		$options_fields .= "<option $selected value=\"$mfield\">$mfield</option>";
	}
	
	$options_perhal = '';
	for ($x = 1; $x <= 50; $x++)
	{
		$selected = (isset($card_conf->perhal) && $x == $card_conf->perhal) ? "selected" : "";
		$options_perhal .= "<option $selected value=\"$x\">$x</option>";
	}
	$checked_stempel = (isset($card_conf->stempel) && $card_conf->stempel == true) ? "checked" : "";
	$checked_kop = (isset($card_conf->kop) && $card_conf->kop == true) ? "checked" : "";
	$checked_pasfoto = (isset($card_conf->pasfoto) && $card_conf->pasfoto == true) ? "checked" : "";
	$checked_logo = (isset($card_conf->logo) && $card_conf->logo == true) ? "checked" : "";
	$checked_kodebar = (isset($card_conf->kodebar) && $card_conf->kodebar == true) ? "checked" : "";
	$checked_ganda = (isset($card_conf->ganda) && $card_conf->ganda == true) ? "checked" : "";
	$checked_gambar_stempel = (isset($card_conf->gambar_stempel) && $card_conf->gambar_stempel == true) ? "checked" : "";
	$checked_logo_ganda = (isset($card_conf->logo_ganda) && $card_conf->logo_ganda == true) ? "checked" : "";
	$checked_kop_ganda = (isset($card_conf->kop_ganda) && $card_conf->kop_ganda == true) ? "checked" : "";
	$checked_stempel_ganda = (isset($card_conf->stempel_ganda) && $card_conf->stempel_ganda == true) ? "checked" : "";
?>

	<div id="card_conf" title="<?php echo __('Member Card Configuration');?>">
		<form name="card_conf_form">
			<fieldset>
				<div id="card_conf_accordion">
					<div>
						<h3><a href="#"><?php echo __('Card');?></a></h3>
						<div>
							<p>
								<label for="lebar" class="lshort"><?php echo __('Width');?>:</label>
								<input id="lebar" name="lebar" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->lebar) ? $card_conf->lebar : '8.8';?>" />
								cm
							</p>
							<p>
								<label for="tinggi" class="lshort"><?php echo __('Height');?>:</label>
								<input id="tinggi" name="tinggi" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->tinggi) ? $card_conf->tinggi : '8.8';?>" />
								cm
							</p>
							<p>
								<label for="gaya" class="lshort"><?php echo __('Theme');?>:</label>
								<input id="gaya" name="gaya" value="<?php echo isset($card_conf->gaya) ? $card_conf->gaya : 'default';?>" />
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Page');?></a></h3>
						<div>
							<p>
								<label for="perhal" class="llong"><?php echo __('Number of cards per page');?>:</label>
								<select id="perhal" name="perhal">
									<?php echo $options_perhal; ?>
								</select>
							</p>
							<p>
								<label for="kop" class="llong"><?php echo __('Display header?');?></label>
								<input id="kop" type="checkbox" name="kop" <?php echo $checked_kop;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="logo" class="llong"><?php echo __('Display logo?');?></label>
								<input id="logo" type="checkbox" name="logo" <?php echo $checked_logo;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="stempel" class="llong"><?php echo __('Display stamp?');?></label>
								<input id="stempel" type="checkbox" name="stempel" <?php echo $checked_stempel;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="pasfoto" class="llong"><?php echo __('Display photo?');?></label>
								<input id="pasfoto" type="checkbox" name="pasfoto" <?php echo $checked_pasfoto;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="kodebar" class="llong"><?php echo __('Display barcode?');?></label>
								<input id="kodebar" type="checkbox" name="kodebar" <?php echo $checked_kodebar;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="ganda" class="llong"><?php echo __('Display backside?');?></label>
								<input id="ganda" type="checkbox" name="ganda" <?php echo $checked_ganda;?> /> <span><?php echo __('Yes!');?></span>
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Photo');?></a></h3>
						<div>
							<p>
								<label for="pasfoto_lebar" class="lshort"><?php echo __('Width');?>:</label>
								<input id="pasfoto_lebar" name="pasfoto_lebar" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->pasfoto_lebar) ? $card_conf->pasfoto_lebar : '8.8';?>" />
								cm
							</p>
							<p>
								<label for="tinggi" class="lshort"><?php echo __('Height');?>:</label>
								<input id="tinggi" name="pasfoto_tinggi" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->pasfoto_tinggi) ? $card_conf->pasfoto_tinggi : '8.8';?>" />
								cm
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Header');?></a></h3>
						<div>
							<p>
								<label for="nama_perpustakaan" class="llong"><?php echo __('Library Name');?>:</label>
								<input id="nama_perpustakaan" name="nama_perpustakaan" type="text" value="<?php echo isset($card_conf->nama_perpustakaan) ? $card_conf->nama_perpustakaan : '';?>" />
							</p>
							<p>
								<label for="alamat_perpustakaan" class="llong"><?php echo __('Address');?>:</label>
								<input id="alamat_perpustakaan" name="alamat_perpustakaan" type="text" value="<?php echo isset($card_conf->alamat_perpustakaan) ? $card_conf->alamat_perpustakaan : '';?>" />
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Logo');?></a></h3>
						<div>
							<p>
								<label for="path_logo" class="lmid"><?php echo __('Filename');?>:</label>
								<input type="path_logo" name="path_logo" type="text" value="<?php echo isset($card_conf->path_logo) ? $card_conf->path_logo : '';?>" />
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Barcode');?></a></h3>
						<div>
							<p>
								<label for="encbar" class="lmid"><?php echo __('Encoding');?>:</label>
								<select name="encbar">
									<option><?php echo __('-- Select --');?></option>
									<?php echo $options_encoding; ?>
								</select>
							</p>
							<input type="hidden" name="bar_rotate" value="0" />
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Stamp');?></a></h3>
						<div>
							<p>
								<label for="lokasi_stempel" class="llong"><?php echo __('Locate');?>:</label>
								<input id="lokasi_stempel" name="lokasi_stempel" type="text" value="<?php echo isset($card_conf->lokasi_stempel) ? $card_conf->lokasi_stempel : '';?>" />
							</p>
							<p>
								<label for="pejabat_stempel" class="llong"><?php echo __('Official Name');?>:</label>
								<input id="pejabat_stempel" name="pejabat_stempel" type="text" value="<?php echo isset($card_conf->pejabat_stempel) ? $card_conf->pejabat_stempel : '';?>" />
							</p>
							<p>
								<label for="nip_prefix_stempel" class="llong"><?php echo __('NIP. Prefix');?>:</label>
								<input id="nip_prefix_stempel" name="nip_prefix_stempel" type="text" value="<?php echo isset($card_conf->nip_prefix_stempel) ? $card_conf->nip_prefix_stempel : '';?>" />
							</p>
							<p>
								<label for="nip_pejabat_stempel" class="llong"><?php echo __('Number of NIP');?>:</label>
								<input id="nip_pejabat_stempel" name="nip_pejabat_stempel" type="text" value="<?php echo isset($card_conf->nip_pejabat_stempel) ? $card_conf->nip_pejabat_stempel : '';?>" />
							</p>
							<p>
								<label for="jabatan_stempel" class="llong"><?php echo __('Position');?>:</label>
								<input id="jabatan_stempel" name="jabatan_stempel" type="text" value="<?php echo isset($card_conf->jabatan_stempel) ? $card_conf->jabatan_stempel : '';?>" />
							</p>
							<p>
								<label for="gambar_stempel" class="llong"><?php echo __('Display stamp image?');?></label>
								<input id="gambar_stempel" name="gambar_stempel" type="checkbox" <?php echo $checked_gambar_stempel;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="path_stempel" class="llong"><?php echo __('Stamp filename');?>:</label>
								<input id="path_stempel" name="path_stempel" type="text" value="<?php echo isset($card_conf->path_stempel) ? $card_conf->path_stempel : '';?>" />
							</p>
							<p>
								<label for="tanggal_stempel" class="llong"><?php echo __('Date');?>:</label>
								<input id="tanggal_stempel" name="tanggal_stempel" type="text" value="<?php echo isset($card_conf->tanggal_stempel) ? $card_conf->tanggal_stempel : '';?>" />
							</p>
							<p>
								<label for="tanggal_fungsi" class="llong"><?php echo __('Date function');?>:</label>
								<select id="tanggal_fungsi" name="tanggal_fungsi">
									<option><?php echo __('-- Select --');?></option>
									<?php echo $options_date_function; ?>
								</select>
								<br /><span><em><?php echo __('Dynamic option mean will used date() function of PHP');?></em></span>
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Fields');?></a></h3>
						<div>
							<p>
								<label for="fields" class="lshort"><?php echo __('Select');?>:</label>
								<select multiple id="fields" name="fields[]" size="<?php echo count($mfields);?>"><?php echo $options_fields;?></select>
								<br /><span><em><?php echo __('Hold Ctrl key for multiple check.');?></em></span>
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#"><?php echo __('Backside');?></a></h3>
						<div>
							<p>
								<label for="isiganda" class="lblock"><?php echo __('Body');?></label>
								<textarea id="isiganda" cols="50" rows="6" name="isiganda"><?php echo isset($card_conf->isiganda)? $card_conf->isiganda : '';?></textarea>
							</p>
							<p>
								<label for="logo_ganda" class="llong"><?php echo __('Display logo?');?></label>
								<input id="logo_ganda" type="checkbox" name="logo_ganda" <?php echo $checked_logo_ganda;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="kop_ganda" class="llong"><?php echo __('Display header?');?></label>
								<input id="kop_ganda" type="checkbox" name="kop_ganda" <?php echo $checked_kop_ganda;?> /> <span><?php echo __('Yes!');?></span>
							</p>
							<p>
								<label for="stempel_ganda" class="llong"><?php echo __('Display stamp?');?></label>
								<input id="stempel_ganda" type="checkbox" name="stempel_ganda" <?php echo $checked_stempel_ganda;?> /> <span><?php echo __('Yes!');?></span>
							</p>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>
