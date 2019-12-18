<?php
// Pega as funções do projeto
require_once("functions/core.php");

// Executa 20.001 inserções no banco de dados
$i = 0;
$sql = "
        INSERT INTO 
            collectors
        (fullName, birthDay, phone, email, cpf)
            VALUES
";
while ($i <= 20000) {
    $i++;
    $sql .= "
        ('BOT-$i [FDK] ', '2000-01-01', '71970707070', 'bot-$i@fdk.com', '123456$i'),
    ";
}
$sql .= "
    ('BOT-LAST [FDK] ', '2000-01-01', '71970707070', 'bot--$i@fdk.com', '123459$i')
";

$query = mysqli_query($conn, $sql)  or die(mysqli_error($conn));
