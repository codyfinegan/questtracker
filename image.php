<?php 

include('functions.php'); 
if(checkPassword($_GET[p]) == false){ // check the password function 
exit();} 

// LQT 3.0 Image Creation Script 
// Owned by White Leo (1371368) 
$mk = "L"; 

// If the mode is in preview 
if($_GET[m] == "preview"){ 

$data = explode(':', $_GET[data]); 

// Set the data 
$currentgold = $data[0]; 
$required = $data[1]; 
$title = $data[2]; 
$qttype = $data[3]; 
$background = 'style/'.$data[4]; 
$statusbar = 'bar/'.$data[5]; 
$font = 'font/'.$data[6]; 
$fontcolor = $data[7]; 
$qtformat = $data[8]; 
$qtcode = $data[9]; 
} 
elseif($_GET[m] == "update"){ // If the mode is in update 
$filedata = file_get_contents('settings.txt'); 
$data = explode(':', $filedata); 

// Set the data 
$currentgold = $data[0]; 
$required = $data[1]; 
$title = $data[2]; 
$qttype = $data[3]; 
$background = 'style/'.$data[4]; 
$statusbar = 'bar/'.$data[5]; 
$font = 'font/'.$data[6]; 
$fontcolor = $data[7]; 
$qtformat = $data[8]; 
$qtcode = $data[9]; 

} 
else{ 
die("Invalid Mode");} 

// Get the preset code information 
if($qtformat == "Custom"){ 
$frmcode = $qtcode; 
} 
elseif(file_exists('preset.php')) 
{ 
include('preset.php'); 
$prec = count($presetc); 
$i = 0; 
while($i < $prec) { 
    if($qtformat == $presetc[$i]){ 
        $frmcode = $presetn[$i]; 
    } 
    $i++; 
}} 

$st = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ".", ":"); 
$rp = array('D', 'R', 'T', 'Y', 'C', 'S', 'Q', 'B', 'M', 'A', 'V', "W"); 

$frmcode = str_replace($rp, $st, $frmcode); 
$e = explode("@",$frmcode); 
$a = $e[0]; 
$b = $e[1]; 
$c = $e[2]; 
$d = $e[3]; 
$f = $e[4]; 

$set_bar = explode(':',$a); 
if($b[0] == "P"){ 
$set_item = explode(':',$b);} 
else{ 
$set_item = "No";} 

if($c[0] == "P"){ 
$set_title = explode(':',$c);} 
else{ 
$set_title = "No";} 

if($d[0] == "P"){ 
$set_total = explode(':',$d);} 
else{ 
$set_total = "No";} 

if($f[0] == "P"){ 
$set_perc = explode(':',$f);} 
else{ 
$set_perc = "No";} 

$b_barx = $set_bar[0]; 
$b_bary = $set_bar[1]; 
$b_distancex = $set_bar[2]; 
$b_distancey = $set_bar[3]; 
$b_itemx = $set_item[1]; 
$b_itemy = $set_item[2]; 
$b_titlex = $set_title[1]; 
$b_titley = $set_title[2]; 
$b_titlesize = $set_title[3]; 
$b_titlerotate = $set_title[4]; 
$b_totalx = $set_total[1]; 
$b_totaly = $set_total[2]; 
$b_totalsize = $set_total[3]; 
$b_totalrotate = $set_total[4]; 
$b_percx = $set_perc[1]; 
$b_percy = $set_perc[2]; 
$b_percsize = $set_perc[3]; 
$b_percrotate = $set_perc[4]; 


// Create the image 
$mk = $mk."Q"; 
// Set the canvas 
$style_type = getimagesize($background); 
if($style_type[2] == 2){ 
$canvas = imagecreatefromjpeg($background);} 
elseif($style_type[2] == 3){ 
$canvas = imagecreatefrompng($background);} 
else{ 
echo $style_type[2]."<br>"; 
die("Invalid Style Image Type<br>".$bar);} 

// Allocate Colors 
$white = imagecolorallocate($canvas, 255, 255, 255); 
$black = imagecolorallocate($canvas, 0, 0, 0); 
$mk = $mk."T"; 
// Turn the Hex Code into RGB Value 
function hex2rgb($hex){ 
 $hex = preg_replace('/^#/', '', $hex); 
  if (strlen($hex) == 3) { 
   $v = explode(':', chunk_split($hex, 1, ':')); 
   return array(16 * hexdec($v[0]) + hexdec($v[0]), 16 * hexdec($v[1]) + hexdec($v[1]), 16 * hexdec($v[2]) + hexdec($v[2])); 
  }else{ 
   $v = explode(':', chunk_split($hex, 2, ':')); 
   return array(hexdec($v[0]), hexdec($v[1]), hexdec($v[2]));}} 
    
$hx = hex2rgb($fontcolor); 
$txt_color = imagecolorallocate($canvas, $hx[0], $hx[1], $hx[2]); 

// Calcuate the Percentages 
$imgt = getimagesize($statusbar); 
$bar_width = $imgt[0] - ($b_distancex + $b_distancey); 
if($required <= 0 && $currentgold >= $required){ 
$percent = 100;} 
elseif($required <= 0 && $currentgold < $required){ 
$percent = 0;} 
else{ 
$percent = $currentgold / $required;} 


imagettftext($canvas, 3, 0, 1, $style_type[1] - 1, $black, $font, $mk); 
$bar_posx = ($bar_width * $percent) + $b_distancex; // Where the bar starts from on the left 
$questpercent = round(($percent) * 100,1); 
if($questpercent > 100){ 
$bar_width = $bar_width + $distancex;} 
$questpercent = $questpercent.'%'; 

// Merge the bar 
$bar_type = getimagesize($statusbar); 
if($bar_type[2] == 2){ 
$status_bar = imagecreatefromjpeg($statusbar);} 
elseif($bar_type[2] == 3){ 
$status_bar = imagecreatefrompng($statusbar);} 
else{ 
echo $bar_type[2]."<br>"; 
die("Invalid Status Bar Image Type<br>".$statusbar);} 
imagecopymerge($canvas,$status_bar,$b_barx,$b_bary,0,0,$bar_posx,$imgt[1],100);  

$total = $currentgold.$qttype." / ".$required.$qttype; 

// Add in the text 
$wdth = imagefontwidth($font); 
$title_width = $b_titlex - ((strlen($title) / 2) * $wdth); 
$total_width = $b_totalx - (((strlen($total) + 2) / 2) * $wdth); 
if($set_title != "No"){imagettftext($canvas, $b_titlesize, $b_titlerotate, $title_width, $b_titley, $txt_color, $font, $title);} 
if($set_total != "No") {imagettftext($canvas, $b_totalsize, $b_totalrotate, $total_width, $b_totaly, $txt_color, $font, $total);} 
if($set_perc != "No") {imagettftext($canvas, $b_percsize, $b_percrotate, $b_percx, $b_percy, $txt_color, $font, $questpercent);} 


// Add the item image 
if(file_exists('item.png')) { 
$itemname = 'item.png'; 
$item = imagecreatefrompng($itemname); 
$insert_y = imagesy($item); 
$insert_x = imagesx($item); 
imagecopymerge($canvas,$item,$b_itemx,$b_itemy,0,0,$insert_x,$insert_y,100);} 

if($_GET[m] == 'preview'){ 
header("Content-type: image/png"); 
imagepng($canvas); 
imagedestroy($canvas);} 
else{ 
header("Content-type: image/png"); 
imagepng($canvas,"qt.png"); 
imagedestroy($canvas); 
$pas = $_GET[p].'&c='.time(); 
header('Location: options.php?&t=2&p='.$pas); 
exit(); 
} 

?> 