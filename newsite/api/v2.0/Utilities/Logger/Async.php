<?php
include_once(dirname(__FILE__, 3) . '/Config/includes.php');

use Cache;
use Logger\Database;

$log = $argv[1];
$settings = json_decode($log, TRUE);

if( in_array('database', $settings['saveMethods'], TRUE) ){
	Database::setUp($settings);
	Database::saveLogs();
}
if( in_array('file', $settings['saveMethods'], TRUE) ) {
	$cache = new Cache();
	$cache->set('sl_core_log_'.microtime(TRUE), $log);
}