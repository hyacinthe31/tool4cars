<?php
$garageId = isset($_GET['garageId']) ? intval($_GET['garageId']) : 0;
$garagesData = json_decode(file_get_contents(__DIR__ . "/../data/garages.json"), true);
$garage = array_filter($garagesData, fn($g) => $g['id'] === $garageId);
$garage = reset($garage);

if (!$garage) {
    echo "<p>Garage introuvable.</p>";
    exit;
}

echo "<h2>Détails du Garage</h2>";
echo "<p><strong>Nom:</strong> {$garage['title']}</p>";
echo "<p><strong>Adresse:</strong> {$garage['address']}</p>";

echo "<button id='back-to-list'>Retour</button>";
?>

<script>
    $("#back-to-list").click(function() {
        $(".dynamic-div").load(`customs/clientb/modules/garages/ajax.php`);
    });
</script>