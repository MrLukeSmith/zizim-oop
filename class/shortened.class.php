<?php

  class shortened extends url {

    var $alias;
    var $shortcode;
    var $short_url;

    function set_alias( $the_alias ){
      $this->alias = $the_alias;
    }

    function get_shortened_url(){
      return $this->short_url;
    }

    function alias_is_valid(){

      // Checks to make sure the alias only contains alphanumeric characters.
      $valid = ( ctype_alnum( $this->alias) ) ? true : false;
      
      return $valid;

    }

    function alias_available(){
      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $db->where("alias", $this->alias);
      $result = $db->get("url");

      $available = (count($result) == 0 ) ? true : false; 
      
      return $available;

    }

    function generate_random_string() {

      $length = 6;
      $string = "";

      $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
      
      for ($p = 0; $p < $length; $p++) {
          $string .= $characters[mt_rand(0, strlen($characters))];
      }

      return $string;

    }

    function generate_shortcode(){

      $valid = false;

      while ($valid == false){

        $this->shortcode = $this->generate_random_string();

        $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
        $db->where("shortcut", $this->shortcode);
        $result = $db->get("url");

        $valid = (count($result) == 0 ) ? true : false; 

      }

      return $valid;

    }


    function generate(){
      
      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );

      if ($this->alias){
        // Use alias. Add to database. 

        $data = array(
          'url' => $this->url,
          'alias' => $this->alias,
          'ip' => $_SERVER['REMOTE_ADDR']);

        $id = $db->insert('url', $data);

        if ($id){

          $this->short_url = "http://ziz.im/".$this->alias;
          return true; 

        } else {

          return false;

        } 

      } else {
         
        if ($this->generate_shortcode()){

          $data = array(
          'url' => $this->url,
          'shortcut' => $this->shortcode,
          'ip' => $_SERVER['REMOTE_ADDR']);

          $id = $db->insert('url', $data);

          if ($id){

            $this->short_url = "http://ziz.im/".$this->shortcode;
            return true;

          } else {

            return false; 

          }

        } else {

          return false;

        }

      }

    }

  }