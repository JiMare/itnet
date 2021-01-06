<?php

class Databaze{

    private static $spojeni;

    private static $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    
    public static function pripoj($host, $uzivatel,$heslo, $databaze){
        if(!isset(self::$spojeni)){
            self::$spojeni = new PDO("mysql:host=$host;dbname=$databaze", $uzivatel, $heslo, self::$nastaveni);
        }
        return self::$spojeni;
    }
   
    public static function dotaz($sql, $parametry = array()){
    $dotaz = self::$spojeni->prepare($sql);
    $dotaz->execute($parametry);
    return $dotaz;
    }



}