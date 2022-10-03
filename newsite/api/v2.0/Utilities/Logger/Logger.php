<?php
/**
 * Logger
 *
 * Esta clase hace un tracking de la ejecucion de un script
 * 
 * Ejemplo de como inicializar la clase:
 * <code>
 * <?php
 *     use Logger\Logger;
 *     Logger::initialize();
 * </code>
 * @author  Angel Jaffet Leon Torres <contacto@angeljaffet.com>
 * @since 1.0.0
 */

namespace Logger;

use Exception;
use Logger\Curl;
use Logger\Database;

class Logger{
	
	protected static $log;
	private static $back_proccess;
	private static $exception = NULL;
	protected static $instance = NULL;

	public function __construct(){
		self::$log['resources'] = NULL;
		self::$log['identifier'] = NULL;
		self::$log['ignoreTraces'] = FALSE;
		self::$log['enableBacktrace'] = FALSE;
		self::$log['run']['init'] = microtime(true);
		self::$log['env'] = getenv();
		self::$back_proccess = dirname(__FILE__) . '/Async.php';
	}

	public function __destruct(){
		self::$log['run']['end'] = microtime(true);
		self::$log['resources'] = count( get_resources() );
		if( isset(self::$log['run']['init']) ){
			self::$log['run']['time'] = self::$log['run']['end'] - self::$log['run']['init'];
			self::saveLog();
		}
	}

	public static function initialize(){
		if( !self::$instance ){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function setIdentifier($id){
		self::$log['identifier'] = $id;
	}

	public static function ignoreTraces($traces){
		self::$log['ignoreTraces'] = is_array($traces) ? $traces : json_decode($traces, TRUE);
	}

	public static function enableBacktrace($config){
		self::$log['enableBacktrace'] = (bool) $config;
	}

	public static function setDatabaseAccess($host, $user, $pass, $dbname, $port = 3306){
		Database::setDatabaseAccess($host, $user, $pass, $dbname, $port);
	}

	public static function setDatabasePrefix($prefix){
		Database::setDatabasePrefix($prefix);
	}

	public static function initTrace($request, $extras = FALSE){
		if( gettype($request) === 'resource' && get_resource_type($request) === 'curl' ){
			Curl::initTrace($request, $extras);
		}
	}

	public static function endTrace($request, $response = ''){
		if( gettype($request) === 'resource' && get_resource_type($request) === 'curl' ){
			Curl::endTrace($request, $response);
		}
	}

	private static function saveLog(){
		$php_executable = 'php';
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			if( file_exists('C:/xampp/php/php.exe') ) $php_executable = 'C:/xampp/php/php.exe';
			elseif( file_exists('C:/MAMP/bin/php/php7.3.7/php.exe') ) $php_executable = 'C:/MAMP/bin/php/php7.3.7/php.exe';
			pclose(popen('start /B cmd /C "' . $php_executable . ' -f ' . self::$back_proccess . ' \'' . json_encode(self::$log, JSON_FORCE_OBJECT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE) . '\' >NUL 2>NUL"', 'r'));
		} else {
			if( file_exists('/usr/bin/php') ) $php_executable = '/usr/bin/php';
			elseif( file_exists('/usr/local/bin/php') ) $php_executable = '/usr/local/bin/php';
			exec($php_executable . ' -f ' . self::$back_proccess . ' \'' . json_encode(self::$log, JSON_FORCE_OBJECT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE) . '\' > /dev/null 2>&1 &');
		}
	}

	public static function getError(){
		return self::$exception;
	}

}

?>