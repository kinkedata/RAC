<?php
/**
 * Cache
 *
 * Esta clase habilita la creación y lectura de un archivo .cache para poder obtener y escribir valores en un fichero de forma eficiente
 * 
 * Ejemplo de como inicializar la clase:
 * <code>
 * <?php
 *     Cache::initialize();
 * </code>
 * @author  Angel Jaffet Leon Torres <contacto@angeljaffet.com>
 * @since 1.0.0
 */
class Cache{
	private static $instance = NULL;
	private static $directory = NULL;
	private static $exception = NULL;
	private static $extension = '.tmp';

	/**
	 * Establece por defecto el directorio donde se guardaran los archivos de cache que se generen
	 */
	public function __construct(){
		self::$directory = dirname(__FILE__) . '/tmp/';
	}

	public static function initialize(){
		if( !self::$instance )
			self::$instance = new self();
		return self::$instance;
	}

	/**
	 * Regresa la ruta completa en la que se deberia encontrar el archivo de cache solicitado
	 * @param string $name Nombre del archivo solicitado
	 * @return string Ruta completa del archivo
	 */
	private static function getCacheFileName($name){
		$name = str_replace([ '/', '\\', ':', '(', ')', '{', '}', '[', ']', '¿', '?', '&', '%', '$', '@', '|' ], '-', $name);
		return self::$directory . $name . self::$extension;
	}

	/**
	 * Regresa el contenido de un archivo de cache si el tiempo especificado es menor a la ultima vez que se creo o modifico
	 * 
	 * Aqui hay un ejemplo de como llamar a esta funcion:
	 * <code>
	 * <?php
	 *     ....
	 *     $content = Cache::get('custom_name');
	 * </code>
	 * @param string $name Nombre del archivo solicitado
	 * @param bool|int $time Cantidad de segundos a validar o FALSE
	 * @return bool|string Contenido del archivo, si no FALSE 
	 */
	public static function get($name, $time = 3600){
		$file = self::getCacheFileName($name);
		if ( file_exists($file) && (!$time || time() - $time < filemtime($file)) ) 
			return file_get_contents($file);
		return FALSE;
	}

	/**
	 * Crea un archivo de cache si el directorio especificado es accesible para la lectura y escritura de datos
	 * 
	 * Aqui hay un ejemplo de como llamar a esta funcion:
	 * <code>
	 * <?php
	 *     ....
	 *     Cache::set('custom_name', 'my_content');
	 * </code>
	 * @param string $name nombre del archivo a crear
	 * @param string $content Contenido a insertar en el archivo
	 * @return bool Si el archivo se pudo crear regresa TRUE, si no FALSE
	 * @see getError
	 */
	public static function set($name, $content){
		$file = self::getCacheFileName($name);
		try{
			$content = is_array($content) ? json_encode($content, JSON_FORCE_OBJECT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE) : $content;
			$manager = @fopen($file, 'w');

			if(!$manager)
				throw new \Exception('Cache/set: No se pudo abrir el archivo.');
			if(fwrite($manager, $content) === FALSE)
				throw new \Exception('Cache/set: No se puede escribir en el archivo.');

			fclose($manager);

			return TRUE;
		} catch(\Exception $e) {
			self::$exception = $e->getMessage();
			return FALSE;
		}
	}

	/**
	 * Captura la descripcion de las excepciones generadas en cualquier llamada a algun metodo de la clase
	 * 
	 * Aqui hay un ejemplo de como se ejecutaria esta funcion:
	 * <code>
	 * <?php
	 *    ....
	 *    Cache::getError();
	 * </code>
	 * @return bool|null Si hubo una excepcion regresa la descripcion, si no NULL
	 */
	public static function getError(){
		return self::$exception;
	}
}
?>