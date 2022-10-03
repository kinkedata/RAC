<?php
class Encryption{
	private static $_nKeySize = 256; 
	
	private function __construct(){}

	final public static function encode($string, $key){
		$salt = openssl_random_pseudo_bytes(8);
		$salted = '';
		$dx = '';
		$key_length = (int) (self::$_nKeySize / 8);
		$block_length = 16;
		$salted_length = $key_length + $block_length;
		while (strlen($salted) < $salted_length){
			$dx = md5($dx.$key.$salt, true);
			$salted .= $dx;
		}
		$key = substr($salted, 0, $key_length);
		$iv = substr($salted, $key_length, $block_length);
		return base64_encode((new self())->randomSalt() . $salt . openssl_encrypt($string, "aes-".self::$_nKeySize."-cbc", $key, true, $iv));
	}

	final public static function decode($string, $key){
		if(!isset($string) || !isset($key)) return false;
		$key_length = (int) (self::$_nKeySize / 8);
		$block_length = 16;
		$data = base64_decode($string);
		$salt = substr($data, 8, 8);
		$encrypted = substr($data, 16);
		$rounds = 3;
		if (128 === self::$_nKeySize){
			$rounds = 2;
		}
		$data00 = $key.$salt;
		$md5_hash = array();
		$md5_hash[0] = md5($data00, true);
		$result = $md5_hash[0];
		for ($i = 1; $i < $rounds; $i++) {
			$md5_hash[$i] = md5($md5_hash[$i - 1].$data00, true);
			$result .= $md5_hash[$i];
		}
		$key = substr($result, 0, $key_length);
		$iv = substr($result, $key_length, $block_length);
		return openssl_decrypt($encrypted, "aes-".self::$_nKeySize."-cbc", $key, true, $iv);
	}

	private function randomSalt($length = 8) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}
}