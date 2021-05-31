<?php

  class Connection
  {
    public static function connect(): PDO
    {
      $link = new PDO(
         "mysql:host=localhost;dbname=pos",
         "root",
         ""
      );

      $link->exec("set names utf8");

      return $link;
    }
  }
