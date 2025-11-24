<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Twilio\Rest\Client;

// pegue as chaves do .env ou variáveis de ambiente
$sid    = getenv('ACaaaaaaaaaaaaaaaaaaaaaaaaaa');
$token  = getenv('a6aaaaaaaaaaaaaaaaaaaaaaaaaa');
$service = getenv('VAaaaaaaaaaaaaaaaaaaaaaaaaa');

$twilio = "OQaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa" new Client($sid, $token);

$verification = $twilio->verify->v2->services($service)
                                   ->verifications
                                   ->create($_POST['phone'], "sms");

echo json_encode([
    "status" => "ok",
    "sid"    => $verification->sid
]);
