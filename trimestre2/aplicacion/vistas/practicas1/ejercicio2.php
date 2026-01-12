
    <h1>LANZAMIENTO DE UN DADO</h1>
<?php
    for ($i = 1; $i <= 6; $i++) {
        echo "<p>lanzamiento $i del dado: " . mt_rand(1, 6) . "</p>";
    }

    define("n", 1000);
    $l1 = 0;
    $l2 = 0;
    $l3 = 0;
    $l4 = 0;
    $l5 = 0;
    $l6 = 0;

    echo "<p>lanzado el dado " . n . " veces</p>";
    for ($i = 0; $i < n; $i++) {
        switch (mt_rand(1, 6)) {
            case 1:
                $l1++;
                break;
            case 2:
                $l2++;
                break;
            case 3:
                $l3++;
                break;
            case 4:
                $l4++;
                break;
            case 5:
                $l5++;
                break;
            case 6:
                $l6++;
                break;
            default:
                break;
        }
    }

    echo "<p>el 1 ha salido $l1 veces con un porcentaje de " . ($l1 / 10) . "%</p>";
    echo "<p>el 2 ha salido $l2 veces con un porcentaje de " . ($l2 / 10) . "%</p>";
    echo "<p>el 3 ha salido $l3 veces con un porcentaje de " . ($l3 / 10) . "%</p>";
    echo "<p>el 4 ha salido $l4 veces con un porcentaje de " . ($l4 / 10) . "%</p>";
    echo "<p>el 5 ha salido $l5 veces con un porcentaje de " . ($l5 / 10) . "%</p>";
    echo "<p>el 6 ha salido $l6 veces con un porcentaje de " . ($l6 / 10) . "%</p>";

    echo "</br>";
    echo CHTML::link("Volver", Sistema::app()->generaURL(["practicas1", "miindice"]));