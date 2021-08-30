<?php

  class Connection
  {
    public static function connect(): PDO
    {
      
      
      //mysql://bad56afeeec69e:c25f632e@us-cdbr-east-04.cleardb.com/heroku_fbe38b75ba63a97?reconnect=true
      
      //host = us-cdbr-east-04.cleardb.com
      //dbname = heroku_fbe38b75ba63a97
      //username =bad56afeeec69e
      //password =c25f632e
      
//      $link = new PDO(
//         "mysql:host=localhost;dbname=pos",
//         "root",
//         ""
//      );
      
//      $link = new PDO(
//         "mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_fbe38b75ba63a97",
//         "bad56afeeec69e",
//         "c25f632e"
//      );
      
      $link = new PDO(
         "ec2-3-222-11-129.compute-1.amazonaws.com;dbname=d9olkh54oodcas",
         "sdyoobmitxkzkm",
         "6cce158829788c5aafc72a20d68a43db78b87bbf75a6a9a434b161872a68ece8"
      );

      $link->exec("set names utf8");

      return $link;
    }
  }
