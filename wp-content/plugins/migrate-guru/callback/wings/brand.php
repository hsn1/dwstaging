<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVBrandCallback')) :
class BVBrandCallback {
	public function process($method) {
		global $bvresp, $bvcb;
		$info = $bvcb->bvmain->info;
		$transient_name = $bvcb->bvmain->brand_transient;
		switch($method) {
		case 'setbrand':
			$info->setTransient($transient_name, $_REQUEST['brand'], 86400);
			$bvresp->addStatus("setbrand", $info->getTransient($transient_name));
			break;
		case 'rmbrand':
			$info->deleteTransient($transient_name);
			$bvresp->addStatus("rmbrand", !$info->getTransient($transient_name));
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;