<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '/path/to/vendor/autoload.php';
use Twilio\Rest\Client;

$sid    = "AC43ebd4aa00d8a466a07cbb0c125a3ba1";
$token  = "a6d533dbc8c29f09796127dc55386973";
$twilio = new Client($sid, $token);

$verification = $twilio->verify->v2->services("VAba0c04e2fc3d6f716d8961e5eaf59e79")
                                   ->verifications
                                   ->create("+5511948793902", "sms");

print($verification->sid);
