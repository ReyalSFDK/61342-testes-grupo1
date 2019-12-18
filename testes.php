<?php
// Pega as funções do projeto
require_once("functions/core.php");

// Cenário 1
//
// Alvo validateLength()
//
// Teste pra saber se o valor minimo está validando corretamente
//
// Parametros: "Maria", "Nome", 6, 10
// Resultado esperado: false
echo "Cenário 1: aprovado no teste? ";
var_dump(validateLength("Maria", "Nome", 6, 10) === false);
echo "<br>";

// Cenário 2
//
// Alvo validateLength()
//
// Teste pra saber se o valor esta sendo passado vazio
//
// Parametros: "", "", 0, 0
// Resultado esperado: false
echo "Cenário 2: aprovado no teste? ";
var_dump(validateLength("", "", 0, 20) === false);
echo "<br>";

// Cenário 3
//
// Alvo validateLength()
//
// Teste pra saber se o valor maximo está validando corretamente
//
// Parametros: "ChocoBag e LarvaGirl", "big bag", 6, 20
// Resultado esperado: false
echo "Cenário 3: aprovado no teste? ";
var_dump(validateLength("ChocoBag e LarvaGirl", "big bag", 6, 20) === false);
echo "<br>";

// Cenário 4
//
// Alvo validateBirthDay()
//
// Teste pra saber se a data de nascimeto é maior que atual
//
// Parametros: DateTime(),
// Resultado esperado: false
echo "Cenário 4: aprovado no teste? ";
$date = new DateTime();
$date->add(new DateInterval("P10D"));

var_dump(validateBirthDay($date) === false);
echo "<br>";


// Cenário 5
//
// Alvo validateCollector()
//
// Testa se o colecionador é valido
//
// Parametros: "Thais Maia", DateTime(1998-08-12), "71984848587", "maia_tha@gail.com", "1234587987"
//
// Resultado esperado: false
echo "Cenário 5: aprovado no teste? ";
var_dump(
    validateCollector(
        "Thais Maia",
        new DateTime('1998-08-12'),
        "71984848587",
        "maia_tha@gail.com",
        "1234587987"
        ) === false
);
echo "<br>";
