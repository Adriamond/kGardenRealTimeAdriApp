<?php

ignore_user_abort();
ob_start();

$url = 'https://fcm.googleapis.com/fcm/send';

$Token = 'eqdGaPHh0Ks:APA91bEa8k6cvMX_5KzJ4VJdNQkpTDIPXOkeKAlVl1BwwLbRJ4jpr5Tgx1ffvnYQgqZ0Pyn7bnPMa3TIoGGNyUvXZrDYFYNEXTu5gC6tZE26jM9TlBbixW6upRoS2KTawKfIzmaRWiAe';

$fields = array('to' => $Token,
    'data' => array('mensaje' => 'Mesa-silla-escritorio'));

define('GOOGLE_API_KEY', 'AIzaSyCN4usOxd_J967LpUI6HlF083peto1TqBE');

$headers = array(
    'Authorization:key=' . GOOGLE_API_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

$result = curl_exec($ch);
if ($result === false)
    die('Curl failed ' . curl_error());
curl_close($ch);
return $result;
?>