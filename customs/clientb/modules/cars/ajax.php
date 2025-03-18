<h1>Voitures Client B</h1>

<?php
$client = 'clientb';
$carsData = json_decode(file_get_contents(__DIR__ . "/../../../../data/cars.json"), true);
$garagesData = json_decode(file_get_contents(__DIR__ . "/../../../../data/garages.json"), true);

$cars = array_filter($carsData, fn($car) => $car['customer'] === $client);

function getGarageName($garageId, $garages) {
    foreach ($garages as $garage) {
        if ($garage['id'] === $garageId) {
            return $garage['title'];
        }
    }
    return "Garage inconnu";
}

echo "<h2>Liste des voitures</h2>";
echo "<table border='1'>";
echo "<tr><th>Nom (minuscule)</th><th>Marque</th><th>Garage</th><th>Actions</th></tr>";
foreach ($cars as $car) {
    echo "<tr>
            <td>" . strtolower($car['modelName']) . "</td>
            <td>{$car['brand']}</td>
            <td>" . getGarageName($car['garageId'], $garagesData) . "</td>
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