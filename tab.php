<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Naouak
 * Date: 01/01/13
 * Time: 01:35
 * To change this template use File | Settings | File Templates.
 */ 
abstract class Tab {
    /**
     * @return string
     */
    abstract function getTab();

    /**
     * @return string
     */
    abstract function getPane();
}
