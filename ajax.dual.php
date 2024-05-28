<?php
require_once('init.php'); // Assurez-vous que le chemin est correct

// Exécute une requête pour obtenir deux enregistrements aléatoires de la table "photos"
$qGet = $mysqli->query('SELECT token, name, path, score FROM photos ORDER BY RAND() LIMIT 2');

// Initialise un tableau pour stocker les données récupérées de la requête
$rows = array();

// Parcourt les résultats de la requête et les stocke dans le tableau $rows
while ($dGet = $qGet->fetch_object()) {
    $rows[] = $dGet;
}
?>
<div class="faces">
    <img src="<?php echo htmlspecialchars($rows[0]->path); ?>" alt="<?php echo htmlspecialchars($rows[0]->name); ?>" class="photos" data-token="<?php echo htmlspecialchars($rows[0]->token); ?>" data-score="<?php echo htmlspecialchars($rows[0]->score); ?>" width="266" height="400">
    <ul>
        <li><?php echo htmlspecialchars($rows[0]->name); ?></li>
        <li><?php echo number_format($rows[0]->score, 0, ',', ' '); ?></li>
    </ul>
</div>
<p id="middle">OR</p>
<div class="faces">
    <img src="<?php echo htmlspecialchars($rows[1]->path); ?>" alt="<?php echo htmlspecialchars($rows[1]->name); ?>" class="photos" data-token="<?php echo htmlspecialchars($rows[1]->token); ?>" data-score="<?php echo htmlspecialchars($rows[1]->score); ?>" width="266" height="400">
    <ul>
        <li><?php echo htmlspecialchars($rows[1]->name); ?></li>
        <li><?php echo number_format($rows[1]->score, 0, ',', ' '); ?></li>
    </ul>
</div>
