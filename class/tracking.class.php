<?php
  
  class tracking extends redirect {

    var $clicks;
    var $lastClick;

    function pullStats(){

      $db = new Mysqlidb( constant('DB_HOST'), constant('DB_USER'), constant('DB_PASS'), constant('DB_NAME') );
      $params = array($this->url_id);
      $result = $db->rawQuery("SELECT * FROM track WHERE urlID = ? ORDER BY timeClicked DESC", $params);

      $this->clicks = count($result);

      $this->lastClick = $result[0]['timeClicked'];

    }

    function getClicks(){
      return $this->clicks;
    }

    function getLastClick(){
      return $this->lastClick;
    }

  }