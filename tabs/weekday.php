<?php
class WeekdayTab extends Tab{
    private $readbyweekday;

    function __construct(){
        $q = DatabaseFactory::getDB()->prepare("SELECT DAYOFWEEK(readdate) as day, COUNT(id) as count FROM book GROUP BY DAYOFWEEK(readdate)");
        $q->execute();
        $this->readbyweekday = ($q->fetchAll(PDO::FETCH_ASSOC));
    }
    /**
     * @return string
     */
    function getTab()
    {
        return "<li><a href='#readbyweekday'>Par jour de la semaine</a></li>";
    }

    /**
     * @return string
     */
    function getPane()
    {
        ob_start();
        include("templates/weekday.php");
        return ob_get_clean();
    }
}