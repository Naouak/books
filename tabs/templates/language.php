<div class="tab-pane" id="readbylanguage">
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
        if(sizeof($this->readbylanguages) > 0){
            foreach ($this->readbylanguages as $line) {
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
</div>