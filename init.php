<?php

$mysqli = new mysqli('localhost', 'root', '', 'iutfacemash');

// Vérifier la connexion
if ($mysqli->connect_errno) {
    echo "Échec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
