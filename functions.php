<?php
// Leos Quest Tracker PHP Functions

function checkPassword($pass){
	if(file_exists('password.php')){
		include_once('password.php'); // include the document password
		if($password == "LeoIsGreat!"){
		 	die("I know Leo is great.<br> You now need to edit the <b>password.php</b> file and change your password.");
			return false;
		}
		elseif($password == $pass){ // if the passwords match
			return true;
		}

		else{
			die("Invalid Password. Cannot proceed.");
			return false;
		}
	}
	else{
		die("Password file does not exist. Cannot proceed until it is created.");
		return false;
	}
}

function openOptions(){
	if(@file_exists('settings.txt')){
		$optData = @file_get_contents('settings.txt');
		$optExplode = @explode(';', $optData);
		
		// Tab 1 data
		$value['currentgold'] = $optExplode[0];
		$value['goldrequired'] = $optExplode[1];
		$value['qttitle'] = $optExplode[2];
		$value['questtype'] = $optExplode[3];
		$value['backgroundimage'] = $optExplode[4];
		$value['statusbarimage'] = $optExplode[5];
		$value['fontfamily'] = $optExplode[6];
		$value['fontcolor'] = $optExplode[7];
		$value['qtformat'] = $optExplode[8];
		$value['formatcode'] = $optExplode[9];
		
		// Tab 3 data
		$value['allowpreset'] = $optExplode[10];
		$value['siglink'] = $optExplode[11];
	
	}
}

function getContents($dir,$typ) {
if (is_dir($dir)) { 
$fd = opendir($dir); 
$images = array();
$i = 0;  
 while (($part = @readdir($fd)) == true) { 
 $pt = explode(';',$typ);
 $ptcount = count($pt);
	while ($ptcount >= 0) {
     if ( eregi("(.".$pt[$ptcount].")$",$part) && $pt[$ptcount] != null) {
        if($part != "." && $part != "..") {$images[$i] = $part;$i++;}
        }
	$ptcount--;
	}
 }
rsort($images);
return $images;} else {
$errors[] = $dir.' is not a directory';
return false;}}

?>