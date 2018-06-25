<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('MigrateGuru')) :
	
require_once dirname( __FILE__ ) . '/main/lib.php';
require_once dirname( __FILE__ ) . '/main/site_info.php';
require_once dirname( __FILE__ ) . '/main/auth.php';
require_once dirname( __FILE__ ) . '/main/db.php';

class MigrateGuru {
	public $version = '1.51';
	public $plugname = 'migrateguru';
	public $brandname = 'Migrate Guru';
	public $brand_transient = 'bvmgbrand';
	public $appurl = 'https://mg.blogvault.net';
	public $slug = 'migrate-guru/migrateguru.php';
  public $plug_redirect = "bvmgredirect";
	public $lib;
	public $info;
	public $auth;
	public $db;
	function __construct() {
		$this->lib = new MGLib();
		$this->info = new MGSiteInfo($this->lib);
		$this->auth = new MGAuth($this->info);
		$this->db = new MGDb();
	}

	public function appUrl() {
		if (defined('BV_APP_URL')) {
			return BV_APP_URL;
		} else {
			return $this->appurl;
		}
	}

	public function authenticatedUrl($method, $apicheck = null, $full = true) {
		$_params = $this->auth->newAuthParams($this->version);
		if ($apicheck) {
			$_params['bvapicheck'] = $apicheck;
		}
		$qstr = http_build_query($_params);
		if (!$full)
			return $method."?".$qstr;
		return $this->appUrl().$method."?".$qstr;
	}
	
	public function isConfigured() {
		return $this->auth->defaultPublic();
	}

	function getMonitTime() {
		return $this->info->getOption('bvmonittime') ?: 0;
	}

	public function setMonitTime() {
		return $this->info->updateOption('bvmonittime', time());
	}

	public function isActivePlugin() {
		$expiry_time = time() - (3 * 24 * 3600);
		return ($this->getMonitTime() > $expiry_time);
	}

	public function isProtectModuleEnabled() {
		return ($this->info->getOption('bvptplug') === $this->plugname) &&
				$this->isActivePlugin();
	}

	public function isDynSyncModuleEnabled() {
		return ($this->info->getOption('bvdynplug') === $this->plugname) &&
				$this->isActivePlugin();
	}

	public function pingbv($method) {
		$body = array();
		$this->info->basic($body);
		$body['plug'] = $this->plugname;
		$url = $this->authenticatedUrl($method);
		$this->lib->http_request($url, $body);
	}

	public function setup($rand_secret) {
		$this->info->updateOption('bvSecretKey', $rand_secret);
		$this->info->updateOption($this->plug_redirect, 'yes');
		$this->info->updateOption('bvActivateTime', time());
	}

	public function isActivateRedirectSet() {
		if ($this->info->getOption($this->plug_redirect) === 'yes') {
			$this->info->updateOption($this->plug_redirect, 'no');
			return true;
		}
		return false;
	}

	public function activate() {
		if (!isset($_REQUEST['blogvaultkey'])) {
			##BVKEYSLOCATE##
		}
		if ($this->isConfigured()) {
			/* This informs the server about the activation */
			$this->pingbv('/bvapi/activate');
		} else {
			$this->setup($this->lib->randString(32));
		}
	}

	public function deactivate() {
		$this->pingbv('/bvapi/deactivate');
	}

	public static function uninstall() {
	}
}
endif;