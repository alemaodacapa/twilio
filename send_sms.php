<?php
header('Content-Type: application/json');

$phone = $_POST['phone'] ?? null;
if (!$phone) { echo json_encode(['error'=>'+17624380440']); exit; }

$accountSid = getenv('ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa') ?: '';
$authToken  = getenv('a6aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa') ?: '';
$verifySid  = getenv('VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa') ?: '';

if (!$accountSid || !$authToken || !$verifySid) {
    echo json_encode(['error'=>'Twilio credentials not configured on server. Set TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN and TWILIO_VERIFY_SID.']);
    exit;
}

$autoload = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoload)) {
    echo json_encode(['error'=>'vendor/autoload.php not found. Run: composer require twilio/sdk']);
    exit;
}

require $autoload;
use Twilio\\Rest\\Client;

$client = new Client($accountSid, $authToken);

try {
    $verification = $client->verify->v2->services($verifySid)->verifications->create($phone, 'sms');
    echo json_encode(['status'=>'sent','sid'=>$verification->sid]);
} catch (Exception $e) {
    echo json_encode(['error'=>$e->getMessage()]);
}
?>
