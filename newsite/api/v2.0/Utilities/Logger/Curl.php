<?php
/**
 * Logger Curl
 *
 * Esta clase hace un tracking de las peticiones que se hacen mediante curl
 * 
 * Ejemplo de como inicializar la clase:
 * <code>
 * <?php
 *     use Logger\Curl;
 *     $curl = new Curl();
 * </code>
 * @author  Angel Jaffet Leon Torres <contacto@angeljaffet.com>
 * @since 1.0.0
 */

namespace Logger;

use Exception;
use Logger\Logger;

class Curl extends Logger{
	
	private static $exception = NULL;

	public static function initTrace($request, $options = FALSE){
		try{
			if( gettype($request) !== 'resource' || get_resource_type($request) !== 'curl' ) throw new Exception('El recurso no es un recurso CURL');
			$id = self::getId($request);
			curl_setopt($request, CURLINFO_HEADER_OUT, TRUE);
			parent::$log['request'][$id]['init'] = microtime(true);
			if( $options ) parent::$log['request'][$id]['options'] = $options;
			if( parent::$log['enableBacktrace'] ) parent::$log['request'][$id]['backtrace'] = debug_backtrace();
		} catch(Exception $e) {
			self::$exception = $e->getMessage();
			return FALSE;
		}
	}

	public static function endTrace($request, $response = ''){
		try{
			if( gettype($request) !== 'resource' || get_resource_type($request) !== 'curl' ) throw new Exception('El recurso no es un recurso CURL');
			$id = self::getId($request);
			parent::$log['request'][$id]['end'] = microtime(true);
			self::getUrl($request);
			self::getBody($request);
			self::getMethod($request);
			self::getErrors($request);
			self::getHeaders($request);
			parent::$log['request'][$id]['response'] = str_replace(array("\r\n", "\r", "\n", "\t"), '', $response);
			self::getHttpCode($request);
			parent::$log['request'][$id]['time'] = self::$log['request'][$id]['end'] - self::$log['request'][$id]['init'];
			unset( parent::$log['request'][$id]['options'] );
			if( parent::$log['ignoreTraces'] && is_array(parent::$log['ignoreTraces']) && in_array(parent::$log['request'][$id]['url'], parent::$log['ignoreTraces']) )
				unset( parent::$log['request'][$id] );
		} catch(Exception $e) {
			self::$exception = $e->getMessage();
			return FALSE;
		}
	}

	private static function getId($resource){
		return (int) $resource;
	}

	private static function getErrors($resource){
		$id = self::getId($resource);
		parent::$log['request'][$id]['error'] = curl_error($resource);
	}

	private static function getUrl($resource){
		$id = self::getId($resource);
		parent::$log['request'][$id]['url'] = parent::$log['request'][$id]['options'][CURLOPT_URL] ?? explode(' ', curl_getinfo($resource, CURLINFO_EFFECTIVE_URL))[0];
	}

	private static function getMethod($resource){
		$id = self::getId($resource);
		parent::$log['request'][$id]['method'] = parent::$log['request'][$id]['options'][CURLOPT_CUSTOMREQUEST] ?? explode(' ', curl_getinfo($resource, CURLINFO_HEADER_OUT))[0];
	}

	private static function getHttpCode($resource){
		$id = self::getId($resource);
		parent::$log['request'][$id]['http_code'] = curl_getinfo($resource, CURLINFO_HTTP_CODE);
		if(curl_getinfo($resource, CURLINFO_HTTP_CODE) == 0) parent::$log['request'][$id]['response'] = curl_error($resource);
	}

	private static function getBody($resource){
		$id = self::getId($resource);
		parent::$log['request'][$id]['body'] = parent::$log['request'][$id]['options'][CURLOPT_POSTFIELDS] ?? NULL;
	}

	private static function getHeaders($resource){
		$id = self::getId($resource);
		parent::$log['request'][$id]['headers'] = parent::$log['request'][$id]['options'][CURLOPT_HTTPHEADER] ?? curl_getinfo($resource, CURLINFO_HEADER_OUT);
	}

	public static function getError(){
		return self::$exception;
	}

}

?>