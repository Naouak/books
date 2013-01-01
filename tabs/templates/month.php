<div class="tab-pane" id="readbymonth">
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
        if(sizeof($this->readbymonths) > 0){
            foreach ($this->readbymonths as $line) {
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
</div>