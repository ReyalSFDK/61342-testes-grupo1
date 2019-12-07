<?php
session_start();

// Get Database
require_once("database.php");

// Constants
const SESSION_ALERT = 'SESSION_ALERT';
const ALERT_ERROR = 'danger';
const ALERT_SUCCESS = 'success';

/**
 * Adiciona um alert na sessão
 *
 * @param string $alertType
 * @param string $alertText
 */
function setAlert(string $alertType, string $alertText) {
    $alert = [$alertType, $alertText];

    $_SESSION[SESSION_ALERT][] = $alert;
}

/**
 * Mostra o alerta na tela
 */
function showAlerts() {
    if (isset($_SESSION[SESSION_ALERT])) {
        foreach ($_SESSION[SESSION_ALERT] as $alert) {
            echo '
            <div class="alert alert-'.$alert[0].'">
                '.$alert[1].'
            </div>
        ';
        }

        $_SESSION[SESSION_ALERT] = [];
    }
}

/**
 * Exibe um cabeçalho HTML
 *
 * @param string $title
 */
function setHeader(string $title) {
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="styles/custom.css">

            <title>'. $title.'</title>
        </head>';
}

/**
 * Mostra a navbar
 *
 * @return string
 */
function setNavBar() {
    echo '
        <nav class="navbar navbar-dark bg-dark nav center color">
            <img class="img" src="https://imagens.viajonarios.com.br/2015/08/1425952800170.jpeg" alt="Logo Colecionadores">
        </nav>
    ';
}

function setJavaScripts() {
    return '
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    ';
}

/**
 * Pega o conteudo da pagina de lista
 *
 * @return array|bool|mysqli_result
 */
function getAllCollectors() {
    global $conn;

    $sql = "SELECT * FROM collectors ORDER BY registration";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return mysqli_fetch_assoc($result);
}

/**
 * Deleta um colecionador do banco
 *
 * @param string $collectorRegistration
 */
function deleteCollector(string $collectorRegistration) {
    global $conn;

    $sql = "DELETE FROM collectors WHERE registration=$collectorRegistration";
    $result = mysqli_query($conn, $sql);;

    if ($result) {
        setAlert(
            ALERT_SUCCESS,
            'O colecionador foi deletado com sucesso'
        );
    } else {
        setAlert(
            ALERT_ERROR,
            'Houve um erro ao apagar o colecionador'
        );
    }

    header('Location: index.php');
}