<div class="tab-pane" id="readbyweekday">
    <table class="table table-stripped table-hover">
        <caption>
            Nombre de livre lus par jour de la semaine
        </caption>
        <thead>
        <tr>
            <th>Jour de la semaine</th>
            <th>Nombre de livres lus</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(sizeof($this->readbyweekday) > 0){
            foreach ($this->readbyweekday as $line) {
                ?>
                <tr>
                    <td><?php echo isset($line["day"])?FullTranslations::$days[$line["day"]-1]:"Total"; ?></td>
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