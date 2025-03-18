<h1>Voitures Client A</h1>

<?php
$client = 'clienta';
$carsData = json_decode(file_get_contents(__DIR__ . "/../../../../data/cars.json"), true);
$cars = array_filter($carsData, fn($car) => $car['customer'] === $client);

// Fonction pour calculer l'âge de la voiture
function getCarAge($year) {
    $currentYear = date("Y");
    return $currentYear - date("Y", $year);
}

echo "<h2>Liste des voitures</h2>";
echo "<table border='1'>";
echo "<tr><th>Nom</th><th>Marque</th><th>Année</th><th>Puissance (ch)</th><th>Actions</th></tr>";
foreach ($cars as $car) {
    $carAge = getCarAge($car['year']);
        
    // Appliquer une couleur en fonction de l'âge de la voiture
    $rowColor = "";
    if ($carAge > 10) {
        $rowColor = "red"; // Plus de 10 ans
    } elseif ($carAge < 2) {
        $rowColor = "green"; // Moins de 2 ans
    }

    echo "<tr style='background-color: $rowColor'>
            <td>{$car['modelName']}</td>
            <td>{$car['brand']}</td>
            <td>" . date("Y", $car['year']) . "</td>
            <td>{$car['power']} ch</td>
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