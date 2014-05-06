<?php 

  class url {

    var $url;

    function __construct( $the_url ){
      $this->url = $the_url;
      $this->process();
    }

    function get_url(){
      return $this->url;
    }

    function process(){
      if ( ( stripos($this->url,'http://') === false ) && ( stripos($this->url,'https://') === false ) && ( stripos($this->url,'ftp://') === false ) ) {
            $this->url = "http://".$this->url;
        }
    }

    function is_valid(){

      // Run a basic validation on the URL
        $valid = ((preg_match('#http\:\/\/[aA-zZ0-9\.]+\.[aA-zZ\.]+#',$this->url)) || (preg_match('#https\:\/\/[aA-zZ0-9\.]+\.[aA-zZ\.]+#',$this->url))) ? true : false;


        if ( stripos($this->url, 'ziz.im') ){ $valid = false; }

        // Output the JSON encoded result. Returning the 'validated' URL for use in the generation process.
        return $valid;
    }
    
  }