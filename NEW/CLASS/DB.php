<?php

  require "../config.php";

  try {

    $DB = new PDO('mysql:host=' . $config["host"] . '; dbname=' . $config["table"] . '; charset=utf8', '' . $config["user"] . '', '' . $config["pass"] . '');
    $connect = true;

  } catch (Exception $e) {
    echo '<div class="error">Exception reçue : ',  $e->getMessage(), "</div>";
    $connect = false;
  }
