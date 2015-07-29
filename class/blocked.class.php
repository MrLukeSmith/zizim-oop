<?php 

  class blocked {

    var $ip;

    function __construct($ip = null){
      $this->ip = $ip;
    }

    function is_blocked(){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $db->where("ip", $this->ip);
      $result = $db->get("blocked");

      $validity = ( count($result) == 1 )? true : false;

      return $validity;

    }

  }