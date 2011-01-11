<?php
// $src_img - a GD image resource
// $angle - degrees to rotate clockwise, in degrees
// returns a GD image resource
// USAGE:
// $im = imagecreatefrompng('test.png');
// $im = imagerotate($im, 15);
// header('Content-type: image/png');
// imagepng($im);
function imageRotateBicubic($src_img, $angle, $bicubic=false) {
  
    // convert degrees to radians
    $angle = $angle + 180;
    $angle = deg2rad($angle);
  
    $src_x = imagesx($src_img);
    $src_y = imagesy($src_img);
  
    $center_x = floor($src_x/2);
    $center_y = floor($src_y/2);
  
    $rotate = imagecreatetruecolor($src_x, $src_y);
    imagealphablending($rotate, false);
    imagesavealpha($rotate, true);

    $cosangle = cos($angle);
    $sinangle = sin($angle);
  
    for ($y = 0; $y < $src_y; $y++) {
      for ($x = 0; $x < $src_x; $x++) {
    // rotate...
    $old_x = (($center_x-$x) * $cosangle + ($center_y-$y) * $sinangle)
      + $center_x;
    $old_y = (($center_y-$y) * $cosangle - ($center_x-$x) * $sinangle)
      + $center_y;
  
    if ( $old_x >= 0 && $old_x < $src_x
         && $old_y >= 0 && $old_y < $src_y ) {
      if ($bicubic == true) {
        $sY  = $old_y + 1;
        $siY  = $old_y;
        $siY2 = $old_y - 1;
        $sX  = $old_x + 1;
        $siX  = $old_x;
        $siX2 = $old_x - 1;
      
        $c1 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX, $siY2));
        $c2 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX, $siY));
        $c3 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX2, $siY2));
        $c4 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX2, $siY));
      
        $r = ($c1['red']  + $c2['red']  + $c3['red']  + $c4['red']  ) << 14;
        $g = ($c1['green'] + $c2['green'] + $c3['green'] + $c4['green']) << 6;
        $b = ($c1['blue']  + $c2['blue']  + $c3['blue']  + $c4['blue'] ) >> 2;
        $a = ($c1['alpha']  + $c2['alpha']  + $c3['alpha']  + $c4['alpha'] ) >> 2;
        $color = imagecolorallocatealpha($src_img, $r,$g,$b,$a);
      } else {
        $color = imagecolorat($src_img, $old_x, $old_y);
      }
    } else {
          // this line sets the background colour
      $color = imagecolorallocatealpha($src_img, 255, 255, 255, 127);
    }
    imagesetpixel($rotate, $x, $y, $color);
      }
    }
    return $rotate;
}