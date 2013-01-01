<?php
class SeriesTab extends Tab{
    private $readbyseries;

    function __construct(){
        $q = DatabaseFactory::getDB()->prepare("SELECT bookname, COUNT(id) as count, MAX(readdate) as lastread, AVG(liked)*10+10 as liked FROM book GROUP BY bookname ORDER BY liked DESC");
        $q->execute();
        $this->readbyseries = ($q->fetchAll(PDO::FETCH_ASSOC));
    }
    /**
     * @return string
     */
    function getTab()
    {
        return '<li><a href="#readbyseries">Par série</a></li>';
    }

    /**
     * @return string
     */
    function getPane()
    {
        ob_start();
        include("templates/series.php");
        return ob_get_clean();
    }
}