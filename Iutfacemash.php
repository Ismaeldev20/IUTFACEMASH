<?php 
require_once('init.php'); 
require_once('process.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facemash</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <!-- Ajout de l'élément audio pour le son -->
    <audio id="clickSound" src="./Naruto.mp3"></audio>

    <header>
        <h1>IUT Facemash</h1>
    </header>
    <p id="first">Were we let for our looks? No. Will we be judged on them? Yes</p>
    <p id="second">WHO'S Hotter? Click to Choose</p>
    <div id="dual">
        <?php require_once('ajax/ajax.dual.php'); ?>
    </div>
    <footer> Pictures From <a href="https://www.facebook.com" target="_blank">Facebook</a></footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(".photos").click(function() {
                // Jouer le son au clic sur une image
                document.getElementById('clickSound').play();
                
                // Afficher le loader
                $("#loader").fadeIn("fast");
                
                // Récupérer les données des images
                var tokenFirst = $(".faces:first-child .photos").attr("data-token"),
                    tokenSecond = $(".faces:last-child .photos").attr("data-token"),
                    scoreFirst = $(".faces:last-child .photos").attr("data-score"),
                    scoreSecond = $(".faces:last-child .photos").attr("data-score"),
                    winner,
                    looser,
                    wScore,
                    lScore;

                // Déterminer le gagnant et le perdant
                if (tokenFirst == $(this).attr("data-token")) {
                    winner = tokenFirst;
                    looser = tokenSecond;
                    wScore = scoreFirst;
                    lScore = scoreSecond;
                } else {
                    winner = tokenSecond;
                    looser = tokenFirst;
                    wScore = scoreSecond;
                    lScore = scoreFirst;
                }

                // Envoyer les données via AJAX
                $.ajax({
                    type: "post",
                    url: "iutfacemash.php",
                    data: "winner=" + winner + "&looser=" + looser + "&wScore=" + wScore + "&lScore=" + lScore,
                    cache: false,
                    success: function(data) {
                        $("body").html(data);
                        $("#loader").fadeOut("fast");
                    }
                });
            });
        });
    </script> 
</body>
</html>
