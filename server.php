<?php
header('Content-Type: application/json');

// -------------------------------
// CONFIGURE SEU SECRET TOTP AQUI
// -------------------------------
$secret = "VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"; // exemplo do Twilio

// Converte Base32 para binário
function base32_decode_custom($b32)
{
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $out = "";
    $buffer = 0;
    $bitsLeft = 0;

    $b32 = strtoupper($b32);

    foreach (str_split($b32) as $char) {
        if ($char === '=') break;

        $value = strpos($alphabet, $char);
        if ($value === false) continue;

        $buffer = ($buffer << 5) | $value;
        $bitsLeft += 5;

        if ($bitsLeft >= 8) {
            $bitsLeft -= 8;
            $out .= chr(($buffer >> $bitsLeft) & 0xFF);
        }
    }
    return $out;
}

// HMAC TOTP (30 segundos)
function generate_totp($secret)
{
    $timeStep = 30;
    $counter = floor(time() / $timeStep);

    $secretKey = base32_decode_custom($secret);
    $binaryCounter = pack("N*", 0) . pack("N*", $counter);

    $hash = hash_hmac('sha1', $binaryCounter, $secretKey, true);

    $offset = ord($hash[19]) & 0xf;
    $code = (
        ((ord($hash[$offset]) & 0x7f) << 24) |
        ((ord($hash[$offset + 1]) & 0xff) << 16) |
        ((ord($hash[$offset + 2]) & 0xff) << 8) |
        (ord($hash[$offset + 3]) & 0xff)
    );

    $totp = $code % 1000000;
    return str_pad($totp, 6, '0', STR_PAD_LEFT);
}

$token = generate_totp($secret);

echo json_encode([
    "token" => $token
]);
