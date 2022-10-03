<?php
/**
 * Sendinblue
 *
 * Esta clase habilita el envio de correos mediante Sendinblue
 * 
 * @author  Angel Jaffet Leon Torres <contacto@angeljaffet.com>
 * @since 1.0.0
 * @link https://developers.sendinblue.com/
 */
class Sendinblue{
	private static $config = NULL;
	private static $instance = NULL;

	public function __construct($token){
		self::$config = (object) array();
		self::$config->token = $token;
		self::$config->subject = NULL;
		self::$config->template = NULL;

		self::$config->to_mail = NULL;
		self::$config->to_name = NULL;
		self::$config->reply_mail = NULL;
		self::$config->reply_name = NULL;
		self::$config->sender_mail = NULL;
		self::$config->sender_name = NULL;
	}

	public static function initialize($token){
		if( !self::$instance )
			self::$instance = new self($token);
		return self::$instance;
	}

	public static function setSubject($subject){
		self::$config->subject = $subject;
	}

	public static function setDestinatary($email, $name = ''){
		self::$config->to_mail = $email;
		self::$config->to_name = $name;
	}

	public static function setSender($email, $name = ''){
		self::$config->reply_mail = $email;
		self::$config->reply_name = $name;
		self::$config->sender_mail = $email;
		self::$config->sender_name = $name;
	}

	public static function setReply($email, $name = ''){
		self::$config->reply_mail = $email;
		self::$config->reply_name = $name;
	}

	public static function getTemplate($filepath){
		self::$config->template = file_get_contents($filepath);
		return self::$config->template;
	}

	public static function send($content = NULL){
		if( empty($content) )
			$content = self::$config->template;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_TIMEOUT => 30,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_SSL_VERIFYHOST => FALSE,
			CURLOPT_SSL_VERIFYPEER => FALSE,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_URL => 'https://api.sendinblue.com/v3/smtp/email',
			CURLOPT_POSTFIELDS => json_encode([ 
				'htmlContent' => $content,
				'subject' => self::$config->subject,
				'to' =>  [ ['email' => self::$config->to_mail, 'name' => self::$config->to_name ] ],
				'sender' => ['email' => self::$config->sender_mail, 'name' => self::$config->sender_name],
				'replyTo' => ['email' => self::$config->reply_mail, 'name' => self::$config->reply_name]
			]),
			CURLOPT_HTTPHEADER => array(
				'accept: application/json',
				'content-type: application/json',
				'api-key: ' . self::$config->token
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if( $err )
			return FALSE;
		return TRUE;
	}
}