<?php
class TypeTab extends Tab{
    private $readbytypes;

    function __construct(){
        $q = DatabaseFactory::getDB()->prepare("SELECT type, COUNT(id) as count, MAX(readdate) as lastread FROM book GROUP BY type");
        $q->execute();
        $this->readbytypes = ($q->fetchAll(PDO::FETCH_ASSOC));
    }


    /**
     * @return string
     */
    function getTab()
    {
       return '<li><a href="#readbytype">Par type</a></li>';
    }

    /**
     * @return string
     */
    function getPane()
    {
        ob_start();
        include("templates/type.php");
        return ob_get_clean();
    }
}