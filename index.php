<?php
//Steg1
header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Referrer-Policy: no-referrer");

//steg2
$firstNames = ["Åsa", "Jimmy", "Anders", "NIsse", "Björn", "F6", "F7", "F8", "F9", "F10"];
$lastNames = ["Öberg", "Rickardsson", "Andersson", "Åkesson", "L5", "L6", "L7", "L8", "L9", "L10"];

//Steg3
$names = array();

for ($i = 0; $i < 10; $i++) {
    $name = array(
        "firstname" => $firstNames[rand(0, 9)],
        "lastname" => $lastNames[rand(0, 9)]
    );
    array_push($names, $name);
}

//Steg 4 – Konvertera PHP-arrayen ($names) till JSON
$json = json_encode(
    $names,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

//Steg5
// OBS!
// Ingen extra data får skickas till klienten,
// t.ex. HTML-kod
echo $json;
