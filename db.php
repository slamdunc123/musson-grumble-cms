<?php
// database connection 
  $dbSelector = false;
      if ($dbSelector) {
        $mysqli = new mysqli('localhost', 'slamdunc_admin', 'PHPb0bbins1', 'slamdunc_musson_grumble') or die($mysqli->error());
      } else {
        $mysqli = new mysqli('localhost', 'root', '', 'musson_grumble_backend') or die($mysqli->error());
      }
?>