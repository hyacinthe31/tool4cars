<h1>Voitures Client C</h1>

<?php
$client = 'clientc';
$carsData = json_decode(file_get_contents(__DIR__ . "/../../../../data/cars.json"), true);
$cars = array_filter($carsData, fn($car) => $car['customer'] === $client);

echo "<h2>Liste des voitures</h2>";
echo "<table border='1'>";
echo "<tr><th>Nom</th><th>Marque</th><th>Couleur</th><th>Actions</th></tr>";
foreach ($cars as $car) {
    echo "<tr>
            <td>{$car['modelName']}</td>
            <td>{$car['brand']}</td>
            <td style='background-color: {$car['colorHex']}; width: 50px;'>&nbsp;</td>
            <td><button class='view-car' data-id='{$car['id']}'>Voir</button></td>
          </tr>";
}
echo "</table>";
?>

<script>
    $(".view-car").click(function() {
        let carId = $(this).data("id");
        $(".dynamic-div").load(`customs/edit.php?carId=${carId}`);
    });
</script>