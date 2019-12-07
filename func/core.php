<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "ucolec";
$conn  = new MySQLi($host, $user, $pass, $database );

if($conn ->connect_error){
    echo "Desconectado! Erro: " . $mysqli_connection->connect_error;
}