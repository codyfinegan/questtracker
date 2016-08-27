<?php
// Leos Quest Trackers
// Created by White Leo (Gaia Id: 1371368)

$version = "3.0 Lite";
$versioncode = "sdgntdx";

if($_GET[mode] == 'endinstall' && file_exists('installation.php')){
	include('password.php');
	@unlink('installation.php');
	die("Installation is complete. Click <a href='options.php?p=$password'>here to continue</a>.");
}

include_once('functions.php'); // include the php functions that run the script

if(checkPassword($_GET[p]) == false){ // check the password function
exit();}

// Get the Url of the webpage
$url = "http://".$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$cnt = strlen($url);
if($url[$cnt - 1] != '/'){$url = $url.'/';}

// Get the contents of the three folders
$backContents = getContents("style","jpg;png");
$backCount = count($backContents);
$fontContents = getContents("font","ttf");
$fontCount = count($fontContents);
$barContents = getContents("bar","jpg;png");
$barCount = count($barContents);

// Set the current tab
$currentTab = "tab".$_GET[t];
if($_GET[t] == null || !$_GET[t]){ // If the current tab is null set it to the default value
	$currentTab = "tab1";
}

// when the item is uploaded
if($_GET[mode] == "update" && $_GET[target] == "changeitem"){

$target_path = "";
/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path = $target_path . "item.png"; 

// check the filesize and the other things about the image

if($_FILES['item']['type'] == 'image/x-png'){

if(move_uploaded_file($_FILES['item']['tmp_name'], $target_path)) {
    header('Location: options.php?p='.$_GET[p].'&t=2&action=pass&c='.time());
	exit();
} else{
    header('Location: options.php?p='.$_GET[p].'&t=4&action=fail&c='.time());
	exit();
}
} else{
    header('Location: options.php?p='.$_GET[p].'&t=4&action=fail2&c='.time());
	exit();
}

}
elseif($_GET[mode] == "update" && $_GET[target] == "pageoptions"){
// When the page options are updated

$url = $_POST[siglink];
$filename = 'url.txt';
$fh = fopen($filename, 'w') or die("can't open file");
fwrite($fh, $url);
fclose($fh);
header('Location: options.php?p='.$_GET[p].'&t=3');
exit();
}
elseif($_GET[mode] == "update" && $_GET[target] == "qtoptions"){
// Update the options
// There will short be any validation because there should have been on the user side

// Validation tools

// Write to file
$filename = 'settings.txt';
$file_data = $_POST[currentgold].":".$_POST[goldrequired].":".$_POST[qttitle].":".$_POST[questtype].":".$_POST[backgroundimage].":".$_POST[statusbarimage].":".$_POST[fontfamily].":".$_POST[colorfont].":".$_POST[customcode].":".$_POST[formatcode];
$fh = fopen($filename, 'w') or die("can't open file");
fwrite($fh, $file_data);
fclose($fh);

// Redirect to create the image
header('Location: image.php?m=update&p='.$_GET[p]);
exit();
}

if(@file_exists('preset.php'))
{
include('preset.php');
$qtformatcount = count($presetc);
}

$page_data = @file_get_contents('settings.txt');
$qtdata = @explode(':',$page_data);

$value['siglink'] = @file_get_contents('url.txt');

// Set the values
$value['currentgold'] = $qtdata[0];
$value['goldrequired'] = $qtdata[1];
$value['qttitle'] = $qtdata[2];
$value['questtype'] = $qtdata[3];
$value['backgroundimage'] = $qtdata[4];
$value['statusbarimage'] = $qtdata[5];
$value['fontfamily'] = $qtdata[6];
$value['fontcolor'] = $qtdata[7];
$value['qtformat'] = $qtdata[8];
$value['formatcode'] = $qtdata[9];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<!--
************** DO NOT REMOVE THIS HEADER **************
Leo's Quest Tracker Script - Created by White Leo (Gaia Id: 1371368)
Version 
Terms of Use
1. This script may not be resold to anyone, or used to make a profit.
2. This header must not be removed
3. You may modify this script, as long as the Watermark and Header are not removed

Thanks and Credit
1. Woroni, for being my Php resource and for creating the original customer management system
2. teh ebil ducky, for the idea of the Gaia Quest Logs, and for hosting the minishop
3. To everyone else in the Thread, you all were wonderful in helping out

Visit the Guild for Updates to the Script or to get help
************** DO NOT REMOVE THIS HEADER **************
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Lqt - Options Page</title>
<link href="theme_blue.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
<!--
var version = '<? echo $version; ?>'
var versioncode = '<? echo $versioncode; ?>'

//-->
</script>
<script type='text/javascript' src='script.js'></script>
<script type='text/javascript' src='text.js'></script>
<script type='text/javascript'>
<!--
if (window != window.top)
top.location.href = location.href;

var changes = false
var current = '<? echo $currentTab; ?>'

var password = '<? echo $_GET[p]; ?>'

function leave(){
	document.getElementById('qtpreview').src = 'display.php?c=<? echo time(); ?>'
	document.getElementById('previewmsg').style.display = 'none'
	swtTab('tab1')
}

function helppage(page){
var pagename = 'http://lqthelp.lq.funpic.org/help.php?p=' + page
var winRef = window.open(pagename,'help')
winRef.focus()
}

//-->
</script>
<style type="text/css">
<!--
#tab2 p {
}

#tab1, #tab2, #tab3, #tab4 {
	display:none;
}

#<? echo $currentTab; ?> {
	display:block;
}
-->
</style>
</head>

<body onLoad="pageload();<? if($value[qtformat] == "Custom"){ echo "document.getElementById('presetcode').style.display = 'block';"; }?><? if(($_GET[t] == 4 && $_GET[action] == 'fail2')||($_GET[t] == 4 && $_GET[action] == 'fail')){echo "echoError('<b>Item Error</b>: Could not upload item image. Make sure it was a valid PNG file.')";} ?>">

<noscript>
<style type="text/css">
<!--
#hidetext, #hide, #unhide, #lk_tab1, #lk_tab2, #lk_tab3, #submit1, #submit2, #reset1, #reset2 {
	display: none;
}

#tab1, #tab2, #tab3, #tab4 {
	display:block;
}
-->
</style>
</noscript>

<table width="620" border="1" align="center" cellpadding="2" cellspacing="2" >
  <tr>
    <td valign="top">&nbsp;</td>
    <td><h1 align="center"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/logo1.jpg" alt="Logo" width="39" height="46"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/title_blue.jpg" alt="Leo's Quest Trackers" name="Title" width="377" height="50" id="Title"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/logo1.jpg" alt="Logo" width="39" height="46"><br>
        <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/optionspage.jpg" alt="Options Page" width="354" height="36"></h1></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="6" valign="top">&nbsp;</td>
    <td valign="top"><div align="center">
      <noscript>
        <p>Your browser has not got javascript enabled. Some user interface may be lost.</p>
        </noscript>
      
    
    <div class="randomtext" id="hidetext" align="center">	</div>		  </div>	</td>
    <td rowspan="6">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" valign="middle"><div class="footer" id="unhide" style="display:none">
      <div align="right"><a href="Javascript: void(0);" onclick="hidelk()" class="linksupdate">Unhide</a></div>
    </div>
	<div class="footer" id="hide" style="display:block">
      <div align="right"><a href="Javascript: void(0);" onclick="unhidelk()" class="linksupdate">Hide</a></div>
    </div>	</td>
  </tr>
<? if(@!file_exists('item.png')){ ?>
  <tr>
    <td align="center" valign="middle"><p><font color="#990000">You do not have an item image uploaded.<br>
	Please add one through the Change Item form before you try to generate your QT.</font></p>    </td>
  </tr>
<? } 
elseif(@!file_exists('qt.png')){ ?>
  <tr>
    <td align="center" valign="middle"><p>Please make sure all files have been uploaded before you generate your QT for the first time.</p>    </td>
  </tr>
<? } ?>
  <tr>
    <td align="center" valign="middle"><p><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1down.jpg" alt="tab1" name="lk_tab1" width="105" height="31" border="0" id="lk_tab1" onClick="swtTab('tab1')"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab4up.jpg" alt="tab4" name="lk_tab4" width="105" height="31" id="lk_tab4" onClick="swtTab('tab4')"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2up.jpg" alt="tab2" name="lk_tab2" width="105" height="31" id="lk_tab2" onClick="swtTab('tab2')"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3up.jpg" alt="tab3" name="lk_tab3" width="105" height="31" id="lk_tab3" onClick="swtTab('tab3')"></p>    </td>
  </tr>
  <tr>
    <td valign="top" align="center"><div class="validate" id="errortext" style="display:none"></div>
	<div class="mess" id="messtext" style="display:none"></div>
</td>
  </tr>
  <tr>
    <td valign="top">
		<div id="tab1">
			<div class="mess" id="previewmsg" style="display:none"><p><b>You are now in Preview Mode</b><br>
	    <a href="Javascript: void(0);" onClick="leave();">Leave Preview</a></p>
		<img src="" id="qtpreview" alt="Could not load preview">
	</div>
      <p align="center"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/qtOption.jpg" alt="QT Options" width="354" height="36"><br>
        These are the options relating to your quest tracker.</p>
      <form action="options.php?p=<? echo $_GET[p]; ?>&mode=update&target=qtoptions&c=<? echo time(); ?>" method="post" enctype="multipart/form-data" name="qtoptions" id="qtoptions">
        <div align="center">
          <table border="1" align="center" cellpadding="2" cellspacing="1" id="tbl_qtoptions">
            <tr>
              <td><div align="right">Current Gold </div></td>
                <td align="left" valign="middle"><div align="left">
                  <input name="currentgold" type="text" class="smalltext" id="currentgold" onChange="textChange()" value="<? echo $value['currentgold']; ?>" size="12">
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(40194);"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
                <td width="20" align="left" valign="middle">&nbsp;</td>
                <td><div align="right">Background Image </div></td>
                <td align="left" valign="middle"><div align="left" onClick="textChange()">
                  <select name="backgroundimage" size="1" class="listtext" id="backgroundimage">
					<? $tmpCount = 0;
					while($tmpCount < $backCount){ ?>
                    <option <? if($value['backgroundimage'] == $backContents[$tmpCount]) { echo "selected";} ?> value="<? echo $backContents[$tmpCount]; ?>"><? echo $backContents[$tmpCount]; ?></option>
					<? $tmpCount++;
					} ?>
                    </select>
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(33406)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
              </tr>
            <tr>
              <td><div align="right">Gold Required</div></td>
                <td align="left" valign="middle"><div align="left">
                  <input name="goldrequired" type="text" class="smalltext" id="goldrequired" onChange="textChange()" value="<? echo $value['goldrequired']; ?>" size="12">
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(24798)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
                <td width="20" align="left" valign="middle">&nbsp;</td>
                <td><div align="right">Staus Bar Image </div></td>
                <td align="left" valign="middle"><div align="left">
                  <select name="statusbarimage" size="1" class="listtext" id="statusbarimage" onChange="textChange()">
					<? $tmpCount = 0;
					while($tmpCount < $barCount){ ?>
                    <option <? if($value['statusbarimage'] == $barContents[$tmpCount]) { echo "selected";} ?> value="<? echo $barContents[$tmpCount]; ?>"><? echo $barContents[$tmpCount]; ?></option>
					<? $tmpCount++;
					} ?>
                    </select>
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(35745)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
              </tr>
            <tr>
              <td><div align="right">QT Title </div></td>
                <td align="left" valign="middle"><div align="left">
                  <input name="qttitle" type="text" class="smalltext" id="qttitle" onChange="textChange()" value="<? echo $value['qttitle']; ?>" size="16">
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(68719)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
                <td width="20" align="left" valign="middle">&nbsp;</td>
                <td><div align="right">Font Family </div></td>
                <td align="left" valign="middle"><div align="left">
                  <select name="fontfamily" size="1" class="listtext" id="fontfamily" onChange="textChange()">
					<? $tmpCount = 0;
					while($tmpCount < $fontCount){ ?>
                    <option <? if($value['fontfamily'] == $fontContents[$tmpCount]) { echo "selected";} ?> value="<? echo $fontContents[$tmpCount]; ?>"><? echo $fontContents[$tmpCount]; ?></option>
					<? $tmpCount++;
					} ?>
                    </select>
                </div></td>
                <td align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(87951)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
              </tr>
            <tr>
              <td><div align="right">Quest Type </div></td>
                <td align="left" valign="middle"><div align="left">
                  <input name="questtype" type="text" class="smalltext" id="questtype" onChange="textChange()" value="<? echo $value['questtype']; ?>" size="6" maxlength="5">
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(23498)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
                <td width="20" align="left" valign="middle">&nbsp;</td>
                <td><div align="right">Font Color #</div></td>
                <td align="left" valign="middle"><div align="left">
                  <input name="colorfont" type="text" class="smalltext" id="colorfont" onChange="textChange()" value="<? echo $value['fontcolor']; ?>" size="16">
                </div></td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(36545)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td><div align="right">QT Format </div></td>
                <td align="left" valign="middle"><div align="left">
                  <select name="customcode" size="1" class="listtext" id="qtformat" onChange="reveal(this,'presetcode');textChange()">
					<? $i = 0; while($i < $qtformatcount) { ?>
					<option value="<? echo $presetc[$i]; ?>" <? if($value[qtformat] == $presetc[$i]) {echo "selected";} ?>><? echo $presetc[$i ]; ?></option>
					<? $i++; } ?>
					
					<option value="Custom" <? if($value[qtformat] == "Custom") {echo "selected";} ?>>Custom Code</option>
                    </select>
                </div></td>
                <td align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(219850)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
              </tr>
            <tr id="presetcode" style="display:none">
              <td>&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle">&nbsp;</td>
                <td width="20" align="left" valign="middle">&nbsp;</td>
                <td><div align="right">Format Code </div></td>
                <td align="left" valign="middle"><div align="left">
                <input name="formatcode" type="text" class="smalltext" id="formatcode" onClick="textChange()" value="<? echo $value['formatcode']; ?>" size="20">
                </div>			</td>
                <td width="20" align="left" valign="middle"><a href="javascript: void(0);" onClick="helppage(21968)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
		      </tr>
            <tr>
              <td colspan="7"><div align="center">
			  <? if(@file_exists('item.png')){ ?>
                <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg" alt="Submit" width="105" height="31" id="submit1" onClick="frmValidate('qtoptions','bob')" onMouseOver="MM_swapImage('submit1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg')" onMouseOut="MM_swapImage('submit1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg')" onMouseDown="MM_swapImage('submit1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitdown.jpg')" onMouseUp="MM_swapImage('submit1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg')">
                &nbsp;
                &nbsp;
                <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/preview.jpg" alt="Preview" name="preview1" width="105" height="31" id="preview1" onClick="frmPreview(frmValidate('qtoptions','fade'))" onMouseOver="MM_swapImage('preview1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/previewover.jpg')" onMouseOut="MM_swapImage('preview1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/preview.jpg')" onMouseDown="MM_swapImage('preview1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/previewdown.jpg')" onMouseUp="MM_swapImage('preview1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/previewover.jpg')">
                &nbsp;
                &nbsp;
				<? } ?>
                <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg" alt="Reset" name="reset1" width="105" height="31" id="reset1" onClick="frmReset('tab1')" onMouseOver="MM_swapImage('reset1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg')" onMouseOut="MM_swapImage('reset1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg')" onMouseDown="MM_swapImage('reset1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetdown.jpg')" onMouseUp="MM_swapImage('reset1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg')">
<noscript>     
               &nbsp;
			   &nbsp;
			   </noscript>
              </div>		        </td>
              </tr>
          </table>
        </div>
      </form>
      </div>
		<div id="tab2">
        <p align="center"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/viewmode.jpg" alt="View Mode" width="354" height="36"><br>
          This is the code you place in your signature box to display your quest tracker. You can modify it, but we suggest you keep the URL link as it is and change where it points to in your page options. This way the target page will not be loaded with any frames.        </p>
        <div align="center">
          <table border="1" cellpadding="2" cellspacing="1" id="tbl_viewmode">
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><img src="display.php?c=<? echo time(); ?>" alt="Click here to generate your QT image again" name="qt" border="1" id="qt"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><strong>BB Code for Forums </strong></td>
              <td><strong>Html Code for Webpages</strong> </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><textarea name="bbcode" rows="3" class="sigcode" id="bbcode">[url=<? echo $url; ?>link.php][img]<? echo $url; ?>display.php[/img][/url]</textarea></td>
              <td><textarea name="htmlcode" rows="3" class="sigcode" id="htmlcode">&lt;a href="<? echo $url; ?>link.php"&gt;&lt;img src="<? echo $url; ?>display.php"&gt;&lt;/a&gt;</textarea></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="Javascript: void(0);" class="linksupdate" onClick="document.getElementById('bbcode').select()">Select BB Code</a> </td>
              <td><a href="Javascript: void(0);" class="linksupdate" onClick="document.getElementById('htmlcode').select()">Select Html Code</a> </td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        <p align="center">&nbsp;</p>
      </div>
	
	<div id="tab3">
		<div align="center"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/pageoptions.jpg" alt="Page Options" width="354" height="36"><br>
		  These are the options that relate to the page and the QT files in general.<br>
		  Leave the Sig Link Blank to have it redirect to the guild.	    </div>
		<form action="options.php?p=<? echo $_GET[p]; ?>&mode=update&target=pageoptions&c=<? echo time(); ?>" method="post" name="pageoptions" id="pageoptions">
		  <div align="center">
		    <table border="1" cellpadding="2" cellspacing="1" id="tbl_pageoptions">
		      <tr>
		        <td><div align="right">Sig Link </div></td>
				  <td><div align="left">
				    <input name="siglink" type="text" class="smalltext" id="siglink" onClick="textChange()" value="<? echo $value['siglink']; ?>" size="30">
				  </div></td>
				  <td><a href="javascript: void(0);" onClick="helppage(57845)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
			  </tr>
		      <tr>
		        <td colspan="3"><div align="center"> <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg" alt="Submit" name="submit3" width="105" height="31" id="submit3" onClick="frmValidate('pageoptions','bob')" onMouseDown="MM_swapImage('submit3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitdown.jpg',0)" onMouseUp="MM_swapImage('submit3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg',0)" onMouseOver="MM_swapImage('submit3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg',0)" onMouseOut="MM_swapImage('submit3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg',0)"> &nbsp;
		          &nbsp; <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg" alt="Reset" name="reset3" width="105" height="31" id="reset3" onClick="frmReset('tab1')" onMouseOver="MM_swapImage('reset3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg',0)" onMouseOut="MM_swapImage('reset3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg',0)" onMouseDown="MM_swapImage('reset3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetdown.jpg',0)" onMouseUp="MM_swapImage('reset3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg',0)">
                    <noscript>
  &nbsp;
&nbsp;
                    </noscript>
                </div>
		        <div align="left"></div></td>
			  </tr>
            </table>
	      </div>
		</form>
        <p align="center">&nbsp;</p>
    </div>	
	<div id="tab4">
      <div align="center">
        <p><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/changeitem.jpg" alt="Change Item" width="354" height="36"><br>
          The item that is displayed on your Quest Tracker can be changed here.<br>
          The image will overwrite the one currently displayed on the Quest Tracker.<br>
          This is used as most host's block outside linking, so using just an image link wouldn't work.</p>
        <div align="center">
          <form action="options.php?p=<? echo $_GET[p]; ?>&mode=update&target=changeitem&c=<? echo time(); ?>" method="post" enctype="multipart/form-data" name="changeitem" id="changeitem">
            <table border="1" cellpadding="2" cellspacing="1" id="tbl_changeitem">
              <tr>
                <td colspan="3"><div align="center"><img src="item.png?c=<? echo time(); ?>" alt="No Item Avalible"></div></td>
                </tr>
              <tr>
                <td><div align="right">Upload Item </div></td>
                <td><div align="left">
                  <input name="item" type="file" class="upload" id="item" onChange="textChange()">
				  <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
</div></td>
                <td><a href="javascript: void(0);" onClick="helppage(35498)"><img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png" alt="?" width="19" height="19" border="0"></a></td>
              </tr>
              <tr>
                <td><div align="right"></div></td>
                <td><div align="left"></div></td>
                <td><a href="help.php?p="></a></td>
              </tr>
              <tr>
                <td colspan="3"><div align="center"> <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg" alt="Submit" name="submit4" width="105" height="31" id="submit4" onClick="frmValidate('changeitem','bob')" onMouseDown="MM_swapImage('submit4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitdown.jpg',0)" onMouseUp="MM_swapImage('submit4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg',0)" onMouseOver="MM_swapImage('submit4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg',0)" onMouseOut="MM_swapImage('submit4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg',0)"> &nbsp;
                  &nbsp; <img src="http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg" alt="Reset" name="reset4" width="105" height="31" id="reset4" onClick="frmReset('tab4')" onMouseOver="MM_swapImage('reset4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg',0)" onMouseOut="MM_swapImage('reset4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg',0)" onMouseDown="MM_swapImage('reset4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetdown.jpg',0)" onMouseUp="MM_swapImage('reset4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg',0)">
                        <noscript>
                        &nbsp;
&nbsp;
                        </noscript>
                  </div>
                    <div align="left"></div></td>
              </tr>
            </table>
            </form>
          </div>
        </div>
	  <form action="options.php?mode=update&target=pageoptions" method="post" name="pageoptions" id="pageoptions">
        <div align="center"></div>
	    </form>
    </div></td>
  </tr>
</table>
<p class="pagefooter">Leo's Quest Trackers (Script and images) were created by <a href="http://www.gaiaonline.com/profile/index.php?view=profile.ShowProfile&item=1371368" target="_blank">White Leo</a> of <a href="http://www.gaiaonline.com" target="_blank">GaiaOnline</a> <br>
If you have any questions or comments you can leave them at the guild</p>
</body>
</html>
