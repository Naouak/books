<?php
require_once("bootstrap.php");
    require_once("tab.php");

$tabs = array();

if ($handle = opendir('tabs')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && substr($entry,-3) == "php") {
             $tabs[] = $entry;
        }
    }
    closedir($handle);
}

   foreach($tabs as $k => $v){
       $name = explode("-",$v,2);
       if(is_numeric($name[0])){
           $name = $name[1];
       } else {
           $name = $v;
       }
       $name = ucfirst(substr($name,0,-4))."Tab";

       require_once("tabs/".$v);

       $tabs[$k] = new $name();
   }

?><!doctype html>
<html>
    <head>
        <title>Lectures de <?=Config::$displayname; ?> en 2013</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/bootstrap-responsive.css">
    </head>

    <body>
        <div class="container">
            <h1>Lectures de <?=Config::$displayname; ?> en 2013</h1>
            <div id="stats-tabs">
            <ul class="nav nav-tabs" data-toggle="tab">
                <?php
                foreach ($tabs as $t) {
                    /** @var $t Tab */
                    echo $t->getTab();
                }

                ?>
            </ul>
            <div class="tab-content">
                <?php
                foreach ($tabs as $t) {
                    /** @var $t Tab */
                    echo $t->getPane();
                }

                ?>
            </div>
            </div>






<?php
if(Utilities::is_logged()){
?>
            <form action="add_book.php" method="post" class="form-horizontal">
                <fieldset>
                    <legend>Ajouter un livre</legend>

                    <div class="control-group">
                        <label class="control-label" for="bookname">Titre du livre</label>
                        <div class="controls">
                            <input type="text" name="bookname" id="bookname">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="volumenumber">Volume n°</label>
                        <div class="controls">
                            <input type="number" value="1" min="1" step="1" name="volumenumber" id="volumenumber">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="language">Langue</label>

                        <div class="controls">
                            <select name="language" id="language">
                                <?php
                                foreach (Translations::$language as $k => $v) {
                                    echo "<option value='$k'>".ucfirst($v)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="type">Type de livre</label>
                        <div class="controls">
                            <select name="type" id="type">
                                <?php
                                foreach (Translations::$type as $k => $v) {
                                    echo "<option value='$k'>".ucfirst($v)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="liked">Appréciation</label>
                        <div class="controls">
                            <label class="radio text-error">
                                <input type="radio" name="liked" id="disliked" value="-1" />
                                Pas aimé
                            </label>
                            <label class="radio text-info">
                                <input type="radio" name="liked" id="meh" value="0">
                                Pas d'avis
                            </label>
                            <label class="radio text-success">
                                <input type="radio" name="liked" id="liked" value="1">
                                Aimé
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">
                                Ajouter
                            </button>
                        </div>
                    </div>

                </fieldset>
            </form>
<?php
}
?>
            <script src="http://yui.yahooapis.com/3.8.0/build/yui/yui.js"></script>
            <script type="text/javascript">
                YUI().use("gallery-bootstrap-tabview",function(Y){
                    var tabs = new Y.Bootstrap.TabView({node: '#stats-tabs'});
                });
            </script>
        </div>
    </body>
</html>