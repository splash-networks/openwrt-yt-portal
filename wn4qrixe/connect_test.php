<?php

$mac = "70:8a:09:65:4d:ec";
$apmac = "70:8a:09:65:4d:ec";
$venue_id = "1025";
$method = "sms";
$fname = "Nasir";
$lname = "Hafeez";
$phone = "12345789";
$email = "n@n.com";
//$last_updated = date("Y-m-d H:i:s");

$target = "https://backend.nasirhafeez.com/api/captive";

$postData = [
  "mac" => $mac,
  "ap" => $apmac,
  "venue_id" => $venue_id,
  "fname" => $fname,
  "lname" => $lname,
  "email" => $email,
  "phone" => $phone,
  "method" => $method
];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $target,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if ($response !== false) {
  $json = json_decode($response, true);
  print_r($json);
//  if ($json['errorCode'] == 0) {
//    echo "Success!";
//  }
}
else {
  die("Error: check with your network administrator");
}

?>

