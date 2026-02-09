<?php
echo "Enlace a nueva: ";
echo CHTML::dibujaEtiqueta("a", ["href" => Sistema::app()->generaURL(["partida", "nueva"])]);
echo CHTML::dibujaEtiqueta("img", ["src" => "../../imagenes/16x16/nuevo.png"], "", true);
echo CHTML::dibujaEtiquetaCierre("a");

echo CHTML::dibujaEtiqueta("form");

?>
<form method="get" action="#">
    <select id="crupi" name="crupi">
        <?php
        foreach ($crupiers as $crupier => $key) {
            $selected = "";

            if ($crupier === $crupierSelect) {
                $selected = "selected";
            }
            echo  "<option value=" . $key . " $selected> $crupier</option>";
        }
        ?>
    </select>
    <button type="submit">Ver</button>
</form>

<?php
foreach ($PartidasCrupi as $partida) {
    $this->dibujaVistaParcial(
        "partida",
        [
            "partida" => $partida
        ]
    );
}

// if (isset($_POST["btn"])) {
//     foreach ($Partidas as $partida) {
//         if ($partida->crupier === $_POST["crupi"]) {
//         }
//     }
// }
