<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVMiscCallback')) :
class BVMiscCallback {
	function enableBadge() {
		global $bvcb;
		return $bvcb->bvmain->info->updateOption("bvBadgeInFooter", "yes");
	}

	function disableBadge() {
		global $bvcb;
		return $bvcb->bvmain->info->deleteOption("bvBadgeInFooter");
	}

	function process($method) {
		global $bvcb, $bvresp;
		$info = $bvcb->bvmain->info;
		switch ($method) {
		case "enableBadge":
			$bvresp->addStatus("status", $this->enableBadge());
			break;
		case "disablebadge":
			$bvresp->addStatus("status", $this->disableBadge());
			break;
		case "getoption":
			$output = $info->getOption($_REQUEST['opkey']);
			$bvresp->addStatus('getoption', $output);
			break;
		case "setdynplug":
			$info->updateOption('bvdynplug', $_REQUEST['dynplug']);
			$bvresp->addStatus("setdynplug", $info->getOption('bvdynplug'));
			break;
		case "unsetdynplug":
			$info->deleteOption('bvdynplug');
			$bvresp->addStatus("unsetdynplug", $info->getOption('bvdynplug'));
			break;
		case "setptplug":
			$info->updateOption('bvptplug', $_REQUEST['ptplug']);
			$bvresp->addStatus("setptplug", $info->getOption('bvptplug'));
			break;
		case "unsetptplug":
			$info->deleteOption('bvptlug');
			$bvresp->addStatus("unsetptplug", $info->getOption('bvptlug'));
			break;
		case "wpupdateplugins":
			$bvresp->addStatus("wpupdateplugins", wp_update_plugins());
			break;
		case "wpupdatethemes":
			$bvresp->addStatus("wpupdatethemes", wp_update_themes());
			break;
		case "phpinfo":
			phpinfo();
			die();
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;