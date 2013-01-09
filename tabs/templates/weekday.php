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

    <?php

    if(sizeof($this->readbyweekday) > 0){
        foreach ($this->readbyweekday as &$line) {
                $line["daylabel"] = isset($line["day"])?FullTranslations::$days[$line["day"]-1]:"Total";
        }

        ?>
        <style type="text/css" scoped="scoped">
            #weekdaychart{
                width: 600px;
                height: 300px;
                margin: auto;
            }
        </style>

        <div id="weekdaychart"></div>
        <script type="text/javascript">
            YUI().use("charts",function(Y){
                var data = <?php echo json_encode($this->readbyweekday); ?>;
                var chart = new Y.Chart({
                    dataProvider: data,
                    type: "bar",
                    showLines: false,
                    styles: {
                        series: {
                            count: {
                                fill:{
                                    color: "#08C"
                                }
                            }
                        },
                        graph: {
                            background: {
                                fill: {
                                    color: "#FFF"
                                }
                            }
                        }
                    },
                    categoryKey: "daylabel",
                    seriesKeys: ["count"]
                });
                var n = Y.one("#weekdaychart");
                var p = n.get("parentNode");
                Y.one("body").append(n);
                chart.render("#weekdaychart");
                p.append(n);
            });
        </script>
        <?php
    }

    ?>
</div>
