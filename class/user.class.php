<?php

  class user {

    var $email;

    function __construct( $email ){
      $this->email = $email;
    }

    function register ( $password ){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );

      $data = array(
        'email' => $this->email,
        'password' => $this->hash_password($password),
        'api_token' => $this->generate_api_token());

      $id = $db->insert('user', $data);

      if ($id){

        return true; 

      } else {

        return false;

      } 

    }

    function login ( $password ){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $db->where("email", $this->email);

      $result = $db->get("user");  

      if ( count($result) == 1){

        $hash = $result[0]["password"];

        if (password_verify($password, $hash)){

          return $result[0]["api_token"];

        } else {

          return false;

        }

      } else {

        return false; 

      }

    }

    function hash_password( $password ){

      $hash = password_hash($password, PASSWORD_BCRYPT);
      return $hash;

    }

    function generate_api_token (){

      $token = uniqid('', true);
      return $token;

    }

    function email_available(){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $db->where("email", $this->email);
      $result = $db->get("user");      

      $available = (count($result) == 0 ) ? true : false; 

      return $available;

    }

  }