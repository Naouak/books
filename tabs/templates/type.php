<div class="tab-pane" id="readbytype">
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
        if(sizeof($this->readbytypes) > 0){
            foreach ($this->readbytypes as $line) {
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
</div>