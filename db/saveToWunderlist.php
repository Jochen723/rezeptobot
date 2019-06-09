<?php
 header("Content-Type: text/html; charset=utf-8");



$json = $_POST['event'];

$test = json_decode($json);

foreach ($test as $t) {
/*
$empfaenger = "me@wunderlist.com";
$betreff = $t;
$from = "jonaskortum@googlemail.com";
$text = "";
*/

$empfaenger = "me@wunderlist.com";
$betreff = $t;
$from = "From: Jonas Kortum <jonaskortum@googlemail.com>";
$text = $t;
mail($empfaenger, $betreff, $text, $from);
echo $t;
}

?>
