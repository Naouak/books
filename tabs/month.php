<?php
class MonthTab extends Tab{
    private $readbymonths;

    function __construct(){
        $q = DatabaseFactory::getDB()->prepare("SELECT MONTH(readdate) as month, COUNT(id) as count FROM book GROUP BY MONTH(readdate)");
        $q->execute();
        $this->readbymonths = ($q->fetchAll(PDO::FETCH_ASSOC));
    }
    /**
     * @return string
     */
    function getTab()
    {
        return '<li><a href="#readbymonth">Par mois</a></li>';
    }

    /**
     * @return string
     */
    function getPane()
    {
        ob_start();
        include("templates/month.php");
        return ob_get_clean();
    }
}