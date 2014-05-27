<?php
   $view = "<h1>Tracking for ziz.im/".$_GET['q']."<br /><small>(".$tracking->get_redirect_url().")</small></h1>";
   $view .= "<p><strong>Number of clicks: </strong>" . $tracking->getClicks() . "</p>";
   $view .= "<p><strong>Timestamp last clicked: </strong>" . $tracking->getLastClick() . "</p>";

   echo $view;