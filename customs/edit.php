<?php
$carId = isset($_GET['carId']) ? intval($_GET['carId']) : 0;
$carsData = json_decode(file_get_contents(__DIR__ . "/../data/cars.json"), true);
$car = array_filter($carsData, fn($c) => $c['id'] === $carId);
$car = reset($car);

if (!$car) {
    echo "<p>Voiture introuvable.</p>";
    exit;
}

echo "<h2>Détails de la voiture</h2>";
echo "<p><strong>Modèle:</strong> {$car['modelName']}</p>";
echo "<p><strong>Marque:</strong> {$car['brand']}</p>";
echo "<p><strong>Année:</strong> " . date("Y", $car['year']) . "</p>";
echo "<p><strong>Puissance:</strong> {$car['power']} ch</p>";
echo "<p><strong>Couleur:</strong> <span style='background-color: {$car['colorHex']}; width: 50px;'>&nbsp;&nbsp;&nbsp;&nbsp;</span></p>";

echo "<button id='back-to-list'>Retour</button>";
?>

<script>
    $("#back-to-list").click(function() {
        let client = "<?= $_COOKIE['client_id'] ?>";
        $(".dynamic-div").load(`customs/${client}/modules/cars/ajax.php`);
    });
</script>