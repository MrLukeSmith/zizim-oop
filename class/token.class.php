<?php 

  class token {

    var $token;

    function __construct($token = null){
      $this->token = $token;
    }

    function is_valid(){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $db->where("token", $this->token);
      $result = $db->get("api");

      $validity = ( count($result) == 1 )? true : false;

      return $validity;

    }

  }