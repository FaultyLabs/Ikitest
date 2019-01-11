<?php
  class API {
    static private $instance = NULL;
    private $allowedorigin = [
      "http://localhost:4000"
    ];

    private function __construct(){}
    
    static public function get(){
      if(self::$instance == NULL){
        self::$instance = new API;
      }
      return self::$instance;
    }
    
    public function authenticate(){
      $headers = getallheaders();
      if(!array_key_exists("principalheader", $headers) && $headers[API_KEY] !== API_PASS){
        echo("Invalid authentication details");
        exit;
      }
    }
  }
