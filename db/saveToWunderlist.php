<?php
 header("Content-Type: text/html; charset=utf-8");

$json = $_POST['event'];
$test = json_decode($json);
$apikey = "bv-8BnbkuzzdvdBAQECCSn";
$event  = "rezeptobot";

 foreach ($test as $t) {
     $value1 = $t;
     $ch = curl_init();

     $postdata = json_encode([
         "value1" => $value1
     ]);

     $header = array();
     $header[] = "Content-Type: application/json";

     curl_setopt($ch,CURLOPT_URL, "https://maker.ifttt.com/trigger/$event/with/key/$apikey");
     curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
     curl_setopt($ch,CURLOPT_POST, 1);
     curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
     curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

     $result = curl_exec($ch);
     sleep(2);
 }

curl_close($ch);
?>