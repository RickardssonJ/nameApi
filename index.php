<?php
//Steg1

/////////////// HEADERS /////////////////
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Referrer-Policy: no-referrer");

//steg2
/////////////// ARRAYS /////////////////

$genders = ["male", "female"];

$firstNameArrays = [
    "male" => ['Robert', 'Tommy', 'Adam', 'Hugo', 'Rolf', 'Oskar', 'Jimmy', 'Björn', 'Georgios', 'Özgür'],
    "female" => ['Åsa', 'Kerstin', 'Elisabeth', 'Carina', 'Kristina', 'Johanna', 'Emelie', 'Pia', 'Lisbeth', 'Nina']
];

$lastNames = ["Öberg", "Rickardsson", "Andersson", "Åkesson", "strandbark", "Hermansson", "Thorsman", "Jigvall", "Honkanen", "widström"];

$names = array();

/////////////// FUNCTIONS /////////////////

function replaceSpecialCharacters($string)
{
    return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
}

function generateEmail($firstname, $lastname)
{
    $firstname = replaceSpecialCharacters($firstname);
    $lastname = replaceSpecialCharacters($lastname);

    $firstTwoLetters = substr($firstname, 0, 2);
    $firstThreeLetters = substr($lastname, 0, 3);

    $email = strtolower($firstTwoLetters) . strtolower($firstThreeLetters) . "@exempel.com";
    return $email;
}


//Steg3
/////////////// CODE TO GENERATE AND PUSH THE NEW USER /////////////////


for ($i = 0; $i < 10; $i++) {

    $gender = $genders[rand(0, 1)];
    //Beroende på om $gender är male eller female så slumpas ett förnamn fram i från $firstNameArrays med (keyn) male eller female.
    $firstName = $firstNameArrays[$gender][rand(0, 9)];
    $lastName = $lastNames[rand(0, 9)];

    $name = array(
        "Firstname" => $firstName,
        "Lastname" => $lastName,
        "Gender" => $gender,
        $age = "Age" => rand(1, 100),
        "Email" => generateEmail($firstName, $lastName)

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
