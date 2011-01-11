<?php

/**
 *
 * copyright (c) 1430 H, Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 * 
 * resize the member image
 *
 */

header("Content-type: image/png");

/* configuration */
$_lebar = ($_GET['lebar']) ? $_GET['lebar'] : 50;
$_tinggi = ($_GET['tinggi']) ? $_GET['tinggi'] : 100;

$_src = ($_GET['src']) ? $_GET['src'] : "patch-thumb.png";
$_type = ($_GET['src']) ? exif_imagetype($_GET['src']) : 3; // 1 = gif, 2 = jpeg, 3 = png, 6 = bmp
$_props = getimagesize($_src);
$_srcx = $_props[0];
$_srcy = $_props[1];

$_errorgd = "Cannot Initialize new GD image stream";

/* source image */
switch ($_type)
{
	case 1 : $imsrc = @imagecreatefromgif ($_src) or die($_errorgd); break;
	case 2 : $imsrc = @imagecreatefromjpeg($_src) or die($_errorgd); break;
	case 3 : $imsrc = @imagecreatefrompng($_src) or die($_errorgd); break;
	case 6 : $imsrc = @imagecreatefromwbmp($_src) or die($_errorgd); break;
}

if (!$imsrc)
{
	$imsrc  = @imagecreate($_lebar, $_tinggi); /* Create a blank image */
        $bgc = imagecolorallocate($imsrc, 255, 255, 255);
        $tc  = imagecolorallocate($imsrc, 0, 0, 0);
        imagefilledrectangle($imsrc, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($imsrc, 1, 5, 5, "Error loading $_src", $tc);
	$_srcx = $_lebar;
	$_srcy = $_tinggi;
}

/* destination image */
$imdst = @imagecreatetruecolor($_lebar, $_tinggi) or die($_errorgd);

/* resize image */
imagecopyresampled($imdst, $imsrc, 0, 0, 0, 0, $_lebar, $_tinggi, $_srcx, $_srcy);

/* result */
imagepng($imdst);
imagedestroy($imdst);

