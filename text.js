// This file contains the information that is randomly displayed at the top of the page
var msg = new Array(4);
msg[0] = "<p>This page is currently version  <span class=\"version\">" + version + "</span>.         Make sure to keep your script up-to-date with the latest version to keep things running smoothly. <a href=\"http://lqthelp.lq.funpic.org/updates/?c=version&v=" + versioncode + "\" class=\"linksupdate\">Check for updates </a></p>";
msg[1] = "<p>If you need any help you can just click the  <img src=\"http://s126.photobucket.com/albums/p109/lqt_lite/3-0/btQ.png\" alt=\"?\" width=\"19\" height=\"19\"> next to the control you would like information about. For any problems not outlined you can just contact somone at the guild through the links list.</p>";
msg[2] = "<p>Your options page is yours alone to access, so don't share your password with anyone. If you are worried someone might have accessed your account, change the password through your host's file manager or through a FTP program immediately.</p>";
msg[3] = "<p>You are currently running the <a href=\"javascript: void(0)\" onclick=\"helppage(27908)\">full version</a> of the QT script. If you experience any problems with this version, such as page loading time, you should try the <a href=\"javascript: void(0)\" onclick=\"helppage(80554)\">lite version</a> which contains less images and features to allow for faster loading time. </p>";

var any = 0

function hidelk(){
document.getElementById('unhide').style.display = 'none'
document.getElementById('hidetext').style.display = 'block'	
document.getElementById('hide').style.display = 'block'	
}

function unhidelk(){
document.getElementById('unhide').style.display = 'block'
document.getElementById('hidetext').style.display = 'none'	
document.getElementById('hide').style.display = 'none'	
}

function randMessage(){
any = Math.floor(msg.length * Math.random())
var message = msg[any]

document.getElementById('hidetext').innerHTML = message
}
