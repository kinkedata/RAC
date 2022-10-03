<?php
use Logger\Logger;

class Request{
    private static $curl = NULL;
    private static $multi_curl = array();
    private static $multi_curl_handle = NULL;
    private static $curl_error = '';
    private static $curl_options = [];

    public static function add($method, $url, $headers = FALSE, $fields = FALSE){
        $counter = count(self::$multi_curl);
        if($counter == 0) self::$multi_curl_handle = curl_multi_init();
        
        self::$multi_curl[$counter] = curl_init();
        curl_setopt(self::$multi_curl[$counter], CURLOPT_URL, $url);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_TIMEOUT, 60);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_ENCODING, '');
        curl_setopt(self::$multi_curl[$counter], CURLOPT_MAXREDIRS, 10);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_SAFE_UPLOAD, TRUE);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt(self::$multi_curl[$counter], CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        if(!empty($fields)) curl_setopt(self::$multi_curl[$counter], CURLOPT_POSTFIELDS, $fields);
        if(!empty($headers)) curl_setopt(self::$multi_curl[$counter], CURLOPT_HTTPHEADER, $headers);

        curl_multi_add_handle(self::$multi_curl_handle, self::$multi_curl[$counter]);
    }

    public static function execute($callback){
        $active = NULL;

        do { 
            $multi_curl_exec = curl_multi_exec(self::$multi_curl_handle, $active); 
        } while($multi_curl_exec == CURLM_CALL_MULTI_PERFORM);

        while ( $active && $multi_curl_exec == CURLM_OK ) {
            if ( curl_multi_select(self::$multi_curl_handle) != -1 ) { 
                do { 
                    $mrc = curl_multi_exec(self::$multi_curl_handle, $active); 
                } while( $mrc == CURLM_CALL_MULTI_PERFORM ); 
            }
        }

        foreach(self::$multi_curl as $request){
            $content = curl_multi_getcontent($request);
            if ( is_callable($callback) ) { 
                $callback($content); 
            }
            curl_multi_remove_handle(self::$multi_curl_handle, $request); 
        }

        curl_multi_close(self::$multi_curl_handle);

        self::$multi_curl = array();
        self::$multi_curl_handle = curl_multi_init();
    }

    public static function make($method, $url, $headers = FALSE, $fields = FALSE){
        self::$curl_options = [];
        self::$curl_options[CURLOPT_URL] = $url;
        self::$curl_options[CURLOPT_TIMEOUT] = 60;
        self::$curl_options[CURLOPT_ENCODING] = '';
        self::$curl_options[CURLOPT_MAXREDIRS] = 10;
        self::$curl_options[CURLOPT_SAFE_UPLOAD] = TRUE;
        self::$curl_options[CURLOPT_RETURNTRANSFER] = TRUE;
        self::$curl_options[CURLOPT_SSL_VERIFYHOST] = FALSE;
        self::$curl_options[CURLOPT_SSL_VERIFYPEER] = FALSE;
        self::$curl_options[CURLOPT_CUSTOMREQUEST] = $method;
        self::$curl_options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        if(!empty($fields)) self::$curl_options[CURLOPT_POSTFIELDS] = $fields;
        if(!empty($headers)) self::$curl_options[CURLOPT_HTTPHEADER] = $headers;
        return self::sendRequest();
    }

    private static function sendRequest(){
        self::$curl_error = NULL;
        self::$curl = curl_init();
        curl_setopt_array(self::$curl, self::$curl_options);
        Logger::initTrace(self::$curl, self::$curl_options);
        $response = curl_exec(self::$curl);
        Logger::endTrace(self::$curl, $response);
        self::$curl_error = curl_error(self::$curl);
        curl_close(self::$curl);
        if(self::$curl_error) return FALSE;
        return $response;
    }

    public static function getRequestError(){
        return self::$curl_error;
    }

    public static function getError(){
        if(!empty(self::$curl_error)) return self::$curl_error;
        return self::$error;
    }
}