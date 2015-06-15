<?php

	session_start();
	require_once("../include/check_install.inc.php");
	require_once("../include/globals.inc.php");
	require_once("../include/ui_module.inc.php");
	require_once("../include/common.inc.php");
	require_once("../include/browserdetection.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

    <link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<script src="../js/prototype.js" type="text/javascript"></script>
	<script src="../js/scriptaculous.js" type="text/javascript"></script>
	<script src="../js/common.js" type="text/javascript"></script>
	<script src="../js/autorun.js" type="text/javascript"></script>
	<script src="../js/zombie.js" type="text/javascript"></script>
	<script src="../js/module.js" type="text/javascript"></script>
	<script src="../js/log.js" type="text/javascript"></script>	
	<script src="../js/msf.js" type="text/javascript"></script>
        
<?php
	// config check
	if(!file_exists(BASE_DIR)) {
		beef_js_error("BASE_DIR needs to be configured. Edit globals.inc.php");
		return;
	}
?>

	<script>
 		var zl  = new ZombieList(<?php echo HEARTBEAT_FREQUENCY; ?>);
 		var ar  = new Autorun();
 		var mod = new Module(<?php echo  HEARTBEAT_FREQUENCY; ?>);
 		var log = new Log(<?php echo SUMMARY_LOG_HEARTBEAT_FREQUENCY; ?>);

		var beefPeriodicalExecuter = true;
 		var peZ = new PeriodicalExecuter(function(pe) { if (beefPeriodicalExecuter) { zl.heartbeat();  } else { if (pe) { pe.stop();} } }, zl.frequency);
 		var peM = new PeriodicalExecuter(function(pe) { if (beefPeriodicalExecuter) { mod.heartbeat(); } else { if (pe) { pe.stop();} } }, mod.frequency);
		var peL = new PeriodicalExecuter(function(pe) { if (beefPeriodicalExecuter) { log.heartbeat(); } else { if (pe) { pe.stop();} } }, log.frequency);

		// ---[ START_EXECUTER
		function start_executer() { beefPeriodicalExecuter = true; }

		// ---[ STOP_EXECUTER
		function stop_executer()  { beefPeriodicalExecuter = false; }

		// ---[ BEEF_ERROR
		function beef_error(error_string) {
			new Effect.Shake('beef_icon');
			alert(error_string);
		}

		// ---[ SELECT_ZOMBIE
		function select_zombie(zombie) {
			zl.select_zombie(zombie);
		}

		// ---[ CHANGE_ZOMBIE
		function change_zombie(zombie) {
			zl.set_current_zombie(zombie);
			display_zombie_section();
		}

		// ---[ SEND_CODE ∑¢ÀÕ¥˙¬Î
		function do_send(code) {
			zl.send_code(code);
		}

		// ---[ GET_MODULE_RESULTS
		function get_module_results(results_id) {
			new Ajax.Updater('module_results', 'get_module_details.php?result_id=' + results_id, {asynchronous:true});
		}

		// ---[ DISPLAY_GENERAL
		function display_general(page) {
			new Ajax.Updater('general_content', page, {asynchronous:true});
			display_general_section();
		}

		// ---[ CHANGE_MODULE
		function change_module(module) {
			new Ajax.Updater('module_content', module, {asynchronous:true, evalScripts: true});
			display_module_section();
		}

		// ---[ DISPLAY_MODULE_SECTION
		function display_module_section() {
			new Element.hide('zombie_section');
			new Element.hide('general_section');
			new Element.hide('module_results');
			new Element.show('module_section');
		}

		// ---[ DISPLAY_ZOMBIE_SECTION
		function display_zombie_section() {
			new Element.hide('general_section');
			new Element.hide('module_section');
			new Element.show('zombie_section');
		}

		// ---[ DISPLAY_GENERAL_SECTION
		function display_general_section() {
			new Element.hide('zombie_section');
			new Element.hide('module_section');
			new Element.show('general_section');
		}

		// ---[ TOGGLE_SLIDE_DIV
		function toggle_slide_div(div, menu_div) {
			current_menu_html = $(menu_div).innerHTML;

			// check if hidden or shown
			if(current_menu_html.match(/Hide/)) {
				new Effect.SlideUp(div, {duration:1});
				new_menu_html = current_menu_html.replace('Hide', 'Show');
				$(menu_div).innerHTML = new_menu_html;
			} else {
				new Effect.SlideDown(div, {duration:1});
				new_menu_html = current_menu_html.replace('Show', 'Hide');
				$(menu_div).innerHTML = new_menu_html;
			}
		}
		
		// --[ OPEN_WINDOW
		function open_window(url, name) {
			window.open(url, name,"scrollbars,width=800,height=600,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes");
		}
		
		function unsafe_content_view(zombie) {
			open_window("get_zombie_details.php?zombie=" + zombie + "&detail=unsafe_content", zombie);
		}

		start_executer();
	</script>

</head>
<body>

	<!-- PAGE HEADER -->
	<div id="pageheader">
		<!-- MENU -->
		<div class="menu">
	
			<ul> <!-- OPTIONS MENU -->
				<li><a href="list.php">ÈÄâÊã©Ê®°Âùó</a>
					<ul>
					<?php echo get_standard_module_menu() ?>
					<?php echo get_network_module_menu() ?>
					</ul>
				</li>
			</ul>
		</div>
    </div>
</body>
</html>