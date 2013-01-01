<?php
class HistoryTab extends Tab{

    private $booklist;

    function __construct(){
        $q = DatabaseFactory::getDB()->prepare("SELECT * FROM book ORDER BY readdate DESC");
        $q->execute();
        $this->booklist = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return string
     */
    function getTab()
    {
        return "<li><a href='#read'>Historique</a></li>";
    }

    /**
     * @return string
     */
    function getPane()
    {
        ob_start();
        include("templates/history.php");
        return ob_get_clean();
    }
}