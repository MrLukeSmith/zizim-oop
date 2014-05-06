<?php

  require('../db.config.php');

  require_once('../class/Mysqlidb.php');

  require('../class/token.class.php');
  require('../class/url.class.php');
  require('../class/shortened.class.php');
  

  if ( isset($_GET['token'])) {

    $token = new token($_GET['token']);

    if ($token->is_valid()){

      if ( isset($_GET['url']) && (isset($_GET['action'])) ){

        $url = new shortened( $_GET['url'] );
        // Creates a new shortened object with the URL provided

        if ($_GET['action'] == "generate"){

          if ($url->is_valid()){
            // Checks the URL is 'valid'

            if ( (isset($_GET['alias']))) {
              // If an alias has been provided

              $url->set_alias( $_GET['alias'] );
              // Sets the alias of the shortened object. 
              
              if ($url->alias_is_valid()){
                // Checks to make sure the alias is valid (alphanumberic)

                if ($url->alias_available()){

                  // The alias isn't in use. Generate the short URL.
                  
                  if ($url->generate()){

                    // Return the shortened URL
                    echo json_encode( array( 'url' => $url->get_shortened_url()) );

                  } else {

                    // Return an error message if something goes wrong.
                    echo json_encode( array( 'error' => 'internal_error', 'note' => 'Sorry, something went wrong. Please try again.' ) );

                  }

                } else {

                  // The alias has already been used
                  echo json_encode( array( 'error' => 'alias_exists', 'note' => 'That alias has already been used, please choose another.' ) );

                }

              } else {
                // The alias wasn't valid
                echo json_encode( array( 'error' => 'alias_not_alphanumeric', 'note' => 'The alias needs to be Alphanumeric.' ) );

              }

            } else {

              // No ALIAS. Generate URL.
              if ($url->generate()){

                // Return the shortened URL
                echo json_encode( array( 'url' => $url->get_shortened_url()) );

              } else {

                // Return an error message if something goes wrong.
                echo json_encode( array( 'error' => 'internal_error', 'note' => 'Sorry, something went wrong. Please try again.' ) );

              }

            }

          } else {
            
            // URL isn't valid, return an error message. Malformed etc.. 
            echo json_encode( array( 'error' => 'invalid_url', 'note' => 'Please enter a valid URL.' ) );

          }

        } else if ($_GET['action'] == "stats") {
          
          // Check the URL is valid. 
          // Get the stats for $url
          echo json_encode( array( 'note' => 'Sorry. The statistics aspect of Zizim API::v1 is still under development.' ) );

        }

      } else {

        // No URL, or ACTION, provided.
        echo json_encode( array( 'error' => 'missing_url', 'note' => 'Please enter a valid URL, and an API action are provided. http://ziz.im/api/docs.php' ) );

      }

    } else {

      // The token provided wasn't valid
      echo json_encode( array( 'error' => 'api_token_invalid', 'note' => 'Invalid API token provided. If you\'ve forgotten your token, please visit http://ziz.im/api/login.php to obtain it.' ) );

    }

  } else {

    // No URL was provided
    echo json_encode( array( 'error' => 'api_token_missing', 'note' => 'No API token provided. If you don\'t have one, please visit http://ziz.im/api/register.php to obtain one.' ) );

  }