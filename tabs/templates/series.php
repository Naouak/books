<div class="tab-pane" id="readbyseries">
    <table class="table table-stripped table-hover">
        <caption>
            Nombre de livre lus par series
        </caption>
        <thead>
        <tr>
            <th>Series</th>
            <th>Nombre de livres lus</th>
            <th>Appréciation</th>
            <th>Date de dernière lecture</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(sizeof($this->readbyseries) > 0){
            foreach ($this->readbyseries as $line) {
                ?>
                <tr>
                    <td><?php echo isset($line["bookname"])?$line["bookname"]:"Toutes"; ?></td>
                    <td><?php echo $line["count"]; ?></td>
                    <td><?php echo round($line["liked"],2); ?>/20</td>
                    <td><?php echo $line["lastread"]; ?></td>
                </tr>
            <?php
            }

        } else {
            ?>
            <tr class="warning">
                <td colspan="4"><strong>Pas de livre lu encore de l'année</strong></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <div class="alert alert-info">
        <p><strong>Attention sur la notation !</strong></p>
        <p>
            La notation des séries est issue d'une notation par volume selon le ressenti à la fin de chaque tome.
            Chaque livre est noté sur une échelle à trois points : aimé, indifférent, pas aimé.
        </p>
        <p>
            Ce qui veut dire que plus une série aura un grand nombre de volumes lus, plus elle a de chance d'avoir une note proche de la réalité.
        </p>
        <p>
            Notez que cette notation est une expérience afin de voir si elle exprime mieux un avis sur une série qu'une note donnée subjectivement à la fin de la lecture globale.
        </p>
    </div>
</div>