// Swap the tab pages
function swtTab(opentab) {
var quest = true
var resetv = false

// Check if changed have been saved
if(changes == true){
quest = confirm('You have made changes in the form without saving them.\nAre you sure you want to lose those changes?')
resetv = true}

if (quest == true){
changes = false
if (resetv == true){
frmReset(current)}

// Hide the tabs
var count = 1

document.getElementById('errortext').innerHTML = ''
document.getElementById('errortext').style.display = 'none'
document.getElementById('messtext').innerHTML = ''
document.getElementById('messtext').style.display = 'none'

randMessage()
while (count <= 4){
	document.getElementById('tab' + count).style.display = 'none'
	count = count + 1
	}
 
// Open the tab
 var pick = document.getElementById(opentab)
 	pick.style.display = 'block'

if (opentab == 'tab1'){
	MM_swapImage('lk_tab1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1down.jpg','lk_tab2','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2up.jpg','lk_tab3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3up.jpg','lk_tab4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab4up.jpg',1)}
	
if (opentab == 'tab2'){
	MM_swapImage('lk_tab1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1up.jpg','lk_tab2','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2down.jpg','lk_tab3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3up.jpg','lk_tab4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab4up.jpg',1)}
	
if (opentab == 'tab3'){
	MM_swapImage('lk_tab1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1up.jpg','lk_tab2','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2up.jpg','lk_tab3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3down.jpg','lk_tab4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab4up.jpg',1)}
 
if (opentab == 'tab4'){
	MM_swapImage('lk_tab1','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1up.jpg','lk_tab2','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2up.jpg','lk_tab3','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3up.jpg','lk_tab4','','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab4down.jpg',1)}
	
current = opentab
 }
 
 }

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function reveal(src,rev) {
	var item=src.options[src.selectedIndex].value;
	obj = document.getElementById(rev);
 if(item != "Custom"){
	obj.style.display = "None";
 }
 else{
	obj.style.display = ""; 
 }
}

function frmReset(tab){
	document.getElementById('errortext').innerHTML = ''
	document.getElementById('errortext').style.display = 'none'
	document.getElementById('messtext').innerHTML = ''
	document.getElementById('messtext').style.display = 'none'
	document.getElementById('previewmsg').style.display = 'none'
if(tab == 'tab1'){
	document.getElementById("qtoptions").reset()
	changes = false
}
else if(tab == 'tab3'){
	document.getElementById("pageoptions").reset()
	changes = false
}
else if(tab == 'tab4'){
	document.getElementById("changeitem").reset()
	changes = false
}

}

function hideCheck(){
if(document.getElementById('qtformat').value != 1){
	document.getElementById('presetcode').style.display = "None"; 
}
else{
	document.getElementById('presetcode').style.display = "";
}

}

function pageload(){
	MM_preloadImages('http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1down.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2down.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3down.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab2up.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab3up.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/tab1up.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submit.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/submitover.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/reset.jpg','http://s126.photobucket.com/albums/p109/lqt_lite/3-0/resetover.jpg')

	randMessage()
	hideCheck()
	
	swtTab(current)
	
	document.getElementById('htmlcode').readOnly = true
	document.getElementById('bbcode').readOnly = true
}

function textChange(){
	changes = true
}

function frmValidate(frm,smt){
	var f = document.getElementById(frm);
	var errCount = 0
	var errMessage = '<p>'
	document.getElementById('errortext').innerHTML = ''
	document.getElementById('errortext').style.display = 'none'
	document.getElementById('messtext').innerHTML = ''
	document.getElementById('messtext').style.display = 'none'
	document.getElementById('previewmsg').style.display = 'none'

	if(frm == 'pageoptions'){
			
	}
	else if(frm == "changeitem"){
		var imagecode = /.png$/	
		if(imagecode.test(f.item.value) == false){
			errCount = errCount + 1
			errMessage = errMessage + '<b>Invalid Image</b>: You must select a PNG image<br>'
		}
	}	
	else if(frm == 'qtoptions'){
		if((f.currentgold.value >=0) == false || (f.currentgold.value == '')){
			errCount = errCount + 1
			errMessage = errMessage + '<b>Current Gold</b> must be a <b>number</b>! <br>'
		}
		if((f.goldrequired.value >= 0) == false || (f.goldrequired.value == '')){
			errCount = errCount + 1
			errMessage = errMessage + '<b>Gold Required</b> must a number greater than 0! <br>'
		}
		
		var colortest = /[^#]\w*/;
		if((colortest.test(f.colorfont.value) == false) || (f.colorfont.value.length == 6) == false){
			errCount = errCount + 1
			errMessage = errMessage + '<b>Font Color</b> is invalid or missing<br>';
		}
		if(f.customcode.value == 'Custom'){
			var forcode = /\D*[@]{1}\D*[@]{1}\D*[@]{1}\D*[@]{1}\D*/;
			if(f.formatcode.value == ''){
				errCount = errCount + 1
				errMessage = errMessage + '<b>Format Code</b> cannot be blank<br>'
			}
			else{
				if(forcode.test(f.formatcode.value) == false){
					errCount = errCount + 1	
					errMessage = errMessage + '<b>Format Code</b> is in an unreadable format<br>'
				}
			}
			
		}
		if(f.questtype.value.length > 5){
			errCount = errCount + 1
			errMessage = '<b>Quest Type</b> can be a max of 5 characters long<br>'
		}
	}
	else{
		alert('Invalid Form')
	}
	
	errMessage = errMessage + '</p>'
	if(errCount != 0){
		document.getElementById('errortext').style.display = "block"
		document.getElementById('errortext').innerHTML = errMessage	
		return true
	}
	else if(smt != 'fade'){
		document.getElementById('errortext').style.display = "none";
		f.submit()
	}
	else if(smt == 'fade'){
		return false
	}
}

function frmPreview(vSt){

if(vSt == false){

var changelog = changes
changes = false
var f = document.getElementById('qtoptions')
var c1 = f.currentgold.value
var c2 = f.goldrequired.value
var c3 = f.qttitle.value
var c4 = f.questtype.value
var c5 = f.backgroundimage.value
var c6 = f.statusbarimage.value
var c7 = f.fontfamily.value
var c8 = f.colorfont.value
var c9 = f.customcode.value
var c10 = f.formatcode.value
var sour = 'image.php?p=' + password + '&m=preview&data=' + c1 + ':' + c2 + ':' + c3 + ':' + c4 + ':' + c5 + ':' + c6 + ':' + c7 + ':' + c8 + ':' + c9 + ':' + c10
document.getElementById('qtpreview').src = sour
document.getElementById('previewmsg').style.display = 'block'
}
}

function echoError(msge){
	document.getElementById('errortext').innerHTML = msge
	document.getElementById('errortext').style.display = 'block'
}

function echoMessage(ecmsg){
	document.getElementById('messtext').innerHTML = ecmsg
	document.getElementById('messtext').style.display = 'block'
}

//-->