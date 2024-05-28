<?php
require_once('init.php'); // Assurez-vous que le nom du fichier est entre guillemets

if (isset($_POST['done'])) {
    $folder = 'photos/'; // Correctif : "folder" a été corrigé en "floder"
    $ext = '.jpg';
    $name = $mysqli->real_escape_string($_POST['name']); // Utilisation de real_escape_string() au lieu de mysql_real_escape_string()
    $mysqli->query('INSERT INTO photos
        SET token = "' . md5($name . 'FacemashLouistiti') . '",
            name = "' . $name . '",
            path = "' . $folder . strtolower($name) . $ext . '"'); // Correctif : ajout d'une virgule après chaque champ dans la requête SQL
    header('Location: add.php');
    exit;
}
?>
<form action="" method="post">
    <input type="text" name="name" placeholder="Nom de l'image">
    <button type="submit" name="done">Add</button>
</form>
