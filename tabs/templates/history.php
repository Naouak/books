<div class="tab-pane" id="read">
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
        if(sizeof($this->booklist) > 0){
            foreach ($this->booklist as $book) {
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
</div>