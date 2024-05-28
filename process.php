<?php
if (
    isset($_POST['winner'], $_POST['looser'], $_POST['wScore'], $_POST['lScore'])
) {
    function calculatePageRank($mysqli)
    {
        // Récupère toutes les photos et leurs scores actuels
        $qGetPhotos = $mysqli->query('SELECT token, score FROM photos');
        $photos = [];
        while ($photo = $qGetPhotos->fetch_object()) {
            $photos[$photo->token] = $photo->score;
        }

        // Initialise un tableau pour stocker le PageRank de chaque photo
        $pageRanks = array_fill_keys(array_keys($photos), 0);

        // Calcule le PageRank itérativement
        $iterations = 10; // Nombre d'itérations
        $dampingFactor = 0.85; // Facteur d'amortissement
        for ($i = 0; $i < $iterations; $i++) {
            foreach ($photos as $token => $score) {
                // Récupère tous les liens entrants pour la photo actuelle
                $qGetLinks = $mysqli->query('SELECT COUNT(*) AS links FROM photos WHERE token <> "' . $mysqli->real_escape_string($token) . '" AND score < ' . (int)$score);
                $links = $qGetLinks->fetch_object()->links;

                // Calcule la contribution des liens entrants au PageRank de la photo
                $contribution = 0;
                foreach ($photos as $otherToken => $otherScore) {
                    if ($otherToken !== $token && $otherScore < $score) {
                        // Calcul de la contribution du lien
                        $contribution += $pageRanks[$otherToken] / $links;
                    }
                }

                // Met à jour le PageRank de la photo
                $pageRanks[$token] = (1 - $dampingFactor) + $dampingFactor * $contribution;
            }
        }

        // Met à jour les scores des photos avec les PageRanks calculés
        foreach ($photos as $token => $score) {
            $newScore = $pageRanks[$token] * 1000; // Multiplication arbitraire pour ajuster l'échelle
            $mysqli->query('UPDATE photos SET score = ' . (int)$newScore . ' WHERE token = "' . $mysqli->real_escape_string($token) . '"');
        }
    }

    // Met à jour les scores en utilisant l'algorithme PageRank
    calculatePageRank($mysqli);
}
?>
