<h1>Garages Client B</h1>

<?php
$client = 'clientb';
$garagesData = json_decode(file_get_contents(__DIR__ . "/../../../../data/garages.json"), true);
$garages = array_filter($garagesData, fn($garage) => $garage['customer'] === $client);

echo "<h2>Liste des Garages</h2>";
echo "<ul>";
foreach ($garages as $garage) {
    echo "<li>
            <button class='view-garage' data-id='{$garage['id']}'>{$garage['title']}</button>
         </li>";
}
echo "</ul>";
?>

<script>
    $(".view-garage").click(function() {
        let garageId = $(this).data("id");
        $(".dynamic-div").load(`customs/editGarage.php?garageId=${garageId}`);
    });
</script>