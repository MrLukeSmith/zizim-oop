<?php

  require('db.config.php');
  require('class/MysqliDb.php');
  require('class/redirect.class.php');
  require('class/tracking.class.php');


  if (isset($_GET['q'])){

    if (substr($_GET['q'], -1) == "$"){

      // Show tracking information.
      $tracking = new tracking( rtrim($_GET['q'], '$') );
      $tracking->pullStats();
      
      include('view/tracking.php');

    } else {

      $url = new redirect($_GET['q']);

      if ($url->is_valid()){
        // The URL was found. Redirect.
        
        $url->track();
        // Add the click / tracking information

        header( "HTTP/1.1 301 Moved Permanently" );  
        header('location:'.$url->get_redirect_url());
        // Perform the redirect

      } else {
        // The URL was not found. 

        header( "HTTP/1.1 301 Moved Permanently" );  
        header('location:index.php?error=url_not_found');
        // Redirect to the login page.

      }

    }

  }