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

$card_conf = json_decode(variable_get('smember_card_conf'));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SMember Plugin v <?php echo $version;?></title>
	<style type="text/css" title="currentStyle">
		@import "../../library/dataTables/css/demo_page.css";
		@import "../../library/dataTables/css/demo_table_jui.css";
		@import "../../<?php echo css_get();?>";
		@import "./css/s.css";
		@import "./css/custom.css";
	</style>
	<script type="text/javascript" language="javascript" src="../../library/js/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../library/ui/js/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../library/dataTables/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="./js/s.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="./js/custom.js"></script>

</head>
<body id="dt_example">
	<div id="container">
		<h1>SMember v <?php echo $version;?></h1>
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
					<button type="button" id="to-conf-card" title="Alt+Shift+K" accesskey="K">
						Setup <u>K</u>artu
					</button>
					<button type="submit" id="kirim" name="kirim" title="Alt+Shift+S" accesskey="S" class="ui-button ui-button-text ui-state-default ui-corner-all">
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
							<th colspan="6">Members Details</th>
						</tr>
						<tr>
							<th width="4%"></th>
							<th width="15%">ID</th>
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
							<th style="padding:0px;"><input value="ID" type="text" class="search_init" style="width: 90px;" /></th>
							<th style="padding:0px;"><input value="Name" type="text" class="search_init" style="width: 115px;" /></th>
							<th style="padding:0px;"><input value="Type" type="text" class="search_init" style="width: 60px;" /></th>
							<th style="padding:0px;"><input value="Institution" type="text" class="search_init" style="width: 200px;" /></th>
							<th style="padding:0px;"><input value="E-mail" type="text" class="search_init" style="width: 200px;" /></th>
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

	<div id="card_conf" title="Member Card Configuration">
		<form name="card_conf_form">
			<fieldset>
				<div id="card_conf_accordion">
					<div>
						<h3><a href="#">Kartu</a></h3>
						<div>
							<p>
								<label for="lebar" class="lshort">Lebar:</label>
								<input id="lebar" name="lebar" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->lebar) ? $card_conf->lebar : '8.8';?>" />
								cm
							</p>
							<p>
								<label for="tinggi" class="lshort">Tinggi:</label>
								<input id="tinggi" name="tinggi" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->tinggi) ? $card_conf->tinggi : '8.8';?>" />
								cm
							</p>
							<p>
								<label for="gaya" class="lshort">Tema:</label>
								<input id="gaya" name="gaya" value="<?php echo isset($card_conf->gaya) ? $card_conf->gaya : 'default';?>" />
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Halaman</a></h3>
						<div>
							<p>
								<label for="perhal" class="llong">Jumlah Kartu per Halaman:</label>
								<select id="perhal" name="perhal">
									<?php echo $options_perhal; ?>
								</select>
							</p>
							<p>
								<label for="kop" class="llong">Tampilkan kop?</label>
								<input id="kop" type="checkbox" name="kop" <?php echo $checked_kop;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="logo" class="llong">Tampilkan logo?</label>
								<input id="logo" type="checkbox" name="logo" <?php echo $checked_logo;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="stempel" class="llong">Tampilkan stempel?</label>
								<input id="stempel" type="checkbox" name="stempel" <?php echo $checked_stempel;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="pasfoto" class="llong">Tampilkan pasfoto?</label>
								<input id="pasfoto" type="checkbox" name="pasfoto" <?php echo $checked_pasfoto;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="kodebar" class="llong">Tampilkan barcode?</label>
								<input id="kodebar" type="checkbox" name="kodebar" <?php echo $checked_kodebar;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="ganda" class="llong">Tampilkan sisi belakang?</label>
								<input id="ganda" type="checkbox" name="ganda" <?php echo $checked_ganda;?> /> <span>Ya!</span>
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Pas Foto</a></h3>
						<div>
							<p>
								<label for="pasfoto_lebar" class="lshort">Lebar:</label>
								<input id="pasfoto_lebar" name="pasfoto_lebar" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->pasfoto_lebar) ? $card_conf->pasfoto_lebar : '8.8';?>" />
								cm
							</p>
							<p>
								<label for="tinggi" class="lshort">Tinggi:</label>
								<input id="tinggi" name="pasfoto_tinggi" maxlength="4" size="4" type="text" value="<?php echo isset($card_conf->pasfoto_tinggi) ? $card_conf->pasfoto_tinggi : '8.8';?>" />
								cm
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Kop</a></h3>
						<div>
							<p>
								<label for="nama_perpustakaan" class="llong">Nama Perpustakaan:</label>
								<input id="nama_perpustakaan" name="nama_perpustakaan" type="text" value="<?php echo isset($card_conf->nama_perpustakaan) ? $card_conf->nama_perpustakaan : '';?>" />
							</p>
							<p>
								<label for="alamat_perpustakaan" class="llong">Alamat Perpustakaan:</label>
								<input id="alamat_perpustakaan" name="alamat_perpustakaan" type="text" value="<?php echo isset($card_conf->alamat_perpustakaan) ? $card_conf->alamat_perpustakaan : '';?>" />
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Logo</a></h3>
						<div>
							<p>
								<label for="path_logo" class="lmid">Berkas Logo:</label>
								<input type="path_logo" name="path_logo" type="text" value="<?php echo isset($card_conf->path_logo) ? $card_conf->path_logo : '';?>" />
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Barcode</a></h3>
						<div>
							<p>
								<label for="encbar" class="lmid">Encoding:</label>
								<select name="encbar">
									<option>-- Pilih --</option>
									<?php echo $options_encoding; ?>
								</select>
							</p>
							<input type="hidden" name="bar_rotate" value="0" />
						</div>
					</div>
					<div>
						<h3><a href="#">Stempel</a></h3>
						<div>
							<p>
								<label for="lokasi_stempel" class="llong">Lokasi:</label>
								<input id="lokasi_stempel" name="lokasi_stempel" type="text" value="<?php echo isset($card_conf->lokasi_stempel) ? $card_conf->lokasi_stempel : '';?>" />
							</p>
							<p>
								<label for="pejabat_stempel" class="llong">Nama Pejabat:</label>
								<input id="pejabat_stempel" name="pejabat_stempel" type="text" value="<?php echo isset($card_conf->pejabat_stempel) ? $card_conf->pejabat_stempel : '';?>" />
							</p>
							<p>
								<label for="nip_prefix_stempel" class="llong">NIP. Prefix:</label>
								<input id="nip_prefix_stempel" name="nip_prefix_stempel" type="text" value="<?php echo isset($card_conf->nip_prefix_stempel) ? $card_conf->nip_prefix_stempel : '';?>" />
							</p>
							<p>
								<label for="nip_pejabat_stempel" class="llong">Angka NIP:</label>
								<input id="nip_pejabat_stempel" name="nip_pejabat_stempel" type="text" value="<?php echo isset($card_conf->nip_pejabat_stempel) ? $card_conf->nip_pejabat_stempel : '';?>" />
							</p>
							<p>
								<label for="jabatan_stempel" class="llong">Jabatan:</label>
								<input id="jabatan_stempel" name="jabatan_stempel" type="text" value="<?php echo isset($card_conf->jabatan_stempel) ? $card_conf->jabatan_stempel : '';?>" />
							</p>
							<p>
								<label for="gambar_stempel" class="llong">Tampilkan cap?</label>
								<input id="gambar_stempel" name="gambar_stempel" type="checkbox" <?php echo $checked_gambar_stempel;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="path_stempel" class="llong">Berkas Cap:</label>
								<input id="path_stempel" name="path_stempel" type="text" value="<?php echo isset($card_conf->path_stempel) ? $card_conf->path_stempel : '';?>" />
							</p>
							<p>
								<label for="tanggal_stempel" class="llong">Tanggal:</label>
								<input id="tanggal_stempel" name="tanggal_stempel" type="text" value="<?php echo isset($card_conf->tanggal_stempel) ? $card_conf->tanggal_stempel : '';?>" />
							</p>
							<p>
								<label for="tanggal_fungsi" class="llong">Fungsi Tanggal:</label>
								<select id="tanggal_fungsi" name="tanggal_fungsi">
									<option>-- Pilih --</option>
									<?php echo $options_date_function; ?>
								</select>
								<br /><span><em>Pilihan Dynamic berarti menggunakan fungsi date() PHP</em></span>
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Baris</a></h3>
						<div>
							<p>
								<label for="fields" class="lshort">Pilih:</label>
								<select multiple id="fields" name="fields[]"><?php echo $options_fields;?></select>
								<br /><span><em>Tahan [Ctrl] untuk memilih lebih dari satu</em></span>
							</p>
						</div>
					</div>
					<div>
						<h3><a href="#">Bagian Belakang</a></h3>
						<div>
							<p>
								<label for="isiganda" class="lblock">Isi:</label>
								<textarea id="isiganda" cols="50" rows="6" name="isiganda"><?php echo isset($card_conf->isiganda)? $card_conf->isiganda : '';?></textarea>
							</p>
							<p>
								<label for="logo_ganda" class="llong">Tampilkan logo?</label>
								<input id="logo_ganda" type="checkbox" name="logo_ganda" <?php echo $checked_logo_ganda;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="kop_ganda" class="llong">Tampilkan kop?</label>
								<input id="kop_ganda" type="checkbox" name="kop_ganda" <?php echo $checked_kop_ganda;?> /> <span>Ya!</span>
							</p>
							<p>
								<label for="stempel_ganda" class="llong">Tampilkan stempel?</label>
								<input id="stempel_ganda" type="checkbox" name="stempel_ganda" <?php echo $checked_stempel_ganda;?> /> <span>Ya!</span>
							</p>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>
