<?php
class LanguageTab extends Tab{
    private $readbylanguages;

    function __construct(){
        $q = DatabaseFactory::getDB()->prepare("SELECT language, COUNT(id) as count FROM book GROUP BY language");
        $q->execute();
        $this->readbylanguages = ($q->fetchAll(PDO::FETCH_ASSOC));
    }
    /**
     * @return string
     */
    function getTab()
    {
        return '<li><a href="#readbylanguage">Par langue</a></li>';
    }

    /**
     * @return string
     */
    function getPane()
    {
        ob_start();
        include("templates/language.php");
        return ob_get_clean();
    }
}