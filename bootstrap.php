<?php

require_once("configuration.php");

session_start();

//connection to database
class DatabaseFactory{
    static private $db = null;

    static public function getDB(){
        if(self::$db == null){
            self::$db = new PDO("mysql:dbname=".Config::$database.";host=".Config::$host,Config::$username,Config::$password);
            self::$db->exec("SET NAMES 'utf-8'");
        }
        return self::$db;
    }
}

class Utilities{
    static function is_logged(){
        return isset($_SESSION["logged"])?$_SESSION["logged"]:false;
    }
}

class FullTranslations extends Translations{
    static $months = array(
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Aôut",
        "Septembre",
        "Octobre",
        "Novenbre",
        "Décembre"
    );
    static $days = array(
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi"
    );
}