<?php
/**
 * Logger Database
 *
 * Esta clase hace un tracking de las peticiones que se hacen mediante la DB, y configura las credenciales que se usaran para guardar los resultados cuando se establezcan
 * 
 * Ejemplo de como inicializar la clase:
 * <code>
 * <?php
 *     use Logger\Database;
 *     $db = new Database();
 * </code>
 * @author  Angel Jaffet Leon Torres <contacto@angeljaffet.com>
 * @since 1.0.0
 */

namespace Logger;

use mysqli;
use DateTime;
use Exception;
use Logger\Logger;

class Database extends Logger{
	
	private static $db = NULL;
	private static $config = NULL;
	private static $prefix = NULL;
	private static $exception = NULL;
	protected static $instance = NULL;

	public function __construct(){
		try {
			self::$prefix = self::$config['database']['prefix'];
			self::$db = new mysqli(	self::$config['database']['host'],
									self::$config['database']['user'],
									self::$config['database']['pass'],
									self::$config['database']['dbname'],
									self::$config['database']['port']      );
			if (self::$db->connect_error) {
				throw new Exception('Las credenciales no son validas');
			}
			self::$db->set_charset('utf8mb4');
			self::$db->query('SET SESSION sql_mode = "";');

			$tables = self::$db->query('SELECT COUNT(*) as total FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name LIKE "'.self::$prefix.'%"')->fetch_object();
			if($tables->total !== 4){
				self::createTables();
			}
		} catch(Exception $e) {
			self::$exception = $e->getMessage();
			return FALSE;
		}
	}

	public static function setUp($config){
		if(!self::$instance){
			self::$config = $config;
			self::$instance = new self();
		}
		return self::$db;
	}

	public static function saveLogs(){
		$info = self::$config;
		$identifier = is_array($info['identifier']) ? json_encode($info['identifier']) : $info['identifier'];
		$resources = $info['resources'];
		$starts = self::microtimeToString($info['run']['init']);
		$ends = self::microtimeToString($info['run']['end']);
		$runtime = $info['run']['time'];

		if( isset(self::$config['request']) ){
			$sql = self::$db->prepare('INSERT INTO '.self::$prefix.'_process VALUES(NULL,?,?,?,?,?)');
			$sql->bind_param('sissd', $identifier, $resources, $starts, $ends, $runtime);
			$sql->execute();
			$process_id = self::$db->insert_id;

			if( isset(self::$config['request']) && !empty(self::$config['request']) )
				self::saveRequests($process_id);
		}
	}

	private static function clearSpaces($string){
		return trim(str_replace(['  ','\t','\n','\r','\0','\x0B'], '', $string));
	}

	private static function storeString($data){
		$data = is_array($data) ? json_encode($data) : $data;
		return is_null($data) ? NULL : self::clearSpaces($data);
	}

	public static function saveRequests($process_id){
		$requests = self::$config['request'];
		foreach($requests as $req){
			$method = $req['method'];
			$url = $req['url'];
			$headers =  self::storeString($req['headers']);
			$body = self::storeString($req['body']);
			$response = self::storeString($req['response']);
			$http_code = $req['http_code'];
			$starts = self::microtimeToString($req['init']);
			$ends = self::microtimeToString($req['end']);
			$runtime = $req['time'];
			$sql = self::$db->prepare('INSERT INTO '.self::$prefix.'_request VALUES(NULL,?,?,?,?,?,?,?,?,?,?)');
			$sql->bind_param('isssssissd', $process_id, $method, $url, $headers, $body, $response, $http_code, $starts, $ends, $runtime);
			$sql->execute();
			$request_id = self::$db->insert_id;

			foreach($req['backtrace'] as $trace){
				self::saveRequestBacktrace($request_id, $trace);
			}
		}
	}

	public static function saveRequestBacktrace($request_id, $trace){
		$file = $trace['file'];
		$line = $trace['line'];
		$function = $trace['function'];
		$args = is_array($trace['args']) ? json_encode($trace['args']) : $trace['args'];
		if( strpos( strtolower($file), 'sociallabs/core/logger') === false ) {
			$sql = self::$db->prepare('INSERT INTO '.self::$prefix.'_filenames SELECT NULL,? FROM DUAL WHERE NOT EXISTS (SELECT * FROM '.self::$prefix.'_filenames WHERE filename=? LIMIT 1)');
			$sql->bind_param('ss', $file, $file);
			$sql->execute();

			if($function == 'initTrace') $args = NULL;
			$sql = self::$db->prepare('INSERT INTO '.self::$prefix.'_request_backtrace SELECT NULL,?,id,?,?,? FROM '.self::$prefix.'_filenames WHERE filename = ?');
			$sql->bind_param('iisss', $request_id, $line, $function, $args, $file);
			$sql->execute();
		}
	}

	public static function setDatabaseAccess($host, $user, $pass, $dbname, $port = 3306){
		parent::$log['saveMethods'][] = 'database';
		parent::$log['database']['host'] = $host;
		parent::$log['database']['user'] = $user;
		parent::$log['database']['pass'] = $pass;
		parent::$log['database']['dbname'] = $dbname;
		parent::$log['database']['port'] = $port;
		if( !isset(parent::$log['database']['prefix']) ) parent::$log['database']['prefix'] = 'sl_core_log_';
	}

	public static function setDatabasePrefix($prefix){
		parent::$log['database']['prefix'] = $prefix;
	}

	private static function createTables(){
		$setup = dirname(__FILE__) . '/setup.sql';
		$content = str_replace( 'tableprefix', self::$prefix, file_get_contents($setup) );
		$commands = explode(';', $content);
		foreach($commands as $command){
			if(!empty($command)){
				self::$db->query($command);
			}
		}
	}

	private static function microtimeToString($time){
		return DateTime::createFromFormat('U.u', number_format($time, 6, '.', ''))->format('Y-m-d H:i:s.u');;
	}

	public static function getError(){
		return self::$exception;
	}

}

?>