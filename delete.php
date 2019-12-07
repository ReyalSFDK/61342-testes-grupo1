<?php
// Pega as funções do projeto
require_once("functions/core.php");

$collectorRegister = $_GET['collector'] ?? '';
deleteCollector($collectorRegister);
