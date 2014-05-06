<?php

  class redirect {

    var $query; 
    var $redirect_url;
    var $url_id;

    function __construct( $q ){
      $this->query = $q;
      $this->process();
    }

    function process(){
      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $params = array($this->query, $this->query);
      $result = $db->rawQuery("SELECT * FROM url WHERE shortcut = ? OR alias = ?", $params);

      if (isset($result[0]['url'])){
        $this->redirect_url = $result[0]['url'];
        $this->url_id = $result[0]['ID'];
      }
    }

    function is_valid(){

      $validity = ( $this->redirect_url != "" )? true : false;

      return $validity;

    }

    function get_redirect_url(){
      return $this->redirect_url;
    }

    function track(){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );

      $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "N/A";

      $data = array(
          'urlID' => $this->url_id,
          'referrer' => $referrer,
          'ip' => $_SERVER['REMOTE_ADDR']);

        $id = $db->insert('track', $data);

        if ($id){
          return true;
        } else {
          return false;
        }

    }

  }