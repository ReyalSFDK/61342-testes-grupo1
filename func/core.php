<?php

// Get Database
require_once("database.php");

/**
 * Retorna um cabeçalho HTML
 *
 * @param string $title
 * @return string
 */
function setHeader(string $title) {
    return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

            <title>'. $title.'</title>
        </head>';
}

/**
 * Pega o conteudo da pagina de lista
 *
 * @return array|bool|mysqli_result
 */
function getIndexContent() {
    global $conn;

    $sql = "SELECT * FROM collectors ORDER BY registration";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}