<html>
  <head>
    <style type="text/css">
      * { font-family: Arial, Helvetica, sans-serif; }
    </style>
    <title>Ziz.im - Shortened URL Stats</title>
  </head>
  <body>

  <h1>Tracking Information</h1>

    <?php

      $view = "<p><strong>Shortened URL:</strong> ziz.im/".rtrim($_GET['q'], "$")."</p>";
      $view .= "<p><strong>Destination URL:</strong> ".$tracking->get_redirect_url()."</p>";
      $view .= "<p><strong>Number of clicks: </strong>" . $tracking->getClicks() . "</p>";
      $view .= "<p><strong>Timestamp last clicked: </strong>" . $tracking->getLastClick() . "</p>";

      echo $view;

    ?>

  </body>
</html>