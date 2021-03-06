<?php

  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
  
  require('../db.config.php');

  require_once('../class/MysqliDb.php');

  require('../class/token.class.php');
  require('../class/url.class.php');
  require('../class/shortened.class.php');
  require('../class/blocked.class.php');
  require('../class/user.class.php');
  


  $blocked = new blocked($_SERVER['REMOTE_ADDR']);
  
  if ( !$blocked->is_blocked() ){

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

    } else if ($_GET['action'] == "register"){
        
        // Add a check to see if the email parameter is present. 
        $user = new user($_GET['email']);

        if ($user->email_available()){

          if ($user->register($_GET['password'])){

            echo json_encode( array( 'note' => 'Account created successfully.' ) );

          } else {

            echo json_encode( array( 'error' => 'internal_error', 'note' => 'Sorry, something went wrong. Please try again.' ) );

          }

        } else {

          echo json_encode( array( 'error' => 'email_already_used', 'note' => 'There\'s already an account with that email address' ) );

        }

    } else if ($_GET['action'] == "login"){

      $user = new user ($_GET['email']);

      $login = $user->login($_GET['password']);

      if (!$login){

        echo json_encode( array( 'error' => 'incorrect_credentials', 'note' => 'There was no match for the credentials you provided.' ) );

      } else {

        echo json_encode( array( 'api_token' => $login ) );

      }

    } else {

      echo json_encode( array( 'error' => 'internal_error', 'note' => 'Sorry, something went wrong. Please try again.' ) );

    }

  } else {

    // IP Address is blocked
    echo json_encode( array( 'error' => 'ip_blocked', 'note' => 'You must\'ve done something naughty, becuase this IP has been blocked. If you think this is a mistake, get in touch.' ) );

  }