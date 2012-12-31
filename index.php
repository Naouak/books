<?php
require_once("bootstrap.php");

    $q = DatabaseFactory::getDB()->prepare("SELECT * FROM book ORDER BY readdate DESC");
    $q->execute();
    $booklist = $q->fetchAll(PDO::FETCH_ASSOC);

    $q = DatabaseFactory::getDB()->prepare("SELECT type, COUNT(id) as count, MAX(readdate) as lastread FROM book GROUP BY type WITH ROLLUP");
    $q->execute();
    $readbytypes = ($q->fetchAll(PDO::FETCH_ASSOC));

    $q = DatabaseFactory::getDB()->prepare("SELECT MONTH(readdate) as month, COUNT(id) as count FROM book GROUP BY MONTH(readdate) WITH ROLLUP");
    $q->execute();
    $readbymonths = ($q->fetchAll(PDO::FETCH_ASSOC));


    $q = DatabaseFactory::getDB()->prepare("SELECT language, COUNT(id) as count FROM book GROUP BY language WITH ROLLUP");
    $q->execute();
    $readbylanguages = ($q->fetchAll(PDO::FETCH_ASSOC));

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

            <table class="table table-stripped table-hover">
                <caption>Livres lus en 2013</caption>
                <thead>
                    <tr>
                        <th>Date de lecture</th>
                        <th>Titre</th>
                        <th>Volume</th>
                        <th>Langue</th>
                        <th>Type de livre</th>
                        <th>Appréciation</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($booklist) > 0){
                    foreach ($booklist as $book) {
                        ?>
                        <tr>
                            <td><?=$book["readdate"]; ?></td>
                            <td><?=$book["bookname"]; ?></td>
                            <td><?=$book["volumenumber"]; ?></td>
                            <td><?=ucfirst(Translations::$language[$book["language"]]); ?></td>
                            <td><?=ucfirst(Translations::$type[$book["type"]]); ?></td>
                            <td><?php
                                if($book["liked"] == 1){
                                    echo "<span class='icon-thumbs-up'></span>";
                                } else if($book["liked"] == -1){
                                    echo "<span class='icon-thumbs-down'></span>";

                                } else {

                                }
                                ;
                             ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr class="warning">
                        <td colspan="6"><strong>Pas de livre lu encore de l'année</strong></td>
                    </tr>
                    <?php
                }

                ?>
                </tbody>
            </table>

            <table class="table table-stripped table-hover">
                <caption>
                    Nombre de livre lus par type
                </caption>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Nombre de livres lus</th>
                        <th>Dernier livre lu</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($readbytypes) > 1){
                    foreach ($readbytypes as $line) {
                        ?>
                        <tr>
                            <td><?php echo ucfirst($line["type"]?:"Total"); ?></td>
                            <td><?php echo $line["count"]; ?></td>
                            <td><?php echo $line["lastread"]; ?></td>
                        </tr>
                        <?php
                    }

                } else {
                    ?>
                    <tr class="warning">
                        <td colspan="3"><strong>Pas de livre lu encore de l'année</strong></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

            <table class="table table-stripped table-hover">
                <caption>
                    Nombre de livre lus par mois
                </caption>
                <thead>
                <tr>
                    <th>Mois</th>
                    <th>Nombre de livres lus</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($readbymonths) > 1){
                    foreach ($readbymonths as $line) {
                        ?>
                        <tr>
                            <td><?php echo isset($line["month"])?FullTranslations::$months[$line["month"]-1]:"Total"; ?></td>
                            <td><?php echo $line["count"]; ?></td>
                        </tr>
                    <?php
                    }

                } else {
                    ?>
                    <tr class="warning">
                        <td colspan="2"><strong>Pas de livre lu encore de l'année</strong></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

            <table class="table table-stripped table-hover">
                <caption>
                    Nombre de livre lus par langues
                </caption>
                <thead>
                <tr>
                    <th>Langue</th>
                    <th>Nombre de livres lus</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($readbylanguages) > 1){
                    foreach ($readbylanguages as $line) {
                        ?>
                        <tr>
                            <td><?php echo isset($line["language"])?FullTranslations::$language[$line["language"]]:"Toutes"; ?></td>
                            <td><?php echo $line["count"]; ?></td>
                        </tr>
                    <?php
                    }

                } else {
                    ?>
                    <tr class="warning">
                        <td colspan="2"><strong>Pas de livre lu encore de l'année</strong></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
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
        </div>
    </body>
</html>