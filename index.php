<?php
$client = isset($_COOKIE['client_id']) ? $_COOKIE['client_id'] : 'clienta';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Tool4cars</title>
</head>
<body>
    <h1>Bienvenue sur Tool4cars</h1>

    <!-- Sélecteur de client -->
    <label for="client-select">Changer de client :</label>
    <select id="client-select">
        <option value="clienta" <?= $client === 'clienta' ? 'selected' : '' ?>>Client A</option>
        <option value="clientb" <?= $client === 'clientb' ? 'selected' : '' ?>>Client B</option>
        <option value="clientc" <?= $client === 'clientc' ? 'selected' : '' ?>>Client C</option>
    </select>

    <?php
    // Si le client est "clientb", afficher le sélecteur de module
    if ($client === 'clientb') {
        echo '<br>';
        echo '<label for="module-select">Choisir un module : </label>';
        echo '<select id="module-select">';
        echo '<option value="cars">Voitures</option>';
        echo '<option value="garages">Garages</option>';
        echo '</select>';
    }
    ?>

    <div class="dynamic-div" data-module="cars" data-script="ajax" data-client="<?= $client ?>">
    </div>
</body>
</html>

<script>
    $(document).ready(function() {
        function loadContent(client) {
            let module = $(".dynamic-div").data("module");
            let script = $(".dynamic-div").data("script");
            let url = `customs/${client}/modules/${module}/${script}.php`;

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $(".dynamic-div").html(response);
                },
                error: function() {
                    $(".dynamic-div").html("<p>Erreur de chargement du module.</p>");
                }
            });
        }

        // Charger le contenu initial
        let client = $(".dynamic-div").data("client");
        loadContent(client);

        // Changer de client et recharger la page
        $("#client-select").change(function() {
            let newClient = $(this).val();
            document.cookie = "client_id=" + newClient + "; path=/";
            location.reload();
        });

        $("#module-select").change(function() {
            let module = $(this).val();
            let client = $(".dynamic-div").data("client");
            $(".dynamic-div").attr("data-module", module);
            $(".dynamic-div").load(`customs/${client}/modules/${module}/ajax.php`);
        });
    });
</script>
